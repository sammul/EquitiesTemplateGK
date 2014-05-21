<?php
$requestuserid=JRequest::getVar('userid');
if($requestuserid>0){$requestuserid=$requestuserid;}
else{$requestuserid=$userid;}
$db=JFactory::getDBO();
$sql="SELECT username FROM #__users WHERE id=".$requestuserid;
$db->setQuery($sql);
$username=$db->LoadResult();

// Create a new query object.
$query = $db->getQuery(true);

$query->select(array('*'));
$query->from('#__k2_items');
$query->where('created_by ='.$requestuserid.' AND catid=66');

$db->setQuery($query);

$items=$db->LoadObjectList();
//$items = K2JomUtilities::getArticles($requestuserid, 66);
//print_r($items);
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
			<h3 class="jomUserItemTitle">
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
				foreach ($tags as $tag):++$i;
					?>
					<a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_k2&view=itemlist&task=tag&tag=' . $tag->name . "&Itemid=" . $itemId); ?>"><?php echo $tag->name; ?></a><?php
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
}
else
{
	echo JText::_('No Result Found.');
}
?>
</div>