<?php
/**
 * add a Blog tab on registered and author user groups dashboard and profile
 */

//Mapping Category: Member Blog, so the category_id = 109
$blog_category = 109;
?>
<div class="jomUserListTitle">
	 <div class="writerdashboard-actions">
		 <ul>
			 <li><a href="<?php echo JURI::base(); ?>community/profile?blogpublished=1#blog">Published</a></li>
			 <li><a href="<?php echo JURI::base(); ?>community/article/add?itemformtype=<?php echo $blog_category; ?>&messaget=1" >Add Blog</a></li>
		 </ul>                                         
	 </div>
	 <?php $dash_published_blog = JRequest::getVar("blogpublished", 1); ?>
	 <table class="writerdashboard">
		 <tr>
			 <th width="<?php echo ($dash_published_blog?'55':'82'); ?>%" class="title">Blog</th>
			 <th width="18%"><?php echo ($dash_published_blog?'Published':'Date'); ?></th>
			 <?php if($dash_published_blog): ?>
			 <th width="17%">Page Views</th>
			 <th width="10%">Share</th>
			 <?php endif; ?>
		 </tr>
		 <?php
		 $dash_limit_start_blog = JRequest::getVar("start", 0);
		 $dash_total_blog = K2JomUtilities::getTotalNumberOfArticlesFilteredByCatID($profile->id, $dash_published_blog, $blog_category);
		 $dash_limit_blog = 10;
		 $items_blog = K2JomUtilities::getArticlesFilteredById($profile->id, $dash_limit_blog, $dash_limit_start_blog, $dash_published_blog, $blog_category);
		 if (JFile::exists(JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php')) {
			 JLoader::register('K2HelperRoute', JPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php');
		 }
		 foreach ($items_blog as $item) {
			 if (isset($item->catid)) {
				 $__item = K2HelperRoute::_findItem(array('item' => $item->id, 'category' => $item->catid));
				 $itemId = $__item->id;
				 unset($__item);
			 }
			 else
				 $itemId = "";
			 if ($dash_published_blog)
				 $articleUrl = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId);
			 else
				 $articleUrl = '/community/article/edit/?id=' . $item->id . '&itemformtype='.$blog_category;

			 $articleUrl2 = JRoute::_('index.php?option=com_k2&view=item&id=' . $item->slug . '&Itemid=' . $itemId, true, -1);
			 echo '<tr>';
			 echo '<td class="title"><a href="' . $articleUrl . '">' . K2JomUtilities::wordLimit($item->title, 12) . '</a></td>';
			 echo '<td class="date"><span>' . JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC4')) . '</span></td>';
			 if($dash_published_blog){
				 echo '<td class="hits">' . $item->hits . '</td>';
				 ?>
				 <td>
					 <span class="st_sharethis_custom" st_url="<?php echo $articleUrl2; ?>" st_title="<?php echo $item->title; ?>" style="cursor: pointer;"></span>

					 <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>                     
				 </td>
			 <?php
			 }
			 echo '</tr>';
		 }
		 ?>
	 </table>
	 <?php
	 jimport('joomla.html.pagination');
	 $_pagination_blog = new JPagination($dash_total_blog, $dash_limit_start_blog, $dash_limit_blog);
	 echo "<div class='cK2Pagination'>" . $_pagination_blog->getPagesLinks() . "</div>";
	 ?>
 </div>
