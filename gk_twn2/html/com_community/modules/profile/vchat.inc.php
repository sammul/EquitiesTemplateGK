<?php
//JLoader::import('joomla.application.component.model');
JLoader::import('joomla.application.component.view');
//Loader::import( 'config', JPATH_BASE . DS . 'components' . DS . 'com_avchat3' . DS . 'models' );
//$model2 = JModel::getInstance( 'avchat3', 'Avchat3Model' );
//$otherdataArr = $model->renderHTML_other();
//$lists = $model->getlist();
//$subscribedlists = $model->getsubscribedlist();
$view2 = new JView(array("template_path"=>JPATH_BASE.DS."templates".DS."gk_twn2".DS."html".DS."com_avchat3".DS."avchat3"));
$datafer = "Equities Issuer Broadcast";
$view2->assignRef('msg', $datafer);
//$view2->assignRef('lists', $lists);
//$view2->assignRef('subscribedlists', $subscribedlists);
$view2->setLayout("default");

$cache2 = JFactory::getCache('mod_menu');
$cache2->clean();
$cache2->clean();

$view2->display(null);