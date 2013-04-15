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

jimport('joomla.application.component.controller');

/**
 * Default manager master display controller.
 *
 * @package        Joomla.Administrator
 * @subpackage     com_akeebasubsstats
 * @since          1.6
 */
class AkeebaSubsStatsController extends JController
{
	/**
	 * @var        string    The default view.
	 * @since    1.6
	 */
	protected $default_view = 'default';

	public function display($cachable = false, $urlparams = false)
	{
		// Load the submenu.
		self::addSubmenu(JFactory::getApplication()->input->get('view', 'default'));

		parent::display();

		return $this;
	}

	public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_AKEEBASUBSSTATS_SUBMENU_DASHBOARD'),
			'index.php?option=com_akeebasubsstats',
			$vName == 'default'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_AKEEBASUBSSTATS_SUBMENU_SALES'),
			'index.php?option=com_akeebasubsstats&view=sales',
			$vName == 'sales'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_AKEEBASUBSSTATS_SUBMENU_SUBSCRIPTIONS'),
			'index.php?option=com_akeebasubsstats&view=subscriptions',
			$vName == 'subscriptions'
		);
	}
}
