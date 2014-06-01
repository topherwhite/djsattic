<?xml version="1.0" encoding="UTF-8"?>
<afAMPxml>
<?php

require_once "../../includes/mySQL_Sessions.inc";
require_once '../../includes/TableRelated.inc';
require_once '../../inc/xml_related.inc';

if (!($connection=@mysql_connect($sqlserver,$sqlusername,$sqluserpswd)))		die();
if (!(mysql_select_db($databasename,$connection)))								showerror();

$clean = explode("_",str_replace('\'',"`",$_GET['key']));
$idnum = hexdec(mysqlclean($clean,0,8,$connection));
$tmpdir = strval(mysqlclean($clean,1,16,$connection));
$org = strval(mysqlclean($clean,2,3,$connection));
$Snd['gnre'] = strval(mysqlclean($clean,3,32,$connection));
$Snd['art'] = strval(mysqlclean($clean,4,32,$connection));
$Snd['alb'] = strval(mysqlclean($clean,5,32,$connection));
$startpt = intval(mysqlclean($clean,6,8,$connection));

$TbleGrp = GenerateTableGroup($idnum);

if		($org == 'ttl')		$orgby = "title,";
elseif	($org == 'alb')		$orgby = "album,";
elseif	($org == 'lng')		$orgby = "LENGTH(lngth),lngth,";
elseif	($org == 'trk')		$orgby = "trck,";
else						$orgby = "";

$gnreRef = "";
$artRef = "";
$albRef = "";

$ins = "AND type='aud' ";

if ($Snd['gnre'] != 'empty')
{	$gnreRef = mysqlclean($Snd,'gnre',32,$connection);
		$ins .= "AND MD5genre='{$gnreRef}' ";
}

if ($Snd['art'] != 'empty')
{	$artRef = mysqlclean($Snd,'art',32,$connection);
		$ins .= "AND MD5artist='{$artRef}' ";
}

if ($Snd['alb'] != 'empty')
{	$albRef = mysqlclean($Snd,'alb',32,$connection);
		$ins .= "AND MD5album='{$albRef}' ";
}

$query['GetNum'] = "SELECT COUNT(*) AS cnt FROM {$TbleGrp['uploads']} WHERE idnum={$idnum} {$ins}";
$query['GetList'] = "SELECT title,artist,album,bitrate,file,ext FROM {$TbleGrp['uploads']}"
				.	" WHERE idnum={$idnum} {$ins}ORDER BY {$orgby}artist,album,trck,title";

if ($nmbr = @mysql_fetch_array(@mysql_query($query['GetNum'],$connection)))
{	if	($GetList=@mysql_query($query['GetList'],$connection))
	{	for ($cntr = 1; $cntr <= $nmbr['cnt']; $cntr++)
		{	$info = @mysql_fetch_array($GetList);
			if ($cntr >= $startpt)
				echo "\n<sound>"
				.	"<title>" . XML_clean_str($info['title'],37) . "</title>"
				.	"<artist>" . XML_clean_str("{$info['artist']}, {$info['album']}",100) . "</artist>"
				.	"<bitrate>{$info['bitrate']}</bitrate>"
				.	"<url>../tmp/aud/{$tmpdir}{$idnum}.{$info['file']}.{$info['ext']}</url>"
				.	"</sound>";
}	}	}


?>















</afAMPxml>