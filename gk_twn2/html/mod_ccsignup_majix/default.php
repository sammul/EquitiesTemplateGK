<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$referralLink_ = $referralLink ? '?pn=rivermedia' : '';

$document =& JFactory::getDocument();
$style = '.jform-lbl-style {
	color: ' . $label_fontcolor . ';
	font-size: ' . $label_fontsize . ';
	font-family: ' . $label_fontfamily . ';
	font-weight: '.$label_fontweight.';
	width: 100% !important;
}
.mod_text {
	text-align: '.$mod_desc_align.';
}';
$document->addStyleDeclaration( $style );
if(!array_key_exists($label_fontfamily, $googleFonts)){
	$stylelink = '<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family='.$label_fontfamily.'">';
	$document->addCustomTag($stylelink);
}

if($ccid== '#############' || $ccid==''){
	echo '<h4 style="color: red">ERROR: Please enter a valid Constant Contact ID</h4>
	<p>FORM DISABLED</p>';
}else{
?>
<form name="ccoptin" id="login-form" action="http://visitor.constantcontact.com/d.jsp" method="post" target="_blank">
<h1>equities.com’s</h1>
<h2>Eye on the Market</h2>
<span>Subscribe to our newsletter to stay on top of the most important news affecting Wall Street.</span>
<?php
if($show_mod_desc)
	echo '<'.$mod_desc_style.' class="mod_text">'.$mod_desc.'</'.$mod_desc_style.'>';
?>
<fieldset class="cc_data">

<p>
	<input placeholder="<?php echo JText::_($email_label); ?>" id="jform_email" class="validate-email required inputbox" type="email" size="<?php echo $email_size; ?>" value="" name="ea" aria-required="true" required="required" />
<!--
	<label for="modcc-email"><?php echo $email_label; ?></label>
	<input id="modcc-email" type="text" name="ea" size="<?php echo $email_size; ?>" class="inputbox" />
	-->
</p>
	<input type="submit" name="<?php echo $submit_btn; ?>" value="<?php echo $submit_btn; ?>" class="button" />
</fieldset>
	<input type="hidden" name="m" value="<?php echo $ccid; ?>" />
	<input type="hidden" name="p" value="oi" />
</form>
<?php
if($show_safesubscribe){
?>
<!-- BEGIN: SafeSubscribe -->
<div align="center" style="padding-top:5px;">
<a href="http://www.constantcontact.com/safesubscribe.jsp<?php echo $referralLink_ ?>" target="_blank"><img src="http://img.constantcontact.com/ui/images1/safe_subscribe_logo.gif" border="0" width="168" height="14" alt=""/></a>
</div>
<!-- END: SafeSubscribe -->
<?php
}
if($show_newsletters){

?>
<!-- BEGIN: Email Marketing you can trust -->
<div align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:10px;color:#999999;">
For <a href="http://www.constantcontact.com/jmml/email-newsletter.jsp<?php echo $referralLink_ ?>" style="text-decoration:none;font-family:Arial,Helvetica,sans-serif;font-size:10px;color:#999999;" target="_blank">Email Newsletters</a> you can trust
</div>
<!-- END: Email Newsletters you can trust -->
<?php
}

}
?>