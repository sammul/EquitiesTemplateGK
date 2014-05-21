<?php
/*ini_set("display_errors", "On");
ini_set("display_startup_errors", "On");
error_reporting(E_ALL);*/
?>
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
			<a target="_blank" href="<?php echo JURI::base(); ?>community/<?php echo str_replace(":", "-", K2JomUtilities::getCommunityURLFragment($profile->id)); ?>/profile?profile=public">
				<img src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape($user->getDisplayName()); ?>" width="180" style="display: block;margin-bottom: 5px;" />
			</a>
        </div>
        <div>
			<?php $current_user_parsing = & JFactory::getUser(); ?>

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
				if (in_array(10, $user_parsing->groups)) {
					echo $user->getDisplayName();
				} else {
					if ($rowp[0]->newusername != "") {
						echo $rowp[0]->newusername;
					} else {
						echo $user->username;
					}
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
			<!-- Wall tab for Users and Vendors -->
            {tab Wall}
            <div><?php require_once 'wall.inc.php'; ?></div>
			
			<!-- Articles tab only for Vendors -->
			<?php if (in_array(10, $user_parsing->groups)): ?>
				{tab Articles |active }
				<?php $dash_published = JRequest::getVar("published", 1); ?>
				<div class="jomUserListTitle">
				   <!--<h2 class="jomListTitle"><?php echo JText::_('COM_COMMUNITY_ARTICLES'); ?></h2>-->
					<div class="writerdashboard-actions">
						<ul>
							<li><a style="font-weight:<?php echo ($dash_published == 1 ? 'bolder' : 'lighter'); ?>" href="<?php echo JURI::base(); ?>community/profile?published=1#articles">Published</a></li>
							<li><a style="font-weight:<?php echo ($dash_published == 0 ? 'bolder' : 'lighter'); ?>" href="<?php echo JURI::base(); ?>community/profile?published=0#articles">Submitted</a></li>
							<li><a style="font-weight:<?php echo ($dash_published == -2 ? 'bolder' : 'lighter'); ?>" href="<?php echo JURI::base(); ?>community/profile?published=-2#articles">Draft</a></li>
							<li><a style="font-weight:lighter" href="<?php echo JURI::base(); ?>community/article/add?itemformtype=1&messaget=1" >Add Article</a></li>
						</ul>                                         
					</div>
					<table class="writerdashboard">
						<tr>
							<th width="<?php echo ($dash_published > 0 ? '55' : '82'); ?>%" class="title">Article</th>
							<th width="18%"><?php echo ($dash_published > 0 ? 'Published' : 'Created'); ?></th>
							<?php if ($dash_published > 0) { ?>
								<th width="17%">Page Views</th>
								<th width="10%">Share</th>
							<?php } else { ?>
								<th width="10%">Preview</th>
							<?php } ?>
						</tr>
						<?php
						$dash_limitstart = JRequest::getVar("start", 0);
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
							if ($dash_published > 0) {
								$articleUrl = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId);
							} else {
								$articleUrl = '/community/article/edit/?id=' . $item->id . '&itemformtype=1';
							}
							//$articleUrl2 = JRoute::_(JURI::base() . 'index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId);
							$articleUrl2 = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId, true, -1);
							echo '<tr>';
							echo '<td class="title"><a href="' . $articleUrl . '">' . K2JomUtilities::wordLimit($item->title, 12) . '</a></td>';
							echo '<td class="date"><span>' . JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC4')) . '</span></td>';
							if ($dash_published > 0) {
								echo '<td class="hits">' . $item->hits . '</td>';
								//                        echo '<td><img src="' . JURI::base() . '/images/community/share.jpg" alt="Share" /></td>';
								?>
								<td>
									<span class="st_sharethis_custom" st_url="<?php echo $articleUrl2; ?>" st_title="<?php echo $item->title; ?>" style="cursor: pointer;"></span>

									<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>                     
								</td>
							<?php } else { ?>
								<td>
									<a href="<?php echo JURI::base(); ?>index.php?option=com_k2&view=item&task=preview&id=<?php echo $item->id; ?>" target="_blank">
										<img src="<?php echo JURI::base(); ?>images/icons/preview.png" />
									</a>
								</td>
								<?php
								echo '</tr>';
							}
						}
						?>
					</table>
					<?php
					jimport('joomla.html.pagination');
					$_pagination = new JPagination($dash_total, $dash_limitstart, $dash_limit);
					echo "<div class='cK2Pagination'>" . $_pagination->getPagesLinks() . "</div>";
					?>
				</div>
			<?php endif; ?>

			<?php
			//{tab Blog}
			//<div>
			//require_once 'blog_articles.inc.php';
			//</div>
			?>

			<!-- Directory and wire tabs only for Vendors -->
			<?php if (in_array(10, $user_parsing->groups)): ?>
				{tab Directory}
				<?php require_once 'directory.inc.php'; ?>
				{tab Equities Wire}
				<?php
				//require_once 'gnw.inc.php'; 
				require_once 'equities_wire.inc.php'
				?>
			<?php endif; ?>


			<!-- Watchlist tab only for Users -->
			<?php if (!in_array(10, $user_parsing->groups)): ?>
	            {tab Watch List}
	            <div><?php require_once 'watchlist.inc.php'; ?></div>
			<?php endif; ?>

			<!-- chat tab for  users and Vendors -->
			{tab Chat}
			<?php require_once 'vchat.inc.php'; ?>
			
			<!-- Followers tab for Authors and Vendors -->
			{tab Followers}
			<div><?php require_once 'followers.inc.php'; ?></div>

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