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

jimport('joomla.application.component.view');

/**
 * View class for default list view
 */
class AkeebaSubsStatsViewSubscriptions extends JView
{
	protected $items;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->data = $this->get('Data');

		JFactory::getDocument()->setTitle(JText::_('COM_AKEEBASUBSSTATS') . ' - ' . JText::_('COM_AKEEBASUBSSTATS_SUBMENU_SUBSCRIPTIONS'));
		JToolBarHelper::title(JText::_('COM_AKEEBASUBSSTATS') . ' - ' . JText::_('COM_AKEEBASUBSSTATS_SUBMENU_SUBSCRIPTIONS'));

		parent::display($tpl);
	}
}
