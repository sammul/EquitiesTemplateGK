<?php
//Copyright 2012 Stefan Nour, Octavian Naicu
//This Joomla Component is distributed under the terms of the GNU General Public License.
//you can redistribute it and/or modify it under the terms of the GNU General Public License 
//as published by the Free Software Foundation, either version 3 of the License, or any 
//later version.

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// load tooltip behavior
JHtml::_('behavior.tooltip');
$base_URI = JURI::root();

$base_PATH = dirname(__FILE__);

$curdir = getcwd();

//GET USER INFOS
$user =& JFactory::getUser();

//GET COMPONENT GENERAL SETTINGS
$config = JComponentHelper::getParams('com_avconference');


//GET AVCONFIG admin.swf name
$avconference_admin_swf = $config->get('avconference_adminswf');




?>
<h1><?php echo $this->msg; ?></h1>


<?php if($user->authorize('avconference.allow_admin_interface', 'com_avconference')){ ?>
	
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="index_obj" width="100%" height="600"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab#version=10,3,0,0">
			<param name="movie" value="<?php echo $base_URI;?>components/com_avcONFERENCE/chat/<?php echo $avconference_admin_swf;?>" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="true" />
			<param name="wmode" value="opaque" />
			<param name="base" value="<?php echo $base_URI;?>components/com_avconference/chat/">
			<embed src="<?php echo $base_URI;?>components/com_avconference/chat/<?php echo $avconference_admin_swf;?>" quality="high" bgcolor="#ffffff"
				width="100%" height="600" name="index_embed" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowFullScreen="true"
				allowScriptAccess="sameDomain"
				type="application/x-shockwave-flash"
				wmode="opaque"
				base="<?php echo $base_URI;?>components/com_avconference/chat/"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
	
<?php }else{ ?>
	
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="index_obj" width="100%" height="600"
			codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab#version=10,3,0,0">
			<param name="movie" value="<?php echo $base_URI;?>components/com_avconference/chat/index.swf" />
			<param name="quality" value="high" />
			<param name="bgcolor" value="#ffffff" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="allowFullScreen" value="true" />
			<param name="wmode" value="opaque" />
			<param name="base" value="<?php echo $base_URI;?>components/com_avconference/chat/">
			<embed src="<?php echo $base_URI;?>components/com_avconference/chat/index.swf" quality="high" bgcolor="#ffffff"
				width="100%" height="600" name="index_embed" align="middle"
				play="true"
				loop="false"
				quality="high"
				allowFullScreen="true"
				allowScriptAccess="sameDomain"
				type="application/x-shockwave-flash"
				wmode="opaque"
				base="<?php echo $base_URI;?>components/com_avconference/chat/"
				pluginspage="http://www.adobe.com/go/getflashplayer">
			</embed>
	</object>
	<?php } ?>



