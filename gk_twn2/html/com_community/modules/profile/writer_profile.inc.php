<!-- begin: .profile-box -->
<script>
    function loadMoreAbout() {
        jQuery("#dotsaboutme").hide();
        jQuery("#readmoreaboutme").hide();
        jQuery("#moreaboutme").slideDown();
    }
</script>
<div class="cPageHeader">

    <div class="cPageAvatar cFloat-L">
        <div>
            <img src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape($user->getDisplayName()); ?>" width="180" style="display: block;" />            
        </div>
        <div class="writer_type">
			<?php
			$writer_type = $user->getInfo("field_writertype");
			echo JText::_('COM_COMMUNITY_WRITER_TYPE_PREFIX');
			echo $writer_type ? $writer_type : JText::_('COM_COMMUNITY_WRITER_TYPE_DEFAULT');
			;
			?>
        </div>
        <div>
			<?php $current_user_parsing = & JFactory::getUser(); //issuers cannot follow anybody ?>
            <?php if($AmIFollowingThisUser): ?>
            <a href="javascript:void(0);" onclick="joms.friends.confirmFriendRemoval('<?php echo $profile->id; ?>')">
                <span class="buttonfollow"><img src="<?php echo JURI::base(); ?>images/icons/minus.png" /><?php echo JText::_('COM_COMMUNITY_REMOVE_FRIEND'); ?></span>
            </a>
            <?php else: ?>
                <?php //if (!$isFriend && !$isBlocked && !in_array(9, $current_user_parsing->groups)): ?>
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

			<?php if ($config->get('enablepm')): ?>
				<a onclick="<?php echo $sendMsg; ?>" href="javascript:void(0);">
					<span class="buttonfollow"><img src="/images/icons/mail.png" /><?php echo JText::_('COM_COMMUNITY_MESSAGE'); ?></span>
				</a>
			<?php endif; ?>

            <ul class="listlinksjomsocial">
                <li><a href="<?php echo CRoute::_('index.php?option=com_community&view=followers&userid=' . $profile->id); ?>"><img alt="<?php echo JText::_('COM_COMMUNITY_FRIENDS'); ?>" src="<?php echo JURI::base(); ?>images/icons/followers.png" /><?php echo JText::_('COM_COMMUNITY_FRIENDS'); ?>&nbsp;(<?php echo CExtraHelper::getTotalNumberOfFollowers($profile->id); ?>)</a></li>
                <li><a href="<?php echo CRoute::_('index.php?option=com_community&view=following&userid=' . $profile->id); ?>"><img alt="<?php echo JText::_('COM_COMMUNITY_FOLLOWING'); ?>" src="<?php echo JURI::base(); ?>images/icons/following.png" /><?php echo JText::_('COM_COMMUNITY_FOLLOWING'); ?>&nbsp;(<?php echo CExtraHelper::getTotalNumberOfFollowing($profile->id); ?>)</a></li>
                <!--<li><a href="#"><img alt="<?php echo JText::_('COM_COMMUNITY_COMMENTS'); ?>" src="<?php echo JURI::base(); ?>images/icons/messages.png" /><?php echo JText::_('COM_COMMUNITY_COMMENTS'); ?></a></li>-->
                <li><a href="#"><img alt="<?php echo JText::_('COM_COMMUNITY_ARTICLES'); ?>" src="<?php echo JURI::base(); ?>images/icons/articles.png" /><?php echo JText::_('COM_COMMUNITY_ARTICLES'); ?> (<?php echo K2JomUtilities::getTotalNumberOfArticles($profile->id); ?>)</a></li>
            </ul>
            <div>
				<?php if ($user->getInfo("twitter")): ?>
					<a href="<?php echo $profileArray["Social Networks"][0]["value"]; ?>" class="marginright" target="_blank"><img alt="tw" src="/images/icons/twitter.png" /></a>
				<?php endif; ?>
				<?php if ($user->getInfo("facebook")): ?>
					<a href="<?php echo $profileArray["Social Networks"][1]["value"]; ?>" class="marginright" target="_blank"><img alt="fb" src="/images/icons/facebook.png" /></a>
				<?php endif; ?>
				<?php if ($user->getInfo("googleplus")): ?>
					<a href="<?php echo $profileArray["Social Networks"][2]["value"]; ?>" class="marginright" target="_blank"><img alt="gp" src="/images/icons/googleplus.png" /></a>
				<?php endif; ?>
				<?php if ($user->getInfo("linkedin")): ?>
					<a href="<?php echo $profileArray["Social Networks"][3]["value"]; ?>" class="marginright" target="_blank"><img alt="ln" src="/images/icons/linkedin.png"  /></a>
				<?php endif; ?>
				<?php if ($user->getInfo("FIELD_WEBSITE")): ?>
					<a href="<?php echo $user->getInfo("FIELD_WEBSITE"); ?>" class="marginright" target="_blank">Website</a>
				<?php endif; ?>
				<?php if ($user->getInfo("field_newsletter")): ?>
					<a href="<?php echo $user->getInfo("field_newsletter"); ?>" class="marginright" target="_blank">Newsletter</a>
				<?php endif; ?>
            </div>
        </div>
        <span class="cPage-Like" id="like-container" style="display:none"><?php echo $likesHTML; ?></span>
    </div>

    <!-- Short Profile info -->
    <div class="cPageInfo">
        <h2 class="cPageInfo-Name cResetH"><?php echo $user->getDisplayName(); ?></h2>
        <h3 style="font-size: 15px !important"><?php echo $user->getInfo("Field_tagline"); ?></h3>
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

            {tab Articles |active }
            <div class="jomUserListTitle">
               <!--<h2 class="jomListTitle"><?php echo JText::_('COM_COMMUNITY_ARTICLES'); ?></h2>-->
                <table class="writerdashboard">
                    <tr>
                        <th width="70%" class="title">Article</th>
                        <th width="20%">Published</th>                        
                        <th width="10%">Share</th>
                    </tr>
					<?php
					$dash_limitstart = JRequest::getVar("start", 0);
					$dash_published = JRequest::getVar("published", 1);
					$dash_total = K2JomUtilities::getTotalNumberOfArticles($profile->id, $dash_published);
					$dash_limit = 10;
					$items = K2JomUtilities::getArticles($profile->id, 10, $dash_limitstart, $dash_published);
					if (JFile::exists(JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php')) {
						JLoader::register('K2HelperRoute', JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
					}
					foreach ($items as $item) {
						if (isset($item->catid)) {
							$__item = K2HelperRoute::_findItem(array('item' => $item->id, 'category' => $item->catid));
							$itemId = $__item->id;
							unset($__item);
						}
						else
							$itemId = "";
						//$articleUrl = K2HelperRoute::getItemRoute($item->slug,$item->catid);
						$articleUrl = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId);
						//##$articleUrl2 = JRoute::_(JURI::base() . 'index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId);
						$articleUrl2 = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId, true, -1);

						echo '<tr>';
//                        echo "<td><a href='$articleUrl'>" . $item->title . "</a></td>";
						echo '<td class="title"><a href="' . $articleUrl . '">' . K2JomUtilities::wordLimit($item->title, 15) . '</a></td>';
						echo '<td class="date"><span>' . JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC4')) . '</span></td>';
//                        echo '<td><img src="'.JURI::base().'/images/community/share.jpg" alt="Share" /></td>';
						?>
						<td>
							<span class="st_sharethis_custom" st_url="<?php echo $articleUrl2; ?>" st_title="<?php echo $item->title; ?>" style="cursor: pointer;"></span>
						</td>
						<?php
						echo '</tr>';
					}
					?>
                </table>
				<?php
				jimport('joomla.html.pagination');
				$_pagination = new JPagination($dash_total, $dash_limitstart, $dash_limit);
				echo "<div class='cK2Pagination'>" . $_pagination->getPagesLinks() . "</div>";
				?>
            </div>
            <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script> 
            <script>
				//stLight.options({publisher:'insert-your-key-here'});
				//stLight.options({offsetLeft:'-10',offsetTop:'10'});
				/*
            $("span.st_sharethis_custom").each(function(){
                stWidget.addEntry({
                    "service":"sharethis",
                    "element":$(this),
                    "url":$(this).attr("st_url"),
                    "summary":$(this).attr("st_title")   
                });
            });
				 */
            </script>
			
			<?php if (in_array(10, $user_parsing->groups)): ?>
			{tab Directory}
			<?php require_once 'directory.inc.php'; ?>
			<?php endif; ?>

            {tab Followers}
            <div><?php require_once 'followers.inc.php'; ?></div>

            {tab Following}
            <div><?php require_once 'following.inc.php'; ?></div>

            {tab Watch List}
            <div><?php require_once 'watchlist.inc.php'; ?></div>

			<?php //{tab Trending} require_once 'trending.inc.php';   ?>
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
	jQuery(document).ready(function(){
		jQuery("span.nn_tabs_alias_watch-list a").on('click', function(){
			SqueezeBox.fromElement(jQuery("#lightbox4watchlist").attr("href"), {size:{x:1200,y:500}, handler:'iframe'});
			//SqueezeBox.fromElement('<?php echo JRoute::_('index.php?option=com_community&view=profile&task=viewwatchlist&requestuserid='.$requestuserid.'&tmpl=component&rand='.rand(1,10000)) ?>', {size:{x:1200,y:500}, handler:'iframe'});
		});
	});
</script>