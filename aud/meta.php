<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><?phprequire '../includes/mySQL_Sessions.inc';require '../includes/TableRelated.inc';require '../aud/aud_page_dim.inc';session_start();	if (empty($_SESSION['idnum']))	{ die("No User Specified"); }$sess_id = session_id();$key = dechex(mktime());$TbleGrp = GenerateTableGroup($_SESSION['idnum']);$clean['type'] = ereg_replace('\'', '`', $_GET['type']);$clean['refnum'] = ereg_replace('\'', '`', $_GET['refnum']);$clean['nxtaud'] = ereg_replace('\'', '`', $_GET['nxtaud']);$refnum = mysqlclean($clean,'refnum',8,$connection);$nxtaud = mysqlclean($clean,'nxtaud',8,$connection);$bgcolor = $Frame['bg'];$TitlePadding = 4;$TitleHeight = 18;if (($clean['type'] == 'title') || ($clean['type'] == 'artist') || ($clean['type'] == 'cmnt'))echo "<head><style>"	." img.ttl{". "float:left;height:18px;" ."}"	." input.save{". "float:right;height:18px;width:110px;background:url(../static/save.png);" ."}"	." input.save:hover{". "background:url(../static/save.h.png);" ."}"	."</style></head>";elseecho "<head><style></style></head>";	if ($clean['type'] == 'title'){	echo "<body onLoad=\"top.library.location='library.php?sess={$sess_id}&nxtaud={$nxtaud}';";	if ($_GET['ttl'] == 'edt') echo "top.playlist.location='playlist_curr.php?sess={$sess_id}';";	echo "\">";	$width = $Frame["title_w"] - 4;	$height = $Frame["title_h"] - 4;	$query['GetTitle'] = "SELECT title FROM {$TbleGrp['uploads']} WHERE rank={$refnum}";		$Title = @mysql_fetch_array(@mysql_query($query['GetTitle'], $connection));	echo "<form method=\"post\" enctype=\"multipart/form-data\" action=\"meta_save.php?"	."type=title&sess={$sess_id}&refnum={$refnum}&nxtaud={$nxtaud}\"><fieldset style=\"border:none;\"><textarea rows=\"1\" style=\""	."position:absolute;font:100% arial;padding-left:{$TitlePadding}px;padding-top:{$TitlePadding}px;background-color:#{$bgcolor};"	."top:21px;left:2px;border:none;width:".($width-$TitlePadding)."px;height:".($height-$TitleHeight-$TitlePadding-2)."px;\""	." class=\"title\" name=\"title\" wrap=\"soft\">{$Title['title']}</textarea>"	."<div style=\"position:absolute;font-weight:bold;padding-left:{$TitlePadding}px;background-color:#{$bgcolor};"	."top:2px;left:2px;border:none;width:".($width-$TitlePadding)."px;height:{$TitleHeight}px;font:90% arial;\">"	."<input class=\"save\" alt=\" \" type=\"image\"/>"	."<img class=\"ttl\" alt=\"Title:\" src=\"../static/titles/ttl.title.png\"/>"	."</div></fieldset></form>";}elseif ($clean['type'] == 'artist'){	echo "<body";	if ($_GET['art'] == 'edt') echo " onLoad=\"top.library.location='library.php?sess={$sess_id}&nxtaud={$nxtaud}';"								.	"top.playlist.location='playlist_curr.php?sess={$sess_id}';\"";	echo ">";	$width = $Frame["artist_w"] - 4;	$height = $Frame["artist_h"] - 4;	$query['GetArtist'] = "SELECT artist FROM {$TbleGrp['uploads']} WHERE rank={$refnum}";		$Artist = @mysql_fetch_array(@mysql_query($query['GetArtist'], $connection));	echo "<form method=\"post\" enctype=\"multipart/form-data\" action=\"meta_save.php?"	."type=artist&sess={$sess_id}&refnum={$refnum}&nxtaud={$nxtaud}\"><fieldset style=\"border:none;\"><textarea style=\""	."position:absolute;font:100% arial;padding-left:{$TitlePadding}px;padding-top:{$TitlePadding}px;background-color:#{$bgcolor};"	."top:21px;left:2px;border:none;width:".($width-$TitlePadding)."px;height:".($height-$TitleHeight-$TitlePadding-2)."px;\""	." class=\"artist\" name=\"artist\" wrap=\"soft\">{$Artist['artist']}</textarea>"	."<div style=\"position:absolute;padding-left:{$TitlePadding}px;background-color:#{$bgcolor};"	."top:2px;left:2px;border:none;width:".($width-$TitlePadding)."px;height:{$TitleHeight}px;font:90% arial;\">"	."<input class=\"save\" alt=\" \" type=\"image\"/>"	."<img class=\"ttl\" alt=\"Artist:\" src=\"../static/titles/ttl.artist.png\"/>"	."</div></fieldset></form>";}elseif ($clean['type'] == 'cmnt'){	$width = $Frame["cmnt_w"] - 4;	$height = $Frame["cmnt_h"] - 4;	$query['GetCmnt'] = "SELECT cmnt FROM {$TbleGrp['uploads']} WHERE rank={$refnum}";		$Cmnt = @mysql_fetch_array(@mysql_query($query['GetCmnt'], $connection));	echo "<form method=\"post\" enctype=\"multipart/form-data\" action=\"meta_save.php?"	."type=cmnt&sess={$sess_id}&refnum={$refnum}&nxtaud={$nxtaud}\"><fieldset style=\"border:none;\"><textarea style=\""	."position:absolute;font:90% arial;padding-left:{$TitlePadding}px;padding-top:{$TitlePadding}px;background-color:#{$bgcolor};"	."top:21px;left:2px;border:none;width:".($width-$TitlePadding)."px;height:".($height-$TitleHeight-$TitlePadding-2)."px;\""	." class=\"cmnt\" name=\"cmnt\" wrap=\"soft\">{$Cmnt['cmnt']}</textarea>"	."<div style=\"position:absolute;font-weight:bold;padding-left:{$TitlePadding}px;background-color:#{$bgcolor};"	."top:2px;left:2px;border:none;width:".($width-$TitlePadding)."px;height:{$TitleHeight}px;font:90% arial;\">"	."<input class=\"save\" alt=\" \" type=\"image\"/>"	."<img class=\"ttl\" alt=\"Comment:\" src=\"../static/titles/ttl.cmnts.png\"/>"	."</div></fieldset></form>";}elseif ($clean['type'] == 'plyr'){	$objdim = 40;	$wd = $Frame["playsong_w"] - 4;	$ht = $Frame["playsong_h"] - 4;	$query['Song'] = "SELECT file, ext FROM {$TbleGrp['uploads']} WHERE rank={$refnum}";		$Song = @mysql_fetch_array(@mysql_query($query['Song'], $connection));	echo "<div style=\"position:absolute;top:2px;left:2px;width:{$wd}px;height:{$ht}px;"	.	"background-color:#{$Frame['bg']};\"><object style=\"position:absolute;top:5px;left:5px;\" "	.	"width=\"{$objdim}\" height=\"{$objdim}\" classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" "	.	"codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\">"	.	"<param name=\"movie\" value=\"../aud_proc/audplayer_mini.swf?song_url=http://www.mysimum.com"	.	"/tmp/aud/{$_SESSION['tmpdir']}{$_SESSION['idnum']}.{$Song['file']}.{$Song['ext']}\" />"	.	"<param name=\"allowScriptAccess\" value=\"sameDomain\" /><param name=\"bgcolor\" value=\"#{$Frame['bg']}\" />"	.	"<param name=\"quality\" value=\"high\" /><embed src=\"../aud_proc/audplayer_mini.swf?song_url=http://www.mysimum.com"	.	"/tmp/aud/{$_SESSION['tmpdir']}{$_SESSION['idnum']}.{$Song['file']}.{$Song['ext']}\" width=\"{$objdim}\" height=\""	.	"{$objdim}\" bgcolor=\"#{$Frame['bg']}\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com"	.	"/go/getflashplayer\" quality=\"high\" allowScriptAccess=\"sameDomain\" /></object></div>";}elseif ($clean['type'] == 'grph'){	$query['Graphic'] = "SELECT graphic FROM {$TbleGrp['uploads']} WHERE rank={$refnum}";		$Graphic = @mysql_fetch_array(@mysql_query($query['Graphic'], $connection));	if ($Graphic['graphic'] == 0)	echo "<img style=\"position:absolute;top:2px;left:2px;\""	.	" src=\"../tmp/img/{$_SESSION['tmpdir']}alb/{$_SESSION['idnum']}.none.alb.png\" alt=\"Album Artwork\">";}?></body></html>