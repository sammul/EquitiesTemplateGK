<?php

// No direct access.
defined('_JEXEC') or die;
$tpl_name = str_replace(' ', '_', JText::_('TPL_GK_LANG_NAME'));
?>

<div id="gkFooterWrap">
      <div id="gkCopyrights">
            <?php if($this->modules('footer_nav')) : ?>
            <div id="gkFooterNav">
                  <jdoc:include type="modules" name="footer_nav" style="<?php echo $this->module_styles['footer_nav']; ?>" />
            </div>
            <?php endif; ?>
            <?php if($this->getParam('copyrights', '') !== '') : ?>
                <span>
        		<?php echo $this->getParam('copyrights', ''); ?>
        	 </span>
            <?php else : ?>

            <?php endif; ?>
            
            <?php if(isset($_COOKIE['gkGavernMobile'.$tpl_name]) && 
	    	$_COOKIE['gkGavernMobile'.$tpl_name] == 'desktop') : ?>
            <span class="mobileSwitcher"><a href="javascript:setCookie('gkGavernMobile<?php echo $tpl_name; ?>', 'mobile', 365);window.location.reload();"><?php echo JText::_('TPL_GK_LANG_SWITCH_TO_MOBILE'); ?></a></span>
            <?php endif; ?>
            
            <?php if($this->getParam('stylearea', '0') == '1') : ?>
            <div id="gkStyleArea">
                  <a href="#" id="gkStyle1">red</a>
                  <a href="#" id="gkStyle2">blue</a>
                  <a href="#" id="gkStyle3">brown</a>
                  <a href="#" id="gkStyle4">green</a>
                  <a href="#" id="gkStyle5">gray</a>
                  <a href="#" id="gkStyle6">pink</a>
            </div>
            <?php endif; ?>
            
      </div>
</div>
<?php if($this->getParam('framework_logo', '0') == '1') : ?>

<?php endif; ?>
<?php $this->loadBlock('social'); ?>

<?php
if(true): 
	$temp_var = JFactory::getUser();
	$temp_hash = '';
	if($temp_var->id != 0){
		if (in_array(3, $temp_var->groups)) { //writer
			$temp_hash = '#articles';
		}
		else if (in_array(9, $temp_var->groups)) { //issuer
			$temp_hash = '';
		}
		else if (in_array(10, $temp_var->groups)) { //vendor
			$temp_hash = '#directory';
		}
		else{ //vendor
			$temp_hash = '#wall';
		}
	}
?>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var bydefault = '<?php echo $temp_hash; ?>';
		var obj = jQuery("a[href$='community/profile']");
		obj.attr('href', obj.attr('href')+bydefault);
	});
</script>
<?php endif; ?>
