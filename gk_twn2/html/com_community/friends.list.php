<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license		GNU/GPL, see LICENSE.php
 *
 * @param	author		string
 * @param	categories	An array of category objects.
 * @params	groups		An array of group objects.
 * @params	pagination	A JPagination object.
 * @params	isJoined	boolean	determines if the current browser is a member of the group
 * @params	isMine		boolean is this wall entry belong to me ?
 * @params	config		A CConfig object which holds the configurations for JomSocial
 */
defined('_JEXEC') or die();
?>
<?php if (isset($sortings)) echo $sortings; ?>
<div class="cLayout cFriends-List">
    <?php
    if (!empty($friends)) {
        ?>
        <ul class="cIndexList forFriendsList cResetList">
            <?php
            foreach ($friends as $user) :
                ?>
                <li id="friend-<?php echo $user->id; ?>">
                    <div class="cIndex-Box clearfix">
                        <div style="float: left; width: 66px">
                            <a href="<?php echo $user->profileLink; ?>" class="cIndex-Avatar cFloat-L">
                                <?php
                                $user_parsing = & JFactory::getUser($user->id);
                                $finalName = $user->username;
                                if (in_array(9, $user_parsing->groups) || in_array(3, $user_parsing->groups))
                                    $finalName = $user->getDisplayName();
                                ?>
                                <img src="<?php echo $user->getThumbAvatar(); ?>" alt="<?php echo $finalName; ?>" class="cAvatar" />

                            </a>
                            <?php if ($user->isOnline()) { ?>
                                <div class="cStatus-Online"><?php echo JText::_('COM_COMMUNITY_ONLINE'); ?></div>
                            <?php } ?>
                        </div>
                        <div class="cIndex-Content">
                            <h3 class="cIndex-Name cResetH">
                                <a href="<?php echo $user->profileLink; ?>">
                                    <?php echo $finalName; ?>
                                </a>
                            </h3>
                            <?php if ($user->getStatus()) { ?>
                                <div class="cIndex-Status">
                                    <?php echo $user->getStatus(); ?>
                                </div>
                            <?php } ?>

                            <div class="cIndex-Actions">
                                <?php if ($my->authorise('community.view', 'friends.pm.' . $user->id)): ?>
                                    <div>
                                        <i class="com-icon-mail-go"></i>
                                        <a onclick="joms.messaging.loadComposeWindow(<?php echo $user->id; ?>)" href="javascript:void(0);"><?php echo JText::_('COM_COMMUNITY_INBOX_SEND_MESSAGE'); ?></a>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <i class="com-icon-groups"></i>
                                    <!--<a href="<?php echo CRoute::_('index.php?option=com_community&view=friends&userid=' . $user->id); ?>"><?php echo JText::sprintf((CStringHelper::isPlural($user->friendsCount)) ? 'COM_COMMUNITY_FRIENDS_COUNT_MANY' : 'COM_COMMUNITY_FRIENDS_COUNT', $user->friendsCount); ?></a>-->
                                    <a href="<?php echo CRoute::_('index.php?option=com_community&view=followers&userid=' . $user->id); ?>"><?php echo JText::sprintf((CStringHelper::isPlural($user->followersCount)) ? 'COM_COMMUNITY_FOLLOWERS_COUNT_MANY' : 'COM_COMMUNITY_FOLLOWERS_COUNT', $user->followersCount); ?></a>
                                </div>
                                <?php if ($isMine and isset($friendRel) && $friendRel == 'following'): ?>
                                    <div class="cFloat-R">
                                        <i class="com-icon-groups-delete"></i>
                                        <a href="javascript:void(0);" onclick="joms.friends.confirmFriendRemoval(<?php echo $user->id; ?>);">
                                            <?php echo JText::_('COM_COMMUNITY_REMOVE_FRIEND'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <?php if (isset($isBlocked) and $isBlocked) { ?>
                                        <a href="javascript:void(0);" class="icon-blockuser" onclick="joms.users.unBlockUser('<?php echo $user->id; ?>');">
                                            <i class="com-icon-block-shade"></i>
                                            <?php echo JText::_('COM_COMMUNITY_UNBLOCK_USER'); ?>
                                        </a>
                                    <?php } else if ($friendRel == 'followers') { ?>
                                        <a href="javascript:void(0);" class="icon-blockuser" onclick="joms.users.blockUser('<?php echo $user->id; ?>');">
                                            <i class="com-icon-block-shade"></i>
                                            <?php echo JText::_('COM_COMMUNITY_BLOCK_USER'); ?>
                                        </a>
                                    <?php } ?>
                                </div>


                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    } else {
        ?>
        <div class="cEmpty cAlert">
            <?php
            if ($friendRel == "followers")
                echo JText::_('COM_COMMUNITY_NO_FOLLOWERS_YET');
            else if ($friendRel == "following")
                echo JText::_('COM_COMMUNITY_NO_FOLLOWING_YET');
            ?>
        </div>
        <?php
    }
    ?>	
</div>