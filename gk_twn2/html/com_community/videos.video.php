<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license		GNU/GPL, see LICENSE.php
 *
 *
 */
defined('_JEXEC') or die();
CAssets::attach('assets/easytabs/jquery.easytabs.min.js', 'js');
?>

<script language="javascript">
    joms.jQuery(function() {

        descHeight = joms.jQuery(".video-description").css('height');
        descHeight = descHeight.split("px");
        descHeight = parseInt(descHeight[0]);

        if(descHeight>120){
            joms.jQuery(".video-description").css('height','120px').css('overflow','hidden');
        } else {
            joms.jQuery(".more-text").hide();
        }

        joms.jQuery(".more-text").click(function()
        {

            if(joms.jQuery(".video-description").css('overflow')=="hidden"){
                joms.jQuery(".video-description").css('height','auto').css('overflow','auto');
                joms.jQuery(".more-text").html('<?php echo JText::_("COM_COMMUNITY_HIDE_ACTIVITY") ?>');
            } else {
                joms.jQuery(".video-description").css('height','120px').css('overflow','hidden');
                joms.jQuery(".more-text").html('<?php echo JText::_("COM_COMMUNITY_MORE") ?>');
            }

        });

        joms.jQuery(".video-player").children('iframe').attr('src',function() {
            return this.src + "?wmode=opaque";
        });

    });
</script>


<div class="video-full" id="<?php echo "video-" . $video->getId() ?>">


    <div class="cPageActions clearfix">
        <div class="cPageAction cFloat-R" style="display:none">
            <?php echo $reportHTML; ?>
            <?php echo $bookmarksHTML; ?>
        </div>
    </div><!--action-button-->

    <!--VIDEO PLAYER-->
    <div class="cVideo-Screen video-player">
        <?php echo $video->getPlayerHTML(); ?>
    </div>
    <div class="cMedia-Option">
        <ul class="cMedia-Options cResetList cFloatedList clearfix">

            <li title="<?php echo JText::_('COM_COMMUNITY_VIDEOS_HITS') ?>">
                <i class="com-icon-chart"></i>
                <span>
                    <?php
                    if (CStringHelper::isPlural($video->getHits())) {
                        echo JText::sprintf('COM_COMMUNITY_VIDEOS_HITS_COUNT_MANY', $video->getHits());
                    } else {
                        echo JText::sprintf('COM_COMMUNITY_VIDEOS_HITS_COUNT', $video->getHits());
                    }
                    ?>
                </span>
            </li>
            <li class="cFloat-R">
                <div id="like-container" class="cMedia-Like"><?php echo $likesHTML; ?></div>
            </li>
        </ul>
    </div>
    <!--end: VIDEO PLAYER-->

    <div class="cLayout">
        <!--div class="cSidebar">

            <?php if ($zoomableMap) { ?>
                <div class="cModule cVideo-Location app-box">
                    <div class="app-box-content">
                        <div id="video-map">
                            <h3 class="app-box-header cResetH"><?php echo JText::sprintf('COM_COMMUNITY_PHOTOS_ALBUM_TAKEN_AT_DESC', ''); ?></h3>
                            <?php echo $zoomableMap; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (count($otherVideos) > 1) { ?>
                <div class="cModule cVideo-RelatedVideo app-box">
                    <h3 class="app-box-header">
                        <?php echo JText::_('COM_COMMUNITY_VIDEOS_OTHER'); ?>
                    </h3>

                    <div class="app-box-content">
                        <ul class="cThumbDetails cResetList">
                            <?php
                            $displayCount = 0;
                            foreach ($otherVideos as $others) {
                                $videoInfo = JTable::getInstance('Video', 'CTable');
                                $videoInfo->load($others->id);

                                if ($others->id != $video->id) {
                                    $displayCount++;
                                } else {
                                    continue;
                                }

                                $groupParam = !empty($others->groupid) ? '&groupid=' . $others->groupid : '';
                                ?>
                                <li>
                                    <a class="cThumb-Avatar cFloat-L" href="<?php echo $videoInfo->getUrl(); ?>">
                                        <b class="cAvatar cVideo-Thumb" style="background-image: url(<?php echo $videoInfo->getThumbnail(); ?>); " data="video_prop_<?php echo rand(0, 200) . '_' . $others->id; ?>" ></b>
                                    </a>
                                    <div class="cThumb-Detail">
                                        <a class="cThumb-Title" href="<?php echo $videoInfo->getUrl(); ?>">
        <?php echo $this->escape($others->title); ?>
                                        </a>
                                        <div class="cThumb-Brief small">
                                            <?php echo $others->hits; ?> <?php echo JText::_('COM_COMMUNITY_VIDEOS_HITS') ?>
                                        </div>
                                    </div>
                                </li>
        <?php
        if ($displayCount == 5) {
            break;
        }
    } //end foreach 
    ?>
                        </ul>
                    </div>
                </div>
            <?php } //end if  ?>
        </div --><!--cSidebar-->

        <div class="cMain">


            <div class="cMedia-About">
                <div class="cMedia-Author">
                    <?php echo JText::_('COM_COMMUNITY_VIDEOS_UPLOADED_BY'); ?>
                    <strong>
                        <a href="<?php echo CUrlHelper::userLink($user->id); ?>">
                            <?php echo $user->getDisplayName(); ?>
                        </a>
                    </strong>.

                    <?php echo JText::_('COM_COMMUNITY_VIDEOS_CREATED') ?>
                    <strong><?php echo JHTML::_('date', $video->created, JText::_('DATE_FORMAT_LC3')); ?></strong>.

                    <?php if (!empty($video->location) && $videoMapsDefault == 1): ?>
                        <?php echo JText::_('COM_COMMUNITY_VIDEOS_LOCATION') ?> <a class="album-map-link" onclick="joms.jQuery('#video-map').toggle();" title="<?php echo JText::_('COM_COMMUNITY_VIEW_LOCATION_TIPS'); ?>" href="javascript: void(0)"><?php echo $video->location; ?></a><br />
                    <?php endif; ?>
                </div>

                <div class="cMedia-Tag videoTextTags small app-box"><?php echo JText::_('COM_COMMUNITY_VIDEOS_IN_THIS_VIDEO'); ?> </div>

                <?php
                if (COwnerHelper::isCommunityAdmin() || ($my->id == $video->creator)) {
                    ?>
                    <div class="cMedia-TagOptions video-tagging">
                        <a class="cButton cButton-Small" id="addtagging" href="javascript:void(0);" onclick="joms.friends.showForm('', 'videos,inviteUsers','<?php echo $video->getId() ?>','1','joms.videos.selectVideoTagFriends(<?php echo $video->getId() ?>)');" >
                            <?php echo JText::_('COM_COMMUNITY_TAG_THIS_VIDEO'); ?>
                        </a>
                    </div>
                <?php } ?>

                <div class="cMedia-Description">
                    <b><?php echo JText::_('COM_COMMUNITY_VIDEOS_PROFILE_VIDEO_DESCRIPTION'); ?></b>
                    <div class="video-description"><?php echo nl2br($video->getDescription()); ?></div>
                    <a href="javascript:void(0)" class="cButton cButton-Small more-text"><?php echo JText::_("COM_COMMUNITY_MORE"); ?></a>
                </div>
            </div><!--video details-->

            <div class="cPage-Wall">


                <?php
                /* $plugin = &JPluginHelper::getPlugin('content', 'jw_disqus');
                  $pluginParams = new JParameter($plugin->params);
                  $disqusshortname = 'equitiesdev'; */
                $params = &JComponentHelper::getParams('com_k2');
                $disqusshortname = $params->get('jw_disqus_subdomain');
                ?>
                <script type="text/javascript">
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = 'http://<?php echo $disqusshortname; ?>.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                <div id="disqus_thread"></div>

                <?php
                $__dsq_my = CFactory::getUser();
//print_r($__dsq_my);
//echo $__dsq_my->id;
                define('DISQUS_SECRET_KEY', '0g5DWftZP75YaVVHHJttfXyy197lrEOKT9Gmst9KjmtKwbzLxwOd0Rf1KBKhJAf7');
                define('DISQUS_PUBLIC_KEY', 'v9NAZ0nn2XG37bs3rsBrit7mZvzPYotuCKTmkUKMmkSWxrxp8fPILqOZJrHRS4HM');

                function dsq_hmacsha1($data, $key) {
                    $blocksize = 64;
                    $hashfunc = 'sha1';
                    if (strlen($key) > $blocksize)
                        $key = pack('H*', $hashfunc($key));
                    $key = str_pad($key, $blocksize, chr(0x00));
                    $ipad = str_repeat(chr(0x36), $blocksize);
                    $opad = str_repeat(chr(0x5c), $blocksize);
                    $hmac = pack(
                            'H*', $hashfunc(
                                    ($key ^ $opad) . pack(
                                            'H*', $hashfunc(
                                                    ($key ^ $ipad) . $data
                                            )
                                    )
                            )
                    );
                    return bin2hex($hmac);
                }

                $__remote_auth_s3 = "{}";
                if ($__dsq_my->id > 0) {
                    $__dsq_data = array(
                        "id" => $__dsq_my->id,
                        "username" => $__dsq_my->username,
                        "email" => $__dsq_my->email
                    );

                    $__dsq_message = base64_encode(json_encode($__dsq_data));
                    $__dsq_timestamp = time();
                    $__dsq_hmac = dsq_hmacsha1($__dsq_message . ' ' . $__dsq_timestamp, DISQUS_SECRET_KEY);
                    $__remote_auth_s3 = "$__dsq_message $__dsq_hmac $__dsq_timestamp";
                }
                ?>

                <script type="text/javascript">
                    var disqus_config = function() {
                        this.page.remote_auth_s3 = "<?php echo $__remote_auth_s3; ?>";
                        this.page.api_key = "<?php echo DISQUS_PUBLIC_KEY; ?>";
                    }
                </script>


            </div>
        </div><!--cMain-->

    </div><!--cLayout-->
</div>

<script type="text/javascript">
    var video_tags = [
<?php foreach ($video->tagged as $tagItem) { ?>
                                                            {
                                                                id:     <?php echo $tagItem->id; ?>,
                                                                videoId: <?php echo $video->id; ?>,
                                                                userId: <?php echo $tagItem->userid; ?>,
                                                                displayName: '<?php echo addslashes($tagItem->user->getDisplayName()); ?>',
                                                                profileUrl: '<?php echo CRoute::_('index.php?option=com_community&view=profile&userid=' . $tagItem->userid, false); ?>',
                                                                canRemove: <?php echo $tagItem->canRemoveTag; ?>
                                                            }
    <?php $end = end($video->tagged);
    if ($end->id != $tagItem->id) echo ','; ?>
<?php } ?>
                                                    ];
                                                    joms.jQuery(document).ready(function(){
                                                        joms.videos.addVideoTextTag(video_tags,"<?php echo JText::_('COM_COMMUNITY_REMOVE') ?>");
                                                    });
</script>