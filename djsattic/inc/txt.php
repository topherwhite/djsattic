<?php
require_once "../../inc/imgtxt.inc";

$str = explode("_",$_GET['str']);
$txt['siz'] = $str[0];
$txt['wd'] = $str[1];
$txt['ht'] = $str[2];
$txt['y'] = $str[3];
$txt['fnt'] = $str[4];
$txt['clr'] = $str[5];
$txt['bgc'] = $str[6];
$txt['msg'] = str_replace("*"," ",$str[7]);

$imgQual = 95;

//$txt['ht'] = intval($txt['siz']) + 12;

$txt['x'] = 10;

$mkImg = new putTxtOnImg();

$mkImg->Message($txt['msg']);

$mkImg->Font("../../inc/fonts/{$txt['fnt']}.ffil");

$mkImg->FontSize($txt['siz']);

$mkImg->Coordinate($txt['x'],$txt['y']);

$mkImg->Colors($txt['clr']);

$mkImg->WriteTXT($txt['ht'],$txt['wd'],$txt['bgc'],$imgQual);

?>
