<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>DJsAttic.com: Register Account</title>
<?php
require_once '../../inc/enduseragreement.inc';
require_once '../../includes/mySQL_Sessions.inc';
require_once "../includes/home_dim.inc";

$theme['r'] = 200;
$theme['g'] = 200;
$theme['b'] = 237;
$ThemeColor = dechex($theme['r']).dechex($theme['g']).dechex($theme['b']);
$key = dechex(mktime());

session_start();	if (empty($_SESSION['state']))	{ header("Location: http://www.djsattic.com/"); exit; }
$sess_id = session_id();



$type[$_SESSION['type']] = 'checked=checked';
$state[$_SESSION['state']] = 'selected=selected';
$country[$_SESSION['country']] = 'selected=selected';
$agreement[$_SESSION['agreement']] = 'checked=checked';

$val['first'] = $_SESSION['first'];
$val['last'] = $_SESSION['last'];
$val['city'] = $_SESSION['city'];
$val['zip'] = $_SESSION['zip'];

$val['email1'] = $_SESSION['email1'];
$val['email2'] = $_SESSION['email2'];
$val['pswd1'] = $_SESSION['pswd1'];
$val['pswd2'] = $_SESSION['pswd2'];

$label['email'] = $_SESSION['email_lbl'];
$label['pswd'] = $_SESSION['pswd_lbl'];
$label['first'] = $_SESSION['first_lbl'];
$label['last'] = $_SESSION['last_lbl'];
$label['zip'] = $_SESSION['zip_lbl'];
$label['captcha'] = $_SESSION['captcha_lbl'];
$label['agree'] = $_SESSION['agree_lbl'];

$width['lbl'] = 76;
$offset['lbl'] = 3;

$buffer['lgn'] = 37;
$top['em1'] = -35;
$top['em2'] = $top['em1'] + $buffer['lgn'];
$top['ps1'] = $top['em2'] + $buffer['lgn'];
$top['ps2'] = $top['ps1'] + $buffer['lgn'];
$left['lgn'] = -130;
$width['lgn'] = 110;

$buffer['pers'] = 22;
$top['first'] = -35;
$top['last'] = $top['first'] + $buffer['pers'];
$top['zip'] = $top['last'] + $buffer['pers'];
$left['pers'] = 70;
$width['pers'] = 110;

$buffer['pers_opt'] = 22;
$top['city'] = $top['zip'] + $buffer['pers'];;
$top['state'] = $top['city'] + $buffer['pers_opt'];
$top['country'] = $top['state'] + $buffer['pers_opt'];
$left['pers_opt'] = 70;
$width['pers_opt'] = 110;

$top['agr'] = 110;
$width['agr'] = 360;
$left['agr'] = 80-($width['agr']/2);
$height['agr'] = 60;
$top['agr_box'] = $top['agr']+$height['agr']+10;
$width['agr_box'] = $width['agr']-20;

$width['cpt_img'] = 180;
$top['cpt_img'] = 210;
$left['cpt_img'] = $left['agr']+$width['agr']-$width['cpt_img']-10;
$top['cpt_lbl'] = $top['cpt_img']+5;
$left['cpt_lbl'] = $left['agr']+10;
$width['cpt_lbl'] = $width['agr']-$width['cpt_img']-10;
$top['cpt_inp'] = $top['cpt_img']+20;
$left['cpt_inp'] = $left['cpt_img']-70;

$top['sbmt'] = 265;

echo 	"<style type=\"text/css\">"

		." form, div, legend, textarea, input, select {"
		.	"position:absolute;"
		.	"font-size:11px;"
		.	"font-family:tahoma,sans-serif;"
		.	"color: #000000;"
		."}"
		
		." input.lgn {"
		.	"left:".($left['lgn']+5+$width['lbl'])."px;"
		.	"width:{$width['lgn']}px;"
		."}"
		
		." input.pers, select.pers {"
		.	"left:".($left['pers']+5+$width['lbl'])."px;"
		.	"width:{$width['pers']}px;"
		."}"
		
		." input.persopt, select.persopt {"
		.	"left:".($left['pers_opt']+5+$width['lbl'])."px;"
		.	"width:{$width['pers_opt']}px;"
		."}"
		
		." input.agr {"
		.	"top:".($top['agr_box']-3)."px;"
		.	"cursor:pointer;"
		."}"
		
		." label.agr {"
		.	"position:absolute;"
		.	"top:{$top['agr_box']}px;"
		.	"font-weight:bold;"
		."}"
		
		." input.submit {"
		.	"top:{$top['sbmt']}px;"
		.	"cursor:pointer;"
		."}"
		
		
		." div.opt, div.req {"
		.	"font-size:10px;"
		.	"text-align:right;"
		.	"width:{$width['lbl']}px;"
		."}"

		." div.req {"
		.	"font-weight:bold;"
		."}"
		
		."</style>"
		
		."\n<script type=\"text/javascript\"> function RegValid() { "
		." var email1 = document.getElementById('email1').value;"
		." var email2 = document.getElementById('email2').value;"
		." var pswd1 = document.getElementById('pswd1').value;"
		." var pswd2 = document.getElementById('pswd2').value;"
		." var first = document.getElementById('first').value;"
		." var last = document.getElementById('last').value;"
		." var zip = document.getElementById('zip').value;"
		." var state = document.getElementById('state').value;"
		." var country = document.getElementById('country').value;"
//		." var agree = document.getElementById('agree_no').selected;"
		." var captcha = document.getElementById('captcha').value;"
		
		." if (((email1 != null) || (email1 != '')) && (email2 != '') && (email1 != email2))"	
		." { alert('The submitted email address values must be identical, and must represent a valid email address.'); return(false); }"

		." if ((((pswd1 != null) || (pswd1 != '')) && (pswd2 != '') && (pswd1 != pswd2)) || ((pswd1.length < 5) || (pswd2.length < 5)))"
		." { alert('The submitted password values must be identical, and must be at least 5 characters in length.'); return(false); }"
		
		." else if ((pswd1.length > 20) || (pswd2.length > 20))"
		." { alert('Your password value may not be greater than 20 characters in length.'); return(false); }"		

//		." if (agree)"
//		." { alert('You must agree to the End User Agreement.'); return(false); }"
			
		." if (captcha.length != 5)"
		." { alert('Please copy the graphical letters shown on the right into the text box on the left as best you can."
		.				" If they are copied incorrectly, the image will be redrawn for you.'); return(false); }"
		
		." document.getElementById('sub_bttn').style.visibility='hidden';"
		." document.getElementById('can_bttn').style.visibility='hidden';"
		." document.getElementById('sub_msg').style.visibility='visible';"
		." document.getElementById('reg_form').submit();"
		." return(true);"
		." } </script>"		
		
		."</head>"
		."<body>"
		;

echo	$img['tran'] . $div
		
		."<div style=\"top:-65px;left:-150px;font:12px arial;width:470px;text-align:center;\">Please enter the requested information below.<br /><b>BOLD</b> fields must be completed.</div>"
		."<form id=\"reg_form\" method=\"post\" enctype=\"multipart/form-data\""
		.	" action=\"reg_presub.php?sess={$sess_id}\"><fieldset style=\"border:none;\">"
		
	."\n"."<input type=\"hidden\" name=\"type\" value=\"lis\" />"
	
	."\n"."<div class=\"req\" style=\"color:#{$label['email']}0000;top:".($top['em1']+$offset['lbl'])."px;left:{$left['lgn']}px;\">"
		.	"Email:</div>"
	."\n"."<input class=\"lgn\" id=\"email1\" style=\"top:{$top['em1']}px;\""
		.	" type=\"text\" name=\"email1\" maxlength=\"50\" value=\"{$val['email1']}\" />"
	
	."\n"."<div class=\"req\" style=\"color:#{$label['email']}0000;top:".($top['em2']+$offset['lbl'])."px;left:{$left['lgn']}px;\">"
		.	"Confirm Email:</div>"
	."\n"."<input class=\"lgn\" id=\"email2\" style=\"top:{$top['em2']}px;\""
		.	" type=\"text\" name=\"email2\" maxlength=\"50\" value=\"{$val['email2']}\" />"
	
	."\n"."<div class=\"req\" style=\"color:#{$label['pswd']}0000;top:".($top['ps1']+$offset['lbl'])."px;left:{$left['lgn']}px;\">"
		.	"Password:</div>"
	."\n"."<input class=\"lgn\" id=\"pswd1\" style=\"top:{$top['ps1']}px;\""
		.	" type=\"password\" name=\"pswd1\" maxlength=\"20\" value=\"{$val['pswd1']}\" />"
	
	."\n"."<div class=\"req\" style=\"color:#{$label['pswd']}0000;top:".($top['ps2']+$offset['lbl'])."px;left:{$left['lgn']}px;\">"
		.	"Confirm Pswd:</div>"
	."\n"."<input class=\"lgn\" id=\"pswd2\" style=\"top:{$top['ps2']}px;\""
		.	" type=\"password\" name=\"pswd2\" maxlength=\"20\" value=\"{$val['pswd2']}\" />"
		
	."\n"."<div class=\"req\" style=\"color:#{$label['first']}0000;top:".($top['first']+$offset['lbl'])."px;left:{$left['pers']}px;\">"
		.	"First Name:</div>"
	."\n"."<input class=\"pers\" id=\"first\" type=\"text\" name=\"first\" maxlength=\"100\" value=\"{$val['first']}\""
		.	"style=\"top:{$top['first']}px;\" />"

	."\n"."<div class=\"req\" style=\"color:#{$label['last']}0000;top:".($top['last']+$offset['lbl'])."px;left:{$left['pers']}px;\">"
		.	"Last Name:</div>"
	."\n"."<input class=\"pers\" id=\"last\" type=\"text\" name=\"last\" maxlength=\"100\" value=\"{$val['last']}\""
		.	"style=\"top:{$top['last']}px;\" />"
		
	."\n"."<div class=\"req\" style=\"color:#{$label['zip']}0000;top:".($top['zip']+$offset['lbl'])."px;left:{$left['pers']}px;\">"
		.	"Zip Code:</div>"
	."\n"."<input class=\"pers\" id=\"zip\" type=\"text\" name=\"zip\" maxlength=\"10\" value=\"{$val['zip']}\""
		.	"style=\"top:{$top['zip']}px;\" />"
	
	."\n"."<div class=\"opt\" style=\"top:".($top['city']+$offset['lbl'])."px;left:{$left['pers_opt']}px;\">"
		.	"City:</div>"
	."\n"."<input class=\"persopt\" id=\"city\" type=\"text\" name=\"city\" maxlength=\"100\" value=\"{$val['city']}\""
		.	" style=\"top:{$top['city']}px;\" />"
	
	."\n"."<div class=\"opt\" style=\"top:".($top['state']+$offset['lbl'])."px;left:{$left['pers_opt']}px;\">"
		.	"State:</div>"
	."\n"."<select class=\"persopt\" id=\"state\" name=\"state\""
		.	"style=\"top:{$top['state']}px;\" onChange=\"document.getElementById('country').selectedIndex=2;\">"
		.	"<option value=\"none\" {$state['none']}>State/Province</option>"
		.	"<option value=\"none\">---------------</option>"
		.	"<option value=\"AL\" {$state['AL']}>AL - Alabama</option>"
		.	"<option value=\"AK\" {$state['AK']}>AK - Alaska</option>"
		.	"<option value=\"AZ\" {$state['AZ']}>AZ - Arizona</option>"
		.	"<option value=\"AR\" {$state['AR']}>AR - Arkansas</option>"
		.	"<option value=\"CA\" {$state['CA']}>CA - California</option>"
		.	"<option value=\"CO\" {$state['CO']}>CO - Colorado</option>"
		.	"<option value=\"CT\" {$state['CT']}>CT - Connecticut</option>"
		.	"<option value=\"DE\" {$state['DE']}>DE - Delaware</option>"
		.	"<option value=\"DC\" {$state['DC']}>DC - District of Columbia</option>"
		.	"<option value=\"FL\" {$state['FL']}>FL - Florida</option>"
		.	"<option value=\"GA\" {$state['GA']}>GA - Georgia</option>"
		.	"<option value=\"HI\" {$state['HI']}>HI - Hawaii</option>"
		.	"<option value=\"ID\" {$state['ID']}>ID - Idaho</option>"
		.	"<option value=\"IL\" {$state['IL']}>IL - Illinois</option>"
		.	"<option value=\"IN\" {$state['IN']}>IN - Indiana</option>"
		.	"<option value=\"IA\" {$state['IA']}>IA - Iowa</option>"
		.	"<option value=\"KS\" {$state['KS']}>KS - Kansas</option>"
		.	"<option value=\"KY\" {$state['KY']}>KY - Kentucky</option>"
		.	"<option value=\"LA\" {$state['LA']}>LA - Louisiana</option>"
		.	"<option value=\"ME\" {$state['ME']}>ME - Maine</option>"
		.	"<option value=\"MD\" {$state['MD']}>MD - Maryland</option>"
		.	"<option value=\"MA\" {$state['MA']}>MA - Massachusetts</option>"
		.	"<option value=\"MI\" {$state['MI']}>MI - Michigan</option>"
		.	"<option value=\"MN\" {$state['MN']}>MN - Minnesota</option>"
		.	"<option value=\"MS\" {$state['MS']}>MS - Mississippi</option>"
		.	"<option value=\"MO\" {$state['MO']}>MO - Missouri</option>"
		.	"<option value=\"MT\" {$state['MT']}>MT - Montana</option>"
		.	"<option value=\"NE\" {$state['NE']}>NE - Nebraska</option>"
		.	"<option value=\"NV\" {$state['NV']}>NV - Nevada</option>"
		.	"<option value=\"NH\" {$state['NH']}>NH - New Hampshire</option>"
		.	"<option value=\"NJ\" {$state['NJ']}>NJ - New Jersey</option>"
		.	"<option value=\"NM\" {$state['NM']}>NM - New Mexico</option>"
		.	"<option value=\"NY\" {$state['NY']}>NY - New York</option>"
		.	"<option value=\"NC\" {$state['NC']}>NC - North Carolina</option>"
		.	"<option value=\"ND\" {$state['ND']}>ND - North Dakota</option>"
		.	"<option value=\"OH\" {$state['OH']}>OH - Ohio</option>"
		.	"<option value=\"OK\" {$state['OK']}>OK - Oklahoma</option>"
		.	"<option value=\"OR\" {$state['OR']}>OR - Oregon</option>"
		.	"<option value=\"PA\" {$state['PA']}>PA - Pennsylvania</option>"
		.	"<option value=\"RI\" {$state['RI']}>RI - Rhode Island</option>"
		.	"<option value=\"SC\" {$state['SC']}>SC - South Carolina</option>"
		.	"<option value=\"SD\" {$state['SD']}>SD - South Dakota</option>"
		.	"<option value=\"TN\" {$state['TN']}>TN - Tennessee</option>"
		.	"<option value=\"TX\" {$state['TX']}>TX - Texas</option>"
		.	"<option value=\"UT\" {$state['UT']}>UT - Utah</option>"
		.	"<option value=\"VT\" {$state['VT']}>VT - Vermont</option>"
		.	"<option value=\"VA\" {$state['VA']}>VA - Virginia</option>"
		.	"<option value=\"WA\" {$state['WA']}>WA - Washington</option>"
		.	"<option value=\"WV\" {$state['WV']}>WV - West Virginia</option>"
		.	"<option value=\"WI\" {$state['WI']}>WI - Wisconsin</option>"
		.	"<option value=\"WY\" {$state['WY']}>WY - Wyoming</option>"
		.	"<option value=\"none\">---------------</option>"
		.	"<option value=\"AB\" {$state['AB']}>AB - Alberta</option>"
		.	"<option value=\"BC\" {$state['BC']}>BC - British Columbia</option>"
		.	"<option value=\"MB\" {$state['MB']}>MB - Manitoba</option>"
		.	"<option value=\"NB\" {$state['NB']}>NB - New Brunswick</option>"
		.	"<option value=\"NF\" {$state['NF']}>NF - Newfoundland</option>"
		.	"<option value=\"NT\" {$state['NT']}>NT - Northwest Territories</option>"
		.	"<option value=\"NS\" {$state['NS']}>NS - Nova Scotia</option>"
		.	"<option value=\"NU\" {$state['NU']}>NU - Nunavut</option>"
		.	"<option value=\"ON\" {$state['ON']}>ON - Ontario</option>"
		.	"<option value=\"PE\" {$state['PE']}>PE - Prince Edward Island</option>"
		.	"<option value=\"QC\" {$state['QC']}>QC - Quebec</option>"
		.	"<option value=\"SK\" {$state['SK']}>SK - Saskatchewan</option>"
		.	"<option value=\"YT\" {$state['YT']}>YT - Yukon</option>"
		.	"<option value=\"none\">---------------</option>"
		.	"<option value=\"AS\" {$state['AS']}>AS - American Samoa</option>"
		.	"<option value=\"FM\" {$state['FM']}>FM - Federated States of Micronesia</option>"
		.	"<option value=\"GU\" {$state['GU']}>GU - Guam</option>"
		.	"<option value=\"MH\" {$state['MH']}>MH - Marshall Islands</option>"
		.	"<option value=\"MP\" {$state['MP']}>MP - Northern Mariana Islands</option>"
		.	"<option value=\"PW\" {$state['PW']}>PW - Palau</option>"
		.	"<option value=\"PR\" {$state['PR']}>PR - Puerto Rico</option>"
		.	"<option value=\"VI\" {$state['VI']}>VI - Virgin Islands</option>"	
		.	"<option value=\"none\">---------------</option>"
		.	"<option value=\"XX\" {$state['XX']}>XX - Other State/Province/Territory</option>"
		."</select>"
	
	."\n"."<div class=\"opt\" style=\"top:".($top['country']+$offset['lbl'])."px;left:{$left['pers_opt']}px;\">"
		.	"Country:</div>"
	."\n"."<select class=\"persopt\" id=\"country\" name=\"country\" id=\"country\""
		.	"style=\"top:{$top['country']}px;\">"
		.	"<option value=\"none\" {$country['none']}>Country</option>"
		.	"<option value=\"none\">---------------</option>"
		.	"<option value=\"USA\" {$country['USA']}>United States</option>"
		.	"<option value=\"Canada\" {$country['Canada']}>Canada</option>"
		."</select>"
		
	."\n"."<div class=\"req\" style=\"color:#{$label['agree']}0000;"
		."top:".($top['agr_box']-1)."px;left:{$left['agr']}px;width:140px;font-size:12px;text-align:left;\">"
		.	"End User Agreement:</div>"
		
	."\n"."<input class=\"agr\" type=\"radio\" name=\"agreement\" id=\"agree_yes\" value=\"yes\" {$agreement['yes']} style=\""
			."left:".($left['agr']+150)."px;\" />"
	."\n"."<label for=\"agree_yes\" class=\"agr\" style=\"left:".($left['agr']+175)."px;width:50px;\">I Agree</label>"

	."\n"."<input class=\"agr\" type=\"radio\" name=\"agreement\" id=\"agree_no\" value=\"no\" {$agreement['no']} style=\""
			."left:".($left['agr']+225)."px;\" />"
	."\n"."<label for=\"agree_no\" class=\"agr\" style=\"left:".($left['agr']+250)."px;width:100px;\">I Do Not Agree</label>"	
	
	."\n"."<textarea wrap=\"soft\" readonly style=\""
		.	"top:{$top['agr']}px;left:{$left['agr']}px;width:{$width['agr']}px;height:{$height['agr']}px;font-size:10px;"
		."\">{$AgreementText}\n</textarea>"
		;
		
		$AgreementText = "";

$wdth['submit'] = 170;
$wdth['cancel'] = 130;

echo "\n"."<img src=\"captcha.php?sess={$sess_id}&w={$width['cpt_img']}&key={$key}\" "
		."style=\"position:absolute;top:{$top['cpt_img']}px;left:{$left['cpt_img']}px;border:solid 1px;\" />"
	."\n"."<div class=\"req\" style=\"color:#{$label['captcha']}0000;"
		."top:{$top['cpt_lbl']}px;left:{$left['cpt_lbl']}px;width:{$width['cpt_lbl']}px;text-align:left;\">"
		.	"Please copy the letters shown<br />\ton the right:</div>"
	."\n"."<input class=\"lgn\" id=\"captcha\" style=\"top:{$top['cpt_inp']}px;left:{$left['cpt_inp']}px;width:55px;\""
		.	" type=\"text\" name=\"captcha\" maxlength=\"5\" value=\"\" />"	

	."\n"."<input id=\"sub_bttn\" type=\"button\" class=\"submit\" value=\"Submit Registration\" style=\""
		.	"font-weight:bold;width:{$wdth['submit']}px;left:".(85-($wdth['submit']/2))."px;\""
		.	" onClick=\""
		.		"RegValid();"
//		.		"document.getElementById('sub_bttn').style.visibility='hidden';"
//		.		"document.getElementById('can_bttn').style.visibility='hidden';"
//		.		"document.getElementById('sub_msg').style.visibility='visible';"
//		.		"document.getElementById('reg_form').submit();"
		."\" />"

		."</fieldset></form>"
		
	."\n"."<input id=\"can_bttn\" type=\"button\" class=\"submit\" value=\"Cancel Registration\" style=\""
		.	"top:".($top['sbmt']+28)."px;color:#444444;width:{$wdth['cancel']}px;left:".(85-($wdth['cancel']/2))."px;\""
		.	"onClick=\"location='reg_cncl.php?sess={$sess_id}';\" />"
		
		."<div id=\"sub_msg\" style=\"text-align:center;font:bold 12px arial;width:".($wdth['submit']+50)."px;left:".(85-(($wdth['submit']+50)/2))."px;top:{$top['sbmt']}px;visibility:hidden;\">"
		."Your registration information has been submitted. In a moment, you will be automatically logged in for the first time."
		."</div>"
		
		."</div>"
		."</div>"
		;
?>

</body>

</html>