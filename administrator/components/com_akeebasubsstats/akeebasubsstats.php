<?php
/**
 * @package			AkeebaSubsStats
 * @version			3.0.10
 *
 * @author			Peter van Westen <peter@nonumber.nl>
 * @link			http://www.nonumber.nl
 * @copyright		Copyright © 2012 NoNumber All Rights Reserved
 * @license			http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_akeebasubsstats')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

$lang = JFactory::getLanguage();
$lang->load('com_modules', JPATH_ADMINISTRATOR);
if ($lang->getTag() != 'en-GB') {
	// Loads English language file as fallback (for undefined stuff in other language file)
	$lang->load('com_akeebasubsstats', JPATH_ADMINISTRATOR, 'en-GB');
}
$lang->load('com_akeebasubsstats', JPATH_ADMINISTRATOR, null, 1);

jimport('joomla.filesystem.file');
$app = JFactory::getApplication();

// Include dependancies
jimport('joomla.application.component.controller');

$controller = JController::getInstance('AkeebaSubsStats');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
