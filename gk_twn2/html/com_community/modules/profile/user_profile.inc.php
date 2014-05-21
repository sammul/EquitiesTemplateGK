<!-- begin: .profile-box -->
<script>
<?php if ($isMine): ?>
		jQuery(document).ready(function() {

			var c_search_form2 = "<div class=\"cModule cFrontPage-Search app-box2\">"
				+ "<div class=\"app-box-content\">"
				+ "<form name=\"search\" id=\"cFormSearch\" method=\"get\" action=\"<?php echo CRoute::_("index.php?option=com_community&view=search"); ?>\">"
				+ "   <div class=\"cSearch-Box input-wrap\">"
				+ "      <input type=\"text\" class=\"input text\" id=\"keyword\" name=\"q\" placeholder=\"Search Members\" style=\"width:93%\"/>"
				+ "      <a class=\"cButton-Search\" href=\"javascript:void(0);\" onclick=\"joms.jQuery('#cFormSearch').submit();\">"
				+ "          <i class=\"com-glyph-search\"></i>                                            "
				+ "      </a>"
				+ "      <input type=\"hidden\" name=\"option\" value=\"com_community\" />"
				+ "      <input type=\"hidden\" name=\"view\" value=\"search\" />"
				+ "  </div>"
				+ "</form>"
				+ "</div>                    "
			"</div>";

			var user_link = "<h3><a class=\"writer-app-form\" style=\"padding-left:11px; margin-top:20px\" href=\"/writer-app\" target=\"_blank\">Writer Application</a></h3>";                 
			jQuery("#jc_community_search").append(c_search_form2);
			jQuery("#jc_writer_application").append(user_link);
		});
<?php endif; ?>

    function loadMoreAbout() {
        jQuery("#dotsaboutme").hide();
        jQuery("#readmoreaboutme").hide();
        jQuery("#moreaboutme").slideDown();
    }
</script>
<?php
$my = CFactory::getUser();
$dbp = & JFactory::getDBO();
$query = "Select newusername,username from #__users where id = '" . $my->_userid . "'";
$res1 = $dbp->setQuery($query);
$res = $dbp->query();
$rowp = $dbp->loadObjectList();
?>
<div class="cPageHeader">

    <div class="cPageAvatar cFloat-L">
        <div>
            <img src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape($user->getDisplayName()); ?>" width="180" style="display: block;margin-bottom: 5px;" />
        </div>
        <div>
            <?php $current_user_parsing = & JFactory::getUser(); ?>
            <?php if (!$isMine): ?>
                <?php if ($AmIFollowingThisUser): ?>
                    <a href="javascript:void(0);" onclick="joms.friends.confirmFriendRemoval('<?php echo $profile->id; ?>')">
                        <span class="buttonfollow"><img src="<?php echo JURI::base(); ?>images/icons/minus.png" /><?php echo JText::_('COM_COMMUNITY_REMOVE_FRIEND'); ?></span>
                    </a>
                <?php else: ?>
                    <?php if (!$isBlocked && !in_array(9, $current_user_parsing->groups)): ?>
                        <?php if (!$isWaitingApproval): ?>
                            <a href="javascript:void(0)" onclick="joms.friends.connect('<?php echo $profile->id; ?>')">
                                <span class="buttonfollow"><img src="<?php echo JURI::base(); ?>images/icons/plus.png" /><?php echo JText::_('COM_COMMUNITY_FRIENDS_ADD_BUTTON'); ?></span>
                            </a>
                        <?php else : ?>
                            <a href="javascript:void(0)" onclick="joms.friends.connect('<?php echo $profile->id; ?>')">
                                <i class="com-icon-info"></i>
                                <span><?php echo JText::_('COM_COMMUNITY_PROFILE_PENDING_FRIEND_REQUEST'); ?></span>
                            </a>
                        <?php endif ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

			<?php if (!$isMine && $config->get('enablepm')): ?>
				<a onclick="<?php echo $sendMsg; ?>" href="javascript:void(0);">
					<span class="buttonfollow"><img src="/images/icons/mail.png" /><?php echo JText::_('COM_COMMUNITY_MESSAGE'); ?></span>
				</a>
			<?php endif; ?>

            <ul class="listlinksjomsocial">
                <li><a href="<?php echo CRoute::_('index.php?option=com_community&view=followers&userid=' . $profile->id); ?>"><img alt="<?php echo JText::_('COM_COMMUNITY_FRIENDS'); ?>" src="<?php echo JURI::base(); ?>images/icons/followers.png" /><?php echo JText::_('COM_COMMUNITY_FRIENDS'); ?>&nbsp;(<?php echo CExtraHelper::getTotalNumberOfFollowers($profile->id); ?>)</a></li>
                <li><a href="<?php echo CRoute::_('index.php?option=com_community&view=following&userid=' . $profile->id); ?>"><img alt="<?php echo JText::_('COM_COMMUNITY_FOLLOWING'); ?>" src="<?php echo JURI::base(); ?>images/icons/following.png" /><?php echo JText::_('COM_COMMUNITY_FOLLOWING'); ?>&nbsp;(<?php echo CExtraHelper::getTotalNumberOfFollowing($profile->id); ?>)</a></li>
                <li><a href="/community/profile/edit"><img alt="<?php echo JText::_('COM_COMMUNITY_APPS_SETTINGS_TITLE'); ?>" src="<?php echo JURI::base(); ?>images/icons/edit.png" /><?php echo JText::_('COM_COMMUNITY_APPS_SETTINGS_TITLE'); ?></a></li>
                <li><a href="/community/inbox"><img alt="<?php echo JText::_('COM_COMMUNITY_COMMENTS'); ?>" src="<?php echo JURI::base(); ?>images/icons/messages.png" /><?php echo JText::_('COM_COMMUNITY_COMMENTS'); ?></a></li>
            </ul>

            <div>
				<?php if ($user->getInfo("FIELD_WEBSITE")): ?>
					<a href="<?php echo $user->getInfo("FIELD_WEBSITE"); ?>" class="marginright" target="_blank"><img alt="ln" src="/images/icons/website.png"  /> Website</a>
				<?php endif; ?>
				<?php if ($user->getInfo("field_newsletter")): ?>
					<a href="<?php echo $user->getInfo("field_newsletter"); ?>" class="marginright" target="_blank"><img alt="ln" src="/images/icons/newsletter.jpg"  /> Newsletter</a>
				<?php endif; ?>
            </div>

        </div>
        <span class="cPage-Like" id="like-container" style="display:none"><?php echo $likesHTML; ?></span>
    </div>
    <!-- Short Profile info -->
    <div class="cPageInfo">
        <h2 class="cPageInfo-Name cResetH"><?php
				if ($rowp[0]->newusername != "") {
					echo $rowp[0]->newusername;
				} else {
					echo $user->username;
				}
				?></h2>
        <div class="jomUserListTitle">
            <h2 class="jomListTitle"><?php echo JText::_('COM_COMMUNITY_APPS_LIST_ABOUT'); ?></h2>
        </div>
        <div class="jomUserItemAbout" style="margin-bottom: 25px">
			<?php
			$aboutField = strip_tags($user->getInfo("FIELD_ABOUTME"));
			if (strlen($aboutField) > 800) {
				$partA = substr($aboutField, 0, 800);
				$partTemp = substr($aboutField, 800);
				if (strpos($partTemp, " ") !== FALSE)
					$posSeperators[] = strpos($partTemp, " ");
				//if(strpos($partTemp, ",")!==FALSE)$posSeperators[] = strpos($partTemp, ",");
				//if(strpos($partTemp, ".")!==FALSE)$posSeperators[] = strpos($partTemp, ".");
				//if(strpos($partTemp, ";")!==FALSE)$posSeperators[] = strpos($partTemp, ";");
				$posSeperator = min($posSeperators);
				$partA .= substr($partTemp, 0, $posSeperator);
				$partB = substr($partTemp, $posSeperator);
				echo "<pre class='preaboutme'>" . $partA . "<span id='dotsaboutme'>...</span><a id='readmoreaboutme' href='' onclick='loadMoreAbout();return false;'>Read more</a><span id='moreaboutme' style='display:none'>" . $partB . "</pre></span>";
			}
			else
				echo $aboutField;
			?>
        </div>

        <div style="overflow: hidden">
            {tab Wall}
            <div><?php require_once 'wall.inc.php'; ?></div>

			<?php if ($isMine): ?>
				{tab Blog}
				<div><?php require_once 'blog_articles.inc.php'; ?></div>
			<?php endif; ?>

			<?php if (in_array(10, $user_parsing->groups)): ?>
				{tab Directory}
				<?php require_once 'directory.inc.php'; ?>
			<?php endif; ?>

			<?php /*if (in_array(10, $user_parsing->groups)): 
				{tab Equities Wire}
			require_once 'equities_wire.inc.php';
			endif; */?>

			<?php if (!$isMine): ?>
				{tab Followers}
				<div><?php require_once 'followers.inc.php'; ?></div>

				{tab Following}
				<div><?php require_once 'following.inc.php'; ?></div>
			<?php endif; ?>
            {tab Watch List}
            <div><?php require_once 'watchlist.inc.php'; ?></div>

			<?php if ($isMine): ?>
				{tab Chat}<?php
			require_once 'vchat.inc.php';
		endif;
			?>

			<?php //{tab Trending} require_once 'trending.inc.php';  ?>
            {/tabs}

        </div>



		<?php if (false && $profile->status) { ?>
			<div class="cPageInfo-Status">
				<span id="profile-status-message"><?php echo $profile->status; ?></span>
				<div class="small">- <?php echo $profile->posted_on; ?></div>
			</div>
		<?php } ?>

    </div>
</div>
<!-- end: .profile-box -->

<div class="cTabsBar cResponsive">
    <ul class="cPageTabs cResetList cFloatedList clearfull">
        <li class="cTabCurrent"><a href="#">Stream Feeds</a></li>
        <li><a href="#">More Info</a></li>
    </ul>
</div>

<script>
    jQuery(document).ready(function() {
        jQuery("span.nn_tabs_alias_watch-list a").on('click', function() {
            SqueezeBox.fromElement(jQuery("#lightbox4watchlist").attr("href"), {size: {x: 1200, y: 500}, handler: 'iframe'});
            //SqueezeBox.fromElement('<?php echo JRoute::_('index.php?option=com_community&view=profile&task=viewwatchlist&requestuserid=' . $requestuserid . '&tmpl=component&rand=' . rand(1, 10000)) ?>', {size:{x:1200,y:500}, handler:'iframe'});
        });
    });
</script>