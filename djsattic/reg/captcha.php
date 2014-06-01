<?php
require_once "../../includes/mySQL_Sessions.inc";
require_once "../../inc/captcha.inc";

session_start();	if (empty($_SESSION['state']))	die();

$width = intval($_GET['w']);
$height = 40;

$aFonts = array("../../inc//fonts/Vera.ttf"
				,"../../inc//fonts/VeraIt.ttf"
				,"../../inc//fonts/VeraBd.ttf"
				);
			
$oVisualCaptcha = new PhpCaptcha($aFonts,$width,$height);
$oVisualCaptcha->Create();



?>