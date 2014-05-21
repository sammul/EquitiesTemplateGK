<?php defined('_JEXEC') or die(); ?>
<script language="javascript" type="text/javascript">function resizeIframe(obj) {obj.style.height = '0px';obj.style.height = (obj.contentWindow.document.body.scrollHeight+100) + 'px';}</script>
<?php
//require_once (JPATH_COMPONENT_SITE . DS . 'helpers' . DS . 'k2.php');
//if($my->id == 0 || K2JomUtilities::getK2UserType($my->id)!=5)return;
?>
<iframe style="width:100%; overflow: hidden" frameBorder="0" scrolling="no" onload="resizeIframe(this)" src="<?php JURI::base(); ?>component/k2/item/add?itemformtype=<?php echo JRequest::getVar("itemformtype", "0"); ?>&messaget=<?php echo JRequest::getVar("messaget", "0"); ?>"></iframe>
