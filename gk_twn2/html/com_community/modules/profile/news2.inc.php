<?php
$uid = JRequest::getVar('userid');
$res = JFactory::getUser($uid);
$symbol = $res->username; 

$options = array(
		 CURLOPT_RETURNTRANSFER => true, // return web page
		 CURLOPT_HEADER         => false,// don't return headers
		 CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
	 );
$ch = curl_init( "http://data.equities.com/dev/api/call.php?method=news_headline&symbol={$symbol}&parser=xml" );
curl_setopt_array( $ch, $options );
$result = curl_exec( $ch ); //let's fetch the result using cURL
$resultnews=json_decode($result, true);
if($resultnews['flag']){
	foreach($resultnews['data'] as $news):
	?>
		<div class="wrapperArticle">
			<div class="jomUserItemHeader">
				<h3 class="jomUserItemTitle" style="width:auto; font-size: 16px !important">
				<?php //print_r($news); ?>
					<!-- 
					<a href="#" onclick='window.open("<?php echo $news['storyurl']; ?>", "_blank", "toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");'><?php echo $news['headline']; ?></a>
					-->
					<a class="modal" rel="{handler: 'iframe', size: {x: 980, y: 800},scrollbars:0}" href='<?php echo $news['storyurl']; ?>'><?php echo $news['headline']; ?></a>
				</h3>
				<!-- Date created -->
				<span class="jomUserItemDateCreated">
					<?php echo JHTML::_('date', $news['datetime'], JText::_('K2_DATE_FORMAT_LC3')); ?>
				</span>
			</div>
			
			<div class="clr"></div>
			<div class="jomUserItemLinks">
				
				<div class="jomUserItemTagsBlock">
					
					<div class="clr"></div>
				</div>
				<div class="jomUserItemReadMore">
				<a class="modal" rel="{handler: 'iframe', size: {x: 980, y: 800},scrollbars:0}" href='<?php echo $news['storyurl']; ?>'><?php echo JText::_('COM_COMMUNITY_READ_MORE'); ?></a>
				<!--
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
/*

			<div class="jomUserItemBody">
				
				<div class="jomUserItemIntroText">
					<?php echo $news['source']; ?>
				</div>
				<div class="clr"></div>
			</div>
*/
?>