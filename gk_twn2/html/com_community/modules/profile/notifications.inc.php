<?php
$my = CFactory::getUser();


$document = JFactory::getDocument();
$document->setTitle(JText::_('COM_COMMUNITY_PROFILE_NOTIFICATIONS'));

$user = CFactory::getUser();
$params = $user->getParams();
$config = CFactory::getConfig();

$modelNotification = CFactory::getModel('notification');
$notifications = $modelNotification->getNotification($my->id, '0', 0);

$app = CAppPlugins::getInstance();
$appFields = $app->triggerEvent('onFormDisplay', array('jsform-profile-notifications'));

$beforeFormDisplay = CFormElement::renderElements($appFields, 'before');
$afterFormDisplay = CFormElement::renderElements($appFields, 'after');

$tmpl = new CTemplate();
echo $tmpl->set('beforeFormDisplay', $beforeFormDisplay)
		->set('afterFormDisplay', $afterFormDisplay)
		->set('params', $params)
		->set('config', $config)
		->set('pagination', $modelNotification->getPagination())
		->set('notifications', $notifications)
		->fetch('profile.notification');