<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license		GNU/GPL, see LICENSE.php
 **/
defined('_JEXEC') OR DIE();
$currentUrl = JURI::current();
?>

<?php if (!preg_match("/\/community\/.+\/profile/i", $currentUrl)): ?>
<script async type="text/javascript" src="<?php echo JURI::root();?>components/com_community/assets/ajaxfileupload.pack.js"></script>
<script async type="text/javascript" src="<?php echo JURI::root();?>components/com_community/assets/imgareaselect/scripts/jquery.imgareaselect.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::root();?>components/com_community/assets/imgareaselect/css/imgareaselect-avatar.css" />
<?php endif; ?>

<script type="text/javascript"> joms.filters.bind();</script>

<?php echo $adminControlHTML; ?>

<!-- begin: .cLayout -->
<div id="cProfileWrapper" class="cLayout cPage cProfile <?php if(!$isMine) { echo 'cProfileOther';} ?>">

	<?php
	require_once( JPATH_BASE . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');
	$userinfo = & CFactory::getActiveProfile();
	$user_parsing = & JFactory::getUser($userinfo->_userid);
	?>
	
	<div class="cPageActions clearfix">
		<div class="cPageAction cFloat-R">
			<?php if (!in_array(9, $user_parsing->groups) && !in_array(3, $user_parsing->groups))echo $blockUserHTML;?>
			<?php if (!in_array(9, $user_parsing->groups) && !in_array(3, $user_parsing->groups))echo $reportsHTML;?>
			<?php echo $bookmarksHTML;?>
		</div>
	</div>
	<div id="editLayout-stop" class="page-action" style="display: none;">
		<a onclick="joms.editLayout.stop()" href="javascript: void(0)"><?php echo JText::sprintf('COM_COMMUNITY_STOP_EDIT_PROFILE_APPS_LAYOUT') ?></a>
	</div>



	<?php $this->renderModules( 'js_profile_top' ); ?>
	<?php if($isMine) $this->renderModules( 'js_profile_mine_top' ); ?>



	<!-- begin: .cSidebar -->
	<!-- end: .cSidebar -->



	<!-- begin: .cMain -->
	<div class="cMain">

		<!-- begin: .cPageHeader -->
		<?php $this->view('profile')->modProfileUserinfoCustomEq($newsfeed, $content); ?>

		<!-- begin: .cSidebar.cResponsive -->
		<!-- end: .cSidebar.cResponsive -->
		
		<!-- wall -->
		
	</div>
	<!-- end: .cMain -->

	<?php if($isMine) $this->renderModules( 'js_profile_mine_bottom' ); ?>
	<?php $this->renderModules( 'js_profile_bottom' ); ?>

</div>
<!-- end: .cLayout -->