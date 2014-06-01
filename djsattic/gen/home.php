<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>DJsAttic.com: music locker and jukebox</title>
<style>
div,input,img{
	position:absolute;
	overflow: visible;
}
input.lgn{
	font-family:arial;
	font-size:12px;
	background-color:#d6d6d6;
	color:#000000;
	width:144px;
	left:54px;
	border:solid 1px #bbbbbb;
}
div.lgnd{
	left:2px;
	width:40px;
	text-align:right;
	font-family:arial;
	font-size:12px;
}
input.sub, div.reg, div.what, div.faq, div.frm{
	cursor:pointer;
	font-family:arial;
	font-size:14px;
	font-weight:bold;
	text-align:center;
	background-color:#F4F4F4;
	color:black;
}
div.reg, div.what, div.faq, div.frm {width:134px;height:20px;padding-top:4px;}
input.sub{
	top:100px;
	left:70px;
	height:26px;
	width:65px;
	font-size:14px;
	border: none;
	background-color: #FFFFFF;
	z-index: 6;
}
div.reg{
	z-index: 3; left: 647px; top: 190px; width:206px; height:42px; background-color:transparent;border:none;
}
div.what{
	z-index:3;
	top:300px;
	left:390px;
	width:406px;
	height:200px;
	background-color:transparent;
	border:none;
}
div.frm{
	top:686px;
	left:92px;
}
div.faq{top:214px;left:4px;width:160px;}
a.footer {cursor:pointer;text-decoration:none;color:black;}
a.footer:hover {color:gray;text-decoration:underline;}
img.load{position:absolute;width:0px;height:0px;top:0px;left:0px;z-index:1;visibility:hidden;}
</style>
</head>
<body style="background-image:url('../static/home/bg.png');background-repeat:repeat-x;">
<div style="position:relative; width:901px; top:32px; margin-left:auto; margin-right:auto;">
<img src="../static/home/main.jpg" style="top:0px;left:0px;z-index:1;" />
<div class="reg" style="" onClick="location='../reg/reg_prep.php'"></div>
<img src="../static/home/topbar.jpg" style="z-index: 6; left: 618px; width:269px; height:31px; top: -31px;" />

<img src="../inc/txt.php?str=16_230_24_20_arial_005399_fffefe_What*is*DJsAttic.com?" style="top:272px; left:210px; z-index:2;" />
<img src="../inc/txt.php?str=10_370_18_14_arial_565353_fffefe_Service:*DJsAttic.com*lets*you*upload*your*entire*music" style="top:304px; left:210px; z-index:2;" />
<img src="../inc/txt.php?str=10_370_18_14_arial_565353_fffefe_library*to*our*remote*servers*and*we*stream*it*back*to*you" style="top:322px; left:210px; z-index:2;" />
<img src="../inc/txt.php?str=10_370_18_14_arial_565353_fffefe_live*anytime,*anywhere*that*you*have*an*internet*connection." style="top:340px; left:210px; z-index:2;" />
<img src="../inc/txt.php?str=12_220_20_16_arial_f00000_fffefe_But*what*good*is*this*to*me..." style="top:364px; left:210px; z-index:2;" />

<img src="../inc/txt.php?str=10_190_18_14_arial_565353_fffefe_Your*Music:*Always*Available" style="top:400px; left:230px; z-index:2;" />
<img src="../inc/txt.php?str=10_140_18_14_arial_565353_fffefe_Free*up*disk*space" style="top:422px; left:230px; z-index:2;" />
<img src="../inc/txt.php?str=10_125_18_14_arial_565353_fffefe_Reduce*risk*of*loss" style="top:400px; left:450px; z-index:2;" />
<img src="../inc/txt.php?str=10_125_18_14_arial_565353_fffefe_Get*organized" style="top:422px; left:450px; z-index:2;" />

<img src="../inc/txt.php?str=14_122_22_20_arial_f00000_f5f5f5_Recent*News" style="top:273px; left:634px; z-index:2;" />

<div id="newsimg1" style="top:383px; left:798px; width:68px; height:48px; background-color:#4f4f4f; border:solid 2px #dfdfdf; z-index:2;"></div>
<div id="newsimg2" style="top:311px; left:798px; width:68px; height:48px; background-color:#4f4f4f; border:solid 2px #dfdfdf; z-index:2;"></div>


<div id="newsdivide" style="top:373px; left:642px; width:181px; height:1px; background-color:#afafaf; border:none; z-index:2;"></div>

<div style="top:30px; left:642px; width:217px; height:139px; border:none;z-index:2;">
<form style="" id="lgn_form" method="post" action="../lgn/lgn_sub.php">
<fieldset style="border-style:none;padding:none;margin:none;">
<div class="lgnd" style="top:39px;">email:</div><input class="lgn" type="text" name="lgnE" size="10" maxlength="50" value="" style="top:37px; z-index: 6;"/>
<div class="lgnd" style="top:65px;">pswd:</div><input class="lgn" type="password" name="lgnP" size="10" maxlength="20" value="" style="top:63px;"/>
</fieldset>
<input name="" type="image" class="sub" id="bttn.sb" onMouseOver="document.getElementById('bttn.sb').style.backgroundColor='#004a7d';" onMouseOut="document.getElementById('bttn.sb').style.backgroundColor='#ffffff';" src="../static/home/sign_in.gif" />
</form>
</div>
  <div class="footer" style="z-index:4;width:901px; top:480px; font-family:arial; font-size:14px; font-weight:bold; text-align:center; position: absolute;"><a class="footer" href="http://www.djsattic.com/">home</a> - <a class="footer" href="../gen/busopp.php">business opportunities</a> - <a class="footer" target="_blank" href="mailto:djsattic@gmail.com">contact</a></div>
  <div style="font-family:arial; font-size:11px; top:600px; font-weight:bold; text-align:center; color:gray; position: absolute; width: 901px;">djsattic.com is viewed best using <a class="footer" style="color:orange;" target="_blank" href="http://www.mozilla.com/en-US/firefox/">firefox.</a></div>
</div>

<div class="what" id="bttn.wh" onClick="location='../gen/whatis.php'" />
</div>
<div class="frm" id="bttn.fr" onClick="window.open('../forum/')" onMouseOver="document.getElementById('bttn.fr').style.backgroundColor='#b8b8b8';" onMouseOut="document.getElementById('bttn.fr').style.backgroundColor='#d6d6d6';" />


</body>
</html>
