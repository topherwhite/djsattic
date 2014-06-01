<?xml version="1.0" encoding="UTF-8"?>
<djsattic><?php

header('Content-type: text/xml');

require_once '../../includes/mySQL_Sessions.inc';
require_once '../../includes/TableRelated.inc';
require_once '../../inc/xml_related.inc';

session_start();	if (empty($_SESSION['idnum']))	{ die(); }

$TbleGrp = GenerateTableGroup($_SESSION['idnum']);

$type = str_replace('\'', '`', $_GET['type']);

$gnreRef = "";
$artRef = "";

$ins = "type='aud'";

if ((!(empty($_GET['gn']))) && (!(empty($_GET['ar']))))
{	$clean['artRef'] = str_replace('\'', '`', $_GET['ar']);
	$clean['gnreRef'] = str_replace('\'', '`', $_GET['gn']);
	$artRef = mysqlclean($clean,'artRef',32,$connection);
	$gnreRef = mysqlclean($clean,'gnreRef',32,$connection);
		$ins .= " AND MD5artist='{$artRef}' AND MD5genre='{$gnreRef}'";
}
elseif (!(empty($_GET['gn'])))
{	$clean['gnreRef'] = str_replace('\'', '`', $_GET['gn']);
	$gnreRef = mysqlclean($clean,'gnreRef',32,$connection);
		$ins .= " AND MD5genre='{$gnreRef}'";
}
elseif (!(empty($_GET['ar'])))
{	$clean['artRef'] = str_replace('\'', '`', $_GET['ar']);
	$artRef = mysqlclean($clean,'artRef',32,$connection);
		$ins .= " AND MD5artist='{$artRef}'";
}

if		($type == 'art')	{	$mode = "artist";	$lbl = "Artist";	}
elseif	($type == 'alb')	{	$mode = "album";	$lbl = "Album";		}
elseif	($type == 'gnre')	{	$mode = "genre";	$lbl = "Genre";		}
	
$query['num'] = "SELECT COUNT(*) AS nm FROM (SELECT DISTINCT MD5{$mode} FROM {$TbleGrp['uploads']}"
				.	" WHERE idnum={$_SESSION['idnum']} AND {$ins}) AS num{$mode}";
$query['lst'] = "SELECT DISTINCT {$mode}, MD5{$mode} FROM {$TbleGrp['uploads']}"
				.	" WHERE idnum={$_SESSION['idnum']} AND {$ins} ORDER BY {$mode}";

if (($lst=@mysql_query($query['lst'],$connection)) && ($num=@mysql_query($query['num'],$connection)))
{	$nm = @mysql_fetch_array($num);
	for ($i = 1; $i <= $nm['nm']; $i++)
	{	$itms[$i] = @mysql_fetch_array($lst);
		if (empty($itms[$i]['MD5genre']))	$itms[$i]['MD5genre'] = "";
		if (empty($itms[$i]['MD5artist']))	$itms[$i]['MD5artist'] = "";
		if (empty($itms[$i]['MD5album']))	$itms[$i]['MD5album'] = "";
}	}

$xml_gnreref = "na";
$xml_artref = "na";
$Group = "";

if ($type == 'alb')
{	if (!(empty($_GET['gn'])))
	{	$query['GetGenre'] = "SELECT genre FROM {$TbleGrp['uploads']} WHERE MD5genre='{$gnreRef}' LIMIT 1";
		$grp = @mysql_fetch_array(@mysql_query($query['GetGenre'],$connection));
		$Group .= $grp['genre'];
		$xml_gnreref = $gnreRef;
	}
	if (!(empty($_GET['ar'])))
	{	if (!(empty($Group)))	$Group .= ", ";
		$query['GetArtist'] = "SELECT artist FROM {$TbleGrp['uploads']} WHERE MD5artist='{$artRef}' LIMIT 1";
		$grp = @mysql_fetch_array(@mysql_query($query['GetArtist'],$connection));
		$Group .= $grp['artist'];
		$xml_artref = $artRef;
	}
}
if (($type == 'art') && (!(empty($_GET['gn']))))
{	$query['GetGenre'] = "SELECT genre FROM {$TbleGrp['uploads']} WHERE MD5genre='{$gnreRef}' LIMIT 1";
	$grp = @mysql_fetch_array(@mysql_query($query['GetGenre'],$connection));
	$Group .= $grp['genre'];
	$xml_gnreref = $gnreRef;
}
if (empty($Group)) $Group = "All";

if ($nm['nm'] > 1)	$lbl .= "s";

echo "\n<hdr>". XML_clean_str($Group,30) ." ({$nm['nm']} {$lbl})</hdr>"
	."<num>{$nm['nm']}</num>"
	."<type>{$type}</type>"
	."<gref>{$xml_gnreref}</gref>"
	."<aref>{$xml_artref}</aref>"
	;

for ($i = 1; $i <= $nm['nm']; $i++)
{	if (($type == 'art') || ($type == 'alb'))
	{	if (strtolower(substr($itms[$i][$mode],-4,-1)) == "_th")
		{	$itms[$i][$mode] = "The " . substr($itms[$i][$mode],0,-4);	}
	}

	echo "<i><t>" . XML_clean_str($itms[$i][$mode],50) . "</t>";
	if ($type == 'gnre')	echo "<g>{$itms[$i]['MD5genre']}</g></i>";
	elseif ($type == 'art')	echo "<r>{$itms[$i]['MD5artist']}</r></i>";
	elseif ($type == 'alb')	echo "<a>{$itms[$i]['MD5album']}</a></i>";
}

?>































































</djsattic>