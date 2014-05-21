
<div class="search_stock2" style="float:right;width: 30%; top: -49px; right: -12px">
	{module 392}
	<?php
	jimport('joomla.application.module.helper');
	$module = JModuleHelper::getModule('jcsearch');
	$attribs['style'] = 'xhtml';
	echo JModuleHelper::renderModule($module, $attribs);
	?>
	<?php
	$userObj = JFactory::getUser($profile->id);
	$tag = $userObj->username;
	$last30day = date('Y-m-d H:i:s', strtotime('-30 day'));
	$sql = "SELECT #__k2_items.title,#__k2_items.created,#__k2_items.introtext  FROM #__k2_tags,#__k2_items,#__k2_tags_xref WHERE #__k2_items.id=#__k2_tags_xref.itemID AND #__k2_tags.id=#__k2_tags_xref.tagID AND #__k2_items.catid=111 AND #__k2_tags.name ='{$tag}' AND #__k2_items.created>'{$last30day}'";

	$db = JFactory::getDBO();
	$db->setQuery($sql);
	$res = $db->loadObjectList();
	if ($res):
		?>
		<div style="width:205px; height:70px; position: absolute; right: -12px">
			<img src="/images/newresearchstar.png" />
		</div>
	<?php endif; ?> 
</div>

<script language="javascript" type="text/javascript">function resizeIframe(obj) {
	obj.style.height = '0px';
	obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
}</script>
<div style="margin-bottom: 20px">

	<div style="display: block;float:left;margin: 0 20px 5px 0px;" >
		<img width="<?php echo (strpos($profile->largeAvatar, "user.png")>0?"70":""); ?>" src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape($user->getDisplayName()); ?>" width="" /><br />
		<?php if ($isMine): ?>
			<a href="javascript:void(0)" onclick="joms.photos.uploadAvatar('profile', '<?php echo $profile->id ?>')"><?php echo JText::_('COM_COMMUNITY_CHANGE_AVATAR') ?></a>
		<?php endif; ?>
	</div>
	<div style="float:left; margin-right: 100px; min-height: 75px;">

		<h2 class="cPageInfo-Name cResetH">
			<?php echo $user->getDisplayName(); ?> (<?php echo $user->username; ?>)
		</h2>
		<?php $current_user_parsing = & JFactory::getUser(); //issuers cannot follow anybody ?>
		<?php if (!in_array(9, $current_user_parsing->groups)) : ?>
			<?php if (!$isFriend && !$isMine && !$isBlocked): ?>
				<?php if (!$isWaitingApproval): ?>
					<a href="javascript:void(0)" onclick="joms.friends.connect('<?php echo $profile->id; ?>')">
						<span class="buttonfollow xxx"><img src="<?php echo JURI::base(); ?>images/icons/plus.png" /><?php echo JText::_('COM_COMMUNITY_FRIENDS_ADD_BUTTON'); ?></span>
					</a>
				<?php else : ?>
					<i class="com-icon-groups-delete"></i>
					<a href="javascript:void(0);" onclick="joms.friends.confirmFriendRemoval(<?php echo $profile->id; ?>);">
						<?php echo JText::_('COM_COMMUNITY_REMOVE_FRIEND'); ?>
					</a>
				<?php endif ?>
			<?php else: ?>
				<?php if ($AmIFollowingThisUser): ?>
					<a href="javascript:void(0);" onclick="joms.friends.confirmFriendRemoval('<?php echo $profile->id; ?>')">
						<span class="buttonfollow xxx"><img src="<?php echo JURI::base(); ?>images/icons/minus.png" /><?php echo JText::_('COM_COMMUNITY_REMOVE_FRIEND'); ?></span>
					</a>
				<?php endif; ?>
			<?php endif; ?>

		<?php endif; ?>
	</div>
</div>



<?php $userObj = JFactory::getUser($profile->id); ?>
{tab Details}
<iframe src="http://app.quotemedia.com/quotetools/clientForward?targetURL=http://www.equities.com/iframe.php?symbol=<?php echo $userObj->username; ?>" frameBorder="0" scrolling="no" style="width:100%;overflow: hidden" onload="resizeIframe(this)"></iframe>

{tab Wall}
<?php 

 // tony commented march 18th 
 require_once 'wall.inc.php'; 

?>

<?php $userObj = JFactory::getUser($profile->id); ?>

{tab Profile}
<?php 
 // tony commented march 18th 
 require_once 'company_info.inc.php'; 
?>

{tab Videos}
<?php 
 // tony commented march 18th 
 require_once 'videos.inc.php'; 
?>

{tab Blog}
<?php 
 // tony commented march 18th 
 require_once 'blog.inc.php';
 ?>


{tab News}
<?php 
 // tony commented march 18th 
 require_once 'news_issuer_profile.inc.php'; 
?>

<?php //* require_once 'news2.inc.php'; ?> 


<?php //*{tab Editorial} require_once 'news.inc.php';   ?>


{tab Followers}
<div>
<?php
 // tony commented march 18th 
 require_once 'followers.inc.php';

 ?></div>

<?php
//{tab Equities DIGITAL}
//require_once 'equities_wire.inc.php';
?>

{tab Trending}
<?php require_once 'trending.inc.php'; ?>

<!--<?php echo print_r(JFactory::getUser()->id, true);?>-->
<?php if(JFactory::getUser()->id > 0){ ?>
{tab Equities LIVE}
<?php require_once 'avconference.inc.php';} ?>

<?php
$userObj = JFactory::getUser($profile->id);
$tag = $userObj->username;
$sql = "SELECT #__k2_items.title,#__k2_items.created,#__k2_items.introtext  FROM #__k2_tags,#__k2_items,#__k2_tags_xref WHERE #__k2_items.id=#__k2_tags_xref.itemID AND #__k2_tags.id=#__k2_tags_xref.tagID AND #__k2_items.catid=111 AND #__k2_tags.name ='{$tag}'";

$db = JFactory::getDBO();
$db->setQuery($sql);
$res = $db->loadObjectList();
if ($res):
	?>
	{tab Research}
	<?php require_once 'research.inc.php'; ?>
<?php endif; ?> 
{/tabs}
