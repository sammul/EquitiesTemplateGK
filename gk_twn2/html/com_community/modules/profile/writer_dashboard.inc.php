<!-- begin: .profile-box -->
<script>
    jQuery(document).ready(function () {
        var c_search_form = "<div class=\"cModule cFrontPage-Search app-box2\">"
            +"<div class=\"app-box-content\">"
            +   "<form name=\"search\" id=\"cFormSearch\" method=\"get\" action=\"<?php echo CRoute::_("index.php?option=com_community&view=search"); ?>\">"
            +   "   <div class=\"cSearch-Box input-wrap\">"
            +    "      <input type=\"text\" class=\"input text\" id=\"keyword\" name=\"q\" placeholder=\"Search Members\" style=\"width:93%\"/>"
            +    "      <a class=\"cButton-Search\" href=\"javascript:void(0);\" onclick=\"joms.jQuery('#cFormSearch').submit();\">"
            +     "          <i class=\"com-glyph-search\"></i>                                            "
            +     "      </a>"
            +     "      <input type=\"hidden\" name=\"option\" value=\"com_community\" />"
            +     "      <input type=\"hidden\" name=\"view\" value=\"search\" />"
            +     "  </div>"
            +   "</form>"
            +   "</div>"
        "</div>";
        jQuery("#jc_community_search").append(c_search_form);
    });
    function loadMoreAbout() {
        jQuery("#dotsaboutme").hide();
        jQuery("#readmoreaboutme").hide();
        jQuery("#moreaboutme").slideDown();
    }
</script>
<div style="float:left; width:69%">
    <h3 style="margin-top: -15px;display: block;">Equities Member Dashboard</h3>
    <div class="cPageHeader">
        <div class="cPageAvatar cFloat-L">
            <div>
                <a target="_blank" href="<?php echo JURI::base(); ?>community/<?php echo str_replace(":", "-", K2JomUtilities::getCommunityURLFragment($profile->id)); ?>/profile">
                    <img src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape($user->getDisplayName()); ?>" width="180" style="display: block;" />
                </a>
            </div>
            <div class="writer_type">
				<?php
				$writer_type = $user->getInfo("field_writertype");
				echo JText::_('COM_COMMUNITY_WRITER_TYPE_PREFIX');
				echo $writer_type ? $writer_type : JText::_('COM_COMMUNITY_WRITER_TYPE_DEFAULT');
				?>
            </div>
            <div>
                <h2 class="cWriterName"><?php echo $user->getDisplayName(); ?></h2>
            </div>
            <div>
				<?php $current_user_parsing = & JFactory::getUser(); //issuers cannot follow anybody  ?>
				<?php if (!$isFriend && !$isMine && !$isBlocked && !in_array(9, $current_user_parsing->groups)): ?>
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

                <ul class="listlinksjomsocial">
                    <li><a href="<?php echo CRoute::_('index.php?option=com_community&view=followers&userid=' . $profile->id); ?>"><img alt="<?php echo JText::_('COM_COMMUNITY_FRIENDS'); ?>" src="<?php echo JURI::base(); ?>images/icons/followers.png" /><?php echo JText::_('COM_COMMUNITY_FRIENDS'); ?>&nbsp;(<?php echo CExtraHelper::getTotalNumberOfFollowers($profile->id); ?>)</a></li>
                    <li><a href="<?php echo CRoute::_('index.php?option=com_community&view=following&userid=' . $profile->id); ?>"><img alt="<?php echo JText::_('COM_COMMUNITY_FOLLOWING'); ?>" src="<?php echo JURI::base(); ?>images/icons/following.png" /><?php echo JText::_('COM_COMMUNITY_FOLLOWING'); ?>&nbsp;(<?php echo CExtraHelper::getTotalNumberOfFollowing($profile->id); ?>)</a></li>
                    <li><a href="/community/profile/edit"><img alt="<?php echo JText::_('COM_COMMUNITY_APPS_SETTINGS_TITLE'); ?>" src="<?php echo JURI::base(); ?>images/icons/edit.png" /><?php echo JText::_('COM_COMMUNITY_APPS_SETTINGS_TITLE'); ?></a></li>
                    <?php /* ?>
                    <!--
                    <li><a href="/community/inbox"><img alt="<?php echo JText::_('COM_COMMUNITY_COMMENTS'); ?>" src="<?php echo JURI::base(); ?>images/icons/messages.png" /><?php echo JText::_('COM_COMMUNITY_COMMENTS'); ?></a></li>
                    //-->
                    <?php */ ?>

					<?php if (in_array(3, $user_parsing->groups)) { ?>
						<li><a href="#"><img alt="<?php echo JText::_('COM_COMMUNITY_ARTICLES'); ?>" src="<?php echo JURI::base(); ?>images/icons/articles.png" /><?php echo JText::_('COM_COMMUNITY_ARTICLES'); ?> (<?php echo K2JomUtilities::getTotalNumberOfArticles($profile->id); ?>)</a></li>
					<?php }; ?>
                </ul>
				<?php if (in_array(3, $user_parsing->groups)) { ?>
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
							<a href="<?php echo $user->getInfo("FIELD_WEBSITE"); ?>" class="marginright" target="_blank"><img alt="Website" src="/images/icons/website.png" /> Website</a>
						<?php endif; ?>
						<?php if ($user->getInfo("field_newsletter")): ?>
							<a href="<?php echo $user->getInfo("field_newsletter"); ?>" class="marginright" target="_blank"><img alt="Newsletter" src="/images/icons/newsletter.jpg" /> Newsletter</a>
						<?php endif; ?>
					</div>
				<?php } ?>
            </div>            

            <span class="cPage-Like" id="like-container" style="display:none"><?php echo $likesHTML; ?></span>


        </div>

        <!-- Short Profile info -->
        <div class="cPageInfo">
            <h2 style="display:none" class="cPageInfo-Name cResetH"><?php echo $user->getDisplayName(); ?></h2>
            <h3 style="display:none;font-size: 15px !important"><?php echo $user->getInfo("Field_tagline"); ?></h3>
            <div class="jomUserListTitle" style="display:none">
                <h2 class="jomListTitle"><?php echo JText::_('COM_COMMUNITY_APPS_LIST_ABOUT'); ?></h2>
            </div>
            <div style="margin-bottom: 25px"></div>
            <div class="jomUserItemAbout" style="display:none; margin-bottom: 25px">
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
				<!-- Wall tab for Authors and Vendors -->
                {tab Wall}
                <div><?php require_once 'wall.inc.php'; ?></div>

				<!-- Articles tab for Authors and Vendors -->
                {tab Articles |active }
				<?php $dash_published = JRequest::getVar("published", 1); ?>
                <div class="jomUserListTitle">
                   <!--<h2 class="jomListTitle"><?php echo JText::_('COM_COMMUNITY_ARTICLES'); ?></h2>-->
                    <div class="writerdashboard-actions">
                        <ul>
                            <li><a style="font-weight:<?php echo ($dash_published==1?'bolder':'lighter'); ?>" href="<?php echo JURI::base(); ?>community/profile?published=1#articles">Published</a></li>
                            <li><a style="font-weight:<?php echo ($dash_published==0?'bolder':'lighter'); ?>" href="<?php echo JURI::base(); ?>community/profile?published=0#articles">Submitted</a></li>
                            <li><a style="font-weight:<?php echo ($dash_published==-2?'bolder':'lighter'); ?>" href="<?php echo JURI::base(); ?>community/profile?published=-2#articles">Draft</a></li>
                            <li><a style="font-weight:lighter" href="<?php echo JURI::base(); ?>community/article/add?itemformtype=1&messaget=1" >Add Article</a></li>
                        </ul>
                    </div>
                    <table class="writerdashboard">
                        <tr>
                            <th width="<?php echo ($dash_published > 0 ? '55' : '82'); ?>%" class="title">Article</th>
                            <th width="18%"><?php
                            $dash_orderby = 'modified';
                            if ($dash_published > 0) {
                                echo 'Published';
                                $dash_orderby = 'publish_up';
                            } elseif ($dash_published == 0) {
                                echo 'Submitted';
                            } else {
                                echo 'Modified';
                            } ?></th>
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

						$items = K2JomUtilities::getArticles($profile->id, 10, $dash_limitstart, $dash_published, $dash_orderby);
						if (JFile::exists(JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php')) {
							JLoader::register('K2HelperRoute', JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
						}
						foreach ($items as $item) {
                            if ($dash_published > 0) {
                                $_showdate = $item->publish_up;
                            } else {
                                if (empty($item->modified) || strpos($item->modified, "0000") !== false) {
                                    $_showdate = $item->created;
                                } else {
                                    $_showdate = $item->modified;
                                }
                            }

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
							echo '<td class="date"><span>' . JHTML::_('date', $_showdate, JText::_('K2_DATE_FORMAT_LC4')) . '</span></td>';
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
									<a href="<?php echo JURI::base(); ?>index.php?option=com_k2&view=item&task=preview&id=<?php echo $item->id; ?>" target="_blank" name="previewhref">
										<img src="<?php echo JURI::base(); ?>images/icons/preview.png" />
									</a>
                                    <?php if ($dash_published == -2) {?>
									<a href="<?php echo JURI::base(); ?>index.php?option=com_k2&format=raw&view=item&task=trash&cid=<?php echo $item->id; ?>"  title="Remove Article" target="_blank" name="removedraft">
										<img src="<?php echo JURI::base(); ?>images/icons/trash.png" />
									</a>
                                    <?php }?>
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

				<!-- Directory and Wire tabs only for Vendors -->
				<?php if (in_array(10, $user_parsing->groups)): ?>
					{tab Directory}
					<?php require_once 'directory.inc.php'; ?>
					{tab Equities Wire}
					<?php require_once 'equities_wire.inc.php'; ?>
				<?php endif; ?>

				<!-- Followers tab for Authors and Vendors -->
				{tab Followers}
				<div><?php require_once 'followers.inc.php'; ?></div>
					
				<!-- Watchlist tab only for Authors -->
				<?php if (!in_array(10, $user_parsing->groups)): ?>
                {tab Watch List}
                <div><?php require_once 'watchlist.inc.php'; ?></div>
				<?php endif; ?>
				
				<!-- Chat tab for Authors and Vendors -->
				{tab Chat}
				<?php require_once 'vchat.inc.php'; ?>

				<?php //{tab Trending} require_once 'trending.inc.php';    ?>
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

</div>


<div class="gkMain gkCol" id="gkRight" style="float:right; margin-top: -28px">
    <div class="gkMain" id="gkRightTop">
		<?php $this->renderModules('writer_right', array('style' => 'xhtml')); ?>
    </div>
</div>


<script>
    jQuery(document).ready(function(){
        jQuery("span.nn_tabs_alias_watch-list a").on('click', function(){
            SqueezeBox.fromElement(jQuery("#lightbox4watchlist").attr("href"), {size:{x:1200,y:500}, handler:'iframe'});
            //SqueezeBox.fromElement('<?php echo JRoute::_('index.php?option=com_community&view=profile&task=viewwatchlist&requestuserid=' . $requestuserid . '&tmpl=component&rand=' . rand(1, 10000)) ?>', {size:{x:1200,y:500}, handler:'iframe'});
        });

        jQuery("a[name^='previewhref']").each(function(){
            var thistd = jQuery(this);
            jQuery(this).unbind('click').click(function(){
                window.open(thistd.attr('href'), 'previewwindow', 'height=600, width=1000, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, resizable=yes,location=no, status=no');

                return false;
            });
        });

        jQuery("a[name^='removedraft']").each(function(){
            jQuery(this).unbind('click').click(function(){
                if(!confirm("Are you sure you want to remove this draft?")) {
                    return false;
                }
                var thisatag = jQuery(this);
                var trashhref = thisatag.attr('href');

                jQuery.ajax({
                    'type': 'GET',
                    'dataType': 'json',
                    'url': trashhref,
                    'success':function(data){
                        if (data.success){
                            jQuery(thisatag).parent().parent().remove();
                        } else {
                            alert(data.msg);
                        }
                    },
                    'complete':function(XHR,TS){XHR = null;}
                });

                return false;
            });
        });

    });
</script>