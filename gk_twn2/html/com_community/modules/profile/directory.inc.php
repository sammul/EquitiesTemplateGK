<?php

// no direct access
defined('_JEXEC') or die('Restricted access');
//if($_GET['debug']!='1'){
//   error_reporting(E_ALL);
//   ini_set('display_errors', 'On')
//}

require_once( JPATH_ROOT . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');

class Jreviews_mylistingsF {
	var $name = "mylistings";
	var $_name = 'mylistings';
	var $_path = '';
	var $_user = '';
	var $_my = '';

	function plgCommunityJreviews_mylistings123(& $subject, $config) {
		$this->_path = JPATH_ROOT . DS . 'administrator' . DS . 'components' . DS . 'com_jreviews';
		$this->_user = CFactory::getActiveProfile();
		$this->_my = CFactory::getUser();
		parent::__construct($subject, $config);
	}

	function generateListings() {
		if (false and !file_exists($this->_path . DS . 'jreviews.php')) {
			return JText::_('JReviews is not installed. Please contact site administrator.');
		} else {
			$user = CFactory::getActiveProfile();
			$userId = $user->id;
			$cacheSetting = 0;
			$cache = JFactory::getCache('plgCommunityJreviews_mylistings');
			$cache->setCaching($cacheSetting);
			return $this->_getPage($userId);
		}
	}

	static function _getPage($userId, $params = null, $cacheSetting) {
		if (!$cacheSetting) {
			# MVC initalization script
			if (!defined('DS'))
				define('DS', DIRECTORY_SEPARATOR);
			require('components' . DS . 'com_jreviews' . DS . 'jreviews' . DS . 'framework.php');
		}

//        Configure::write('Libraries.disableJS',array('jquery'));
		# Populate $params array with module settings
		$eParams['page'] = 1;
		$eParams['user'] = $userId;
		//$eParams['module'] = $params->toArray();
		$eParams['module']['community'] = true;
		$eParams['module_id'] = 'plugin_mylistings' . $userId;
		$eParams['data']['module'] = true;

		$eParams['data']['controller'] = 'community_listings';
		$eParams['data']['action'] = 'mylistings';
		//$eParams['data']['module_limit'] = $params->get('limit',10);
		$eParams['data']['module_limit'] = 10;

		$Dispatcher = new S2Dispatcher('jreviews', true, true);
		return $Dispatcher->dispatch($eParams);
	}

}
$mylist = new Jreviews_mylistingsF();
echo $mylist->generateListings();