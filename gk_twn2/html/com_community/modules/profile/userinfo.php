<?php

defined('_JEXEC') or die();
require_once (JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'k2.php');
require_once (JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'extrahelpers.php');
//$img_avatar_src = K2JomUtilities::getAvatar($profile->id);
//JRequest::setVar("jom_img_avatar_src", $img_avatar_src);
$user_parsing = & JFactory::getUser($profile->id);
if($_GET['fer']=='123'){
	echo "<pre>";
	print_r($user_parsing);
	echo "</pre>";
}
$profileArray = K2JomUtilities::object_to_array($profile->fields);
$session = & JFactory::getSession();
$publicProfile = false;
if(isset($_GET['profile']) && $_GET['profile']=='public')
	$publicProfile = true;
$currentUrl = JURI::current();
if(preg_match("/\/community\/.+\/profile/i", $currentUrl))
	$publicProfile = true;
if (in_array(9, $user_parsing->groups)) {
	$session->set('jom_user_type', "issuer");
	if ($isMine && !$publicProfile)
		require_once 'issuer_dashboard.inc.php';
	else
		require_once 'issuer_profile.inc.php';
}
else if (in_array(3, $user_parsing->groups)) {
	$session->set('jom_user_type', "writer");
	if ($isMine && !$publicProfile)
		require_once 'writer_dashboard.inc.php';
	else
		require_once 'writer_profile.inc.php';
}
else{
	$session->set('jom_user_type', "regular");
	if ($isMine && !$publicProfile)
		require_once 'user_dashboard.inc.php';
	else
		require_once 'user_profile.inc.php';
}
