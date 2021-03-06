<?php

//No direct access.
defined('_JEXEC') or die;

$right_column_middle_class = ' oneCol';

if($this->modules('right_left and right_right')) {
	$right_column_middle_class = ' twoCol';
}
if($this->getParam("cwidth_position", '') == 'style') {
    // right column
    if($this->modules('right_left and right_right')) {
         $gkRightLeft = $this->getParam('right2_column_width', '50'). '%';
         $gkRightRight = (100 - $this->getParam('right2_column_width', '50')) . '%';
    }
    // all columns
    $left_column = $this->modules('left_top + left_bottom + left_left + left_right');
    $right_column = $this->modules('right_k2_top + right_top + right_bottom + right_left + right_right');
   
    if($left_column && $right_column) {
         $gkRight = $this->getParam('right_column_width', '20'). '%';
    }  elseif ( $right_column ) {
         $gkRight = $this->getParam('right_column_width', '20'). '%';
    }
}

/*start*/
$currentUrl = JURI::current();
require_once( JPATH_BASE . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');
$communityUser = & CFactory::getActiveProfile();
$parsing_user = & JFactory::getUser($communityUser->_userid);
//if (preg_match("/\/community\/.+\/profile/i", $currentUrl) || preg_match("/\/community\/profile/i", $currentUrl)) {
if (preg_match("/\/community\/profile/i", $currentUrl)) {
    //echo "Community user detected.";
	if (in_array(9, $parsing_user->groups) || in_array(3, $parsing_user->groups)) {
		//hide sidebar
		return;
	}
	/*$checkuser = JFactory::getUser();
	if($checkuser->id>0){
		if (in_array(3, $parsing_user->groups)) {
			//hide sidebar
			return;
		}
	}*/
} elseif (preg_match("/\/community\/.+\/profile/i", $currentUrl) ) {
	if (in_array(9, $parsing_user->groups)) {
		//hide sidebar
		return;
	}
} elseif (preg_match("/\/community\/register/i", $currentUrl) ) {
    //no sidebar on registration page
	return;
} elseif (preg_match("/\/research\/diy-research-report/i", $currentUrl) ) {
    //no sidebar on diy view
	return;
} elseif (preg_match("/\/research\/eva-research-reports/i", $currentUrl) ) {
    //no sidebar on diy view
	return;
} elseif (preg_match("/\/research\/small-cap-stars/i", $currentUrl) ) {
    //no sidebar on diy view
	return;
} elseif (preg_match("/\/events-conferences/i", $currentUrl) ) {
	return;
}
/*end*/
$option=JRequest::getVar('option');
$view=JRequest::getVar('view');
?>
<?php if($this->modules('right_k2_top + right_top + right_bottom + right_left + right_right')) : ?>
<div id="gkRight" class="gkMain gkCol" <?php if($this->getParam("cwidth_position", '') == 'style') echo "style=width:".$gkRight;  ?>>
<?php if($this->modules('right_k2_top')) :
	if( $option =='com_k2' && $view=='item')
	{
		 ?>

	<div id="gkRightTop" class="gkMain">
		<jdoc:include type="modules" name="right_k2_top" style="<?php echo $this->module_styles['right_k2_top']; ?>" />
	</div>
	<?php } ?>
	<?php endif; ?>
	<?php if($this->modules('right_top')) : ?>
	<div id="gkRightTop" class="gkMain">
		<jdoc:include type="modules" name="right_top" style="<?php echo $this->module_styles['right_top']; ?>" />
	</div>
	<?php endif; ?>

	<?php if($this->modules('right_left + right_right')) : ?>
	<div id="gkRightMiddle" class="gkMain">
		<?php if($this->modules('right_left')) : ?>
		<div id="gkRightLeft" class="gkMain gkCol <?php echo $this->generatePadding('gkRightLeft'); ?>" <?php if($this->getParam("cwidth_position", '') == 'style') echo "style=width:".$gkRightLeft;  ?>>
			<jdoc:include type="modules" name="right_left" style="<?php echo $this->module_styles['right_left']; ?>" />
		</div>
		<?php endif; ?>	
		
		<?php if($this->modules('right_right')) : ?>
		<div id="gkRightRight" class="gkMain gkCol" <?php if($this->getParam("cwidth_position", '') == 'style') echo "style=width:".$gkRightRight;  ?>>
			<jdoc:include type="modules" name="right_right" style="<?php echo $this->module_styles['right_right']; ?>" />
		</div>
		<?php endif; ?>			
	</div>
	<?php endif; ?>	

	<?php if($this->modules('right_bottom')) : ?>
	<div id="gkRightBottom" class="gkMain">
		<jdoc:include type="modules" name="right_bottom" style="<?php echo $this->module_styles['right_bottom']; ?>" />
	</div>
	<?php endif; ?>	
</div>
<?php endif; ?>
