<?xml version="1.0" encoding="UTF-8"?><djsattic><?phpheader('Content-type: text/xml');require_once '../../includes/mySQL_Sessions.inc';require_once '../../includes/TableRelated.inc';session_start();	if (empty($_SESSION['idnum']))	{ die(); }$TbleGrp = GenerateTableGroup($_SESSION['idnum']);$ref = mysqlclean($_GET,'ref',2,$connection);$query['lst'] = "SELECT * FROM {$TbleGrp['lists']} WHERE rank={$_SESSION['curr_list']}";if ($lst = @mysql_fetch_array(@mysql_query($query['lst'], $connection))){	$query['ReOrg'] .= "UPDATE {$TbleGrp['lists']} SET ";		for ($i = $ref; $i < 50; $i++)		{	$nxt = $i+1;			$query['ReOrg'] .= "itm{$i}=itm{$nxt},";			if ($lst["itm{$nxt}"] != 0) { $fnl = $nxt; }		}		if (empty($fnl)) $fnl = $ref;	$query['ReOrg'] .= "itm50=0 WHERE rank={$_SESSION['curr_list']}";	if (@mysql_query($query['ReOrg'], $connection))	{	echo "<ref>". intval($ref) ."</ref>"			."<fnl>". intval($fnl) ."</fnl>"			;	}}?></djsattic>