<?php
JLoader::import('joomla.application.component.model');
JLoader::import('joomla.application.component.view');
JLoader::import( 'config', JPATH_BASE . DS . 'components' . DS . 'com_broadcast' . DS . 'models' );
$model = JModel::getInstance( 'config', 'BroadcastModel' );
$otherdataArr = $model->renderHTML_other();
$lists = $model->getlist();
$subscribedlists = $model->getsubscribedlist();
$view = new JView(array("template_path"=>JPATH_BASE.DS."templates".DS."gk_twn2".DS."html".DS."com_broadcast".DS."config"));
$view->assignRef('otherdataArr', $otherdataArr);
$view->assignRef('lists', $lists);
$view->assignRef('subscribedlists', $subscribedlists);
$view->setLayout("default");

$cache = JFactory::getCache('mod_menu');
$cache->clean();
$cache->clean();

$view->display(null);