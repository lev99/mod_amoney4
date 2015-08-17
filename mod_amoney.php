<?php
/**
* @version 3.0
* @package AMoney
* @copyright (C) 2008 Adeptus
* @Email: adeptus@adeptsite.info
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
defined( '_VALID_MOS' ) or die( 'ƒоступ запрещен.' );
global $mosConfig_live_site;
// ќбщие настройки
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
$pretext = $params->get('pretext', '');
$btntxt = $params->get('btntxt', 'ќтправить');
// Webmoney
$use_wm = $params->get('use_wm', 1);
$wmz = $params->get('wmz','Z336955269328');
$wme = $params->get('wme','E103233136042');
$wmr = $params->get('wmr','R270500581273');
$wmu = $params->get('wmu','U182150656389');
$wm_summ = $params->get('wm_summ', '10');
$wm_successurl = $params->get('wm_successurl', $mosConfig_live_site);
$wm_errorurl = $params->get('wm_errorurl', $mosConfig_live_site);
$wm_descpay = $params->get('wm_descpay','Ѕлагодарность јвтору');
// яндекс
$use_yandex = $params->get('use_yandex', 1);
$yandex = $params->get('yandex','41001113417267');
$yandex_summ = $params->get('yandex_summ','50');
$yandex_successurl = $params->get('yandex_successurl', $mosConfig_live_site);
// PayPal
$use_paypal = $params->get('use_paypal', 1);
$donate_email = $params->get('paypal_email','alex1962@donpac.ru');
$paypalcur_on = $params->get('paypalcur_on');
$paypalcur_val = $params->get('paypalcur_val');
$paypalval_on = $params->get('paypalval_on');
$paypalval_val = $params->get('paypalval_val');
$paypalvalleast_val = $params->get('paypalvalleast_val');
$donate_org = $params->get('donate_org','Donate Author');
$donate_len = $params->get('donate_len');
$paypallen_val = $params->get('paypallen_val');
$link_cancel = $params->get('link_cancel',$mosConfig_live_site);
$link_return = $params->get('link_return',$mosConfig_live_site);
//////////////////////////////////////////////////////////////////////////////
if ($wmz != '') {
    $wmtype1 = 'WMZ';
    $wmnum1 = $wmz;
}
if ($wme != '') {
    $wmtype2 = 'WME';
    $wmnum2 = $wme;
}
if ($wmr != '') {
    $wmtype3 = 'WMR';
    $wmnum3 = $wmr;
	 }
if ($wmu != '') {
    $wmtype4 = 'WMU';
    $wmnum4 = $wmu;
	 }
$logowm = $mosConfig_live_site.'/modules/mod_amoney/logowm.gif';
$logoyandex = $mosConfig_live_site.'/modules/mod_amoney/logoyandex.gif';
$logopaypal = $mosConfig_live_site.'/modules/mod_amoney/logopaypal.gif';
$logowm_sm = $mosConfig_live_site.'/modules/mod_amoney/logowm_small.gif';
$logoyandex_sm = $mosConfig_live_site.'/modules/mod_amoney/logoyandex_small.gif';
$logopaypal_sm = $mosConfig_live_site.'/modules/mod_amoney/logopaypal_small.gif';
?>
<style type="text/css">
#wm, #yandex, #paypal {
	width:97%;
	padding:3px;
	margin:3px;
	border:1px solid #CCC;
}
#rules {
	width:100%;
}
#wm, #yandex, #paypal {
	height:150px;
	height:150px !important;
}
#poweredby {
	text-align:center;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:9px;
	margin:3px;
}
.money {
	padding:2px;
	border:1px solid #CCC;
	margin:1px;
}
</style>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/modules/mod_amoney/jquery.js"></script>
<script type="text/javascript">
	function show_wm()
	{
		var $j = jQuery.noConflict();
		$j('#yandex').hide();
		$j('#paypal').hide();
		$j('#wm').fadeIn(1500);
		return false;
	};
	function show_yandex()
	{
		var $j = jQuery.noConflict();
		$j('#wm').hide();
		$j('#paypal').hide();
		$j('#yandex').fadeIn(1500);
		return false;
	};
	function show_paypal()
	{
		var $j = jQuery.noConflict();
		$j('#wm').hide();
		$j('#yandex').hide();
		$j('#paypal').fadeIn(1500);
		return false;
	};
	function hide_all()
	{
		var $j = jQuery.noConflict();
		$j('#wm').hide();
		$j('#yandex').hide();
		$j('#paypal').hide();
		return false;
	}
</script>
<!--------------------------- «аголовок - ѕанель управлени¤ --------------------------->
<div id="rulez" align="center">
	<?php
	if ($pretext != '')
	{?>
		<span style="font-weight:bold; cursor:pointer; border-bottom:1px solid #CCC; padding:3px;" onclick="hide_all()" title="—крыть все">
			<?php echo $pretext;?>
		</span><br/><br/>
	<?php
	}?>
	<?php
	if ($use_wm)
	{?>
		<a href="javascript:void(0);" onclick="show_wm()" title="Webmoney">
			<img src="<?php echo $logowm_sm;?>" alt="Webmoney" border="0" />
		</a>
	<?php
	}?>
	<?php
	if ($use_yandex)
	{?>
		<a href="javascript:void(0);" onclick="show_yandex()" title="Yandex">
			<img src="<?php echo $logoyandex_sm;?>" alt="Yandex" border="0" />
		</a>
	<?php
	}?>
	<?php
	if ($use_paypal)
	{?>
		<a href="javascript:void(0);" onclick="show_paypal()" title="PayPal">
			<img src="<?php echo $logopaypal_sm;?>" alt="PayPal" border="0" />
		</a>
	<?php
	}?>
</div>
<!--------------------------- Webmoney --------------------------->
<div id="wm" align="center" style="display:none;">
	<form id="pay" name="pay" method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp">
		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="100%" align="center">
					<img src="<?php echo $logowm;?>" alt="" title="" border="0" />
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					¬алюта и сумма:
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<input name="LMI_PAYMENT_AMOUNT" type="text" size="3" value="<?php echo $wm_summ;?>">
					<input type="hidden" name="LMI_PAYMENT_DESC" value="<?php echo $wm_descpay;?>">
					<input type="hidden" name="LMI_PAYMENT_NO" value="1">
					<input type="hidden" name="LMI_SIM_MODE" value="0">
					<input type="hidden" name="LMI_SUCCESS_URL" value="<?php echo $wm_successurl;?>">
					<input type="hidden" name="LMI_SUCCESS_METHOD" value="2">
					<input type="hidden" name="LMI_FAIL_URL" value="<?php echo $wm_errorurl;?>">
					<input type="hidden" name="LMI_FAIL_METHOD" value="2">
					<select name="LMI_PAYEE_PURSE" style="min-width:30px;">
						<option value="<?php echo $wmnum1;?>"><?php echo $wmtype1;?></option>
						<option value="<?php echo $wmnum2;?>"><?php echo $wmtype2;?></option>
						<option value="<?php echo $wmnum3;?>"><?php echo $wmtype3;?></option>
        		        <option value="<?php echo $wmnum4;?>"><?php echo $wmtype4;?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<br/>
					<input type="submit" class="button" value="<?php echo $btntxt;?>">
				</td>
			</tr>
		</table>
	</form>
</div>
<!--------------------------- Yandex --------------------------->
<div id="yandex" align="center" style="display:none;">
	<form id="yandex_pay" name="yandex_pay" method="POST" action="https://money.yandex.ru/charity.xml">
		<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="100%" align="center">
					<img src="<?php echo $logoyandex;?>" alt="" title="" border="0" />
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					—умма: &nbsp;
					<input type="text" id="CompanySum" name="CompanySum" value="<?php echo $yandex_summ;?>" size="8" />&nbsp;руб.
					<input type="hidden" name="to" value="<?php echo $yandex;?>"/>
					<input type="hidden" name="CompanyName" value="<?php echo $wm_descpay;?> "/>
					<input type="hidden" name="CompanyLink" value="<?php echo $yandex_successurl;?>"/>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					—чет <?php echo $yandex;?>
				</td>
			</tr>
			<tr>
				<td width="100%" align="center">
					<br/>
					<input type="submit" class="button" value="<?php echo $btntxt;?>">
				</td>
			</tr>
		</table>
	</form>
</div>
<!--------------------------- PayPal --------------------------->
<div id="paypal" align="center" style="display:none;">
<?php
$length = isset( $_POST[ 'paypallength' ] ) ? (int) $_POST[ 'paypallength' ] : "";
$amount = isset( $_POST[ 'paypalamount' ] ) ? trim( $_POST[ 'paypalamount' ] ) : "";
$amount = str_replace( ',', '.', $amount );
if( 1 <= $length && $length <= 3 )
{
  $amount = (int) round( $amount, 0 );
}
if( $amount < $paypalvalleast_val )
{
  $amount = $paypalvalleast_val;
}
$currency_code = isset( $_POST[ 'paypalcurrency_code' ] ) ? trim( $_POST[ 'paypalcurrency_code' ] ) : 0;
if ($length == 4) {
  header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=".$donate_email."&item_name=".$donate_org."&amount=".$amount."&no_shipping=0&no_note=1&tax=0&currency_code=".$currency_code."&bn=PP%2dDonationsBF&charset=UTF%2d8&return=".$link_return."&cancel=".$link_cancel);
}
else if ($length == 1) {
  header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick-subscriptions&business=".$donate_email."&item_name=".$donate_org."&no_shipping=1&no_note=1&currency_code=".$currency_code."&bn=PP%2dSubscriptionsBF&charset=UTF%2d8&a3=".$amount."%2e00&p3=1&t3=W&src=1&sra=1&return=".$link_return."&cancel=".$link_cancel);
}
elseif ($length == 2) {
  header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick-subscriptions&business=".$donate_email."&item_name=".$donate_org."&no_shipping=1&no_note=1&currency_code=".$currency_code."&bn=PP%2dSubscriptionsBF&charset=UTF%2d8&a3=".$amount."%2e00&p3=1&t3=M&src=1&sra=1&return=".$link_return."&cancel=".$link_cancel);
}
elseif ($length == 3) {
  header("Location: https://www.paypal.com/cgi-bin/webscr?cmd=_xclick-subscriptions&business=".$donate_email."&item_name=".$donate_org."&no_shipping=1&no_note=1&currency_code=".$currency_code."&bn=PP%2dSubscriptionsBF&charset=UTF%2d8&a3=".$amount."%2e00&p3=1&t3=Y&src=1&sra=1&return=".$link_return."&cancel=".$link_cancel);
}
$currencies = array( 'USD' => '$ ', 'GBP' => '&pound; ', 'EUR' => '&euro; ' );
echo "<div id=\"paypal_logo\">";
echo "<img src=\"$logopaypal\" alt=\"PayPal\" />";
echo "</div>";
echo "<form action=\"".$_SERVER['REQUEST_URI']."\" method=\"post\">";
if ($paypalval_on == 0) {
  $javaScript = <<< JAVASCRIPT
<script type="text/javascript">
  function donateChangeCurrency( )
  {
    var selectionObj = document.getElementById( 'donate_currency_code' );
    var selection = selectionObj.value;
    var currencyObj = document.getElementById( 'donate_symbol_currency' );
    if( currencyObj )
    {
      var currencySymbols = { 'USD': '$ ', 'GBP': '&pound; ', 'EUR': 'И ' };
      var currencySymbol = currencySymbols[ selection ];
      currencyObj.innerHTML = currencySymbol;
    }
  }
</script>
JAVASCRIPT;
  $symbol = $currencies[ $paypalcur_val ];
  echo "$javaScript Enter Amount:<br/><span id=\"donate_symbol_currency\">".$symbol."</span><input type=\"text\" name=\"paypalamount\" size=\"3\" class=\"inputbox\">";
}
elseif ($paypalval_on == 1) {
  echo "<input type=\"hidden\" value=\"".$paypalval_val."\" name=\"paypalamount\">";
}
if ($paypalcur_on == 0) {
  print( "<select name=\"paypalcurrency_code\" id=\"donate_currency_code\" class=\"inputbox\" onchange=\"donateChangeCurrency();\">" );
  foreach( $currencies as $currency => $dummy )
  {
    $selected = ( $currency == $paypalcur_val ) ? " selected=\"selected\"" : "";
    print( "<option value=\"$currency\"$selected>$currency</option>\n" );
  }
  print( "</select>\n" );
}
elseif ($paypalcur_on == 1) {
  echo "<input type=\"hidden\" name=\"paypalcurrency_code\" value=\"".$paypalcur_val."\">";
}
if ($donate_len == 0) {
  ?>
  <select name="paypallength" class="inputbox">
    <option value="4">One Time</option>
    <option value="1">Weekly</option>
    <option value="2">Monthly</option>
    <option value="3">Annual</option>
  </select>
  <?
}
elseif ($donate_len == 1) {
  ?>
  <input type="hidden" name="paypallength" value="<? echo $paypallen_val; ?>" />
  <?
}
?>
<br/><br/>
<input type="submit" class="button" name="paypalsubmit" alt="Make payments with PayPal !" value="Donate Now" />
</form>
</div>
<div id="poweredby">
	Powered by <a href="http://www.adeptsite.info" title="Visit Author!" target="_blank">Adeptus Donate</a>
</div>
