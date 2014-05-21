<?php
//Copyright 2013 AVChat Software
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
$user = JFactory::getUser();

//GET COMPONENT GENERAL SETTINGS
$config = JComponentHelper::getParams('com_avchat3');

$open_method = $config->get('avchat3_open_method');
$popup_height = $config->get('avchat3_popup_height');
$popup_width = $config->get('avchat3_popup_width');


//GET AVCONFIG admin.swf name
$avchat_admin_swf = $config->get('avchat3_adminswf');

$avchat_FB_app_ID = $config->get('avchat3_FBappID');

//GET THE ROOM ID
if(isset($_GET['room']) && $_GET['room'] != ''){
	$room_id = $_GET['room'];
}else{
	$room_id = '';
}
//var_dump($room_id);
//die('tenis');

//CHECK IF THE USER HAS ACCESS TO ADMIN.SWF
if($user->authorize('avchat3.allow_admin_interface', 'com_avchat3')){ 
	$swf = $avchat_admin_swf ; 
}else{
	$swf = 'index.swf';
}

//CHECK IF USER HAS ACCESS TO AUTOMATICALLY JOIN ROOMS
if(!$user->authorize('avchat3.allow_room_join')){
	$room_id = '';
}

if($avchat_FB_app_ID != "") {
			$FB_appId = $avchat_FB_app_ID;
		}
		else {
			$FB_appId = "";
		}
		
		$chat_path = $base_URI."components/com_avchat3/chat";
		
		$AVChat_exists = "false";
		//$FB_appId = JPATH_SITE . DS . 'components' . DS . 'com_avchat3' .  DS . 'chat' . DS . 'swfobject.js';
		if(file_exists(JPATH_SITE . DS . 'components' . DS . 'com_avchat3' .  DS . 'chat' . DS . 'swfobject.js')){
			$AVChat_exists = "true";
		}
		
		if($user->get('id') != 0 && !$user->authorize('avchat3.allow_user_interface', 'com_avchat3')){
		?> 
			<div id="av_message" style="color:#ff0000"> You do not have sufficient privileges to access this page. <a style="display:block;padding:5px 3px;width:200px;margin:5px 0;text-align:center;background:#f3f3f3;border:1px solid #ccc" href="index.php/login" >Click to upgrade!</a></div>
		<?php
	}
	else{
		
		?>
	
		<h1>Equities Community Video Chat</h1>


		<input type="hidden" name="FB_appId" id="FB_appId" value="<?php echo $FB_appId ?>" />
		<input type="hidden" name="AVChat_exists" id="AVChat_exists" value="<?php echo $AVChat_exists ?>" />
		<input type="hidden" name="open_method" id="open_method" value="<?php echo $open_method ?>" />
		<script src="<?php echo $chat_path ?>/tinycon.min.js"></script>
		<script type="text/javascript" src="<?php echo $chat_path ?>/facebook_integration.js"></script>
		<script type="text/javascript" src="<?php echo $chat_path ?>/swfobject.js"></script>
		<script type="text/javascript" src="<?php echo $chat_path ?>/new_message.js"></script>
		<script type="text/javascript">
			var chat_path = "<?php echo $chat_path; ?>"; 
			var embed = "<?php echo $open_method; ?>";
		</script>
		<div id="myContent">
				<div id="av_message" style="color:#ff0000"> </div>
			</div>
		<?php if($open_method == 'embed'){ ?>
			<script type="text/javascript">
				var flashvars = {
					lstext : "Loading Settings...",
					sscode : "php",
					userId : ""
				};
				var params = {
					quality : "high",
					bgcolor : "#272727",
					play : "true",
					loop : "false",
					allowFullScreen : "true",
					base : "<?php echo $chat_path ?>/",
					FlashVars : "userId=room-<?php echo $room_id ?>"
				};
				var attributes = {
					name : "index_embed",
					id :   "index_embed",
					align : "middle"
				};
			</script>
			<script type="text/javascript">
			swfobject.embedSWF("<?php echo $chat_path."/".$swf; ?>", "myContent", "100%", "600", "10.3.0", "", flashvars, params, attributes);</script>
			
	<?php }else { 
	
  			if($AVChat_exists == "true" ){ ?>
  				
  				<script type="text/javascript">
  					document.getElementById("av_message").innerHTML = '<a href="javascript:void(0);" onclick="window.open(\'<?php echo $base_URI;?>components/com_avchat3/chat/index_popup.php?movie_param=<?php echo $swf;?>&FB_appId=<?php echo $FB_appId?>&AVChat_exists=<?php echo $AVChat_exists?>\', \'Video Chat\', \'height=<?php echo $popup_height; ?>, width=<?php echo $popup_width;?>\')"  style="display:block;background:#f0f0f0; border:1px solid #ccc;text-align:center; padding:5px;">Open chat in popup</a>';
  				</script>
  				<!--<a href="javascript:void(0);" onclick="window.open('<?php echo $base_URI;?>components/com_avchat3/chat/index_popup.php?movie_param=<?php echo $movie_param;?>&FB_appId=<?php echo $FB_appId?>', 'Video Chat', 'height=<?php echo $popup_height; ?>, width=<?php echo $popup_width;?>')"  style="display:block;background:#f0f0f0; border:1px solid #ccc;text-align:center; padding:5px;">Open chat in popup</a> -->
			<?php }
			
		
	 } 
	?>
			<script type="text/javascript" src="<?php echo $chat_path ?>/find_player.js"></script>
	<?php } ?>
