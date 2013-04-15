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
?>
	<div class="akeeba-bootstrap akeebasubsstats">
		<div class="span" style="width:59%;min-width:640px;">
			<?php list($chart, $table) = $this->model->getOutputData($this->data, 'day', 0, 15, 4); ?>
			<fieldset>
				<legend><?php echo JText::_('COM_AKEEBASUBSSTATS_BY_DAY'); ?></legend>
				<div class="span" style="width:49%;"><?php echo $table; ?></div>
				<div class="span" style="width:49%;"><?php echo $chart; ?></div>
			</fieldset>
			<div class="clearfix"></div>
			<?php list($chart, $table) = $this->model->getOutputData($this->data, 'month', 0, 15, 4, 100); ?>
			<div class="span" style="width:49%;">
				<fieldset>
					<legend><?php echo JText::_('COM_AKEEBASUBSSTATS_BY_MONTH'); ?></legend>
					<?php echo $table; ?>
					<?php echo $chart; ?>
				</fieldset>
				<div class="clearfix"></div>
			</div>
			<?php list($chart, $table) = $this->model->getOutputData($this->data, 'year', 0, 15, 4, 100); ?>
			<div class="span" style="width:49%;">
				<fieldset>
					<legend><?php echo JText::_('COM_AKEEBASUBSSTATS_BY_YEAR'); ?></legend>
					<?php echo $table; ?>
					<?php echo $chart; ?>
				</fieldset>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="span" style="width:39%;min-width:480px;">
			<?php renderLatest($this->latest, $this->data['countries']); ?>
		</div>
	</div>
<?php

function renderData(&$model, &$data, $by = 'day')
{
	list($chart, $table) = $model->getOutputData($data, $by, 0, 15, 4);
	?>
	<fieldset>
		<legend><?php echo JText::_('COM_AKEEBASUBSSTATS_BY_' . strtoupper($by)); ?></legend>
		<div class="span" style="width:49%;"><?php echo $table; ?></div>
		<div class="span" style="width:49%;"><?php echo $chart; ?></div>
	</fieldset>
	<div class="clearfix"></div>
<?php
}

function renderLatest(&$data, &$countries)
{
	?>
	<fieldset>
		<legend><?php echo JText::_('COM_AKEEBASUBSSTATS_LATEST'); ?></legend>
		<table class="table table-striped">
			<!--thead>
				<th><?php echo JText::_('COM_AKEEBASUBS_SUBSCRIPTIONS_USER'); ?></th>
				<th>€</th>
				<th><?php echo JText::_('COM_AKEEBASUBS_SUBSCRIPTIONS_LEVEL'); ?></th>
				<th><?php echo JText::_('JGLOBAL_CREATED'); ?></th>
			</thead-->
			<tbody>
				<?php foreach ($data as $row) : ?>
					<tr>
						<td>
							<img src="http://www.nonumber.nl/images/flags/<?php echo strtolower($row->country); ?>.png"
								width="16" height="11"
								title="<?php echo $countries[$row->country]; ?>" />
							<a href="index.php?option=com_akeebasubs&view=user&id=<?php echo $row->user_id; ?>"><?php echo $row->user; ?></a>
						</td>
						<td nowrap="nowrap">€ <?php echo $row->amount; ?></td>
						<td>
							<a href="index.php?option=com_akeebasubs&view=subscription&id=<?php echo $row->id; ?>"><?php echo $row->level; ?></a>
						</td>
						<td><?php echo date('d M - H:i', strtotime($row->date)); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<a href="index.php?option=com_akeebasubs&view=subscriptions"><?php echo JText::_('COM_AKEEBASUBSSTATS_MORE'); ?></a>
	</fieldset>
<?php
}
