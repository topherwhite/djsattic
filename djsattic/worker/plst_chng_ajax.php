<?xml version="1.0" encoding="UTF-8"?>
<djsattic><?php

header('Content-type: text/xml');

require_once '../../includes/mySQL_Sessions.inc';
require_once '../../includes/TableRelated.inc';
require_once '../../inc/xml_related.inc';

session_start();	if (empty($_SESSION['idnum']))	{ die("No User Specified"); }

$TbleGrp = GenerateTableGroup($_SESSION['idnum']);

$MaxLength = 50;

$_SESSION['curr_list'] = mysqlclean($_GET,'ref',8,$connection);
$num = 0;

$query['lst'] = "SELECT title,created";
for ($i = 1; $i <= $MaxLength; $i++)	$query['lst'] .= ",itm{$i}";
$query['lst'] .= " FROM {$TbleGrp['lists']} WHERE rank={$_SESSION['curr_list']}";

if ($lst = @mysql_fetch_array(@mysql_query($query['lst'], $connection)))
{	for ($i = 1; $i <= $MaxLength; $i++)
	{	if ($lst["itm{$i}"] != 0)
		{	$query['info'] = "SELECT title,artist,album,lngth FROM {$TbleGrp['uploads']} WHERE rank=" . $lst["itm{$i}"];
			if ($meta = @mysql_query($query['info'], $connection))
			{	$info = @mysql_fetch_array($meta);
				echo "\n<i>"
					."<t>". XML_clean_str($info['title'],45) ."</t>"
					."<r>". XML_clean_str($info['artist'],35) ."</r>"
					."<a>". XML_clean_str($info['album'],35) ."</a>"
					."<l>". XML_clean_str($info['lngth'],35) ."</l>"
					."</i>";
				$num = $i;
}	}	}	}


echo "\n<num>{$num}</num>"
	."\n<lst>" . XML_clean_str($lst['title'],50) . "</lst>"
	."\n<date>" . XML_clean_str(date("M j, 'y, g:i a",$lst['created']),50) . "</date>"
	."\n<key>{$_SESSION['curr_list']}</key>"
	;
?>















</djsattic>