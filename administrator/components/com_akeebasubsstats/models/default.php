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
class AkeebaSubsStatsModelDefault extends JModelList
{
	var $levels = 0;
	var $countries = 0;
	var $all_countries = array(
		'AD' => 'Andorra', 'AE' => 'United Arab Emirates', 'AF' => 'Afghanistan',
		'AG' => 'Antigua and Barbuda', 'AI' => 'Anguilla', 'AL' => 'Albania',
		'AM' => 'Armenia', 'AN' => 'Netherlands Antilles', 'AO' => 'Angola',
		'AQ' => 'Antarctica', 'AR' => 'Argentina', 'AS' => 'American Samoa',
		'AT' => 'Austria', 'AU' => 'Australia', 'AW' => 'Aruba',
		'AX' => 'Aland Islands', 'AZ' => 'Azerbaijan', 'BA' => 'Bosnia and Herzegovina',
		'BB' => 'Barbados', 'BD' => 'Bangladesh', 'BE' => 'Belgium',
		'BF' => 'Burkina Faso', 'BG' => 'Bulgaria', 'BH' => 'Bahrain',
		'BI' => 'Burundi', 'BJ' => 'Benin', 'BL' => 'Saint Barthélemy',
		'BM' => 'Bermuda', 'BN' => 'Brunei Darussalam', 'BO' => 'Bolivia, Plurinational State of',
		'BR' => 'Brazil', 'BS' => 'Bahamas', 'BT' => 'Bhutan', 'BV' => 'Bouvet Island',
		'BW' => 'Botswana', 'BY' => 'Belarus', 'BZ' => 'Belize', 'CA' => 'Canada',
		'CC' => 'Cocos (Keeling) Islands', 'CD' => 'Congo, the Democratic Republic of the',
		'CF' => 'Central African Republic', 'CG' => 'Congo', 'CH' => 'Switzerland',
		'CI' => 'Cote d\'Ivoire', 'CK' => 'Cook Islands', 'CL' => 'Chile',
		'CM' => 'Cameroon', 'CN' => 'China', 'CO' => 'Colombia', 'CR' => 'Costa Rica',
		'CU' => 'Cuba', 'CV' => 'Cape Verde', 'CX' => 'Christmas Island', 'CY' => 'Cyprus',
		'CZ' => 'Czech Republic', 'DE' => 'Germany', 'DJ' => 'Djibouti', 'DK' => 'Denmark',
		'DM' => 'Dominica', 'DO' => 'Dominican Republic', 'DZ' => 'Algeria',
		'EC' => 'Ecuador', 'EE' => 'Estonia', 'EG' => 'Egypt', 'EH' => 'Western Sahara',
		'ER' => 'Eritrea', 'ES' => 'Spain', 'ET' => 'Ethiopia', 'FI' => 'Finland',
		'FJ' => 'Fiji', 'FK' => 'Falkland Islands (Malvinas)', 'FM' => 'Micronesia, Federated States of',
		'FO' => 'Faroe Islands', 'FR' => 'France', 'GA' => 'Gabon', 'GB' => 'United Kingdom',
		'GD' => 'Grenada', 'GE' => 'Georgia', 'GF' => 'French Guiana', 'GG' => 'Guernsey',
		'GH' => 'Ghana', 'GI' => 'Gibraltar', 'GL' => 'Greenland', 'GM' => 'Gambia',
		'GN' => 'Guinea', 'GP' => 'Guadeloupe', 'GQ' => 'Equatorial Guinea', 'GR' => 'Greece',
		'GS' => 'South Georgia and the South Sandwich Islands', 'GT' => 'Guatemala',
		'GU' => 'Guam', 'GW' => 'Guinea-Bissau', 'GY' => 'Guyana', 'HK' => 'Hong Kong',
		'HM' => 'Heard Island and McDonald Islands', 'HN' => 'Honduras', 'HR' => 'Croatia',
		'HT' => 'Haiti', 'HU' => 'Hungary', 'ID' => 'Indonesia', 'IE' => 'Ireland',
		'IL' => 'Israel', 'IM' => 'Isle of Man', 'IN' => 'India', 'IO' => 'British Indian Ocean Territory',
		'IQ' => 'Iraq', 'IR' => 'Iran, Islamic Republic of', 'IS' => 'Iceland',
		'IT' => 'Italy', 'JE' => 'Jersey', 'JM' => 'Jamaica', 'JO' => 'Jordan',
		'JP' => 'Japan', 'KE' => 'Kenya', 'KG' => 'Kyrgyzstan', 'KH' => 'Cambodia',
		'KI' => 'Kiribati', 'KM' => 'Comoros', 'KN' => 'Saint Kitts and Nevis',
		'KP' => 'Korea, Democratic People\'s Republic of', 'KR' => 'Korea, Republic of',
		'KW' => 'Kuwait', 'KY' => 'Cayman Islands', 'KZ' => 'Kazakhstan',
		'LA' => 'Lao People\'s Democratic Republic', 'LB' => 'Lebanon',
		'LC' => 'Saint Lucia', 'LI' => 'Liechtenstein', 'LK' => 'Sri Lanka',
		'LR' => 'Liberia', 'LS' => 'Lesotho', 'LT' => 'Lithuania', 'LU' => 'Luxembourg',
		'LV' => 'Latvia', 'LY' => 'Libyan Arab Jamahiriya', 'MA' => 'Morocco',
		'MC' => 'Monaco', 'MD' => 'Moldova, Republic of', 'ME' => 'Montenegro',
		'MF' => 'Saint Martin (French part)', 'MG' => 'Madagascar', 'MH' => 'Marshall Islands',
		'MK' => 'Macedonia, the former Yugoslav Republic of', 'ML' => 'Mali',
		'MM' => 'Myanmar', 'MN' => 'Mongolia', 'MO' => 'Macao', 'MP' => 'Northern Mariana Islands',
		'MQ' => 'Martinique', 'MR' => 'Mauritania', 'MS' => 'Montserrat', 'MT' => 'Malta',
		'MU' => 'Mauritius', 'MV' => 'Maldives', 'MW' => 'Malawi', 'MX' => 'Mexico',
		'MY' => 'Malaysia', 'MZ' => 'Mozambique', 'NA' => 'Namibia', 'NC' => 'New Caledonia',
		'NE' => 'Niger', 'NF' => 'Norfolk Island', 'NG' => 'Nigeria', 'NI' => 'Nicaragua',
		'NL' => 'Netherlands', 'NO' => 'Norway', 'NP' => 'Nepal', 'NR' => 'Nauru', 'NU' => 'Niue',
		'NZ' => 'New Zealand', 'OM' => 'Oman', 'PA' => 'Panama', 'PE' => 'Peru', 'PF' => 'French Polynesia',
		'PG' => 'Papua New Guinea', 'PH' => 'Philippines', 'PK' => 'Pakistan', 'PL' => 'Poland',
		'PM' => 'Saint Pierre and Miquelon', 'PN' => 'Pitcairn', 'PR' => 'Puerto Rico',
		'PS' => 'Palestinian Territory, Occupied', 'PT' => 'Portugal', 'PW' => 'Palau',
		'PY' => 'Paraguay', 'QA' => 'Qatar', 'RE' => 'Reunion', 'RO' => 'Romania',
		'RS' => 'Serbia', 'RU' => 'Russian Federation', 'RW' => 'Rwanda', 'SA' => 'Saudi Arabia',
		'SB' => 'Solomon Islands', 'SC' => 'Seychelles', 'SD' => 'Sudan', 'SE' => 'Sweden',
		'SG' => 'Singapore', 'SH' => 'Saint Helena, Ascension and Tristan da Cunha',
		'SI' => 'Slovenia', 'SJ' => 'Svalbard and Jan Mayen', 'SK' => 'Slovakia',
		'SL' => 'Sierra Leone', 'SM' => 'San Marino', 'SN' => 'Senegal', 'SO' => 'Somalia',
		'SR' => 'Suriname', 'ST' => 'Sao Tome and Principe', 'SV' => 'El Salvador',
		'SY' => 'Syrian Arab Republic', 'SZ' => 'Swaziland', 'TC' => 'Turks and Caicos Islands',
		'TD' => 'Chad', 'TF' => 'French Southern Territories', 'TG' => 'Togo',
		'TH' => 'Thailand', 'TJ' => 'Tajikistan', 'TK' => 'Tokelau', 'TL' => 'Timor-Leste',
		'TM' => 'Turkmenistan', 'TN' => 'Tunisia', 'TO' => 'Tonga', 'TR' => 'Turkey',
		'TT' => 'Trinidad and Tobago', 'TV' => 'Tuvalu', 'TW' => 'Taiwan',
		'TZ' => 'Tanzania, United Republic of', 'UA' => 'Ukraine', 'UG' => 'Uganda',
		'UM' => 'United States Minor Outlying Islands', 'US' => 'United States',
		'UY' => 'Uruguay', 'UZ' => 'Uzbekistan', 'VA' => 'Holy See (Vatican City State)',
		'VC' => 'Saint Vincent and the Grenadines', 'VE' => 'Venezuela, Bolivarian Republic of',
		'VG' => 'Virgin Islands, British', 'VI' => 'Virgin Islands, U.S.', 'VN' => 'Viet Nam',
		'VU' => 'Vanuatu', 'WF' => 'Wallis and Futuna', 'WS' => 'Samoa', 'YE' => 'Yemen',
		'YT' => 'Mayotte', 'ZA' => 'South Africa', 'ZM' => 'Zambia', 'ZW' => 'Zimbabwe'
	);

	/**
	 * Get data
	 */
	public function getData()
	{
		$db = JFactory::getDBO();

		$data = array();

		$today = new DateTime();
		$today->setDate(gmdate('Y'), gmdate('m'), gmdate('d'));
		$today->setTime(0, 0, 0);

		$to = clone $today;
		$to->modify('+1 day');

		$level = JFactory::getApplication()->input->getString('level', '');
		$query = $db->getQuery(true);
		$query->select('l.title')
			->from('#__akeebasubs_levels as l')
			->where('l.enabled = 1')
			->order('l.ordering ASC');
		$db->setQuery($query);
		$data['levels'] = $db->loadColumn();
		if ($level) {
			$query->where('l.title = ' . $db->q($level));
			$db->setQuery($query);
			$this->levels = $db->loadColumn();
		}

		// GET COUNTRIES
		$max = 5;
		$to->setDate(gmdate('Y'), 1, 1);
		$to->modify('+1 year');
		$from = clone $to;
		$from->modify('-' . $max . ' years');
		$country = JFactory::getApplication()->input->getString('country', '');
		$query = $db->getQuery(true);
		$query->select('u.country')
			->from('#__akeebasubs_subscriptions as s')
			->join('LEFT', '#__akeebasubs_users as u ON u.user_id = s.user_id')
			->where('s.state = ' . $db->q('C'))
			->where('s.net_amount > 0')
			->where('s.created_on > ' . $db->q($from->format('Y-m-d')))
			->where('s.created_on <= ' . $db->q($to->format('Y-m-d')))
			->where('u.country <> ' . $db->q(''))
			->group('u.country')
			->order('u.country ASC');
		$db->setQuery($query);
		$countries = $db->loadColumn();
		$data['countries'] = array();
		foreach ($countries as $c) {
			$data['countries'][$c] = isset($this->all_countries[$c]) ? $this->all_countries[$c] : $c;
		}
		asort($data['countries']);

		if ($country) {
			$query->where('u.country = ' . $db->q($country));
			$db->setQuery($query);
			$this->countries = $db->loadColumn();
		}

		$to = clone $today;
		$to->modify('+1 day');

		// PROJECTED
		$data['projected'] = new stdClass;
		$max = 90;
		$from = clone $to;
		$from->modify('-' . $max . ' days');

		$query = $this->buildQuery('DATE(s.created_on)', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$rows = $this->fillEmptyDates($rows, 'day', $from, $to);

		$count = 0;
		$amount = 0;
		$count_last = 0;
		$amount_last = 0;
		$ratio = 0;
		$i = 0;
		foreach ($rows as $row) {
			if ($row->id == gmdate('Y-m-d')) {
				$count_last = $row->count;
				$amount_last = $row->amount;
				continue;
			}
			$i++;
			$count += $row->count * $i;
			$amount += $row->amount * $i;
			$ratio += $i;
		}
		$data['projected']->count = $count / $ratio;
		$data['projected']->amount = $amount / $ratio;
		if ($amount_last > $data['projected']->amount) {
			$count += $count_last;
			$amount += $amount_last;
			$ratio += $i + 1;
			$data['projected']->count = $count / $ratio;
			$data['projected']->amount = $amount / $ratio;
			$data['projected']->add_count = 0;
			$data['projected']->add_amount = 0;
		} else {
			$data['projected']->add_count = max(0, $data['projected']->count - $count_last);
			$data['projected']->add_amount = $data['projected']->amount - $amount_last;
		}

		// BY DAY
		$max = 14;
		$from = clone $to;
		$from->modify('-' . $max . ' days');

		$query = $this->buildQuery('DATE(s.created_on)', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$data['day'] = $this->fillEmptyDates($rows, 'day', $from, $to, 'Y-m-d', 'd M (D)', 'Y-m-d');

		// BY WEEK
		$max = 13;
		$diff = 8 - $to->format('N');
		$to->modify('+' . $diff . ' days');
		$from = clone $to;
		$from->modify('-' . $max . ' weeks');

		$query = $this->buildQuery('CONCAT(YEAR(s.created_on), "-", WEEK(s.created_on, 3))', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$data['week'] = $this->fillEmptyDates($rows, 'week', $from, $to, 'Y-W', 'W', 'Y-m-d');

		// BY MONTH
		$max = 13;
		$to->setDate(gmdate('Y'), gmdate('m'), 1);
		$to->modify('+1 month');
		$from = clone $to;
		$from->modify('-' . $max . ' months');

		$query = $this->buildQuery('CONCAT(YEAR(s.created_on), "-", MONTH(s.created_on))', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$data['month'] = $this->fillEmptyDates($rows, 'month', $from, $to, 'Y-n', 'M', 'Y-m-d');

		// BY YEAR
		$max = 5;
		$to->setDate(gmdate('Y'), 1, 1);
		$to->modify('+1 year');
		$from = clone $to;
		$from->modify('-' . $max . ' years');

		$query = $this->buildQuery('YEAR(s.created_on)', $from, $to);
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$data['year'] = $this->fillEmptyDates($rows, 'year', $from, $to, 'Y', 'Y', 'Y-m-d');

		return $data;
	}

	public function buildQuery($id, $from, $to)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('DATE(s.created_on) as d')
			->select('YEAR(s.created_on) as dy')->select('MONTH(s.created_on) as dm')->select('WEEK(s.created_on, 3) as dw')->select('DAY(s.created_on) as dd')
			->select($id . ' as id')
			->select('COUNT(*) as count')
			->select('SUM(net_amount) as amount')
			->from('#__akeebasubs_subscriptions as s')
			->where('s.state = ' . $db->q('C'))
			->where('s.net_amount > 0')
			->where('s.created_on > ' . $db->q($from->format('Y-m-d')))
			->where('s.created_on <= ' . $db->q($to->format('Y-m-d')))
			->group('d')
			->order('s.created_on ASC');
		if ($this->levels) {
			$query->join('LEFT', '#__akeebasubs_levels as l ON l.akeebasubs_level_id = s.akeebasubs_level_id');
			$query->where('l.title IN (' . "'" . implode("','", $this->levels) . "'" . ')');
		}
		if ($this->countries) {
			$query->join('LEFT', '#__akeebasubs_users as u ON u.user_id = s.user_id');
			$query->where('u.country IN (' . "'" . implode("','", $this->countries) . "'" . ')');
		}
		return $query;
	}

	public function fillEmptyDates($rows, $by, &$from, &$to, $format_id = 'Y-m-d', $format_date = 'd M (D)', $format_label = '')
	{
		$newrows = array();
		foreach ($rows as $row) {
			if ($by == 'week') {
				if ($row->dm == 12 && $row->dw == 1) {
					$row->id = ($row->dy + 1) . '-' . $row->dw;
				}
			}
			if (!isset($newrows[$row->id])) {
				$newrows[$row->id]->id = $row->id;
				$newrows[$row->id]->count = $row->count;
				$newrows[$row->id]->amount = $row->amount;
				$newrows[$row->id]->days = 1;
			} else {
				$newrows[$row->id]->count += $row->count;
				$newrows[$row->id]->amount += $row->amount;
				$newrows[$row->id]->days++;
			}
		}
		$rows = $newrows;

		$data = array();
		$start = 0;
		$date = clone $from;
		while ($date->format('Y-m-d') < $to->format('Y-m-d')) {
			$current = clone $date;
			$date->modify('+1 ' . $by);
			if ($by == 'week') {
				if ($current->format('m') == 12 && (int) $current->format('W') == 1) {
					$d = ($current->format('Y') + 1) . '-' . (int) $current->format('W');
				} else {
					$d = $current->format('Y-') . (int) $current->format('W');
				}
			} else {
				$d = $current->format($format_id);
			}
			if (isset($rows[$d])) {
				$dat = $rows[$d];
			} else {
				if (!$start) {
					continue;
				}
				$dat = new stdClass;
				$dat->id = $d;
				$dat->count = 0;
				$dat->amount = 0;
			}
			$dat->date = $current->format($format_date);
			if ($by == 'week') {
				$dat->date = (int) $dat->date;
			}
			if (
				($by == 'week' && ($dat->date >= 52 || $dat->date <= 1))
				|| ($by == 'month' && ($current->format('n') == 12 || $current->format('n') == 1))
			) {
				$dat->date .= ' (' . substr($d, 0, 4) . ')';
			}
			$dat->label = $current->format($format_label);

			$dat->days = isset($dat->days) ? $dat->days : 0;

			$data[] = $dat;
			$start = 1;
		}
		return $data;
	}

	function getLatest()
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('s.akeebasubs_subscription_id as id')
			->select('s.created_on as date')
			->select('s.net_amount as amount')
			->select('u.name as user')
			->select('au.akeebasubs_user_id as user_id')
			->select('au.country as country')
			->select('l.title as level')
			->from('#__akeebasubs_subscriptions as s')
			->join('LEFT', '#__users as u ON u.id = s.user_id')
			->join('LEFT', '#__akeebasubs_users as au ON au.user_id = s.user_id')
			->join('LEFT', '#__akeebasubs_levels as l ON l.akeebasubs_level_id = s.akeebasubs_level_id')
			->where('s.state = ' . $db->q('C'))
			->order('s.created_on DESC');
		$db->setQuery($query, 0, 14);
		$data = $db->loadObjectList();

		return $data;
	}

	function getOutputData(&$data, $by = 'day', $getnext = 0, $maxchart = 0, $maxtable = 0, $chartheight = 160)
	{
		$rows = $data[$by];
		// TABLE
		$rows = array_reverse($rows);
		if ($maxchart) {
			$rows = array_slice($rows, 0, $maxchart);
		}

		$total_count = 0;
		$total_amount = 0;
		$max_count = 0;
		$max_amount = 0;

		$trs = array();
		$first = 1;
		foreach ($rows as $i => $row) {
			$class = '';
			$text = $row->date;
			if ($first) {
				$current = new stdClass;
				$current->label = $row->label;

				$text_current = $row->date;
				$class = 'info';

				$totaldays = 1;
				$daysleft = 0;

				if ($getnext) {
					$next = new stdClass;
					$nextdate = new DateTime();
					$nextdate->setDate(gmdate('Y'), gmdate('m'), gmdate('d'));
					$nextdate->setTime(0, 0, 0);
					$nextdate->modify('+1 day');
					$totaldays_next = 1;
				}

				$text .= ' (' . JText::_('COM_AKEEBASUBSSTATS_CURRENT') . ')';

				switch ($by) {
					case 'day':
						$text = JText::_('COM_AKEEBASUBSSTATS_TODAY') . ' - ' . $text;

						$text_current = JText::_('COM_AKEEBASUBSSTATS_TODAY');

						if ($getnext) {
							$text_next = JText::_('COM_AKEEBASUBSSTATS_TOMORROW');
							$next->label = gmdate('Y-m-d', $nextdate->getTimestamp());
						}
						break;
					case 'week':
						$totaldays = 7;
						$daysleft = $totaldays - gmdate('N');

						if ($getnext) {
							$nextdate = new DateTime();
							$nextdate->setDate(gmdate('Y'), gmdate('m'), gmdate('d'));
							$nextdate->setTime(0, 0, 0);
							$nextdate->modify('+7 days');
							$totaldays_next = $totaldays;
							$text_next = gmdate('W', $nextdate->getTimestamp());
							$next->label = gmdate('Y-m-d', $nextdate->getTimestamp());
						}
						break;
					case 'month':
						$totaldays = gmdate('t');
						$daysleft = $totaldays - gmdate('j');

						if ($getnext) {
							$nextdate = new DateTime();
							$nextdate->setDate(gmdate('Y'), gmdate('m') + 1, 1);
							$totaldays_next = gmdate('t', $nextdate->getTimestamp());
							$text_next = gmdate('M', $nextdate->getTimestamp());
							$next->label = gmdate('Y-m-d', $nextdate->getTimestamp());
						}
						break;
					case 'year':
						$lastday = new DateTime();
						$lastday->setDate(gmdate('Y'), 12, 31);
						$lastday->setTime(0, 0, 0);
						$totaldays = gmdate('z', $lastday->getTimestamp());
						$daysleft = $totaldays - (gmdate('z') + 1);

						if ($getnext) {
							$nextdate = clone $lastday;
							$nextdate->modify('+1 year');
							$totaldays_next = gmdate('z', $nextdate->getTimestamp()) + 1;
							$nextdate->modify('-1 year');
							$nextdate->modify('+1 day');
							$text_next = gmdate('Y', $nextdate->getTimestamp());
							$next->label = gmdate('Y-m-d', $nextdate->getTimestamp());
						}
						break;
				}
				if ($by == 'day') {
					$current->count = max($row->count, $data['projected']->count);
					$current->amount = max($row->amount, $data['projected']->amount);
				} else {
					$current->count = $row->count + ($data['projected']->count * $daysleft) + $data['projected']->add_count;
					$current->amount = $row->amount + ($data['projected']->amount * $daysleft) + $data['projected']->add_amount;
				}

				if ($getnext) {
					$next->count = $data['projected']->count * $totaldays_next;
					$next->amount = $data['projected']->amount * $totaldays_next;

					$trs[] =
						'<tr class="warning ghosted">'
							. '<td>' . $text_next . ' (' . JText::_('COM_AKEEBASUBSSTATS_PROJECTED') . ')</td>'
							. ($by != 'day' ? ''
							. '<td class="count">' . round($next->count / $totaldays_next, 1) . '</td>'
							. '<td class="amount">€ ' . round($next->amount / $totaldays_next) . '</td>'
							: '')
							. '<td class="count">' . round($next->count) . '</td>'
							. '<td class="amount">€ ' . round($next->amount) . '</td>'
							. '</tr>';
				}

				if (round($current->amount) > round($row->amount) && round($current->count) <= round($row->count)) {
					$current->count = $row->count + 1;
				}
				if (round($current->count) > round($row->count) && round($current->amount) <= round($row->amount)) {
					$current->amount += (round($current->count) - round($row->count)) * 10;
				}

				$trs[] =
					'<tr class="warning ghosted">'
						. '<td>' . $text_current . ' (' . JText::_('COM_AKEEBASUBSSTATS_PROJECTED') . ')</td>'
						. ($by != 'day' ? ''
						. '<td class="count">' . round($current->count / $totaldays, 1) . '</td>'
						. '<td class="amount">€ ' . round($current->amount / $totaldays) . '</td>'
						: '')
						. '<td class="count">' . round($current->count) . '</td>'
						. '<td class="amount">€ ' . round($current->amount) . '</td>'
						. '</tr>';

				$max_count = max($max_count, round($current->count));
				$max_amount = max($max_amount, round($current->amount));
			}
			$trs[] =
				'<tr class="' . $class . '">'
					. '<td>' . $text . '</td>'
					. ($by != 'day' ? ''
					. '<td class="count">' . round($row->count / $row->days, 1) . '</td>'
					. '<td class="amount">€ ' . round($row->amount / $row->days) . '</td>'
					: '')
					. '<td class="count">' . round($row->count) . '</td>'
					. '<td class="amount">€ ' . round($row->amount) . '</td>'
					. '</tr>';

			if ($by == 'year') {
				$total_count += $row->count;
				$total_amount += $row->amount;
			}

			$max_count = max($max_count, round($row->count));
			$max_amount = max($max_amount, round($row->amount));

			$first = 0;
		}

		if ($maxtable) {
			$trs = array_slice($trs, 0, $maxtable);
		}

		if ($by == 'year') {
			if ($maxtable) {
				$trs = array_slice($trs, 0, $maxtable - 1);
			}
			$trs[] =
				'<tr class="success">'
					. '<td>' . JText::_('COM_AKEEBASUBSSTATS_TOTAL') . '</td>'
					. '<td class="count">' . round($total_count / $row->days, 1) . '</td>'
					. '<td class="amount">€ ' . round($total_amount / $row->days) . '</td>'
					. '<td class="count">' . round($total_count) . '</td>'
					. '<td class="amount">€ ' . round($total_amount) . '</td>'
					. '</tr>';
		}
		$table =
			'<table class="table table-striped">'
				. '<thead>'
				. '<th>' . JText::_('COM_AKEEBASUBSSTATS_' . strtoupper($by)) . '</th>'
				. ($by != 'day' ? ''
				. '<th class="right" colspan="2">' . JText::_('COM_AKEEBASUBSSTATS_AVERAGE') . '</th>'
				: '')
				. '<th class="right" colspan="2">' . JText::_('COM_AKEEBASUBSSTATS_SALES') . '</th>'
				. '</thead>'
				. '<tbody>'
				. implode('', $trs)
				. '</tbody>'
				. '</table>';

		// GRAPH
		$rows = array_reverse($rows);

		$chartdata = new stdClass;
		foreach ($rows as $i => $row) {
			$chartdata->count[] = '[\'' . $row->label . '\',' . round($row->count) . ']';
			$chartdata->amount[] = '[\'' . $row->label . '\',' . round($row->amount) . ']';
			$chartdata->projected_count[] = '[\'' . $row->label . '\',' . round($row->count) . ']';
			$chartdata->projected_amount[] = '[\'' . $row->label . '\',' . round($row->amount) . ']';
		}
		array_pop($chartdata->projected_count);
		array_pop($chartdata->projected_amount);
		$chartdata->projected_count[] = '[\'' . $current->label . '\',' . round($current->count) . ']';
		$chartdata->projected_amount[] = '[\'' . $current->label . '\',' . round($current->amount) . ']';

		if ($getnext) {
			$chartdata->projected_count[] = '[\'' . $next->label . '\',' . round($next->count) . ']';
			$chartdata->projected_amount[] = '[\'' . $next->label . '\',' . round($next->amount) . ']';
		}

		$max_count = $this->getMax($max_count);
		$max_amount = $this->getMax($max_amount, 1.2);

		$days = 1;
		switch ($by) {
			case 'day':
				$format = '%b&nbsp;%#d';
				break;
			case 'week':
				$format = '%w';
				$days = 7;
				break;
			case 'month':
				$format = '%b';
				$days = 30;
				break;
			case 'year':
				$format = '%Y';
				$days = 365;
				break;
		}

		$avg_count = round($data['projected']->count * $days);
		$avg_amount = round($data['projected']->amount * $days);

		$script = "
			(function($) {
				$(document).ready(function(){
					akeebasubsstats_render_chart('" . $by . "', '" . $format . "',
						[
							[" . implode(',', $chartdata->count) . "], [" . implode(',', $chartdata->amount) . "],
							[" . implode(',', $chartdata->projected_count) . "], [" . implode(',', $chartdata->projected_amount) . "],
						],
						" . $max_count . "," . $max_amount . "," . $avg_count . "," . $avg_amount . "
					);
				});
			})(akeeba.jQuery);
		";
		JFactory::getDocument()->addScriptDeclaration($script);

		$chart =
			'<div class="akeebasubsstats_chart_labels">'
				. '<div class="akeebasubsstats_chart_label_count">' . JText::_('COM_AKEEBASUBSSTATS_SUBSCRIPTIONS') . '</div>'
				. '<div class="akeebasubsstats_chart_label_amount">' . JText::_('COM_AKEEBASUBSSTATS_NET_SALES') . '</div>'
				. '</div>'
				. '<div id="akeebasubsstats_chart_' . $by . '" style="height:' . (int) $chartheight . 'px;width:100%"></div>';

		return array($chart, $table);
	}

	function getMax($number, $weight = 1)
	{
		$number = ceil($number * 1.05 * $weight);
		$ratio = 2;
		if ($number > 15) {
			$teens = (int) ('1' . str_repeat(0, strlen($number) - 1));
			$check = $number / $teens;
			if ($check < 1.5) {
				$ratio = 2;
				$teens = $teens / 10;
			} else if ($check < 4) {
				$ratio = 4;
				$teens = $teens / 10;
			} else {
				$ratio = 1;
			}

			$ratio = $ratio * $teens;
		}
		return ceil($number / $ratio) * $ratio;
	}
}
