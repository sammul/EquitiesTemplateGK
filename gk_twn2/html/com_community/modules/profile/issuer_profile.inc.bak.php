
<div class="search_stock2" style="float:right;width: 30%; top: -60px; right: -12px">
	{module 392}
    <?php
    jimport('joomla.application.module.helper');
    $module = JModuleHelper::getModule('jcsearch');
    $attribs['style'] = 'xhtml';
    echo JModuleHelper::renderModule($module, $attribs);
    ?>
</div>
<script language="javascript" type="text/javascript">function resizeIframe(obj) {
        obj.style.height = '0px';
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }</script>
<div style="margin-bottom: 20px">

	<div style="display: block;float:left;margin: 0 20px 5px 0px;" >
		<img src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape($user->getDisplayName()); ?>" width="" /><br />
		<?php if ($isMine): ?>
			<a href="javascript:void(0)" onclick="joms.photos.uploadAvatar('profile', '<?php echo $profile->id ?>')"><?php echo JText::_('COM_COMMUNITY_CHANGE_AVATAR') ?></a>
		<?php endif; ?>
	</div>
	<div style="float:left; margin-right: 100px">
		<h2 class="cPageInfo-Name cResetH">
			<?php echo $user->getDisplayName(); ?>
		</h2>
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
	</div>
</div>



<?php $userObj = JFactory::getUser($profile->id); ?>
{tab Details}
<!--<iframe src="/iframe.php?symbol=<?php echo strtolower($userObj->username); ?>" frameBorder="0" scrolling="no" style="width:100%;overflow: hidden" onload="resizeIframe(this)"></iframe>-->
<iframe src="http://app.quotemedia.com/quotetools/clientForward?targetURL=http://www.equities.com/iframe.php?symbol=<?php echo $userObj->username; ?>" frameBorder="0" scrolling="no" style="width:100%;overflow: hidden" onload="resizeIframe(this)"></iframe>

{tab Wall}
<?php require_once 'wall.inc.php'; ?>

<?php $userObj = JFactory::getUser($profile->id); ?>

{tab Profile}
<?php require_once 'company_info.inc.php'; ?>

{tab Videos}
<?php require_once 'videos.inc.php'; ?>

{tab Blog}
<?php require_once 'blog.inc.php'; ?>

{tab News}
<?php require_once 'news_issuer_profile.inc.php'; ?>
<?php // require_once 'news2.inc.php'; ?>


<?php //{tab Editorial} require_once 'news.inc.php';   ?>


{tab Followers}
<div><?php require_once 'followers.inc.php'; ?></div>

{tab Equities Wire}
<?php require_once 'equities_wire.inc.php'; ?>

{tab Trending}
<?php require_once 'trending.inc.php'; ?>
{/tabs}
