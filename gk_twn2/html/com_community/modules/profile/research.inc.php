<?php
$userObj = JFactory::getUser($profile->id);
/*
JUser Object ( [isRoot:protected] => [id] => 6182 [name] => Apple Inc [username] => AAPL [email] => investor_relations@apple.com [password] => 13088bd17232c9bbdac9dea45ef45d1a:pe2k78FlExZzwpom7tJJGr9xyGji3Fj6 [password_clear] => [usertype] => [block] => 0 [sendEmail] => 0 [registerDate] => 2013-06-08 07:05:43 [lastvisitDate] => 2013-06-19 05:35:28 [activation] => [params] => {"timezone":"America\/New_York","update_cache_list":1} [groups] => Array ( [9] => 9 ) [guest] => [lastResetTime] => 0000-00-00 00:00:00 [resetCount] => 0 [_params:protected] => JRegistry Object ( [data:protected] => stdClass Object ( [timezone] => America/New_York [update_cache_list] => 1 ) ) [_authGroups:protected] => Array ( [0] => 1 [1] => 2 [2] => 9 ) [_authLevels:protected] => [_authActions:protected] => [_errorMsg:protected] => [_errors:protected] => Array ( ) ) - See more at: http://www.equities.com/community/6182-apple-inc/profile#research
*/
// Research category
// #__k2_tags
// #__k2_tags_xref
$tag = $userObj->username;

//$sql = "SELECT * FROM #__k2_items WHERE catid=111";
$sql = "SELECT #__k2_items.title,#__k2_items.alias,#__k2_items.created,#__k2_items.introtext  FROM #__k2_tags,#__k2_items,#__k2_tags_xref WHERE #__k2_items.id=#__k2_tags_xref.itemID AND #__k2_tags.id=#__k2_tags_xref.tagID AND #__k2_items.catid=111 AND #__k2_tags.name ='{$tag}'";
$db=JFactory::getDBO();
//$sql="SELECT tabdisplay FROM #__k2_categories WHERE id=".$catid;
$db->setQuery( $sql);
$res=$db->loadObjectList();

?>
<div class="jomUserListTitle">
<?php foreach($res as $item): ?>
	<div class="wrapperArticle">
		<div class="jomUserItemHeader">
			<h3 class="jomUserItemTitle" style="width:auto; font-size: 16px !important">
				<a target="_blank" href="<?php echo "http://www.equities.com/research/research-reports/".$item->alias;//$articleUrl; ?>"><?php echo $item->title; ?></a>
			</h3>
			<!-- Date created -->
			<span class="jomUserItemDateCreated">
				<?php echo date('m/d/Y',strtotime($item->created) ); //JHTML::_('date', $item->created, "mm/dd/yyyy"); //JText::_('K2_DATE_FORMAT_LC3')); ?>
			</span>
		</div>
		<div class="jomUserItemBody">
			<!-- Item introtext -->
			<div class="jomUserItemIntroText">
				<?php //echo $item->introtext; ?>
				<?php //echo K2HelperUtilities::wordLimit(strip_tags($item->introtext, '<p><a><strong>'), 300) ?>
			</div>
			<div class="clr"></div>
		</div>

		<div class="clr"></div>
		<!--
		<div class="jomUserItemLinks">
			
			<div class="jomUserItemTagsBlock">
				1111111111111
				<div class="clr"></div>
			</div>
			<div class="jomUserItemReadMore"><a href="<?php echo '#';//$articleUrl; ?>"><?php echo "LINK";//JText::_('COM_COMMUNITY_READ_MORE'); ?>&nbsp;&gt;</a></div>
			<div class="clr"></div>
		</div> -->
	</div>
<?php endforeach; ?>
</div>