<?php
/**
 * @package            Akeeba Subscriptions Stats
 * @version            3.0.10
 *
 * @author             Peter van Westen <peter@nonumber.nl>
 * @link               http://www.nonumber.nl
 * @copyright          Copyright © 2012 NoNumber All Rights Reserved
 * @license            http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View class for default list view
 */
class AkeebaSubsStatsViewSales extends JView
{
	protected $items;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->model = $this->getModel();
		$this->data = $this->get('Data');

		JFactory::getDocument()->setTitle(JText::_('COM_AKEEBASUBSSTATS') . ' - ' . JText::_('COM_AKEEBASUBSSTATS_SUBMENU_SALES'));
		JToolBarHelper::title(JText::_('COM_AKEEBASUBSSTATS') . ' - ' . JText::_('COM_AKEEBASUBSSTATS_SUBMENU_SALES'));

		parent::display($tpl);
	}
}
