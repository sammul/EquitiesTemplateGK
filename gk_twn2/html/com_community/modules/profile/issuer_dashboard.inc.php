<style>.js_PriCell{visibility:hidden;}#phWall,#phProfile,#phVideos,#phBlog,#phSyndication,#phWire,#phLIVE,#phNotifications,#phSettings{display:none}
</style>
<script language="javascript" type="text/javascript">function resizeIframe(obj) {obj.style.height = '0px';obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';}</script>
<h1 class="issuertitle"><?php echo JText::_("EQUITIES ISSUER DASHBOARD"); ?></h1>
<hr /><br />
<div style="float:left; width:69%" class="issuer-dashboard">
	<div style="position: absolute">
		<div id="phWall" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>Interact with equities global community members and your shareholders in real-time.</div><div class="row"></div></div>
		<div id="phProfile" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>View your public profile here as others see it.</div><div class="row"></div></div>
		<div id="phVideos" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>Disseminate your company videos and make your media library accessible to the investment community.</div><div class="row"></div></div>
		<div id="phBlog" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>Communicate with members, investors and the web with your company blog.</div><div class="row"></div></div>
		<div id="phSyndication" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>Disseminate your company news and press releases to millions of self-directed investors and industry professionals.</div><div class="row"></div></div>
		<div id="phWire" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>Receive special discounted rates for GlobeNewsWire-Nasdaq OMX press releases.</div><div class="row"></div></div>
		<div id="phLIVE" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>Host live webcast video chats with the investment community</div><div class="row"></div></div>
		<div id="phNotifications" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>See new messages, followers and wall updates</div><div class="row"></div></div>
		<div id="phSettings" class="popuphelper4issuer"><div class="text"><div class="closepopuphelper4issuer">x</div>Update your profile and adjust social broadcast settings</div><div class="row"></div></div>		
	</div>
    {tab Wall|block}
    <?php 
     require_once 'wall.inc.php';
    ?>

    {tab Profile|block}
    <?php 
     require_once 'company_info.inc.php'; 
    ?>

    {tab Videos|block}
    <div class="socialConnectUserInfo">
        <ul class="socialConnectUserMenu">
            <li><a onclick="joms.videos.addVideo()" href="javascript: void(0);">Add</a></li>
        </ul>
    </div>
    <?php 
	 require_once 'videos.inc.php'; 
    ?>

    {tab Blog|block}
    <div class="socialConnectUserInfo">
        <ul class="socialConnectUserMenu">
            <li>
                <a class="modal socialConnectAddLink" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=item&task=add&tmpl=component&itemformtype=67'); ?>"><?php echo JText::_('Add Update'); ?></a>
            </li>
        </ul>
    </div>
    <?php 
require_once 'blog.inc.php';
     ?>

    <?php
    //{tab News}
    //require_once 'news2.inc.php'; 
    ?>


    <?php
    //{tab Editorial}
    /* <div class="socialConnectUserInfo">
      <ul class="socialConnectUserMenu">
      <li>
      <a class="modal socialConnectAddLink" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=item&task=add&tmpl=component'); ?>"><?php echo JText::_('Add Update'); ?></a>
      </li>
      </ul>
      </div>
      require_once 'newsdata.inc.php'; */
    //require_once 'news.inc.php'; 
    ?>

    <?php
//	{tab Followers}
//	echo '<div><h4>'.JText::_('FOLLOWERS_FROM_EQUITIES').'</h4><br />';
//	require_once 'followers.inc.php'
//	echo '</div>';
    ?>

    {tab Syndication|eqlogo|ferishere}
    <div class="socialConnectUserInfo">
        <ul class="socialConnectUserMenu">
            <li>
                <a class="modal socialConnectAddLink" rel="{handler:'iframe',size:{x:990,y:550}}" href="<?php echo JRoute::_('index.php?option=com_k2&view=item&task=add&tmpl=component&itemformtype=66'); ?>"><?php echo JText::_('Add Update'); ?></a>
            </li>
        </ul>
    </div>
    <?php require_once 'equities_wire.inc.php'; ?>
	
	{tab Wire|eqlogo|ferishere}
	<?php require_once 'gnw.inc.php'; ?>

    {tab LIVE|eqlogo|ferishere}
    <?php
    //require_once 'vchat.inc.php';  //old 
    
     // tony commented march 18th 
    require_once 'avconference.inc.php';
    ?>

    <?php //{tab Trending}  ?>
    <?php //require_once 'trending.inc.php';  ?>

    {tab Notifications|block}
    <?php require_once 'notifications.inc.php'; ?>

    {tab Settings|block}
<?php require_once 'edit_issuer_profile.inc.php'; ?>
    {/tabs}

</div>

<div style="float:left; width:1%">&nbsp;</div>
<div style="float:left; width:30%" id="issuer_dash">
    <div class="search_stock">
		{module 392}
        <?php
        jimport('joomla.application.module.helper');
        $module = JModuleHelper::getModule('jcsearch');
        $attribs['style'] = 'xhtml';
        echo JModuleHelper::renderModule($module, $attribs);
        ?>
    </div>
    <div style="clear:both"></div>
	<div>
    <?php //{module 479} ?>
    <p>
	<a class="jcepopup" data-mediabox="width[640];height[480];controls[controls];src[https://s3.amazonaws.com/equitiesmediastream/equities/Issuer-Dashboard-Video.mp4];autoplay[true]" href="https://s3.amazonaws.com/equitiesmediastream/equities/Issuer-Dashboard-Video.mp4" onclick="_gaq.push(['_trackEvent', 'Videos', 'Play', 'Issuer Dashboard']);" target="_blank" type="video/mp4"><img alt="Issuer-How-to-video-300x135" src="images/Issuer-How-to-video-300x135.jpg" /></a></p>
    </div>
    <div style="background:#E9E9E9; padding:10px">
        <div style="text-align:center;">
            <div style="display: block;" >
                    <a target="_blank" href="<?php echo JURI::base(); ?>community/<?php echo str_replace(":", "-", K2JomUtilities::getCommunityURLFragment($profile->id)); ?>/profile?profile=public"><img src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape($user->getDisplayName()); ?>"  /></a>
<!--                <a href="<?php echo JURI::base(); ?>community/profile/uploadAvatar"><img src="<?php echo $profile->largeAvatar; ?>" alt="<?php echo $this->escape($user->getDisplayName()); ?>"  /></a>-->
            </div>
            <div>
                <h2 style="font-weight: normal">
<?php echo $user->getDisplayName(); ?> (<?php echo $user->username; ?>)
                </h2>
            </div>
        </div>
    </div>
    <div>
        <link rel="stylesheet" type="text/css" href="http://app.quotemedia.com/css/tools.css" />
        <style type="text/css" >
            .qmmt_main	{ background:none; border:none;  } 
            .qmmt_text		{ font: 11px  arial;color: #666666; text-align:left;  padding:2px;}

            .qmmt_text_up		{ font: 11px  arial; color: #009900; }
            .qmmt_text_down	{ font: 11px  arial; color: #ff0000; }

            .qmmt_tab				 { font: 11px  arial; border:1px solid #ffffff; color:#666; background: #eeeeee; }
            .qmmt_tabactive 	 { font: 11px  arial; border:1px solid #ffffff; }

            .qmmt_cycle	{ background-color:#eeeeee; color: #666666; }

            .qmmt_header_text	{ font-family: arial, sans-serif; color: #000000;  }
            .qmmt_header_bar	{ background-color:#fff; border:none; }

            a.qmmt_text 				{ color: #185487; text-decoration:none;  }
            a:visited.qmmt_text 	{ color: #185487; text-decoration:none; }
            a:hover.qmmt_text 	{ color: #185487; text-decoration:none; }  

            .qmmt_nonrt_text { font: oblique 10px  arial;color: #666666; font-weight:normal; }
			
			.nn_tabs_tabs li span a span{display: inline-block}
			.feromon{display: inline-block; background: url(/images/questionmark.png) no-repeat; width: 14px; height: 14px; margin-top: 3px; margin-left:5px}
			.popuphelper4issuer{width: 250px;}
			#phSyndication{margin-top: -73px; margin-left: 128px}
			#phSyndication .text{background: #000; color: #fff; width: 250px; padding: 10px}
			#phSyndication .text .closepopuphelper4issuer{float: right; margin-top: -5px; padding: 3px; color: #ccc; width: 5px; height: 5px; cursor: pointer}
			#phWire{margin-top: -73px; margin-left: 225px}
			#phWire .text{background: #000; color: #fff; width: 250px; padding: 10px}
			#phWire .text .closepopuphelper4issuer{float: right; margin-top: -5px; padding: 3px; color: #ccc; width: 5px; height: 5px; cursor: pointer}
			#phLIVE{margin-top: -57px; margin-left: 308px}
			#phLIVE .text{background: #000; color: #fff; width: 250px; padding: 10px}
			#phWall .text .closepopuphelper4issuer, #phProfile .text .closepopuphelper4issuer, #phVideos .text .closepopuphelper4issuer, #phLIVE .text .closepopuphelper4issuer,
			#phBlog .text .closepopuphelper4issuer, #phNotifications .text .closepopuphelper4issuer, #phSettings .text .closepopuphelper4issuer{float: right; margin-top: -5px; padding: 3px; color: #ccc; width: 5px; height: 5px; cursor: pointer}
			
			#phWall .text, #phProfile .text, #phVideos .text,
			#phBlog .text, #phNotifications .text, #phSettings .text{background: #000; color: #fff; width: 250px; padding: 10px}
			.row{margin-left:125px; background: url(/images/row.png) no-repeat; width: 10px; height: 5px; position: absolute;}
			
			#phWall{margin-top: -72px; margin-left: -104px}
			#phProfile{margin-top: -57px; margin-left: -36px}
			#phVideos{margin-top: -72px; margin-left: 31px}
			#phBlog{margin-top: -57px; margin-left: 94px}
			#phNotifications{margin-top: -57px; margin-left: 447px}
			#phSettings{margin-top: -35px; margin-left: -95px}

        </style>
<?php $userObj = JFactory::getUser($profile->id); ?>
        <script LANGUAGE="javascript" TYPE="text/javascript" src="http://app.quotemedia.com/quotetools/miniQuoteChart.go?webmasterId=101598&symbol=<?php echo $userObj->username; ?>&toolWidth=259&chhig=180&chcon=off&symbols=^FCHI&symbols=^BFX&symbols=^MIBTEL&symbols=^GDAXI&chbg=ffffff&chbgch=ffffff&chfill=cc318DCA&chfill2=318DCA&chln=333333"></script>
    </div>
    <div class="box nsp headlines big" style="margin-bottom: 22px">
        <div>
            <h3 class="header">
                <span style="border-bottom: 1px solid #C7C7C7;margin: 0px;">Dedicated Account Manager</span>
            </h3>
            <div class="content">
                <img src="/images/pedrorivera.jpg" style="display:block; float:left; border:1px solid #C7C7C7" />
                <div style="float:left; margin-left: 10px">
                    <span style="font-size: 14px; font-weight: bold; display: block; margin-bottom: 10px;">Pedro Rivera</span>
                    <a style="font-size: 16px; color:#185487; display: block; margin-bottom: 10px" href="mailto:support@equities.com">support@equities.com</a>
                    <span style="font-size: 14px; font-weight: bold;">310.822.5500</span>
                </div>
            </div>
        </div>
    </div>
<!--    <div class="box nsp headlines big">
        <div>
            <h3 class="header"><span style="border-bottom: 1px solid #C7C7C7;margin: 0px;">Knowledge Base</span></h3>
            <div class="content">
                <ol style="list-style: decimal">
                    <li style="padding-left: 0px; background: none"><a href="#" style="color:#185487">HSBS brings in Zimmorhansi to head securities lending</a></li>
                    <li style="padding-left: 0px; background: none"><a href="#" style="color:#185487">China Quietly Invests Reserves in U.K. Properties</a></li>
                    <li style="padding-left: 0px; background: none"><a href="#" style="color:#185487">Pensions, HSBS and BNP Paribas</a></li>
                    <li style="padding-left: 0px; background: none"><a href="#" style="color:#185487">U.S. Stock Futures Little Changed After GDP, Claims Data</a></li>
                    <li style="padding-left: 0px; background: none"><a href="#" style="color:#185487">China Quietly Invests Reserves in U.K. Properties</a></li>
                </ol>
            </div>
        </div>
    </div>-->
    <?php
    /*<div class="box nsp headlines big" style="display:none">
        <div>
            <h3 class="header"><span style="border-bottom: 1px solid #C7C7C7;margin: 0px;">Most Popular</span></h3>
            <div class="content">{module 380}</div>
        </div>
    </div>*/
	?>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("li.ferishere span a").each(function(){
			var rand_100813 = Math.floor(Math.random()*10000);
			var item_100813 = jQuery(this).find("span").html();
			jQuery(this).html(jQuery(this).html() + '<div class="feromon" data-popuphelp="ph'+item_100813+'"></div>') ;
		});
		jQuery(".feromon").bind("mouseover", function(){
			jQuery(".popuphelper4issuer").hide();
			jQuery("#"+jQuery(this).data("popuphelp")).show();
		});
		jQuery(".popuphelper4issuer").bind("click", function(){
			jQuery(this).hide();
		});
	});
</script>
