<?xml version="1.0" encoding="UTF-8"?>
<djsattic><?php

header('Content-type: text/xml');

require_once '../../includes/mySQL_Sessions.inc';
require_once '../../includes/TableRelated.inc';
require_once '../../inc/xml_related.inc';

session_start();	if (empty($_SESSION['idnum']))	{ die(); }

$TbleGrp = GenerateTableGroup($_SESSION['idnum']);

if		($_SESSION['orgby'] == 'ttl')	$orgby = "title,";
elseif	($_SESSION['orgby'] == 'alb')	$orgby = "album,";
elseif	($_SESSION['orgby'] == 'lng')	$orgby = "LENGTH(lngth),lngth,";
elseif	($_SESSION['orgby'] == 'trk')	$orgby = "trck,";
else									$orgby = "";

$gnreRef = "";
$artRef = "";
$albRef = "";

$ins = "AND type='aud' ";

if (!(empty($_GET['gn'])))
{	$clean['gnreRef'] = str_replace('\'', '`', $_GET['gn']);
	$gnreRef = mysqlclean($clean,'gnreRef',32,$connection);
		$ins .= "AND MD5genre='{$gnreRef}' ";
}

if (!(empty($_GET['ar'])))
{	$clean['artRef'] = str_replace('\'', '`', $_GET['ar']);
	$artRef = mysqlclean($clean,'artRef',32,$connection);
		$ins .= "AND MD5artist='{$artRef}' ";
}

if (!(empty($_GET['al'])))
{	$clean['albRef'] = str_replace('\'', '`', $_GET['al']);
	$albRef = mysqlclean($clean,'albRef',32,$connection);
		$ins .= "AND MD5album='{$albRef}' ";
}

$query['num'] = "SELECT COUNT(*) AS cnt, SUM(size) AS sze FROM {$TbleGrp['uploads']} WHERE idnum={$_SESSION['idnum']} {$ins}";
$query['lst'] = "SELECT rank,file,title,artist,album,lngth,size,bitrate,trck,ext FROM {$TbleGrp['uploads']}"
				.	" WHERE idnum={$_SESSION['idnum']} {$ins}ORDER BY {$orgby}artist,album,trck,title";

if ($nm = @mysql_fetch_array(@mysql_query($query['num'],$connection)))
{	$query['lst'] .= " LIMIT " . $nm['cnt'];
	if ($lst = @mysql_query($query['lst'],$connection))
	{	for ($i = 1; $i <= $nm['cnt']; $i++)
		{	$it[$i] = @mysql_fetch_array($lst);
}	}	}

if (empty($gnreRef))	$gnreRef = "empty";
if (empty($artRef))		$artRef = "empty";
if (empty($albRef))		$albRef = "empty";

$tm['full'] = 0;

for ($i = 1; $i <= $nm['cnt']; $i++)
{	$tm['strlen'] = strlen($it[$i]['lngth']);
	$tm['sec'] = intval(substr($it[$i]['lngth'],-2,2));
	if ($tm['strlen'] >= 5)	$tm['min'] = 60 * intval(substr($it[$i]['lngth'],-5,2));
	else						$tm['min'] = 60 * intval(substr($it[$i]['lngth'],-4,1));
	if ($tm['strlen'] == 7)	$tm['hrs'] = 3600 * intval(substr($it[$i]['lngth'],-7,1));
	else						$tm['hrs'] = 0;
	$tm['full'] = $tm['full'] + $tm['hrs'] + $tm['min'] + $tm['sec'];

//	if ($it[$i]['artist'] == $it[($i-1)]['artist'])	$art[$i] = "_"; else $art[$i] = XML_clean_str($it[$i]['artist'],24);
//	if ($it[$i]['album'] == $it[($i-1)]['album'])	$alb[$i] = "_"; else $alb[$i] = XML_clean_str($it[$i]['album'],24);

//	echo "\n<i>"
//		."<n>". dechex(intval($it[$i]['rank'])) ."</n>"
//		."<k>". dechex(intval($it[$i]['trck'])) ."</k>"
//		."<t>". XML_clean_str($it[$i]['title'],37) ."</t>"
//		."<r>". $art ."</r>"
//		."<a>". $alb ."</a>"
//		."<l>". XML_clean_str($it[$i]['lngth'],10) ."</l>"
//		."</i>";
}

$hrs = floor($tm['full']/3600);
$min = floor(($tm['full']-($hrs*3600))/60);
$sec = floor($tm['full']-($hrs*3600)-($min*60));
if ($hrs == 0)							$hrs = "";
else									$hrs = $hrs . ":";
if (($min < 10) && ($hrs != 0))			$min = "0" . $min;
if ($sec < 10)							$sec = "0" . $sec;



for ($i = 1; $i <= 200; $i++)
{
	if (($it[$i]['artist'] == $it[($i-1)]['artist']) && ($i != 1))	$art = "_";
	else
	{	if (substr($it[$i]['artist'],-4,-1) == "_th")	{	$art = "The " . substr($it[$i]['artist'],0,-4);	}
		else	{	$art = $it[$i]['artist'];	}
		$art = XML_clean_str($art,30);
	}
	 
	if (($it[$i]['album'] == $it[($i-1)]['album']) && ($i != 1))	$alb = "_";
	else
	{	if (substr($it[$i]['album'],-4,-1) == "_th")	{	$alb = "The " . substr($it[$i]['album'],0,-4);	}
		else	{	$alb = $it[$i]['album'];	}
		$alb = XML_clean_str($alb,30);
	}
	
	echo "\n<i>"
		."<n>". dechex(intval($it[$i]['rank'])) ."</n>"
		."<k>". dechex(intval($it[$i]['trck'])) ."</k>"
		."<t>". XML_clean_str($it[$i]['title'],37) ."</t>"
		."<r>". $art ."</r>"
		."<a>". $alb ."</a>"
		."<l>". XML_clean_str($it[$i]['lngth'],10) ."</l>"
		."</i>";
}

echo "\n<cn>". dechex($nm['cnt']) ."</cn>"
	."\n<sz>". dechex($nm['sze']) ."</sz>"
	."\n<tm>". $hrs . $min .":". $sec ."</tm>"
	."\n<or>". $_SESSION['orgby'] ."</or>"
//	.	"_{$gnreRef}"
//	.	"_{$artRef}"
//	.	"_{$albRef}"

	;

?>































</djsattic>