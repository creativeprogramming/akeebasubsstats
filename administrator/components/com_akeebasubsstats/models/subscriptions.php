<?php
/**
 * @package            Akeeba Subscriptions Stats
 * @version            0.1.0
 *
 * @author             Peter van Westen <peter@nonumber.nl>
 * @link               http://www.nonumber.nl
 * @copyright          Copyright © 2012 NoNumber All Rights Reserved
 * @license            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Default Model
 */
class AkeebaSubsStatsModelSubscriptions extends JModelList
{
	var $all_levels = array();
	var $levels = array();

	/**
	 * Get data
	 */
	public function getData()
	{
		$db = JFactory::getDBO();

		$data = array();

		$level = JFactory::getApplication()->input->getString('level', '');
		$query = $db->getQuery(true);
		$query->select('l.title')
			->from('#__akeebasubs_levels as l')
			->where('enabled = 1')
			->order('l.ordering ASC');
		$db->setQuery($query);
		$this->all_levels = $db->loadColumn();
		$data['levels'] = $this->all_levels;
		if ($level) {
			$query->where('l.title = ' . $db->q($level));
			$db->setQuery($query);
			$this->levels = $db->loadColumn();
		} else {
			$this->levels = $this->all_levels;
		}

		$today = new DateTime();
		$today->setDate(gmdate('Y'), gmdate('m'), gmdate('d'));
		$today->setTime(0, 0, 0);

		$to = clone $today;
		$to->modify('+1 day');

		// BY DAY
		$max = 31;
		$from = clone $to;
		$from->modify('-' . $max . ' days');

		$query = $this->buildQuery('DATE(s.created_on)', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$data['day'] = $this->fillEmptyDates($rows, 'day', $from, $to, 'Y-m-d', 'd M (D)', 'Y-m-d');

		// BY WEEK
		$max = 52;
		$diff = 8 - $to->format('N');
		$to->modify('+' . $diff . ' days');
		$from = clone $to;
		$from->modify('-' . $max . ' weeks');

		$query = $this->buildQuery('CONCAT(YEAR(s.created_on), "-", WEEK(s.created_on, 3))', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$data['week'] = $this->fillEmptyDates($rows, 'week', $from, $to, 'Y-W', 'W', 'W');

		// BY MONTH
		$max = 25;
		$to->setDate(gmdate('Y'), gmdate('m'), 1);
		$to->modify('+1 month');
		$from = clone $to;
		$from->modify('-' . $max . ' months');

		$query = $this->buildQuery('CONCAT(YEAR(s.created_on), "-", MONTH(s.created_on))', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$data['month'] = $this->fillEmptyDates($rows, 'month', $from, $to, 'Y-n', 'M', 'M (Y)');

		// BY YEAR
		$max = 5;
		$to->setDate(gmdate('Y'), 1, 1);
		$to->modify('+1 year');
		$from = clone $to;
		$from->modify('-' . $max . ' years');

		$query = $this->buildQuery('YEAR(s.created_on)', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$data['year'] = $this->fillEmptyDates($rows, 'year', $from, $to, 'Y', 'Y', 'Y');

		return $data;
	}

	public function buildQuery($id, $from, $to)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('DATE(s.created_on) as d')
			->select($id . ' as id')
			->select('l.title as level')
			->select('COUNT(*) as count')
			->select('SUM(net_amount) as amount')
			->from('#__akeebasubs_subscriptions as s')
			->join('LEFT', '#__akeebasubs_levels as l ON l.akeebasubs_level_id = s.akeebasubs_level_id')
			->where('s.state = ' . $db->q('C'))
			->where('s.net_amount > 0')
			->where('s.created_on > ' . $db->q($from->format('Y-m-d')))
			->where('s.created_on < ' . $db->q($to->format('Y-m-d')))
			->where('l.title IN (' . "'" . implode("','", $this->levels) . "'" . ')')
			->group('level')->group('d')
			->order('s.created_on ASC');
		return $query;
	}

	public function fillEmptyDates($rows, $by, &$from, &$to, $format_id = 'Y-m-d', $format_date = 'd M (D)', $format_label = '')
	{
		$newrows = array();
		foreach ($this->levels as $level) {
			if (!isset($newrows[$level])) {
				$newrows[$level] = array();
			}
		}

		$first = 0;
		foreach ($rows as $row) {
			if (!$first) {
				$first = $row->d;
			}
			if (!isset($newrows[$row->level])) {
				$newrows[$row->level] = array();
			}
			if (!isset($newrows[$row->level][$row->id])) {
				$newrows[$row->level][$row->id]->id = $row->id;
				$newrows[$row->level][$row->id]->count = $row->count;
				$newrows[$row->level][$row->id]->amount = $row->amount;
				$newrows[$row->level][$row->id]->days = 1;
			} else {
				$newrows[$row->level][$row->id]->count += $row->count;
				$newrows[$row->level][$row->id]->amount += $row->amount;
				$newrows[$row->level][$row->id]->days++;
			}
		}
		$data = array();
		foreach ($newrows as $level => $rows) {
			$data[$level] = array();

			$date = clone $from;
			while ($date->format('Y-m-d') < $to->format('Y-m-d')) {
				$current = clone $date;
				$date->modify('+1 ' . $by);
				if ($first >= $date->format('Y-m-d')) {
					continue;
				}
				if ($by == 'week') {
					$d = $current->format('Y-') . ((int) $current->format('W'));
				} else {
					$d = $current->format($format_id);
				}
				if (isset($rows[$d])) {
					$dat = $rows[$d];
				} else {
					$dat = new stdClass;
					$dat->id = $d;
					$dat->count = 0;
					$dat->amount = 0;
				}
				$dat->date = $current->format($format_date);
				if (
					($by == 'week' && ($current->format('W') >= 52 || $current->format('W') <= 1))
					|| ($by == 'month' && ($current->format('n') == 12 || $current->format('n') == 1))
				) {
					$dat->date .= $current->format(' (Y)');
				}
				$dat->label = $current->format($format_label);

				$dat->days = isset($dat->days) ? $dat->days : 0;

				$data[$level][] = $dat;
			}
		}
		return $data;
	}
}
