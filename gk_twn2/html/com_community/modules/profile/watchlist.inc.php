<?php

$mainframe = JFactory::getApplication();
$jinput = $mainframe->input;
$my = CFactory::getUser();
/*echo $id = JRequest::getInt('userid', 0);
if ($id == 0) {
	$id = $my->id;
}
$user = CFactory::getUser($id);
*/

$userid=$my->id;
JHTML::_('behavior.modal'); 
$requestuserid=JRequest::getVar('userid');
if($requestuserid>0)
{
	$requestuserid=$requestuserid;
}
else
{
	$requestuserid=$userid;
}
?>
<?php

/*$options = array(
         CURLOPT_RETURNTRANSFER => true, // return web page
         CURLOPT_HEADER         => false,// don't return headers
         CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
     );
$ch = curl_init( "http://qm.infinitenine.com/dev/api/call.php?method=create_user&uid=597" );
curl_setopt_array( $ch, $options );
$result = curl_exec( $ch ); //let's fetch the result using cURL
$resultnew=json_decode($result);
$finalresult=(array)$resultnew;
echo "<pre>";
print_r($finalresult);
curl_close( $ch );

$options = array(
         CURLOPT_RETURNTRANSFER => true, // return web page
         CURLOPT_HEADER         => false,// don't return headers
         CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
     );
$ch = curl_init( "http://qm.infinitenine.com/dev/api/call.php?method=create_folder&uid=597&folder_name=dev" );
curl_setopt_array( $ch, $options );
$result = curl_exec( $ch ); //let's fetch the result using cURL
$resultnew=json_decode($result);
$finalresult=(array)$resultnew;
echo "<pre>";
print_r($finalresult);
curl_close( $ch );

 $options = array(
         CURLOPT_RETURNTRANSFER => true, // return web page
         CURLOPT_HEADER         => false,// don't return headers
         CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
     );
$ch = curl_init( "http://qm.infinitenine.com/dev/api/call.php?method=add_symbol&uid=597&folder_name=dev&symbol=CSCO" );
curl_setopt_array( $ch, $options );
$result = curl_exec( $ch ); //let's fetch the result using cURL
$resultnew=json_decode($result);
$finalresult=(array)$resultnew;
echo "<pre>";
print_r($finalresult);
curl_close( $ch );

 $options = array(
         CURLOPT_RETURNTRANSFER => true, // return web page
         CURLOPT_HEADER         => false,// don't return headers
         CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
     );
$ch = curl_init( "http://qm.infinitenine.com/dev/api/call.php?method=getwatchlist&uid=597" );
curl_setopt_array( $ch, $options );
$result = curl_exec( $ch ); //let's fetch the result using cURL
$resultnew=json_decode($result);
$finalresult=(array)$resultnew;
echo "<pre>";
print_r($finalresult);
curl_close( $ch );
*/
?>
<!-- 996 -->
<a id="lightbox4watchlist" class="modal" rel="{handler: 'iframe', size: {x: 1200, y: 500},scrollbars:0}"   href="<?php echo JRoute::_('index.php?option=com_community&view=profile&task=viewwatchlist&requestuserid='.$requestuserid.'&tmpl=component&rand='.rand(1,10000)) ?>"  ><?php echo JText::_('COM_COMMUNITY_WATCHLIST_CLICK_AND_VIEW_STOCK');?></a>
