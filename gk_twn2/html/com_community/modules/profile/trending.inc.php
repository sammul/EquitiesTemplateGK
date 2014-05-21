<?php
$cpath='cache/community/'.$profile->id;
$cfile=$cpath.'/trending.html';
$generateCache=0;
if(!file_exists($cpath))mkdir($cpath, 0777, true);
if(!file_exists($cfile))$generateCache=1;
else if(time()-filemtime($cfile)>=3600){$generateCache=1;unlink($cfile);}
else{echo file_get_contents($cfile);return;}
ob_start();

$requestuserid = JRequest::getVar('userid');
//$requestuserid = $profile->id;
if ($requestuserid > 0) {
	$requestuserid = $requestuserid;
} else {
	$requestuserid = $userid;
}
$db = JFactory::getDBO();
$sql = "SELECT username FROM #__users WHERE id=" . $requestuserid;
$db->setQuery($sql);
$tagname = $db->LoadResult();

if (!empty($tagname)) {
	$options = array(
		CURLOPT_RETURNTRANSFER => true, // return web page
		CURLOPT_HEADER => false, // don't return headers
		CURLOPT_CONNECTTIMEOUT => 5  // timeout on connect
	);
	if(strpos($tagname, ":")>-1){
		$tagname = str_replace(":",".",$tagname);
		$tagname = str_replace("$","",$tagname);
	}
	$ch = curl_init("http://data.equities.com/api/call.php?method=twitter_search&q=" . $tagname);
	curl_setopt_array($ch, $options);
	$result = curl_exec($ch); //let's fetch the result using cURL
	$mainresult = json_decode($result);
	$finalresult = array($mainresult);
	$finaldata = (array) (json_decode($finalresult[0]->data));

	if (count($finaldata)) {
		?>
		<div class="simpleTabsContent">
			<div class="jomUserListTitle" style="margin-top: 10px">
				<div class="trading-title"><?php echo JText::_('Social Mentions about your company in the last seven days') ?> <strong><?php //echo $tagname;      ?></strong></div>
				<?php
				foreach ($finaldata as $finalresult => $value) {
					$result = (array) $value;
					?><div class="trading-main-box">
						<div class="trading-image-box">
							<a  href="<?php echo 'https://twitter.com/' . $result['from_user']; ?>" title="<?php echo $result['from_user_name']; ?>"><img src="<?php echo $result['profile_image_url'] ?>" alt="<?php echo $result['from_user_name']; ?>" height="48px"  width="48px"/></a>
						</div>

						<div class="trading-desc-box">
							<div class="trading-heading-box">
								<a  href="<?php echo 'https://twitter.com/' . $result['from_user']; ?>" title="<?php echo $result['from_user_name']; ?>"><?php echo $result['from_user_name']; ?>
								</a>
							</div>
							<div class="trading-date-box"><?php echo date("j M y H:i:s", strtotime($result['created_at'])); ?></div>
							<div style="clear:both;"></div>
							<div class="trading-discrip-text-box"><?php echo $result['text']; ?></div>
						</div>
						<div style="clear:both;"></div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
	curl_close($ch);
}
file_put_contents($cfile,ob_get_contents());
ob_end_clean();
echo file_get_contents($cfile);