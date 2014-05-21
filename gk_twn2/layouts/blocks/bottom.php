<?php

// No direct access.
defined('_JEXEC') or die;

$bottom_1_6_columns = $this->generateColumnsBlock(6, 'bottom', 'bottom1_6', 1);
$bottom_7_12_columns = $this->generateColumnsBlock(6, 'bottom', 'bottom7_12', 7);

?>


	<?php if($this->modules('middlenav1')) : ?>
	<div id="gkMiddleNav1" class="gkWrap">
		<jdoc:include type="modules" name="middlenav1" style="<?php echo $this->module_styles['middlenav1']; ?>" />	
	</div>
	<?php endif; ?>

	<?php if($this->modules('bottom1 + bottom2 + bottom3 + bottom4 + bottom5 + bottom6') && $bottom_1_6_columns !== null) : ?>
	<div id="gkBottom1" class="gkWrap">
		<?php foreach($bottom_1_6_columns as $column) : ?>
		<?php if($column !== null) : ?>	
		<div id="gkbottom<?php echo $column['name']; ?>" class="gkCol <?php echo $column['class']; ?>">
            <div>
			<?php $this->addCSSRule('#gkbottom'.$column['name'].' { width: ' . $column['width'] . '%; }'); ?>
			<jdoc:include type="modules" name="<?php echo $column['name']; ?>" style="<?php echo $this->module_styles[$column['name']]; ?>" />
            </div>
        </div>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	
	<?php if($this->modules('middlenav2')) : ?>
	<div id="gkMiddleNav2" class="gkWrap">
		<jdoc:include type="modules" name="middlenav2" style="<?php echo $this->module_styles['middlenav2']; ?>" />	
	</div>
	<?php endif; ?>
	
	<?php if($this->modules('bottom7 + bottom8 + bottom9 + bottom10 + bottom11 + bottom12') && $bottom_7_12_columns !== null) : ?>
	<div id="gkBottom2" class="gkWrap">
		<?php foreach($bottom_7_12_columns as $column) : ?>
		<?php if($column !== null) : ?>	
		<div id="gkbottom<?php echo $column['name']; ?>" class="gkCol <?php echo $column['class']; ?>">
            <div>
			<?php $this->addCSSRule('#gkbottom'.$column['name'].' { width: ' . $column['width'] . '%; }'); ?>
			<jdoc:include type="modules" name="<?php echo $column['name']; ?>" style="<?php echo $this->module_styles[$column['name']]; ?>" />
		    </div>
        </div>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>
	
