<?php

// No direct access.
defined('_JEXEC') or die;

?>

<?php if( $this->modules('banner')) : ?>
<div id="gkBanner1" class="clear clearfix">
      <jdoc:include type="modules" name="banner" style="<?php echo $this->module_styles['banner']; ?>" />
</div>
<?php endif; ?>
