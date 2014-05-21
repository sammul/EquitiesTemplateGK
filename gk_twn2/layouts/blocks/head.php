<?php



// This is the code which will be placed in the head section



// No direct access.

defined('_JEXEC') or die;



$favicon_image = $this->getParam('favicon_image', '');



if($favicon_image == '') {

	$favicon_image = $this->URLtemplate() . '/images/favicon.ico';

} else {

	$favicon_image = $this->URLbase() . $favicon_image;

}



$this->API->addFavicon($favicon_image);



?>



<?php



	// check the color version

	$template_style = '';

	if($this->getParam("stylearea", 1)) $template_style = (isset($_COOKIE['gk_twn2_16_style']) ? $_COOKIE['gk_twn2_16_style'] : $this->getParam("template_color", 1));

	else $template_style = $this->getParam("template_color", 1);

	// load the CSS files

	if($this->getParam('reset_css', '') != '') {

		$this->addCSS($this->URLtemplate() . '/css/reset/'.$this->getParam('reset_css', '').'.css');

	}

	

	$this->addCSS($this->URLtemplate() . '/css/layout.css');

	$this->addCSS($this->URLtemplate() . '/css/j.css');

	$this->addCSS($this->URLtemplate() . '/css/template.css');

	$this->addCSS($this->URLtemplate() . '/css/menu.css');

	$this->addCSS($this->URLtemplate() . '/css/gk.stuff.css');

	

	if($this->getParam('typography', '1') == '1') {

		$this->addCSS($this->URLtemplate() . '/css/typography.style'.$template_style.'.css');

		if($this->getParam('typo_iconset1', '1') == '1') $this->addCSS($this->URLtemplate() . '/css/typography.iconset.1.css');	

		if($this->getParam('typo_iconset2', '1') == '1') $this->addCSS($this->URLtemplate() . '/css/typography.iconset.2.css');	

		if($this->getParam('typo_iconset3', '1') == '1') $this->addCSS($this->URLtemplate() . '/css/typography.iconset.3.css');	

	}

	

	$this->addCSS($this->URLtemplate() . '/css/style'.$template_style.'.css');

	

	if($this->getParam("css_override", '0')) {

		$this->addCSS($this->URLtemplate() . '/css/override.css');

	}

	

	if($this->getParam("css_prefixer", '0')) {

          $this->addJS($this->URLtemplate() . '/js/prefixfree.js');

    }

	

    if($this->getParam("css_custom", '') != '') {

         $this->addCSSRule($this->getParam('css_custom', ''));

    }

    

	if($this->getParam('css_compression', '0') == 1 || $this->getParam('css_cache', '0') == 1) {
          $this->registerCache();
     }
     if($this->getParam('js_compression', '0') == 1 ) {
          $this->registerJSCompression();
     }


	// include fonts

	$font_iter = 1;

	

	while($this->getParam('font_name_group'.$font_iter, 'gkFontNull') !== 'gkFontNull') {
     $font_data = explode(';', $this->getParam('font_name_group'.$font_iter, ''));
     if(isset($font_data) && count($font_data) >= 2) {
          $font_type = $font_data[0];
          $font_name = $font_data[1];
          if($this->getParam('font_rules_group'.$font_iter, '') != ''){
               if($font_type == 'standard') {
                    $this->addCSSRule($this->getParam('font_rules_group'.$font_iter, '') . ' { font-family: ' . $font_name . '; }'."\n");
               } elseif($font_type == 'google') {
                    $font_link = preg_replace('/https?:/m', '', $font_data[2]);
                    $font_family = $font_data[3];
                    $this->addCSS($font_link);
                    $this->addCSSRule($this->getParam('font_rules_group'.$font_iter, '') . ' { font-family: \''.$font_family.'\', Arial, sans-serif; }'."\n");
               } elseif($font_type == 'squirrel') {
                    $this->addCSS($this->URLtemplate() . '/fonts/' . $font_name . '/stylesheet.css');
                    $this->addCSSRule($this->getParam('font_rules_group'.$font_iter, '') . ' { font-family: ' . $font_name . ', Arial, sans-serif; }'."\n");
               } elseif($font_type == 'adobe') {
                    $this->API->addJS('//use.edgefonts.net/'.$font_name.'.js');
                $font_name = explode(":", $font_name);
                $font_name = $font_name[0];
                $this->API->addCSSRule($this->API->get('font_rules_group'.$font_iter, '') . ' { font-family: ' . $font_name . ', Arial, sans-serif; }'."\n");
               }
          }
     }
     $font_iter++;
     }

	// include JavaScript

	$this->addJS($this->URLtemplate() . '/js/gk.scripts.js');
	$this->addJS($this->URLtemplate() . '/js/sidepanel.js');


	

	// include lazy load

	if($this->getParam('use_lazyload', '1') == 1) {

		echo '<script type=\'text/javascript\' data-excluded=\''.str_replace("=Disabled\r\n", ",",$this->getParam('lazyload_for_pages', 'null')).'\' id=\'gkLazyLoad\' src=\''.$this->URLtemplate().'/js/lazyload.js\' ></script>';

	}

	

	if($this->browser->get('browser') == 'ie7') {

		$this->addJS($this->URLtemplate() . '/js/ie7.equal.columns.js');

	}

	

	if($this->getParam('selectivizr', '0') == 1 && ($this->browser->get('browser') == 'ie7' || $this->browser->get('browser') == 'ie8')) {

		$this->addJS($this->URLtemplate() . '/js/selectivizr.js');

	}

	

		$this->addJSFragment(' $GKMenu = { height:'.($this->getParam('menu_height','0') == 1 ? 'true' : 'false') .', width:'.($this->getParam('menu_width','0') == 1 ? 'true' : 'false') .', duration: '.($this->getParam('menu_duration', '500')).' };');

	

	

	$this->addJSFragment('$GK_TMPL_URL = "' . $this->URLtemplate() . '";');



?>




    <!--[if IE 9.0]><link rel="stylesheet" href="<?php echo $this->URLtemplate(); ?>/css/ie9.css" type="text/css" /><![endif]-->

	<!--[if IE 8.0]><link rel="stylesheet" href="<?php echo $this->URLtemplate(); ?>/css/ie8.css" type="text/css" /><![endif]-->

	<!--[if IE 7.0]><link rel="stylesheet" href="<?php echo $this->URLtemplate(); ?>/css/ie7.css" type="text/css" /><![endif]-->