<?php
//JLoader::import('joomla.application.component.model');
JLoader::import('joomla.application.component.view');
//Loader::import( 'config', JPATH_BASE . DS . 'components' . DS . 'com_avchat3' . DS . 'models' );
//$model2 = JModel::getInstance( 'avchat3', 'Avchat3Model' );
//$otherdataArr = $model->renderHTML_other();
//$lists = $model->getlist();
//$subscribedlists = $model->getsubscribedlist();
$view2 = new JView(array("template_path"=>JPATH_BASE.DS."templates".DS."gk_twn2".DS."html".DS."com_avconference".DS."avconference"));
//$datafer = "Please login to view the Issuer Broadcast";
$datafer = "Equities Issuer Broadcast";
$view2->assignRef('msg', $datafer);
//$view2->assignRef('lists', $lists);
//$view2->assignRef('subscribedlists', $subscribedlists);
$view2->setLayout("default");
$view2->display(null);
