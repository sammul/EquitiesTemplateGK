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

$query->select(array('*,CASE WHEN CHAR_LENGTH(alias) THEN CONCAT_WS(":", id, alias) ELSE id END as slug'));
$query->from('#__k2_items');
$query->where('created_by =' . $requestuserid . ' AND catid=67');
$query->order('publish_up DESC');

$db->setQuery($query);

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
        if (JFile::exists(JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php')) {
            JLoader::register('K2HelperRoute', JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
        }
		?>
		<table class="writerdashboard">
			<tr>
				<th width="70%" class="title">Article</th>
				<th width="20%">Published</th>                        
				<th width="10%">Share</th>
			</tr>
			<?php
            //print_r($items);
			foreach ($items as $item){
                if (isset($item->catid)) {
                    $__item = K2HelperRoute::_findItem(array('item' => $item->id, 'category' => $item->catid));
                    if ($__item) $itemId = $__item->id;
                    unset($__item);
                } else {
                    $itemId = "";
                }
				//$articleUrl = JRoute::_(JURI::base() . 'index.php?option=com_k2&view=item&id=' . $item->id . "&Itemid=" . $itemId);
				$articleUrl = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . "&Itemid=" . $itemId, true, -1);
				echo '<tr>';
//              echo "<td><a href='$articleUrl'>" . $item->title . "</a></td>";
				echo '<td class="title"><a href="'.$articleUrl.'">' . K2JomUtilities::wordLimit($item->title, 8) . '</a></td>';
				echo '<td class="date"><span style="font-size:13px;">' . JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC4')) . '</span></td>';
				//echo '<td><img src="' . JURI::base() . '/images/community/share.jpg" alt="Share" /></td>';
                ?>
                    <td>
                        <span class="st_sharethis_custom" st_url="<?php echo $articleUrl; ?>" st_title="<?php echo $item->title; ?>" style="cursor: pointer;"></span>
                    </td>
            <?php
				echo '</tr>';
            }?>
				
		</table>
	<?php
	} else {
		echo JText::_('No Result Found.');
	}
	?>
</div>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script> 

<?php
/*file_put_contents($cfile,preg_replace('(\r|\n|\t|<\!--.*-->)','',ob_get_contents()));
ob_end_clean();
echo file_get_contents($cfile);*/