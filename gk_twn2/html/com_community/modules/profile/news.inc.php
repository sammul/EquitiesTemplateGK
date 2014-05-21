<?php
/*$cpath='cache/community/'.$profile->id;
$cfile=$cpath.'/news.html';
$generateCache=0;
if(!file_exists($cpath))mkdir($cpath, 0777, true);
if(!file_exists($cfile))$generateCache=1;
else if(time()-filemtime($cfile)>=43200){$generateCache=1;unlink($cfile);}
else{echo file_get_contents($cfile);return;}
ob_start();*/

$requestuserid=JRequest::getVar('userid');
if($requestuserid>0){$requestuserid=$requestuserid;}
else{$requestuserid=$userid;}
$dash_limitstart = JRequest::getVar("start", 0);
$dash_total = K2JomUtilities::getTotalNumberOfNews($username);
$dash_limit = 10;
$db=JFactory::getDBO();
$sql="SELECT username FROM #__users WHERE id=".$requestuserid;
$db->setQuery($sql);
$username=$db->LoadResult();
/*$query="SELECT i.id, i.catid, i.alias, i.modified, i.publish_down, c.alias AS categoryalias, i.title, i.fulltext, i.created , i.introtext FROM #__k2_items AS i INNER JOIN #__k2_categories c ON c.id = i.catid INNER JOIN #__k2_tags_xref tr ON tr.itemID = i.id AND tr.tagID LEFT JOIN #__k2_tags AS k2tag ON tr.tagID=k2tag.id  WHERE (k2tag.name LIKE '%".$profile->name."%' OR i.title LIKE '%".$profile->name."%' OR i.fulltext LIKE '%".$profile->name."%' OR k2tag.name LIKE '%".$username."%' OR i.title LIKE '%".$username."%' OR i.fulltext LIKE '%".$username."%' )  AND  i.published = 1 AND c.published = 1 AND (i.publish_down > CURDATE() OR i.publish_down = '0000-00-00 00:00:00')   GROUP BY i.id";*/
$query="SELECT i.id, i.catid, i.alias, i.modified, i.publish_down, c.alias AS categoryalias, i.title, i.fulltext, i.created , i.introtext FROM #__k2_items AS i INNER JOIN #__k2_categories c ON c.id = i.catid INNER JOIN #__k2_tags_xref tr ON tr.itemID = i.id INNER JOIN #__k2_tags AS k2tag ON tr.tagID=k2tag.id   WHERE i.published = 1 AND c.published = 1 AND (i.publish_down > CURDATE() OR i.publish_down = '0000-00-00 00:00:00') AND k2tag.name='$username' GROUP BY i.id order by i.created DESC LIMIT $dash_limitstart,$dash_limit";
$db->setQuery($query);
$items=$db->LoadObjectList();
?>
<div class="jomUserListTitle">
<?php
$application = JFactory::getApplication();
$menu = $application->getMenu();
$itemId = $menu->getActive()->id;
//$items = K2JomUtilities::getArticles($profile->id, 4);
if(count($items))
{
foreach ($items as $item):
	$articleUrl = JRoute::_(JURI::base().'index.php?option=com_k2&view=item&id=' . $item->id . "&Itemid=" . $itemId);
	?>
	<!-- Start K2 Item Layout -->
	<div class="wrapperArticle">
		<div class="jomUserItemHeader">
			<h3 class="jomUserItemTitle" style="width:auto; font-size: 16px !important">
				<a href="<?php echo $articleUrl; ?>"><?php echo $item->title; ?></a>
			</h3>
			<!-- Date created -->
			<span class="jomUserItemDateCreated">
				<?php echo JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC3')); ?>
			</span>
		</div>
		<div class="jomUserItemBody">
			<!-- Item introtext -->
			<div class="jomUserItemIntroText">
				<?php echo K2HelperUtilities::wordLimit(strip_tags($item->introtext, '<p><a><strong>'), 30) ?>
			</div>
			<div class="clr"></div>
		</div>

		<div class="clr"></div>
		<div class="jomUserItemLinks">
			<!-- Item tags -->
			<div class="jomUserItemTagsBlock">
				<?php
				$db=JFactory::getDBO();
				$sql="SELECT name FROM #__k2_tags_xref as ktx LEFT JOIN #__k2_tags AS kt ON ktx.tagID=kt.id   WHERE ktx.itemID=".$item->id;
				$db->setQuery($sql);
				$tags=$db->LoadObjectList();
				$i = 0;
				if (JFile::exists(JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php')) {
					JLoader::register('K2HelperRoute', JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
				}
				foreach ($tags as $tag):++$i;
					if (isset($item->catid)) {
						$__item = K2HelperRoute::_findItem(array('item' => $item->id, 'category' => $item->catid));
						$itemId = $__item->id;
						unset($__item);
					}
					else
						$itemId = "";
					//$articleUrl = K2HelperRoute::getItemRoute($item->slug,$item->catid);
					$articleUrl = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId);
					?>
					<a href="<?php echo $articleUrl; ?>"><?php echo $tag->name; ?></a><?php
			if ($i < count($tags))
				{
					if(!empty($tag->name))
					{
					echo ",&nbsp;";
					}
				}
		endforeach;
				?>
				<div class="clr"></div>
			</div>
			<div class="jomUserItemReadMore"><a href="<?php echo $articleUrl; ?>"><?php echo JText::_('COM_COMMUNITY_READ_MORE'); ?>&nbsp;&gt;</a></div>
			<div class="clr"></div>
		</div>
	</div>
	<!-- End K2 Item Layout -->

<?php endforeach;
	jimport('joomla.html.pagination');
	$_pagination = new JPagination($dash_total, $dash_limitstart, $dash_limit);
	echo "<div class='cK2Pagination'>" . $_pagination->getPagesLinks('#news') . "</div>";
}
else
{
	echo JText::_('No Result Found.');
}
?>
</div>
<?php
/*file_put_contents($cfile,ob_get_contents());
ob_end_clean();