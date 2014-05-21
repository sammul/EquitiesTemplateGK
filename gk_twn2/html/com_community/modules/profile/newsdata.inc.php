<?php
/* $cpath='cache/community/'.$profile->id;
  $cfile=$cpath.'/blog.html';
  $generateCache=0;
  if(!file_exists($cpath))mkdir($cpath, 0777, true);
  if(!file_exists($cfile))$generateCache=1;
  else if(time()-filemtime($cfile)>=43200){$generateCache=1;unlink($cfile);}
  else{echo file_get_contents($cfile);return;}
  ob_start();
 */
$requestuserid = JRequest::getVar('userid');
if ($requestuserid > 0) {
	$requestuserid = $requestuserid;
} else {
	$requestuserid = $userid;
}
$db = JFactory::getDBO();
$sql = "SELECT username FROM #__users WHERE id=" . $requestuserid;
$db->setQuery($sql);
$username = $db->LoadResult();

// Create a new query object.
$query = $db->getQuery(true);

//$query="SELECT * FROM '#__k2_items' WHERE 'created_by'='".$requestuserid.'"' AND 'catid'=2";

$query->select(array('*'));
$query->from('#__k2_items');
$query->where('created_by =' . $requestuserid . ' AND catid=69 AND published=1');

$query->order($db->nameQuote('id').' desc');     
//$db->setQuery($query,0,1); 

$db->setQuery($query,0,10);

$items = $db->LoadObjectList();


//$items = K2JomUtilities::getArticles($requestuserid, 67);
//print_r($items);
?>
<div class="jomUserListTitle">

	<?php
	$application = JFactory::getApplication();
	$menu = $application->getMenu();
	$itemId = $menu->getActive()->id;
//$items = K2JomUtilities::getArticles($profile->id, 4);
	if (count($items)) {
		?>
		<table class="writerdashboard">
			<tr>
				<th width="70%" class="title">Article</th>
				<th width="20%">Published</th>                        
				<th width="10%">Share</th>
			</tr>
			<?php
			foreach ($items as $item):
				$articleUrl = JRoute::_(JURI::base() . 'index.php?option=com_k2&view=item&id=' . $item->id . "&Itemid=" . $itemId);
				echo '<tr>';
//              echo "<td><a href='$articleUrl'>" . $item->title . "</a></td>";
				echo '<td class="title"><a href="'.$articleUrl.'">' . K2JomUtilities::wordLimit($item->title, 8) . '</a></td>';
				echo '<td class="date"><span>' . JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC4')) . '</span></td>';
				echo '<td><img src="' . JURI::base() . '/images/community/share.jpg" alt="Share" /></td>';
				echo '</tr>';
				?>
				

		<?php endforeach; ?>
		</table>
	<?php
	} else {
		echo JText::_('No Result Found.');
	}
	?>
</div>
<?php
/*file_put_contents($cfile,preg_replace('(\r|\n|\t|<\!--.*-->)','',ob_get_contents()));
ob_end_clean();
echo file_get_contents($cfile);*/