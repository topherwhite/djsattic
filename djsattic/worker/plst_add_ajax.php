<?xml version="1.0" encoding="UTF-8"?>
<djsattic><?php

header('Content-type: text/xml');

require_once '../../includes/mySQL_Sessions.inc';
require_once '../../includes/TableRelated.inc';
require_once '../../inc/xml_related.inc';

session_start();	if (empty($_SESSION['idnum']))	{ die(); }

$TbleGrp = GenerateTableGroup($_SESSION['idnum']);

$ref = mysqlclean($_GET,'ref',8,$connection);

$query['CheckList'] = "SELECT * FROM {$TbleGrp['lists']} WHERE rank={$_SESSION['curr_list']}";

$query['GetInfo'] = "SELECT title,artist,album,lngth FROM {$TbleGrp['uploads']} WHERE rank={$ref}";

if ($itms = @mysql_fetch_array(@mysql_query($query['CheckList'],$connection)))
{	$full = "no";
	for ($cntr = 1; (($full == "no") && ($cntr <= 51)); $cntr++)
	{	$name = "itm" . $cntr;
		if (($itms[$name] == 0) || ($itms[$name] == $ref))	$full = "yes";
		{	$EmptyAt = $name;	$EmptyNum = $cntr;	}
	}

	if ($itms[$name] == $ref)
		echo "<s>1</s>";	
	elseif ($EmptyAt == 'itm51')
		echo "<s>2</s>";
	else
	{	$query['InsertSong'] = "UPDATE {$TbleGrp['lists']} SET {$EmptyAt}={$ref} WHERE rank={$_SESSION['curr_list']}";
		if (@mysql_query($query['InsertSong'], $connection))
		{	if ($info = @mysql_fetch_array(@mysql_query($query['GetInfo'],$connection)))
			{	echo "<s>3</s>"
					."<n>{$EmptyNum}</n>"
					."<t>" . XML_clean_str($info['title'],24) . "</t>"
					."<r>" . XML_clean_str($info['artist'],24) . "</r>"
					."<a>" . XML_clean_str($info['album'],24) . "</a>"
					."<l>" . XML_clean_str($info['lngth'],24) . "</l>"
					;
}	}	}	}

?>







</djsattic>