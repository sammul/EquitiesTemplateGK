<?php

// No direct access.
defined('_JEXEC') or die;
$logo_image = $this->getParam('logo_image', '');

if(($logo_image == '') || ($this->getParam('logo_type', '') == 'css')) {
     $logo_image = $this->URLtemplate() . '/images/style1/logo.png';
} else {
     $logo_image = $this->URLbase() . $logo_image;
}

$logo_text = $this->getParam('logo_text', '');
$logo_slogan = $this->getParam('logo_slogan', '');

$user = JFactory::getUser();
// getting User ID
$userID = $user->get('id');
//
$btn_login_text = ($userID == 0) ? JText::_('TPL_GK_LANG_LOGIN') : JText::_('TPL_GK_LANG_LOGOUT');

?>
<div id="gkLogoWrap">

    <?php if($this->modules('lang')) : ?>
    <jdoc:include type="modules" name="lang" style="<?php echo $this->module_styles['lang']; ?>" />
    <?php endif; ?>

	<?php if ($this->getParam('logo_type', 'image')!=='none'): ?>
     <?php if($this->getParam('logo_type', 'image') == 'css') : ?>
     <h1 id="gkLogo">
          <a href="<?php echo JURI::root(); ?> " class="cssLogo"></a>
     </h1>
     <?php elseif($this->getParam('logo_type', 'image')=='text') : ?>
     <h1 id="gkLogo" class="text">
         <a href="<?php echo JURI::root(); ?> ">
          <?php if($this->getParam('logo_text', '') != '') : ?><span><?php echo $this->getParam('logo_text', ''); ?></span><?php endif; ?>
          <?php if($this->getParam('logo_slogan', '') != '') : ?><small class="gkLogoSlogan"><?php echo $this->getParam('logo_slogan', ''); ?></small><?php endif; ?>
         </a>
     </h1>
    <?php elseif($this->getParam('logo_type', 'image')=='image') : ?>
    <h1 id="gkLogo">
          <a href="<?php echo JURI::root(); ?> ">
          <img src="<?php echo $logo_image; ?>" alt="<?php echo $this->getPageName(); ?>" />
          </a>
     </h1>
     <?php endif; ?>
    <?php endif; ?>

	<?php if((GK_REGISTER || GK_LOGIN) && !GK_COM_USERS) : ?>
	<div id="gkButtons">
		<div>
            <?php if(GK_LOGIN) : ?>
			<a href="<?php echo $this->URLbase(); ?>index.php?option=com_users&amp;view=login" id="btnLogin"><span><?php echo $btn_login_text; ?></span></a>
			<?php endif; ?>
			<?php if(GK_REGISTER) : ?>
			<a href="<?php echo $this->URLbase(); ?>index.php?option=com_users&amp;view=registration" id="btnRegister"><span><?php echo JText::_('TPL_GK_LANG_REGISTER'); ?></span></a>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>

	<?php if($this->modules('highlighter')) : ?>
	<div id="gkHighlighter">
		<jdoc:include type="modules" name="highlighter" style="<?php echo $this->module_styles['highlighter']; ?>" />
	</div>
	<?php endif; ?>	
</div>