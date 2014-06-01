<?php

require_once "../../inc/id3/getid3.inc";
require_once "../../includes/mySQL_Sessions.inc";

if (!($connection = @mysql_connect($sqlserver,$sqlusername,$sqluserpswd)))	die("Could not connect to database");
if (!(mysql_select_db($databasename,$connection)))							showerror();

$getid3 = new getID3;
$getid3->encoding = 'UTF-8';

$name_base = $_POST['name_base'];
$key = mktime();

$num_files = intval($_POST["num"]);

echo '<input type="button" onClick="top.location=\'add.php?key='. $key .'\';" value="return" />'
	.'<br /><br />$strt = '. $name_base .';';

for ($cnt=1;$cnt<=$num_files;$cnt++)
{	
	if (!(empty($_FILES["file_{$cnt}"]['name'])))
	{
		$str = $_FILES["file_{$cnt}"]['name'];
		$pext = strtolower(substr($str,strrpos($str,".")+1,strlen($str)-strrpos($str,".")));
		if ( ($pext != "mp3") /* && ($pext != "mp3")*/ )
			unlink($_FILES["file_{$cnt}"]['tmp_name']);
		
		else
		{	$UploadDir = "/cluster/harry/aud/mp3/all/shared/";
			$File['name'] = ($name_base+$cnt).".{$pext}";
			$UploadFile = $UploadDir . $File['name'];
			$sh_SetPerm = "chmod a+rw {$UploadFile}";
			
			if (move_uploaded_file($_FILES["file_{$cnt}"]['tmp_name'],$UploadFile))
			{	exec($sh_SetPerm);
				$getid3->Analyze($UploadFile);
				
				$clean['title'] = strval(@$getid3->info['tags']['id3v2']['title'][0]);
				$clean['artist'] = strval(@$getid3->info['tags']['id3v2']['artist'][0]);
				$clean['album'] = strval(@$getid3->info['tags']['id3v2']['album'][0]);
				$clean['gnre'] = strval(@$getid3->info['tags']['id3v2']['genre'][0]);
				$clean['trck'] = strval(@$getid3->info['tags']['id3v2']['track'][0]);
				
				if (empty($clean['title']))		$clean['title'] = strval(@$getid3->info['tags']['id3v1']['title'][0]);
				if (empty($clean['artist']))	$clean['artist'] = strval(@$getid3->info['tags']['id3v1']['artist'][0]);
				if (empty($clean['album']))		$clean['album'] = strval(@$getid3->info['tags']['id3v1']['album'][0]);
				if (empty($clean['gnre']))		$clean['gnre'] = strval(@$getid3->info['tags']['id3v1']['genre'][0]);
				if (empty($clean['trck']))		$clean['trck'] = $cnt;
				
				$clean['lngth'] = strval(@$getid3->info['playtime_string']);
				$clean['bitrate'] = strval(intval(@$getid3->info['audio']['bitrate']/1000));
				$clean['enc'] = strval(@$getid3->info['audio']['bitrate_mode']);
				$clean['size'] = strval(round(@$getid3->info['filesize']/1024/10.24));
				
				if (!(empty($clean['title'])))		$clean['title'] = ereg_replace("'","`",$clean['title']);
					else	$clean['title'] = "Please Provide Title";
				if (!(empty($clean['artist'])))		$clean['artist'] = ereg_replace("'","`",$clean['artist']);
					else	$clean['artist'] = "Please Provide Artist";
				if (!(empty($clean['album'])))		$clean['album'] = ereg_replace("'","`",$clean['album']);
					else	$clean['album'] = "No Album";
				if (!(empty($clean['lngth'])))		$clean['lngth'] = ereg_replace("'","`",$clean['lngth']);
					else	$clean['lngth'] = "Unknown";
				if (!(empty($clean['bitrate'])))	$clean['bitrate'] = ereg_replace("'","`",$clean['bitrate']);
					else	$clean['bitrate'] = 1;
				if (!(empty($clean['enc'])))		$clean['enc'] = ereg_replace("'","`",$clean['enc']);
					else	$clean['enc'] = "cbr";
				if (!(empty($clean['size'])))		$clean['size'] = ereg_replace("'","`",$clean['size']);
					else	$clean['size'] = 1;
				if (!(empty($clean['trck'])))		$clean['trck'] = ereg_replace("'","`",$clean['trck']);
					else	$clean['trck'] = 1;
				if (!(empty($clean['gnre'])))		$clean['gnre'] = ereg_replace("'","`",$clean['gnre']);
					else	$clean['gnre'] = 'Unspecified';
				
				
	echo 	'<br />$i = '. $cnt .';'
		.	' $trck = '. mysqlclean($clean,'trck',3,$connection) .';'
		.	' $art = "'. mysqlclean($clean,'artist',50,$connection) .'";'
		.	' $alb = "'. mysqlclean($clean,'album',50,$connection) .'";'
		.	' $gen = "'. mysqlclean($clean,'gnre',25,$connection) .'";'
		.	' $enc = "'. mysqlclean($clean,'enc',3,$connection) .'";'
		.	' $bit = '. mysqlclean($clean,'bitrate',3,$connection) .';'
		.	' $lng = "'. mysqlclean($clean,'lngth',7,$connection) .'";'
		.	' $siz = '. mysqlclean($clean,'size',5,$connection) .';'
		.	'<br />$ttl = "'. mysqlclean($clean,'title',50,$connection) .'";'
		.	'<br />$do = ShareFile($i,$strt,$id,$DirPath,$TbleGrp,$ttl,$art,$alb,$gen,$trck,$lng,$bit,$enc,$siz);'
		.	'<br />$chck = @mysql_fetch_array(@mysql_query($do[\'chckfile\'],$connection));'
		.	'<br />if (empty($chck[\'rank\'])) { if (@mysql_query($do[\'putfile\'],$connection)) { exec($do[\'copyfile\']); } }'
		;
			}	
		}
	}
}


?>