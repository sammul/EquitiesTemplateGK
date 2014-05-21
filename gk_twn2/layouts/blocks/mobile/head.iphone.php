<?php

// This is the code which will be placed in the head section

// No direct access.
defined('_JEXEC') or die;

$this->addCSS($this->URLtemplate() . '/css/mobile/iphone.css');
// include JavaScript
if($this->getParam('mobile_scripts', 1) == '1') {
$this->addJS($this->URLtemplate() . '/js/mobile/zepto.js');
$this->addJS($this->URLtemplate() . '/js/mobile/gk.iphone.js');
// remove mootools and other template scripts
$k2option = JRequest::getCmd('option');
if($k2option != 'com_k2') {
    GKParser::$customRules['/<script type="text\/javascript">(.*?)<\/script>/mis'] = '';
    GKParser::$customRules['/<script type="text\/javascript" src="(.*?)media\/system\/js(.*?)"><\/script>/mi'] = '';
}
} else {
	$this->addJS($this->URLtemplate() . '/js/mobile/gk.iphone.mt.js');
}
