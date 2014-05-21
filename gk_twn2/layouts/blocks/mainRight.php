<?php

// No direct access.
defined('_JEXEC') or die;

$top_1_6_columns = $this->generateColumnsBlock(6, 'top', 'top1_6', 1);
$top_7_12_columns = $this->generateColumnsBlock(6, 'top', 'top7_12', 7);

?>

<?php if($this->modules('top1 + top2 + top3 + top4 + top5 + top6') && $top_1_6_columns !== null) : ?>
<div id="gkTop1" class="gkMain">
	<div id="gkToptop2" class="gkCol gkColRight">
		<?php $this->addCSSRule('#gkToptop2 { width: 100%; }'); ?>
		<jdoc:include type="modules" name="top2" style="<?php echo $this->module_styles["top2"]; ?>" />
	</div>
	<?php $this->loadBlock('right'); ?>
</div>
<?php endif; ?>

<?php if( $this->modules('banner2')) : ?>
<div id="gkBanner2" class="clear clearfix">
      <jdoc:include type="modules" name="banner2" style="<?php echo $this->module_styles['banner2']; ?>" />
</div>
<?php endif; ?>

<?php if($this->modules('top7 + top8 + top9 + top10 + top11 + top12') && $top_7_12_columns !== null) : ?>
<div id="gkTop2" class="gkMain gkWrap">
	<?php foreach($top_7_12_columns as $column) : ?>
	<?php if($column !== null) : ?>	
	<div id="gkTop<?php echo $column['name']; ?>" class="gkCol <?php echo $column['class']; ?>">
		<?php $this->addCSSRule('#gkTop'.$column['name'].' { width: ' . $column['width'] . '%; }'); ?>
		<jdoc:include type="modules" name="<?php echo $column['name']; ?>" style="<?php echo $this->module_styles[$column['name']]; ?>" />
	</div>
	<?php endif; ?>
	<?php endforeach; ?>
</div>

<?php endif; ?>
