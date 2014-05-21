<?php
/**
 * @package		JomSocial
 * @subpackage 	Template
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license		GNU/GPL, see LICENSE.php
 *
 * @param	applications	An array of applications object
 * @param	pagination		JPagination object
 */
defined('_JEXEC') or die();
?>
	<h2><?php echo JText::_( 'COM_COMMUNITY_REGISTER_TITLE_USER_INFO' ); ?></h2>
<div class="form-field redtext">
	<?php echo JText::_( 'COM_COMMUNITY_REGISTER_REQUIRED_FILEDS' ); ?>
</div>

<style type="text/css">
	.newBox{width: 978px !important; background: #f3f3f3 !important; }
	.newBox p{line-height: 1.8em; font-size: 14px; padding-right: 20px; padding-top: 10px}
	.newBox h2{font-weight: bold; color: #185487}
	.newBox .rightBox ul li{list-style: none !important; background: none !important}
	.newBox .rightBox{float:right; width: 43%; padding-top: 20px; padding-left: 0px}
	.newBox .rightBox li input[type="text"], .newBox .rightBox li input[type="password"]{height: 28px; margin-bottom: 0px; padding: 13px 25px 13px 5px !important; font-size: 14px}
	.newBox .rightBox label{font-size: 14px !important; font-weight: normal}
	.newBox .lside{padding: 20px}
	.newBox .form-field{margin-bottom: 15px; margin-top: 8px}
	.newBox .greenButton{border:none; background: url(/images/button-bak.png) repeat-x; width: 120px; height: 37px; color: #fff; font-weight: normal; font-size: 17px; text-shadow: none; margin-right: 5px; float:right}
	.newBox .greenButton:hover{color: #fff !important; }
	.newBox .line-c{border-top: 1px solid #ccc; padding-top: 20px; width: 94%}


	/*styles for ipad*/
	.ipds{padding-top: 0!important}
	.newBox .ipad-h3{color: #006ab0; font-weight: normal; font-size: 31px}
	.newBox .smalli{font-size: 12px; color: #1d2e63}
	.newBox .font-1{font-size: 23px; color: #1d2e63}
	.newBox .font-2{font-size: 20px; color: #fff; background: #0074b7; font-weight: normal; margin-left: -30px;padding: 20px;}
	.newBox .normal{font-size: 16px; color: #1d2e63; }
	.newBox .list-ipad{margin-left: 20px}
	.newBox .list-ipad li{list-style: disc; line-height: 1.5em; color: #1d2e63; font-size: 14px}
	.newBox .smaller{color: #1d2e63; font-size: 11px; line-height: 1.2em}
	.newBox .head-box-ipad{background: url(/images/ipad.png) no-repeat; background-position: right top; padding: 25px 20px 0 20px;  height: 147px }
	.newBox .ipad-h1{font-size: 54px !important; color: #1d2e63; font-weight: normal}
	.newBox .line-bold{border-bottom: 7px solid #ddd; width: 95%; margin-left: 20px}

</style>

<div class="rfull newBox ipds">
<?php if(JRequest::getVar("page", "") == "ipad"): ?>
<div class="head-box-ipad">
<div class="ipad-h1">JOIN OUR COMMUNITY</div>

<div class="ipad-h3">to enter for a chance to win a free iPad Mini**</div>
<p class="smalli">Winner will be selected and notified by email on Friday March 7, 2014</p>
</div>
<div class="line-bold"></div>
<?php endif ?>
<div class="lside"><?php //$this->renderModules( 'rside' ); ?>
	<!--<p><span style="font-size: 20px;"><strong>Join the my-f <img src="images/community/community.jpg" /> Community</strong></span></p>-->
	<?php if(JRequest::getVar("page", "") == "ipad"): ?>

<p class="font-1">Be among the first to receive alerts on our new list of Small-Cap Stars for 2014, unveiled the week of February 24th!</p>

<p class="font-2">In 2013, the equities.com Small-Cap Stars outperformed 90% of all small-cap mutual funds with an overall return of 45%.</p>

<p class="normal"><strong>Your free membership includes access to all website features including:</strong>

<ul class="list-ipad">
<li>Community networking with public companies, industry 
    vendors, private market investment opportunities, 
    authors, analysts and like-minded investors</li>
<li>Small-Cap Stars</li>
<li>Equities Valuation Analysis (EVA) Reports</li>
<li>Your personal profile with Wall, Blog, Social
     Broadcasting, Network Feed and Video Chat functions</li>
<li>Insightful financial news written by equities.com editorial 
    staff and expert contributors.</li>
<li>And so much more!</li>
</p>

<p class="smaller">
**Apple, Inc. does not endorse or sponsor this product, service or promotion. This iPad Mini drawing is only available to attendees of the New York Traders Expo and requires registration to our free equities.com community.
</p>
	<?php else:?>
	<h2>JOIN THE EQUITIES.COM COMMUNITY</h2>
<p>Become part of an entire financial ecosystem consisting of public companies, industry vendors, knowledgeable contributing authors and other active investors. Your dashboard includes your profile, wall, blog, watch list, and video chat features. Instantly see just the news you want and share or comment on it with your followers.
</p>
<p><strong>Gain access to the equities.com Small-Cap Stars</strong>, a list of top performing stocks selected by our institutional-style algorithms. Our system identifies which fundamental criteria were most important to a stock’s success over the previous 12 month period and then finds stocks that are in a similar position of anticipated growth today.  While no system offers 100% accuracy, the Small Cap Stars outperformed 95% of all small cap mutual funds by achieving annualized returns of 45% as a whole in 2013 with 83% of our stocks ending with gains.</p>
<p><strong>Use our member-exclusive Equities Valuation Analysis (EVA) Reports</strong>, with over 15,000 institutional-quality research reports available at the touch of a finger.  This quick, easy-to-use analysis tool lets you instantly see critical performance indicators such as growth rates, profit margins and valuations. Then we explain how to interpret those results so you can make your best investment decisions. Finally, EVA also lets investors leverage the renowned DuPont ROE breakdown to get a full understanding of a stock’s health and potential.  Broaden your research with key Technical Analysis indicators too!</p>
	<?php endif; ?>
</div>
<div class="rightBox">
<form action="<?php echo CRoute::getURI(); ?>" method="post" id="jomsForm" name="jomsForm" class="community-form-validate">

<ul class="">
	
<?php if ($isUseFirstLastName) { ; ?>
	<li>
		<label id="jsfirstnamemsg" for="jsfirstname" class="form-label"><?php echo JText::_( 'COM_COMMUNITY_FIRST_NAME' ); ?>*</label>

		<div class="form-field">
		    <input type="text" id="jsfirstnamemsg" name="jsfirstname"
					value="<?php echo $data['html_field']['jsfirstname']; ?>"
					class="input text required validate-firstname"  />
			<span id="errjsfirstnamemsg" style="display:none;">&nbsp;</span>
		</div>
	</li>
	<li>
		<label id="jslastnamemsg" for="jslastname" class="form-label"><?php echo JText::_( 'COM_COMMUNITY_LAST_NAME' ); ?>*</label>

		<div class="form-field">
		    <input type="text" id="jslastnamemsg" name="jslastname"
					value="<?php echo $data['html_field']['jslastname']; ?>"
					class="input text required validate-jslastname"  />
			<span id="errjslastnamemsg" style="display:none;">&nbsp;</span>
		</div>
	</li>
<?php } else { ?>
	<li>
		<label id="jsnamemsg" for="jsname" class="form-label"><?php echo JText::_( 'COM_COMMUNITY_NAME' ); ?>*</label>

		<div class="form-field">
		    <input type="text" name="jsname" id="jsname" value="<?php echo $_POST['fname']; ?> <?php echo $_POST['lname'] ?>" class="input text required validate-name"  />
			<span id="errjsnamemsg" style="display:none;">&nbsp;</span>
		</div>
	</li>
<?php } ?>
	<li>
		<label id="jsemailmsg" for="jsemail" class="form-label"><?php echo JText::_( 'COM_COMMUNITY_EMAIL' ); ?>*</label>

		<div class="form-field">
		    <input type="text" id="jsemail" name="jsemail" value="<?php echo $data['html_field']['jsemail']; ?>" class="input text required validate-email"  />
		    <input type="hidden" name="emailpass" id="emailpass" value="N"/>
		    <span id="errjsemailmsg" style="display:none;">&nbsp;</span>
		</div>
	</li>
	<li>
		<label id="jsusernamemsg" for="jsusername" class="form-label"><?php echo JText::_( 'COM_COMMUNITY_USERNAME' ); ?>*</label>

		<div class="form-field">
		    <input type="text" id="jsusername" name="jsusername" value="<?php echo $data['html_field']['jsusername']; ?>"
			       class="input text  required validate-username"  />
		    <input type="hidden" name="usernamepass" id="usernamepass" value="N"/>
			<span id="errjsusernamemsg" style="display:none;">&nbsp;</span>
		</div>
	</li>
	
	<li>
		<label id="pwmsg" for="jspassword" class="form-label"><?php echo JText::_( 'COM_COMMUNITY_PASSWORD' ); ?>*</label>

		<div class="form-field">
		    <input class="input password required validate-password" type="password" id="jspassword" name="jspassword" style="width: 50%" />
		</div>
	</li>
	<li>
		<label id="pw2msg" for="jspassword2" class="form-label"><?php echo JText::_( 'COM_COMMUNITY_VERIFY_PASSWORD' ); ?>*</label>

		<div class="form-field">
		    <input class="input password  required validate-passverify" type="password" id="jspassword2" name="jspassword2" style="width: 50%" />
		    <span id="errjspassword2msg" style="display:none;">&nbsp;</span>
		</div>
	</li>
	<li>
		<div class="form-field">
		    <input class="checkbox required" type="checkbox" id="jsacceptterms" name="jsacceptterms" />
		    <span id="errjsaccepttermsmsg" style="display:none;">&nbsp;</span>	
			<label for="jsacceptterms" class="clighter"><a href="/terms-and-conditions" target="_blank"><?php echo JText::_( 'COM_COMMUNITY_ACCEPT_TERMS' ); ?></a></label>
		</div>
	</li>
	<li>
		<div class="form-field">
		    <input class="checkbox" type="checkbox" id="jssubscription" name="jssubscription" checked="checked" />
			<label for="jssubscription" class="clighter"><?php echo JText::_( 'COM_COMMUNITY_SUBSCRIPTION' ); ?></label>
		</div>
	</li>
	<?php
	if(!empty($recaptchaHTML))
	{
	?>
	<li>
		<label class="clighter"><?php echo JText::_( 'COM_COMMUNITY_CAPTCHA_DESC' ); ?></label>
		<div class="form-field">
			<div class="cRecaptcha">
				<?php echo $recaptchaHTML;?>
			</div>
		</div>
	</li>
	<?php
	}
	if( $config->get('enableterms') )
	{
	?>
	<li class="has-seperator">
		<div class="form-field">
			<label class="label-checkbox">
				<input type="checkbox" name="tnc" id="tnc" value="Y" data-message="<?php echo JText::_('COM_COMMUNITY_REGISTER_ACCEPT_TNC')?>" class="input checkbox required validate-tnc"/>
				<?php echo JText::_('COM_COMMUNITY_I_HAVE_READ').' <a href="javascript:void(0);" onclick="joms.registrations.showTermsWindow(0);">'.JText::_('COM_COMMUNITY_TERMS_AND_CONDITION').'</a>.';?>
			</label>
		</div>
	</li>
	<?php }?>
	<li class="form-action has-seperator">
		<div class="form-field line-c">
			<input class="greenButton  validateSubmit" type="submit" id="btnSubmit" value="<?php echo JText::_('COM_COMMUNITY_NEXT'); ?>" name="submit" />
			<?php if ( $fbHtml ) { ?>
			<div class="auth-facebook">
				<?php echo $fbHtml;?>
			</div>
			<?php } ?>
		</div>
	</li>
</ul>
<?php
if( $config->get('enableterms') )
{
?>

<?php
}
?>



<input type="hidden" name="isUseFirstLastName" value="<?php echo $isUseFirstLastName; ?>" />
<input type="hidden" name="task" value="register_save" />
<input type="hidden" name="id" value="0" />
<input type="hidden" name="gid" value="0" />
<input type="hidden" id="authenticate" name="authenticate" value="0" />
<input type="hidden" id="authkey" name="authkey" value="" />
</form>
</div>
</div>
<script type="text/javascript">
	cvalidate.init();
	cvalidate.noticeTitle	= '<?php echo addslashes(JText::_('COM_COMMUNITY_NOTICE') );?>';
	cvalidate.setSystemText('REM','<?php echo addslashes(JText::_("COM_COMMUNITY_ENTRY_MISSING")); ?>');
	cvalidate.setSystemText('JOINTEXT','<?php echo addslashes(JText::_("COM_COMMUNITY_AND")); ?>');

joms.jQuery( '#jomsForm' ).submit( function(){
    joms.jQuery('#btnSubmit').hide();
	joms.jQuery('#cwin-wait').show();
	joms.jQuery('#jomsForm input').attr('readonly', true);

	if(joms.jQuery('#authenticate').val() != '1')
	{
		joms.registrations.authenticate();
		return false;
	}
});





// Password strenght indicator
var password_strength_settings = {
	'texts' : {
		1 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L1')); ?>',
		2 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L2')); ?>',
		3 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L3')); ?>',
		4 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L4')); ?>',
		5 : '<?php echo addslashes(JText::_('COM_COMMUNITY_PASSWORD_STRENGHT_L5')); ?>'
	}
}

joms.jQuery('#jspassword').password_strength(password_strength_settings);


</script>
