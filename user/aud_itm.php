<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="content-type" content="text/html;charset=utf-8" /><?phprequire '../includes/mySQL_Sessions.inc';require '../includes/TableRelated.inc';require '../includes/ThemeGen.inc';require '../includes/javascript/OpenMiniWin.inc';$clean['pl'] = ereg_replace('\'', '`', $_GET['pl']);$clean['id'] = ereg_replace('\'', '`', $_GET['id']);$clean['lnk'] = ereg_replace('\'', '`', $_GET['lnk']);$clean['key'] = ereg_replace('\'', '`', $_GET['key']);$clean['win'] = ereg_replace('\'', '`', $_GET['win']);$clean['wdth'] = ereg_replace('\'', '`', $_GET['wdth']);$clean['ht'] = ereg_replace('\'', '`', $_GET['ht']);$ThemeColor = ereg_replace('\'', '`', $_GET['th']);$BorderColor = ColorOffset($ThemeColor,(-92));$ObjWdth = $clean['wdth'] - 2;$ObjHght = $ObjWdth * 1;if ($clean['win'] == 'ys') $ObjHght = $ObjWdth/2;$FrameHeight = $clean['ht'] - 2;$TopSection = 42;$TopHeight = $TopSection - 4;$BttmHeight = $FrameHeight - $ObjWdth - $TopSection;$BttmVert = $TopSection + $ObjHght + 1;$bgcolor = $ThemeColor;if ($clean['win'] == 'no')	echo OpenMiniWin(($ObjWdth+2),(($ObjWdth/2)+2));else	echo	"<title>Player</title>";echo	"</head>";echo "<body style=\"font:100% arial;background-color:#{$BorderColor};\">";$pad = 4;if ($clean['pl'] == 0 && ($clean['win'] == 'no'))$player = "<div style=\"padding:{$pad}px {$pad}px {$pad}px {$pad}px;position:absolute;left:1px;"	.	"top:{$TopSection}px;width:".($ObjWdth-2*$pad)."px;height:".($ObjHght-2*$pad)."px;background-color:#{$bgcolor};\">"	.	"The Player will not display while you are in Editmode</div>";elseif ($clean['win'] == 'ys'){	$Play = "playlist_url=../tmp/lists/" . ereg_replace('\'', '`', $_GET['plst']) . ".tmp.xspf";	$TopSection = 1;}else{	if (!($connection = @mysql_connect($sqlserver,$sqlusername,$sqluserpswd)))	die("Could not connect to database");	if (!(mysql_select_db($databasename,$connection)))							showerror();		$rank = mysqlclean($clean, "pl", 8, $connection);	$id = mysqlclean($clean, "id", 8, $connection);	$lnk = mysqlclean($clean, "lnk", 11, $connection);	$key = mysqlclean($clean, "key", 10, $connection);		$PlayList = "../tmp/lists/".dechex($id).$key.".tmp.xspf";		$TbleGrp = GenerateTableGroup($id);		$query['GetList'] = "SELECT * FROM {$TbleGrp['lists']} WHERE rank={$rank}";		$NumSongs = 0;	if ($itm = @mysql_fetch_array(@mysql_query($query['GetList'],$connection)))	{	for ($rep = 1; $rep <= 20; $rep++)		{	if ($itm["itm{$rep}"] != 0)			{	$NumSongs = $NumSongs + 1;				$query['GetSongs'] = "SELECT title, artist, file, ext FROM {$TbleGrp['uploads']} WHERE rank={$itm["itm{$rep}"]}";				$file[$NumSongs] = @mysql_fetch_array(@mysql_query($query['GetSongs'],$connection));		}	}		$FileData = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><playlist version=\"1\""				.	" xmlns=\"http://xspf.org/ns/0/\"><title>{$itm['title']}</title><trackList>";		for ($rep = 1; $rep <= $NumSongs; $rep++)		{	$FileData .= "<track><location>"		.	"http://www.mysimum.com/tmp/aud/{$lnk}.tmp/{$id}.{$file[$rep]['file']}.{$file[$rep]['ext']}"		.	"</location><title>{$file[$rep]['title']} ({$file[$rep]['artist']})</title></track>";		}		$FileData .= '</trackList></playlist>';		$Hndler = fopen($PlayList, 'w');	fwrite($Hndler, $FileData);		fclose($Hndler);		$Play = "playlist_url=" . $PlayList;	}}	if (($clean['pl'] != 0) || ($clean['win'] == 'ys'))	$player="<div style=\"position:absolute;left:1px;top:{$TopSection}px;\">"	.	"<object"	.	" width=\"{$ObjWdth}\" height=\"{$ObjHght}\""	.	' classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"'	.	' codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0"'	.	'>'	.	'<param name="movie" value="../aud_proc/audplayer_full.swf?' . $Play . '" />'	.	'<param ' . 'name="allowScriptAccess" ' . 'value="sameDomain" />'	.	'<param ' . 'name="quality" ' . 'value="high" />'	.	'<param ' . 'name="bgcolor" ' . 'value="#' . $bgcolor . '" />'	.	'<embed'	.	' src="../aud_proc/audplayer_full.swf?' . $Play . '"'	.	" width=\"{$ObjWdth}\" height=\"{$ObjHght}\" bgcolor=\"#{$bgcolor}\""	.	' type="application/x-shockwave-flash"'	.	' pluginspage="http://www.macromedia.com/go/getflashplayer"'	.	' quality="high"'	.	' allowScriptAccess="sameDomain"'	.	' />'	.	'</object>'	.	"</div>"	;	$TitlePad = 6;if ($clean['win'] == 'no')echo	"<div style=\"position:absolute;left:1px;top:1px;padding-top:{$TitlePad}px;width:{$ObjWdth}px;"	.	"height:".($TopHeight-$TitlePad+2)."px;background-color:#{$bgcolor};text-align:center;\">"	.	$itm['title']	.	"</div>"	;	echo $player;	if ($clean['win'] == 'no')	echo	"<div style=\"text-align:center;cursor:pointer;position:absolute;left:1px;top:{$BttmVert}px;width:{$ObjWdth}px;"	.		"height:{$BttmHeight}px;background-color:#{$bgcolor};\""	.	" onClick=\"OpenMiniWin('aud_itm.php?plst=".dechex($id).$key."&wdth={$clean['wdth']}&th={$bgcolor}&win=ys')\""		.	">"	.	"Open Floating Audio Player"	.	"</div>"	;									?>	</body></html>