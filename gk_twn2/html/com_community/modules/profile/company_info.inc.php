<?php
//$cpath='cache/community/'.$profile->id;
//$cfile=$cpath.'/companyinfo.html';
//$generateCache=0;
//if(!file_exists($cpath))mkdir($cpath, 0777, true);
//if(!file_exists($cfile))$generateCache=1;
//else if(time()-filemtime($cfile)>=43200){$generateCache=1;unlink($cfile);}
//else{echo file_get_contents($cfile);return;}
//ob_start();?>
<style>
.tab_news_box ul li{float:left; list-style:none; margin:0 1px 0 0;}
.tab_news_box ul li a{ background:#EEEEEE;  line-height: 13px; padding: 3px 10px;  float: left; color: #666666;font: 12px Arial,Helvetica,sans-serif; }
.tab_news_box ul li a:hover{background:#fff; color: #000 !important;}
.tab_news_box ul li a.active_tab_news{background:#fff; color: #000 !important;}
.left-box, .right-box{ margin-bottom: 20px; width: 45%; }
</style>

<div class="tab_news_box">
<ul>
	<li><a href="javascript:void(0);" class="active_tab_news" id="CP_tabs-1" onclick="showHideCPTab(this.id);">Profile</a></li>
	<li><a href="javascript:void(0);" class="" id="CP_tabs-2" onclick="showHideCPTab(this.id);">Key Ratios</a></li>
	<!--
	<li><a href="javascript:void(0);" class="" id="tabs-3" onclick="showHideTab(this.id);"><?php echo $symbol." "; ?>News</a></li>
	-->
</ul> 
</div>

<div style="clear:both;"></div>

<div id="CP_DIV_1">

	<br />
	<div class="jomUserItemAbout" style="margin-bottom: 25px">
	<?php
	require_once( JPATH_BASE . DS . 'components' . DS . 'com_community' . DS . 'libraries' . DS . 'core.php');
	$userinf = & CFactory::getActiveProfile();
	echo $userinf->getInfo("FIELD_ABOUTME");
	?>
	</div>
	<div class="left-box">
		<h3><?php echo JText::_('COM_COMMUNITY_ISSUER_INFORMATION'); ?></h3>
	<?php
	$io=0;
	foreach($profileArray["Issuer Information"] as $itemi) { ?>
			<div class="c-<?php echo $io ?>">
				<span class="label-t"><?php echo $itemi["name"]; ?>:</span>
				<span class="value-f"><?php echo $itemi["value"]; ?></span>
			</div>
	<?php $io=1-$io;}?>
	</div>
	<div class="right-box">
		<h3><?php echo JText::_('COM_COMMUNITY_CONTACT_INFORMATION'); ?></h3>
		<?php
		$io=0;
		foreach($profileArray["Contact Information"] as $itemi) { ?>
			<div class="c-<?php echo $io ?>">
				<span class="label-t"><?php echo $itemi["name"]; ?>:</span>
				<span class="value-f"><?php echo $itemi["value"]; ?></span>
			</div>
		<?php $io=1-$io;}?>
		<?php
		$website = $profileArray['Personal Details'][2]['value'];
		if($website != ''){
			?>
			<div class="c-<?php echo $io ?>">
				<span class="label-t">Website:</span>
				<span class="value-f"><a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a></span>
			</div>
		<?php
		}
		$newsletter = $profileArray['Personal Details'][3]['value'];
		if($newsletter != ''){
			?>
			<div class="c-<?php echo $io ?>">
				<span class="label-t">Newsletter:</span>
				<span class="value-f"><a href="<?php echo $newsletter; ?>" target="_blank"><?php echo $newsletter; ?></a></span>
			</div>
		<?php
		}
		?>
	</div><br />
	
</div>

<div id="CP_DIV_2" style="display:none">
<?php
$uid = JRequest::getVar('userid');
$res = JFactory::getUser($uid);
$symbol = $res->username;

$options = array(
		 CURLOPT_RETURNTRANSFER => true, // return web page
		 CURLOPT_HEADER         => false,// don't return headers
		 CURLOPT_CONNECTTIMEOUT => 5     // timeout on connect
	 );
$ch = curl_init( "http://data.equities.com/dev/api/call.php?method=get_ratios&symbol={$symbol}" );
curl_setopt_array( $ch, $options );
$result = curl_exec( $ch ); //let's fetch the result using cURL
$resultnews=json_decode($result, true);	
?>

<?php
$i = 10;
$titleArr = array(
	'incomestatements'=>'Income Statements',
	'financialstrength'=>'Financial Strength (LTM)',
	'managementeffectiveness'=>'Management Effectiveness',
	'valuationmeasures'=>'Valuation Measures',
	
	'dividendssplits'=>'Dividends & Splits',
	'profitability'=>'Profitability (LTM)',
	'assets'=>'Assets'
);

$labelArr = array(
	'revenue' => 'Revenue (LTM) ($):',
	'revenuepershare' => 'Revenue per Share (LTM) ($):',
	'revenue3years' => 'Revenue Growth 3 Yr:',
	'revenue5years' => 'Revenue Growth 5 Yr:',
	
	'quickratio' => 'Quick Ratio:',
	'currentratio' => 'Current Ratio:',
	'longtermdebttocapital' => 'Long Term Debt to Total Capital:',
	'totaldebttoequity' => 'Total Debt to Equity:',
	'intcoverage' => 'Interest Coverage:',
	'leverageratio' => 'Leverage Ratio:',
	
	'returnonequity' => 'Return on Equity',
	'returnoncapital' => 'Return on Capital',
	'returnonassets' => 'Return on Assets',
	
	'peratio' => 'P/E Ratio:',
	'pehighlast5years' => 'P/E High - Last 5 Years:',
	'pelowlast5years' => 'P/E Low - Last 5 Years:',
	'pricetosales' => 'Price to Sales:',
	'pricetobook' => 'Price to Book:',
	'pricetotangiblebook' => 'Price to Tangible Book:',
	'pricetocashflow' => 'Price to Cash Flow:',
	'pricetofreecash' => 'Price to Free Cash:',
	
	'dividendrate' => 'Annual Dividend Rate ($):',
	'dividendyield' => 'Annual Dividend Yield:',
	'dividend3years' => 'Dividend Growth 3 Yr:',
	'dividend5years' => 'Dividend Growth 5 Yr:',
	'paymenttype' => 'Payment Type:',
	'exdividenddate' => 'Ex-Dividend Date:',
	
	'grossmargin' => 'Gross Margin:',
	'ebitmargin' => 'EBIT Margin:',
	'ebitdamargin' => 'EBITDA Margin:',
	'pretaxprofitmargin' => 'Pre-Tax Profit Margin:',
	'profitmargincont' => 'Profit Margin (Cont. Op):',
	'profitmargintot' => 'Profit Margin (Total Op):',
	
	'assetsturnover' => 'Asset Turnover:',
	'invoiceturnover' => 'Inventory Turnover:',
	'receivablesturnover' => 'Receivable Turnover:',

);

foreach ( $resultnews['data'] as $title => $val  ){
	$class = $i++>4?'left-box':'right-box';
	?>
	<div class="<?php echo $class;?>">
	<h3><?php echo $titleArr[$title]; ?></h3>
	<?php
	$j = 1;
	foreach ($val as $k => $v){
		$j = $j == 0?1:0;
	?>
	<div class="c-<?php echo $j; ?>">
		<span class="label-t" style="width:45%;"><?php echo $labelArr[$k]; ?></span>
		<span class="value-f" style="width:45%;"><?php echo $v; ?></span>
	</div>
	<?php
	}
	?>
	</div>
	<?php
}
?>
</div>
<script type="text/javascript">
 function showHideCPTab(id)
 {
   if(id == "CP_tabs-1"){
   //className
     document.getElementById("CP_tabs-1").className = "active_tab_news";
	 document.getElementById("CP_tabs-2").className = "";
     document.getElementById("CP_DIV_1").style.display = "block";
	 document.getElementById("CP_DIV_2").style.display = "none";
   }
   
   if(id=="CP_tabs-2"){
   document.getElementById("CP_tabs-1").className = "";
	 document.getElementById("CP_tabs-2").className = "active_tab_news";
     document.getElementById("CP_DIV_2").style.display = "block";
	 document.getElementById("CP_DIV_1").style.display = "none";
   }
   
 }
 
/*$(document).ready(function() {
alert("fgdfg");
// Handler for .ready() called.
});*/
</script>
<?php
//file_put_contents($cfile,preg_replace('(\r|\n|\t|<\!--.*-->)','',ob_get_contents()));
//ob_end_clean();
//echo file_get_contents($cfile);