<?php 
$user =& CFactory::getUser();
$this->renderModules('js_profile_feed_top'); ?>

<script type="text/javascript" language="javascript">

function wallRemove( id )
{
	if(confirm('<?php echo JText::_('COM_COMMUNITY_WALL_CONFIRM_REMOVE'); ?>'))
	{		
		joms.jQuery('#wall_'+id).fadeOut('normal').remove();
		if(typeof getCacheId == 'function') {
			cache_id = getCacheId();
		}else{
			cache_id = "";
		}	
		jax.call('community','<?php echo $ajaxRemoveFunc; ?>', id, cache_id );
	}
}

joms.jQuery(document).ready(function(){
	joms.utils.textAreaWidth('#wall-message');
	joms.utils.autogrow('#wall-message');
});
</script>

<div class="activity-stream-front">	
	<?php
	$this->view('profile')->modProfileUserstatus();
	?>
	
	<?php if($isMine) { ?>
	<div class="joms-latest-activities-container">
	
				<a id="activity-update-click" onclick="wallRemove(<?php echo $user->id; ?>);return false;" href="javascript:void(0)" ><?php echo JText::_('COM_COMMUNITY_WALL_REMOVE');?></a>
	
		<!--<a id="activity-update-click" href="javascript:void(0);"></a>-->
	</div>
	<?php } ?>

	<div class="activity-stream-profile">
		<div id="activity-stream-container">
			<?php echo $newsfeed; ?>
		</div>
	</div>
	

	<?php $this->renderModules('js_profile_feed_bottom'); ?>
	<div id="apps-sortable" class="connectedSortable" >
		<?php
		$this->view('profile')->modProfileActivities();
		?>
		<?php echo $content; ?>
	</div>
</div>
