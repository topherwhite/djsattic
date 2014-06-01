<?xml version="1.0" encoding="UTF-8"?>
<djsattic><?php

header('Content-type: text/xml');

require_once '../../includes/mySQL_Sessions.inc';
require_once '../../includes/TableRelated.inc';
require_once '../../inc/xml_related.inc';

session_start();	if (empty($_SESSION['idnum']))	{ die(); }

$TbleGrp = GenerateTableGroup($_SESSION['idnum']);

$ref = mysqlclean($_GET,'ref',32,$connection);
$st = 1;

$query['alb'] = "SELECT rank,title,artist,album,lngth FROM {$TbleGrp['uploads']} WHERE idnum={$_SESSION['idnum']} AND MD5album='{$ref}' ORDER BY trck";
$query['num'] = "SELECT COUNT(*) AS nm FROM ({$query['alb']}) AS numsongs";
$query['lst'] = "SELECT * FROM {$TbleGrp['lists']} WHERE rank={$_SESSION['curr_list']}";

	if ($nm = @mysql_fetch_array(@mysql_query($query['num'],$connection)))
	{	if ($GetSng = @mysql_query($query['alb'],$connection))
		{	for ($i = 1; $i <= $nm['nm']; $i++)
				$sng[$i] = @mysql_fetch_array($GetSng);
	}	}	
	
	if ($lst = @mysql_fetch_array(@mysql_query($query['lst'],$connection)))
	{	for ($i = 1; $i <= 50; $i++)	{	if ($lst["itm{$i}"] == 0)	{	$EmptyAt = $i; break;	}	}
		if (($EmptyAt < 1) || ($EmptyAt > 50) || (empty($EmptyAt)))		$st = 2;
		elseif (($EmptyAt+$nm['nm']) > 51)							$st = 3;
		else
		{	$ins = "";
			for ($i = 1; $i <= $nm['nm']; $i++)
			{	$lstitm = "itm" . ($EmptyAt - 1 + $i);
				if ($i != 1)	$ins .= ",";
				$ins .= $lstitm . "=" . $sng[$i]['rank'];
				
				echo "<s>"
					."<t>". XML_clean_str($sng[$i]['title'],45) ."</t>"
					."<r>". XML_clean_str($sng[$i]['artist'],24) ."</r>"
					."<a>". XML_clean_str($sng[$i]['album'],24) ."</a>"
					."<l>". XML_clean_str($sng[$i]['lngth'],12) ."</l>"
					."</s>";
			}
			$query['AddAlb'] = "UPDATE {$TbleGrp['lists']} SET {$ins} WHERE rank={$_SESSION['curr_list']}";
			if (@mysql_query($query['AddAlb'],$connection))		$st = 4;
		}
	}

echo "<st>" . $st . "</st>"
	."<nm>" . $nm['nm'] . "</nm>"
	."<tr>" . $EmptyAt . "</tr>"
	;

?>







</djsattic>