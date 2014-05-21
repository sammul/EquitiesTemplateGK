<?php

// No direct access.
defined('_JEXEC') or die;
$gkContent = '100%';
if($this->getParam("cwidth_position", '') == 'style') {
// main column
    if($this->modules('inset1 and inset2')) {
         $gkInset1 = $this->getParam('inset_column_width', '20'). '%';
         $gkInset2 = $this->getParam('inset2_column_width', '20'). '%';
         $gkComponentWrap = (100 - ($this->getParam('inset_column_width', '20') + $this->getParam('inset2_column_width', '20'))) . '%';
    } elseif($this->modules('inset1 or inset2')) {
         if($this->modules('inset1')) {
              $gkInset1 = $this->getParam('inset_column_width', '20'). '%';
              $gkComponentWrap = (100 - $this->getParam('inset_column_width', '20')) . '%';
         } else {
              $gkInset2 = $this->getParam('inset2_column_width', '20'). '%';
              $gkComponentWrap = (100 - $this->getParam('inset2_column_width', '20')) . '%';
         }
    }
   
    // all columns
    $left_column = $this->modules('left_top + left_bottom + left_left + left_right');
    $right_column = $this->modules('right_top + right_bottom + right_left + right_right');

    if($left_column && $right_column) {
        $gkContent = (100 - ($this->getParam('left_column_width', '20') + $this->getParam('right_column_width', '20'))). '%';
    } elseif ( $left_column ) {
        $gkContent = (100 - $this->getParam('left_column_width', '20')). '%';
    } elseif ( $right_column ) {
        $gkContent = (100 - $this->getParam('right_column_width', '20')) . '%';
    }

}

/*start*/
$no_right_column = false;
$currentUrl = JURI::current();
require_once( JPATH_BASE . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');
$communityUser = & CFactory::getActiveProfile();
$parsing_user = & JFactory::getUser($communityUser->_userid);

if ($communityUser && $communityUser->_userid > 0) {
    JHtml::_('behavior.keepalive');
}

//if (preg_match("/\/community\/.+\/profile/i", $currentUrl) || preg_match("/\/community\/profile/i", $currentUrl)) {
if (preg_match("/\/community\/profile/i", $currentUrl)) {
    //echo "Community user detected.";
	if (in_array(9, $parsing_user->groups) || in_array(3, $parsing_user->groups)) {
		//hide sidebar, dashb oard has its own sidebar
		$gkContent = "100%";
		$no_right_column = true;
	}
	/*$checkuser = JFactory::getUser();
	if($checkuser->id>0){
		if (in_array(3, $parsing_user->groups)) {
			//hide sidebar
			$gkContent = "100%";
			$no_right_column = true;
		}
	}*/
} elseif (preg_match("/\/community\/.+\/profile/i", $currentUrl) ) {
	if (in_array(9, $parsing_user->groups)) {
		//hide sidebar, dashb oard has its own sidebar
		$gkContent = "100%";
		$no_right_column = true;
	}
} elseif (preg_match("/\/community\/register/i", $currentUrl) ) {
    //no sidebar on registration page
	$gkContent = "100%";
	$no_right_column = true;
} elseif (preg_match("/\/research\/diy-research-report/i", $currentUrl) ) {
    //nosidebar for diy report view
	$gkContent = "100%";
	$no_right_column = true;
} elseif (preg_match("/\/research\/eva-research-reports/i", $currentUrl) ) {
    //nosidebar for diy report view
	$gkContent = "100%";
	$no_right_column = true;
} elseif (preg_match("/\/research\/small-cap-stars/i", $currentUrl) ) {
    //nosidebar for diy report view
	$gkContent = "100%";
	$no_right_column = true;
} elseif (preg_match("/\/events-conferences/i", $currentUrl) ) {
    //nosidebar for events-conferences
	$gkContent = "100%";
	$no_right_column = true;
} /*elseif (preg_match("/\/news\/latest-news/i", $currentUrl) ) {
    //nosidebar for events-conferences
	$gkContent = "100%";
	$no_right_column = true;
}*/
/*end*/
?>

<?php if($this->mainExists('all')) : ?>
<div id="gkMain">
   
      <jdoc:include type="modules" name="resourceheader" style="<?php echo $this->module_styles['resourceheader']; ?>" />
 
	<div id="gkMainBlock" class="gkMain">
		<?php $this->loadBlock('left'); ?>
		<?php if($this->mainExists('content')) : ?>
		<div id="gkContent" class="gkMain gkCol <?php echo $this->generatePadding('gkContentColumn'); ?>" <?php if($this->getParam("cwidth_position", '') == 'style' || $no_right_column) echo "style=width:".$gkContent;  ?>>
			<?php if($this->modules('top')) : ?>
			<div id="gkContentTop" class="gkMain">
				<jdoc:include type="modules" name="top" style="<?php echo $this->module_styles['top']; ?>" />
			</div>
			<?php endif; ?>
			
			<?php if($this->mainExists('content_mainbody')) : ?>
			<div id="gkContentMainbody" class="gkMain <?php echo $this->generatePadding('gkContentMainbody'); ?>">
				<?php if($this->modules('inset1')) : ?>
				<div id="gkInset1" class="gkMain gkCol" <?php if($this->getParam("cwidth_position", '') == 'style') echo "style=width:".$gkInset1;  ?>>
					<jdoc:include type="modules" name="inset1" style="<?php echo $this->module_styles['inset1']; ?>" />
				</div>
				<?php endif; ?>			
				
				<?php if($this->mainExists('component_wrap')) : ?>
					<?php 
						$is_column = ($this->modules('inset1 + inset2')) ? 'gkCol' : '';
					?>
					
				<div id="gkComponentWrap" class="gkMain <?php echo $is_column; ?> <?php echo $this->generatePadding('gkComponentWrap'); ?>" <?php if($this->getParam("cwidth_position", '') == 'style') echo "style=width:".$gkComponentWrap;  ?>>	
					<?php if($this->modules('mainbody_top')) : ?>
					<div id="gkMainbodyTop" class="gkMain">
						<jdoc:include type="modules" name="mainbody_top" style="<?php echo $this->module_styles['mainbody_top']; ?>" />
					</div>
					<?php endif; ?>	
					
					<?php $this->messages('message-position-3'); ?>
					
					<?php if(
						($this->isFrontpage() && $this->getParam('mainbody_frontpage', 'only_component') == 'only_mainbody') ||
						($this->isFrontpage() && $this->getParam('mainbody_frontpage', 'only_component') == 'mainbody_before_component') ||
						(!$this->isFrontpage() && $this->getParam('mainbody_subpage', 'only_component') == 'mainbody_before_component')
					) : ?>
					<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
					<?php endif; ?>
					
					<?php if($this->mainExists('component') && !($this->isFrontpage() && $this->getParam('mainbody_frontpage', 'only_component') == 'only_mainbody')) : ?>
					<div id="gkMainbody" class="gkMain gkMarginTBLR">
						<div id="gkMainbodyWrap">
															<?php if($this->modules('breadcrumb_mainbody')) : ?>
									<jdoc:include type="modules" name="breadcrumb_mainbody" style="<?php echo $this->module_styles['breadcrumb_mainbody']; ?>" />
									<?php endif; ?>
							<?php if($this->modules('breadcrumb') || $this->getToolsOverride()) : ?>
							<div id="gkBreadcrumbMainbody">
								<div>

									
									<?php if($this->getToolsOverride()) : ?>
										<?php $this->loadBlock('tools/tools'); ?>
									<?php endif; ?>
								</div>
							</div>
							<?php endif; ?>
							
							<?php if($this->isFrontpage()) : ?>
								<?php if($this->getParam('mainbody_frontpage', 'only_component') == 'only_component') : ?>	
								<div id="gkComponent">
									<jdoc:include type="component" />
								</div>
								<?php elseif($this->getParam('mainbody_frontpage', 'only_component') == 'mainbody_before_component') : ?>
								<div id="gkComponent">
									<jdoc:include type="component" />
								</div>
								<?php else : ?>
								<div id="gkComponent">
									<jdoc:include type="component" />
								</div>
								<?php endif; ?>
							<?php else : ?>
								<?php if($this->getParam('mainbody_subpage', 'only_component') == 'only_component') : ?>	
								<div id="gkComponent">
									<jdoc:include type="component" />
								</div>
								<?php elseif($this->getParam('mainbody_subpage', 'only_component') == 'mainbody_before_component') : ?>
								<div id="gkComponent">
									<jdoc:include type="component" />
								</div>
								<?php else : ?>
								<div id="gkComponent">
									<jdoc:include type="component" />
								</div>
								<?php endif; ?>					
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>
					
					<?php if(
						(($this->isFrontpage() && !$this->getParam('mainbody_frontpage', 'only_component') == 'only_component') &&
						($this->isFrontpage() && !$this->getParam('mainbody_frontpage', 'only_component') == 'mainbody_before_component')) ||
						((!$this->isFrontpage() && !$this->getParam('mainbody_subpage', 'only_component') == 'only_component') &&
						(!$this->isFrontpage() && !$this->getParam('mainbody_subpage', 'only_component') == 'mainbody_before_component'))
					) : ?>
					<jdoc:include type="modules" name="mainbody" style="<?php echo $this->module_styles['mainbody']; ?>" />
					<?php endif; ?>
					
					<?php if($this->modules('mainbody_bottom')) : ?>
					<div id="gkMainbodyBottom" class="gkMain">
						<jdoc:include type="modules" name="mainbody_bottom" style="<?php echo $this->module_styles['mainbody_bottom']; ?>" />
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
					
				<?php if($this->modules('inset2')) : ?>
				<div id="gkInset2" class="gkMain gkCol" <?php if($this->getParam("cwidth_position", '') == 'style') echo "style=width:".$gkInset2;  ?>>
					<jdoc:include type="modules" name="inset2" style="<?php echo $this->module_styles['inset2']; ?>" />
				</div>
				<?php endif; ?>	
			</div>
			<?php endif; ?>
			            <div id="full3">
            <div class="full3-1 first">
            <jdoc:include type="modules" name="under1" style="<?php echo $this->module_styles['mainbody_bottom']; ?>"  />
            </div>
            <div class="full3-1 second">
            <jdoc:include type="modules" name="under2" style="<?php echo $this->module_styles['mainbody_bottom']; ?>"  />
            </div>
            <div class="full3-1 third">
            <jdoc:include type="modules" name="under3" style="<?php echo $this->module_styles['mainbody_bottom']; ?>"  />
            </div>
            </div>
			<?php if($this->modules('bottom')) : ?>
			<div id="gkContentBottom" class="gkMain">
				<jdoc:include type="modules" name="bottom" style="<?php echo $this->module_styles['bottom']; ?>" />
			</div>
			<?php endif; ?>

		</div>
		<?php endif; ?>
	
		<?php $this->loadBlock('right'); ?>
	</div>
</div>
<?php endif; ?>

<?php
$__current_option = JRequest::getVar('option');
$__current_view = JRequest::getVar('view');
$__current_layout = JRequest::getVar('layout');

//If it has disqus comment box.
if (in_array(strtolower($__current_option), array("com_k2","com_content"))
  && strtolower($__current_view) == "item" 
  && !$this->isFrontpage() && $this->modules('mainbody_bottom') ) {
    //print_r($_REQUEST);

    $__dsq_my	= CFactory::getUser();
    //print_r($__dsq_my);
    //echo $__dsq_my->id;
    define('DISQUS_SECRET_KEY', '0g5DWftZP75YaVVHHJttfXyy197lrEOKT9Gmst9KjmtKwbzLxwOd0Rf1KBKhJAf7');
    define('DISQUS_PUBLIC_KEY', 'v9NAZ0nn2XG37bs3rsBrit7mZvzPYotuCKTmkUKMmkSWxrxp8fPILqOZJrHRS4HM');

    function dsq_hmacsha1($data, $key) {
        $blocksize=64;
        $hashfunc='sha1';
        if (strlen($key)>$blocksize)
            $key=pack('H*', $hashfunc($key));
        $key=str_pad($key,$blocksize,chr(0x00));
        $ipad=str_repeat(chr(0x36),$blocksize);
        $opad=str_repeat(chr(0x5c),$blocksize);
        $hmac = pack(
                    'H*',$hashfunc(
                        ($key^$opad).pack(
                            'H*',$hashfunc(
                                ($key^$ipad).$data
                            )
                        )
                    )
                );
        return bin2hex($hmac);
    }

    $__remote_auth_s3 = "{}";
    if ($__dsq_my->id > 0) {
        $__dsq_data = array(
                "id" => $__dsq_my->id,
                "username" => $__dsq_my->username,
                "email" => $__dsq_my->email
            );

        $__dsq_message = base64_encode(json_encode($__dsq_data));
        $__dsq_timestamp = time();
        $__dsq_hmac = dsq_hmacsha1($__dsq_message . ' ' . $__dsq_timestamp, DISQUS_SECRET_KEY);
        $__remote_auth_s3 = "$__dsq_message $__dsq_hmac $__dsq_timestamp";
    }
?>

<script type="text/javascript">
var disqus_config = function() {
    this.page.remote_auth_s3 = "<?php echo $__remote_auth_s3; ?>";
    this.page.api_key = "<?php echo DISQUS_PUBLIC_KEY; ?>";
}
</script>

<?php
}//end if disqus
?>
