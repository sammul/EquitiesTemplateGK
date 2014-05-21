<?php
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

$query->select(array('*'));
$query->from('#__k2_items');
$query->where('created_by =' . $requestuserid . ' AND catid=66');

$db->setQuery($query);

$items = $db->LoadObjectList();
//$items = K2JomUtilities::getArticles($requestuserid, 66);
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
//                
                ?>
                <tr>
                    <td class="title"><a href="<?php echo $articleUrl ?>"><?php echo K2JomUtilities::wordLimit($item->title, 8); ?></a></td>
                    <td class="date"><span><?php echo JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC4')); ?></span></td>
                    <td>
                        <span class="st_sharethis_custom" st_url="<?php echo $articleUrl; ?>" st_title="<?php echo $item->title; ?>" style="cursor: pointer;"></span>
                        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>   
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </table>
        <?php
    } else {
        echo JText::_('No Result Found.');
    }
    ?>
</div>