<?xml version="1.0" encoding="UTF-8"?><djsattic><?phpheader('Content-type: text/xml');require_once '../../includes/mySQL_Sessions.inc';require_once '../../includes/TableRelated.inc';session_start();	if (empty($_SESSION['idnum']))	{ die(); }$TbleGrp = GenerateTableGroup($_SESSION['idnum']);$query['UpdateCount'] = "UPDATE filecount SET audlists=audlists-1 WHERE idnum={$_SESSION['idnum']}";$query['DeleteList'] =	"DELETE FROM {$TbleGrp['lists']} WHERE rank={$_SESSION['curr_list']}";$query['GetNextID'] = "SELECT MIN(rank) AS next FROM {$TbleGrp['lists']} WHERE idnum={$_SESSION['idnum']} AND type='aud'";if ( (@mysql_query($query['UpdateCount'],$connection)) && (@mysql_query($query['DeleteList'],$connection)) ){		if ($id = @mysql_fetch_array(@mysql_query($query['GetNextID'], $connection)))	{	$_SESSION['curr_list'] = $id['next'];		echo "<id>{$id['next']}</id>";}	}?></djsattic>