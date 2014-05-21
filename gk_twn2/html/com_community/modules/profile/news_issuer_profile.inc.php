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
/*$query="SELECT i.id, i.catid, i.alias, i.modified, i.publish_down, c.alias AS categoryalias, i.title, i.fulltext, i.created , i.introtext FROM #__k2_items AS i INNER JOIN #__k2_categories c ON c.id = i.catid INNER JOIN #__k2_tags_xref tr ON tr.itemID = i.id INNER JOIN #__k2_tags AS k2tag ON tr.tagID=k2tag.id   WHERE i.published = 1 AND c.published = 1 AND (i.publish_down > CURDATE() OR i.publish_down = '0000-00-00 00:00:00') AND k2tag.name='$username' GROUP BY i.id order by i.created DESC LIMIT $dash_limitstart,$dash_limit";*/

require_once (JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
require_once (JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'utilities.php');
$itemListModel = K2Model::getInstance('Itemlist', 'K2Model');
$categories = $itemListModel->getCategoryTree(1);
$tmp = @implode(',', $categories);
$cats = " AND i.catid IN ({$tmp})";

$query="SELECT i.id, i.catid, i.alias, i.modified, i.publish_down, c.alias AS categoryalias, i.title, i.fulltext, i.created , i.introtext FROM #__k2_items AS i INNER JOIN #__k2_categories c ON c.id = i.catid INNER JOIN #__k2_tags_xref tr ON tr.itemID = i.id INNER JOIN #__k2_tags AS k2tag ON tr.tagID=k2tag.id   WHERE i.published = 1 AND c.published = 1 AND (i.publish_down > CURDATE() OR i.publish_down = '0000-00-00 00:00:00') AND k2tag.name='$username' $cats GROUP BY i.id order by i.created DESC LIMIT $dash_limitstart,$dash_limit";
$db->setQuery($query);
$items=$db->LoadObjectList();

// start changes 26 june 2013
$uid = JRequest::getVar('userid');
$res = JFactory::getUser($uid);
$symbol = $res->username;

$options = array(
		 CURLOPT_RETURNTRANSFER => true, // return web page
		 CURLOPT_HEADER         => false,// don't return headers
		 CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
	 );
	// echo "http://data.equities.com/dev/api/call.php?method=google_news&q=MSFT&symbol={$symbol}&parser=xml";
$ch = curl_init( "http://data.equities.com/dev/api/call.php?method=news_headline&symbol={$symbol}&parser=xml" );
curl_setopt_array( $ch, $options );
$result = curl_exec( $ch ); //let's fetch the result using cURL
$resultnews=json_decode($result, true);	

$ch2 = curl_init( "http://data.equities.com/dev/api/call.php?method=google_news&symbol={$symbol}&parser=xml" );
curl_setopt_array( $ch2, $options );
$result2 = curl_exec( $ch2 ); //let's fetch the result using cURL
$resultnews2=json_decode($result2, true);
?>
<style type="text/css">
element.style {
    border-right: 0 none;
}
.qm_inactivebutton {
    background: none repeat scroll 0 0 #EEEEEE;
    border: 1px solid #FFFFFF;
    color: #666666;
    font: 12px Arial,Helvetica,sans-serif;
}
.qm_inactivebutton {
    background-color: #EEEEEE;
    border: 1px solid #AAAAAA;
    color: #000000;
    cursor: pointer;
    display: table-cell;
    font: 10px Tahoma,Arial,Helvetica,sans-serif;
    padding: 3px;
    text-align: center;
}
table td, .cat-list-row0 td, .cat-list-row1 td {
    padding: 6px 0 !important; 
}
.tab_news{cursor: pointer; text-align: center; font: 12px Arial,Helvetica,sans-serif;color: #666666;}

.tab_news_box{ width:350px; background:#red; float:left;   margin: 0 0 10px;}
.tab_news_box ul li{float:left; list-style:none; margin:0 1px 0 0;}
.tab_news_box ul li a{ background:#EEEEEE;  line-height: 13px;
    padding: 3px 10px;  float: left; color: #666666;font: 12px Arial,Helvetica,sans-serif; }
.tab_news_box ul li a:hover{background:#fff; color: #000 !important;}
.tab_news_box ul li a.active_tab_news{background:#fff; color: #000 !important;}
</style>



<div class="tab_news_box">
<ul>
    <li><a href="javascript:void(0);" class="active_tab_news" id="tabs-1" onclick="showHideTab(this.id);">Press Releases</a></li>	
	<li><a href="javascript:void(0);" class="" id="tabs-2" onclick="showHideTab(this.id);">Equities Editorial</a></li>
	
	<?php if( !strpos($symbol, ':')): ?>
	<li><a href="javascript:void(0);" class="" id="tabs-3" onclick="showHideTab(this.id);"><?php echo $symbol." "; ?>News</a></li>
	<?php endif;?>
</ul>
</div>

<div style="clear:both;"></div>

<div id="DIV_1" style="display:block">
<?php
if($resultnews['flag']){
	$checkdu = array();
	foreach($resultnews['data'] as $news):
	if( in_array($news['headline'], $checkdu) ){
		continue;
	}else{
		$checkdu[] = $news['headline'];   
	}
	?>
		<div class="wrapperArticle">
			<div class="jomUserItemHeader">
				<h3 class="jomUserItemTitle" style="width:auto; font-size: 16px !important">
				<?php //print_r($news); ?>
					<!-- 
					<a href="#" onclick='window.open("<?php echo $news['storyurl']; ?>", "_blank", "toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");'><?php echo $news['headline']; ?></a>
					
					<a class="modal" rel="{handler: 'iframe', size: {x: 980, y: 800},scrollbars:0}" href='<?php echo $news['storyurl']; ?>'><?php echo $news['headline']; ?></a>
					-->
					<a target="_blank" href='<?php echo $news['storyurl']; ?>'><?php echo $news['headline']; ?></a>
				</h3>
				<!-- Date created -->
				<span class="jomUserItemDateCreated">
					<?php //echo JHTML::_('date', $news['datetime'], JText::_('K2_DATE_FORMAT_LC3')); ?>
					<?php echo date('m/d/Y', strtotime($news['datetime'])); //JHTML::_('date',date('m/d/Y', strtotime($news['datetime']))); ?>
				</span>
			</div>
			<!--
			<div class="jomUserItemBody">
				
				<div class="jomUserItemIntroText">
					<?php echo $news['source']; ?>
				</div>
				<div class="clr"></div>
			</div>
			-->
			<div class="clr"></div>
			<div class="jomUserItemLinks">
				
				<div class="jomUserItemTagsBlock">
					
					<div class="clr"></div>
				</div>
				<div class="jomUserItemReadMore">
				<a target="_blank" href='<?php echo $news['storyurl']; ?>'><?php echo JText::_('COM_COMMUNITY_READ_MORE'); ?></a>
				<!--<a class="modal" rel="{handler: 'iframe', size: {x: 980, y: 800},scrollbars:0}" href='<?php echo $news['storyurl']; ?>'><?php echo JText::_('COM_COMMUNITY_READ_MORE'); ?></a>
				
				<a href="#" onclick='window.open("<?php echo $news['storyurl']; ?>", "_blank", "toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");'>
				<?php echo JText::_('COM_COMMUNITY_READ_MORE'); ?>&nbsp;&gt;</a>
				-->
				</div>
				<div class="clr"></div>
			</div>
			
		</div>
	<?php
	endforeach;
}
else
{
	echo JText::_('No Result Found.');
}
//End changes
?>
</div>


<div id="DIV_2" style="display:none;">
<div class="jomUserListTitle">
<?php
$application = JFactory::getApplication();
$menu = $application->getMenu();
$itemId = $menu->getActive()->id;
//$items = K2JomUtilities::getArticles($profile->id, 4);
if(count($items))
{
foreach ($items as $item):
    if (isset($item->catid)) {
        $__item = K2HelperRoute::_findItem(array('item' => $item->id, 'category' => $item->catid));
        $itemId = $__item->id;
        unset($__item);
    } else {
        $itemId = "";
    }
    $item->slug = $item->id . ":" . $item->alias;
	//$articleUrl = JRoute::_(JURI::base().'index.php?option=com_k2&view=item&id=' . $item->id . "&Itemid=" . $itemId);
	//$articleUrl = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId, true, -1);
	$articleUrl = JURI::base().substr(JRoute::_('index.php?option=com_k2&view=item&id='.$item->slug.'&Itemid='.$itemId), strlen(JURI::base(true)) + 1);
	?>
	<!-- Start K2 Item Layout -->
	<div class="wrapperArticle">
		<div class="jomUserItemHeader">
			<h3 class="jomUserItemTitle" style="width:auto; font-size: 16px !important">
				<a href="<?php echo $articleUrl; ?>" target= "_blank"><?php echo $item->title; ?></a>
			</h3>
			<!-- Date created -->
			<span class="jomUserItemDateCreated">
				<?php echo date('m/d/Y', strtotime($item->created)); //JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC3')); ?>
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
                    $tag->link = JRoute::_(K2HelperRoute::getIssuerTagRoute($tag->name));
                    $tag->name = strtoupper($tag->name);
					?>
					<a href="<?php echo $tag->link; ?>" target="_blank"><?php echo $tag->name; ?></a><?php
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
			<div class="jomUserItemReadMore"><a href="<?php echo $articleUrl; ?>" target= "_blank"><?php echo JText::_('COM_COMMUNITY_READ_MORE'); ?>&nbsp;&gt;</a></div>
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
</div>
<?php if( !strpos($symbol, ':')): ?>
<div id="DIV_3" style="display:none">
<?php
if($resultnews2['flag']){
	foreach($resultnews2['data'] as $news):
	?>
		<div class="wrapperArticle">
			<div class="jomUserItemHeader">
				<h3 class="jomUserItemTitle" style="width:auto; font-size: 16px !important">
					<a href='<?php echo $news['link']; ?>' target ="_blank"><?php echo $news['title']; ?></a>
				</h3>
				<!-- Date created -->
				<span class="jomUserItemDateCreated">
					<?php //echo JHTML::_('date', $news['pubDate'], JText::_('K2_DATE_FORMAT_LC3')); ?>
					<?php echo date('m/d/Y', strtotime($news['pubDate'])); //JHTML::_('date',date('m/d/Y', strtotime($news['pubDate']))); ?>
				</span>
			</div>
			<div class="jomUserItemBody">
				<div class="jomUserItemIntroText">
				<?php echo K2HelperUtilities::wordLimit(strip_tags($news['description'], '<p><a><strong>'), 30) ?>
					<?php //echo $news['description']; ?>
				</div>
				<div class="clr"></div>
			</div>

			<div class="clr"></div>
			<div class="jomUserItemLinks">
				<div class="jomUserItemTagsBlock">
					<div class="clr"></div>
				</div>
				<div class="jomUserItemReadMore">
				<a href='<?php echo $news['link']; ?>' target ="_blank"><?php echo JText::_('COM_COMMUNITY_READ_MORE'); ?></a>
				</div>
				<div class="clr"></div>
			</div>
		</div>
	<?php
	endforeach;
}
else
{
	echo JText::_('No Result Found.');
}
//End changes
?>

</div>
<?php endif; ?>
<script type="text/javascript">
 function showHideTab(id)
 {
   if(id == "tabs-1"){
   //className
     document.getElementById("tabs-1").className = "active_tab_news";
	 document.getElementById("tabs-2").className = "";
	 document.getElementById("tabs-3").className = "";
     document.getElementById("DIV_1").style.display = "block";
	 document.getElementById("DIV_2").style.display = "none";
	 document.getElementById("DIV_3").style.display = "none";
   }
   
   if(id=="tabs-2"){
   document.getElementById("tabs-1").className = "";
	 document.getElementById("tabs-2").className = "active_tab_news";
	 document.getElementById("tabs-3").className = "";
     document.getElementById("DIV_2").style.display = "block";
	 document.getElementById("DIV_1").style.display = "none";
	 document.getElementById("DIV_3").style.display = "none";
   }
   
   if(id=="tabs-3"){
	 document.getElementById("tabs-1").className = "";
	 document.getElementById("tabs-2").className = "";
	 document.getElementById("tabs-3").className = "active_tab_news";
     document.getElementById("DIV_3").style.display = "block";
	 document.getElementById("DIV_1").style.display = "none";
	 document.getElementById("DIV_2").style.display = "none";
   }
 }
 
/*$(document).ready(function() {
alert("fgdfg");
// Handler for .ready() called.
});*/
</script>
<?php
/*file_put_contents($cfile,ob_get_contents());
ob_end_clean();
