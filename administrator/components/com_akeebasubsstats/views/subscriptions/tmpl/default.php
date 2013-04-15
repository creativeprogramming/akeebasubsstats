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

JHtml::_('behavior.modal');
JHtml::_('behavior.tooltip');

JHtml::script('akeeba_strapper/akeebajq.js', false, true);
JHtml::script('akeeba_strapper/akeebajqui.js', false, true);

JHtml::stylesheet('akeeba_strapper/bootstrap.min.css', false, true);
JHtml::script('akeeba_strapper/bootstrap.min.js', false, true);

JHtml::stylesheet('akeebasubsstats/jquery.jqplot.min.css', false, true);
JHtml::script('akeebasubsstats/charts.js', false, true);
JHtml::script('akeebasubsstats/jquery.jqplot.min.js', false, true);
JHtml::script('akeebasubsstats/jqplot.highlighter.min.js', false, true);
JHtml::script('akeebasubsstats/jqplot.canvasTextRenderer.min.js', false, true);
JHtml::script('akeebasubsstats/jqplot.canvasAxisLabelRenderer.min.js', false, true);
JHtml::script('akeebasubsstats/jqplot.dateAxisRenderer.min.js', false, true);
JHtml::script('akeebasubsstats/jqplot.categoryAxisRenderer.min.js', false, true);
JHtml::script('akeebasubsstats/jqplot.enhancedLegendRenderer.min.js', false, true);

JHtml::stylesheet('akeebasubsstats/style.min.css', false, true);
JHtml::stylesheet('akeebasubsstats/style.min.css', false, true);

$level = JFactory::getApplication()->input->getString('level', '');
$stacked = JFactory::getApplication()->input->getInt('stacked', 0);
?>
	<div class="akeeba-bootstrap akeebasubsstats">
		<form
			action="<?php echo JRoute::_('index.php?option=com_akeebasubsstats&view=subscriptions'); ?>"
			method="post" name="adminForm" id="module-form" class="form-validate">
			<select name="level" class="inputbox" onchange="this.form.submit()">
				<option value="">- <?php echo JText::_('COM_AKEEBASUBSSTATS_SELECT_LEVEL'); ?> -</option>
				<?php foreach ($this->data['levels'] as $l) : ?>
					<option<?php echo $l == $level ? ' selected="selected"' : ''; ?>><?php echo $l; ?></option>
				<?php endforeach ?>
			</select>

			<div class="span" style="width:100%">
				<?php renderDataTable($this->data, 'day'); ?>
				<?php renderDataTable($this->data, 'week'); ?>
				<?php renderDataTable($this->data, 'month'); ?>
				<?php renderDataTable($this->data, 'year'); ?>
			</div>
		</form>
	</div>
<?php
function renderDataTable(&$data, $by = 'day')
{
	$stacked = JFactory::getApplication()->input->getInt('stacked', 0);

	$rows = $data[$by];

	$chartdata = array();
	foreach ($rows as $level => $levelrows) {
		$leveldata = array();
		foreach ($levelrows as $row) {
			$leveldata[] = '[\'' . $row->label . '\',' . round($row->count) . ']';
		}
		$chartdata[$level] = '[' . implode(',', $leveldata) . ']';
	}

	$max_count = 0;
	if ($stacked) {
		$dates = array_keys($rows[key($rows)]);
		foreach ($dates as $i) {
			$totalcount = 0;
			foreach ($rows as $levelrows) {
				if (isset($levelrows[$i])) {
					$totalcount += round($levelrows[$i]->count);
				}
			}
			$max_count = max($max_count, $totalcount);
		}
	} else {
		foreach ($rows as $levelrows) {
			foreach ($levelrows as $row) {
				$max_count = max($max_count, round($row->count));
			}
		}
	}
	$max_count = getMax($max_count);

	$script = "
		(function($) {
			$(document).ready(function(){
				akeebasubsstats_render_chart_levels('" . $by . "',
					[" . implode(',', $chartdata) . "],
					[{label:'" . implode("'},{label:'", array_keys($chartdata)) . "'},],
					" . (int) $max_count . ", " . (int) $stacked . "
				);
			});
		})(akeeba.jQuery);
	";
	JFactory::getDocument()->addScriptDeclaration($script);

	$height = max(200, count($chartdata) * 18);
	$chart = '<div id="akeebasubsstats_chart_' . $by . '" style="height:' . $height . 'px;width:80%"></div>';

	echo '<fieldset>'
		. '<legend>' . JText::_('COM_AKEEBASUBSSTATS_BY_' . strtoupper($by)) . '</legend>'
		. '<div style="width:100%;">' . $chart . '</div>'
		. '</fieldset>';
}

function getMax($number)
{
	$number = ceil($number * 1.05);
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
