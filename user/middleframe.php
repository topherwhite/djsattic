<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?phprequire '../includes/mySQL_Sessions.inc';require '../includes/TableRelated.inc';require '../includes/DirectoryRelated.inc';session_start();	if (empty($_SESSION['idnum']))	{ die(); }?><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="content-type" content="text/html;charset=utf-8" /><title>Profile</title><?php$sess_id = session_id();$id = mysqlclean($_GET,'loc',8,$connection);$clean['ref'] = ereg_replace('\'', '`', $_GET['ref']);$firstnum = mysqlclean($clean,'ref',4,$connection);$BaseLnk = "../tmp/img/" . substr($_SESSION['tmpdir'],0,11) . ".prf/";$TbleGrp = GenerateTableGroup($id);echo	"<style>"	.	"table.main{"."position:absolute;top:1px;left:2px;width:".($_GET['w']+2)."px;height:".($_GET['h']*2-2)."px;"	.		"background-color:#cccccc;vertical-align:middle;text-align:center;}"//	.	"img.thmb{display:table-row;}"	.	"tr.imgrow{height:70px;}"	.	"td.lbl{font:9px arial;text-align:center;}"	.	"td.mv{font:bold 9px arial;}"	.	"td.mv:hover{background-color:black;color:white;}"	.	"</style>"	;	$query['name'] = "SELECT firstname, nickname FROM names WHERE idnum={$id} LIMIT 1";$query['frndcnt'] = "SELECT frnds_appr FROM frnds.frndcount WHERE idnum={$id} LIMIT 1";$info = @mysql_fetch_array(@mysql_query($query['name'],$connection));$frndcnt = @mysql_fetch_array(@mysql_query($query['frndcnt'],$connection));$lastnum = $firstnum + 5;if ($lastnum >= $frndcnt['frnds_appr'])	$lastnum = $frndcnt['frnds_appr'];		$query['GetFrnds'] = "SELECT frnd FROM {$TbleGrp['frnds']} WHERE idnum={$id} AND status=1 LIMIT {$lastnum}";if ($getfrnds = @mysql_query($query['GetFrnds'],$connection)){	for ($i=1;$i<=$lastnum;$i++)	{		$frnd['id'][$i] = @mysql_fetch_array($getfrnds);		if ($i >= $firstnum)		{	$query['GetName'] = "SELECT concat(firstname,' ',lastname) AS full FROM names WHERE idnum={$frnd['id'][$i]['frnd']} LIMIT 1";			$frnd['name'][$i] = @mysql_fetch_array(@mysql_query($query['GetName'],$connection));					$query['GetPic'] = "SELECT prof_pic FROM pageinfo WHERE idnum={$frnd['id'][$i]['frnd']} LIMIT 1";			$frnd['pic'][$i] = @mysql_fetch_array(@mysql_query($query['GetPic'],$connection));			$frnd['piclnk'][$i] = $BaseLnk . GenerateFullImageDirectoryPath($frnd['id'][$i]['frnd']) 							.	"edit.{$frnd['id'][$i]['frnd']}.{$frnd['pic'][$i]['prof_pic']}.jpg";			$dim = getimagesize($frnd['piclnk'][$i]);			if ($dim[0] > $dim[1]) $frnd['imgstyle'][$i] = "width:50px;";			else					$frnd['imgstyle'][$i] = "height:50px;";		}	}}echo "</head>"	."<body>";echo	"<table class=\"main\">"	.	"<tr>"	.	"<td colspan=\"3\" style=\"height:18px;font:bold 12px arial;\">"	.	$info['firstname'] . "'s Friends"	.	"</td>"	.	"<td colspan=\"3\" style=\"height:18px;font:12px arial;\">"	.	"({$firstnum}-{$lastnum} of " . $frndcnt['frnds_appr'] . " total)"	.	"</td>"	.	"</tr>"	.	"<tr style=\"height:10px;\">"	;echo "<td colspan=\"2\" class=\"mv\"";if ($firstnum != 1)	echo " style=\"color:red;cursor:pointer;\" onClick=\"location="		.	"'../user/middleframe.php?sess={$sess_id}&loc={$id}&h={$_GET['h']}&w={$_GET['w']}&ref=".($firstnum-6)."'\">";else echo " style=\"color:black;\">";echo "Prev</td>";echo "<td colspan=\"2\">-</td>" . "<td colspan=\"2\" class=\"mv\"";if ($frndcnt['frnds_appr'] > $lastnum)	echo " style=\"color:red;cursor:pointer;\" onClick=\"location="		.	"'../user/middleframe.php?sess={$sess_id}&loc={$id}&h={$_GET['h']}&w={$_GET['w']}&ref=".($lastnum+1)."'\">";else echo " style=\"color:black;\">";echo "Next</td>";	echo "</tr>";echo "<tr class=\"imgrow\">";for ($i=$firstnum;$i<=($firstnum+5);$i++)	{	echo	"<td colspan=\"2\" class=\"lbl\" onClick=\"top.location='../user/user.php?sess={$sess_id}&loc={$frnd['id'][$i]['frnd']}'\">"		.	$frnd['name'][$i]['full']		.	"<br /><img class=\"thmb\" src=\"{$frnd['piclnk'][$i]}\" style=\"{$frnd['imgstyle'][$i]}cursor:pointer;\"/>"		.	"</td>"		;	if ($i == ($firstnum+2))	echo "</tr><tr class=\"imgrow\">";}echo "</tr>";echo "</table>"	;	echo "</body></html>"?>