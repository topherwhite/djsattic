<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="content-type" content="text/html;charset=utf-8" /><title>mySimum.com: Record NOW!</title><?phprequire '../includes/mySQL_Sessions.inc';require '../includes/Console.inc';require '../includes/Styles-SideBar.inc';require '../includes/LoginBox.inc';if (!(empty($_GET['sess'])))	{	session_start();	if (empty($_SESSION['idnum']))	{ header("Location: http://www.mysimum.com/"); exit; }	$sess_id = session_id();	$ThemeColor = dechex($_SESSION['r']).dechex($_SESSION['g']).dechex($_SESSION['b']);}else{	$sess_id = "";	$ThemeColor = dechex(200).dechex(200).dechex(237);}$TextColor = ColorOffset($ThemeColor,(-92));echo BeginStyleDefinitions();echo SideBarStyles($bgcolor,$ThemeColor);if (empty($sess_id))	echo LoginBoxStyles();echo EndStyleDefinitions();?></head><body><?phpecho SideBarSyntax($sess_id,$_SESSION['idnum'],'','rec','',$_SESSION['email'],$ThemeColor,$_SESSION['msgs']);if (empty($sess_id))	echo LoginBoxSyntax();echo	"<div style=\"font:36px arial;width:700px;top:82px;left:210px;color:#{$TextColor};\">"	.	"Record <b>NOW!</b>"	.	"<div style=\"font-size:20px;top:46px;left:16px;\">"	.	"Soon we hope to provide you with our own free software for recording and mixing your music."	.	"<br /><br />Until that day, we recommend that you download this free software from <br /><b>NCH Swift Sound</b>."	.	"<br /><br /><a href=\"http://www.download.com/3000-20-10580119.html?part=undefined&subj=dl&tag=button\">"	.	"<img src=\" http://i.i.com.com/cnwk.1d/i/dl/dl-bta.gif\" alt=\"Get it from CNET Download.com!\" border=\"0\"></a>"	.	"<br /><br />If you have a better suggestion or know of better free software please tell us."	.	"<br /><a href=\"mailto:mysimum@gmail.com\">mySimum@gmail.com</a>"	.	"</div>"	.	"</div>"	;?></body></html>