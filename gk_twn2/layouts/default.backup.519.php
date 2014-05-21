<?php
/**
 *
 * Default view
 *
 * @version             1.0.0
 * @package             Gavern Framework
 * @copyright			Copyright (C) 2010 - 2011 GavickPro. All rights reserved.
 *               
 */
 
// No direct access.
defined('_JEXEC') or die;
if($this->getParam("cwidth_position", 'head') == 'head') {
$this->generateColumnsWidth();
}
$this->addCSSRule('.gkWrap { width: ' . $this->getParam('template_width','1240px') . '!important; }');
$this->addCSSRule('html { min-width: ' . $this->getParam('template_width','1240px') . '!important; }');
$tpl_page_suffix = '';
if($this->page_suffix != '') {
	$tpl_page_suffix = ' class="'.$this->page_suffix.'"';
}
$tpl_name = str_replace(' ', '_', JText::_('TPL_GK_LANG_NAME'));
$user = JFactory::getUser();
// getting User ID
$userID = $user->get('id');
// getting params
$option = JRequest::getCmd('option', '');
$view = JRequest::getCmd('view', '');
// defines if register is active
define('GK_REGISTER', ($this->modules('register') ? $userID == 0 : false));
// defines if login is active
define('GK_LOGIN', $this->modules('login'));
// defines if com_users
define('GK_COM_USERS', $option == 'com_users' && ($view == 'login' || $view == 'registration'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
	  xmlns:og="http://ogp.me/ns#" 
	  xmlns:fb="http://ogp.me/ns/fb#"
	  xml:lang="<?php echo $this->API->language; ?>" lang="<?php echo $this->API->language; ?>">
	 
<head>
        
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <jdoc:include type="head" />
    <?php $this->loadBlock('head'); ?>
    <?php $this->loadBlock('cookielaw'); ?>
	
	
	
	<?php
   $menus      = &JSite::getMenu();
   $menu      = $menus->getActive();
   $pageclass   = "";
    
   if (is_object( $menu )) :
    $params = new JParameter( $menu->params );
   $pageclass = $params->get( 'pageclass_sfx' );
    endif; ?>
	
	
</head>
<?php
$class='';
$menu =& JSite::getMenu();
/* //comment by james
$active = $menu->getActive();
$params = $menu->getParams( $active->id );
$class = $params->get( "pageclass_sfx" );
*/
?>

<body class="<?php echo $pageclass; ?>">
	<!--[if IE 6]>
   <div id="gkInfobar"><a href="http://browsehappy.com"><?php echo JText::_('TPL_GK_LANG_IE6_BAR'); ?></a></div>
   <![endif]-->
	<?php $this->messages('message-position-1'); ?>
			
	<div id="gkPage" class="gkMain gkWrap">
        <?php if(isset($_COOKIE['gkGavernMobile'.$tpl_name]) &&
              $_COOKIE['gkGavernMobile'.$tpl_name] == 'desktop') : ?>
              <div class="mobileSwitch">
            <a href="javascript:setCookie('gkGavernMobile<?php echo $tpl_name; ?>', 'mobile', 365);window.location.reload();"><?php echo JText::_('TPL_GK_LANG_SWITCH_TO_MOBILE'); ?></a>
             </div>
    <?php endif; ?>  
    
    
        <?php $this->loadBlock('logo'); ?>
        
        <div id="gkMenuWrap" class="clear">    
           	<?php if($this->modules('topmenu1 or search') ) : ?>
           	<div id="gkTopMenu">
           		<?php if($this->modules('topmenu1')) : ?>
           		<div id="gkTopMenu1">
           			<jdoc:include type="modules" name="topmenu1" style="<?php echo $this->module_styles['topmenu1']; ?>" />
           		</div>
           		<?php endif; ?>
           		
           		<?php if($this->modules('search')) : ?>
           		<div id="gkSearch">
           			<jdoc:include type="modules" name="search" style="<?php echo $this->module_styles['search']; ?>" />
           		</div>
           		<?php endif; ?>	
           	</div>
            <?php endif; ?>
           <?php if($this->getParam('show_menu', 1)) : ?>
          	<div id="gkMainMenu" class="clear">
      			<?php
      				$this->menu->loadMenu($this->getParam('menu_name','mainmenu')); 
      			    $this->menu->genMenu($this->getParam('startlevel', 0), $this->getParam('endlevel',-1));
      			?>
          	</div>
          	<?php endif; ?>
          	<?php if($this->generateSubmenu && $this->menu->genMenu($this->getParam('startlevel', 0)+1, $this->getParam('endlevel',-1), true)): ?>
          	<?php if($this->getParam('show_menu', 1)) : ?>
            <div id="gkSubmenu" class="clear">
          		<?php $this->menu->genMenu($this->getParam('startlevel', 0)+1, $this->getParam('endlevel',-1));?>
          	</div>
          	<?php endif; ?>
			<?php else: ?>
          	
          		<?php if($this->modules('middlemenu')) : ?>
          		<div id="gkMiddleMenu" class="clear">
          			<jdoc:include type="modules" name="middlemenu" style="<?php echo $this->module_styles['middlemenu']; ?>" />
          		</div>
          		<?php endif; ?>
          	
          	<?php endif;?>
          	
          	<?php if($this->modules('breadcrumb or topmenu2')) : ?>         		
          	<div id="gkBottomMenu" class="clear">
          		<?php if($this->modules('breadcrumb')) : ?>
          		<div id="gkBreadcrumb">
          			<jdoc:include type="modules" name="breadcrumb" style="<?php echo $this->module_styles['breadcrumb']; ?>" />
          		</div>
          		<?php endif; ?>	
          		
          		<?php if($this->modules('topmenu2')) : ?>
          		<div id="gkTopMenu2">
          			<jdoc:include type="modules" name="topmenu2" style="<?php echo $this->module_styles['topmenu2']; ?>" />
          		</div>
          		<?php endif; ?>
          	</div>
          	<?php endif; ?>
        </div>	
        
    	<?php $this->messages('message-position-2'); ?>
	    <div id="mainContent" class="gkWrap clear">
	    	<?php $this->loadBlock('header'); ?>
         <?php if($this->isFrontpage() ){
                 if($userID == 0){
                       $this->loadBlock('signup');
                     }
                     
                     }?>
            <div style="display: block;	width: 70%; float:left;">
	    	<?php $this->loadBlock('mainLeft'); ?>
	    	</div>
	    	<div style="display: block;	width: 30%; float:left;">
	    	<?php $this->loadBlock('mainRight'); ?>
	    	</div>
	    	<?php $this->loadBlock('user'); ?>
	    </div>
    </div>
    
    <div id="gkBottomWrap" class="gkWrap clear">
        <?php $this->loadBlock('bottom'); ?>
    </div>
    
    <div id="gkFooter" class="gkWrap">
    	<?php $this->loadBlock('footer'); ?> 
    </div>
   
   <?php if(GK_LOGIN && !GK_COM_USERS) : ?>	
   <div id="gkPopupLogin">	
   	<div class="gkPopupWrap">
   	     <?php $this->loadBlock('tools/login'); ?>
   	</div>
   	</div>
   <?php endif; ?>
   
   <?php if(GK_REGISTER && !GK_COM_USERS) : ?>
   <div id="gkPopupRegister">	
   	<div class="gkPopupWrap">
   		<?php $this->loadBlock('tools/register'); ?>
   	</div>
   </div>
   <?php endif; ?>
   
   <?php if((GK_REGISTER || GK_LOGIN) && !GK_COM_USERS) : ?>
   <div id="gkPopupOverlay"></div>
   <?php endif; ?>
   
	<jdoc:include type="modules" name="debug" />
	<!-- Start of StatCounter -->
<script type="text/javascript">
var sc_project=7027499; 
var sc_invisible=1; 
var sc_security="e524b3f5"; 
var sc_https=1; 
var scJsHost = (("https:" == document.location.protocol) ?
"https://secure." : "http://www.");
document.write("<sc"+"ript type='text/javascript' src='" +
scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web stats"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="http://c.statcounter.com/7027499/0/e524b3f5/1/"
alt="web stats"></a></div></noscript>
<!-- End of StatCounter  -->
</body>
</html>