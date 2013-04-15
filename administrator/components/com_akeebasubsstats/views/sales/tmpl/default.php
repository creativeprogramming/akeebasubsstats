<?php
/**
 * @package            Akeeba Subscriptions Stats
 * @version            1.0.0
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
JHtml::script('akeebasubsstats/jqplot.canvasOverlay.min.js', false, true);

JHtml::stylesheet('akeebasubsstats/style.min.css', false, true);

$level = JFactory::getApplication()->input->getString('level', '');
$country = JFactory::getApplication()->input->getString('country', '');

$title = JText::_('COM_AKEEBASUBSSTATS_SALES_BY') . ':';
$title .= ' ' . ($level ? $level : JText::_('COM_AKEEBASUBSSTATS_SELECT_ALL_LEVELS'));
$title .= ' / ' . ($country ? $this->data['countries'][$country] : JText::_('COM_AKEEBASUBSSTATS_SELECT_ALL_COUNTRIES'));

?>
	<div class="akeeba-bootstrap akeebasubsstats">
		<form
			action="<?php echo JRoute::_('index.php?option=com_akeebasubsstats&view=sales'); ?>"
			method="post" name="adminForm" id="module-form" class="form-validate">
			<select name="level" class="inputbox" onchange="this.form.submit()">
				<option value="">- <?php echo JText::_('COM_AKEEBASUBSSTATS_SELECT_LEVEL'); ?> -</option>
				<?php foreach ($this->data['levels'] as $l) : ?>
					<option<?php echo $l == $level ? ' selected="selected"' : ''; ?>><?php echo $l; ?></option>
				<?php endforeach ?>
			</select>
			<select name="country" class="inputbox" onchange="this.form.submit()">
				<option value="">- <?php echo JText::_('COM_AKEEBASUBSSTATS_SELECT_COUNTRY'); ?> -</option>
				<?php foreach ($this->data['countries'] as $code => $c) : ?>
					<option value="<?php echo $code; ?>"<?php echo $code == $country ? ' selected="selected"' : ''; ?>><?php echo $c; ?></option>
				<?php endforeach ?>
			</select>

			<h3><?php echo $title; ?></h3>

			<div class="span" style="width:400px;">
				<?php renderData($this->model, $this->data, 'day'); ?>
			</div>
			<div class="span" style="width:400px;">
				<?php renderData($this->model, $this->data, 'week'); ?>
			</div>
			<div class="span" style="width:400px;">
				<?php renderData($this->model, $this->data, 'month'); ?>
			</div>
			<div class="span" style="width:400px;">
				<?php renderData($this->model, $this->data, 'year'); ?>
			</div>
		</form>
	</div>
<?php
function renderData(&$model, &$data, $by = 'day')
{
	list($chart, $table) = $model->getOutputData($data, $by, 1);
	echo '<fieldset>'
		. '<legend>' . JText::_('COM_AKEEBASUBSSTATS_BY_' . strtoupper($by)) . '</legend>'
		. $chart
		. $table
		. '</fieldset>';
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
