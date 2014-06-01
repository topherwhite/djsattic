<?php

require_once "../../includes/mySQL_Sessions.inc";
require_once "../../includes/DirectoryRelated.inc";
require_once "../../includes/TableRelated.inc";
require_once "../../inc/id3/getid3.inc";

session_start();	if (empty($_SESSION['idnum']))	{ die("Cannot process request because session has been logged out or destroyed."); }

$getid3 = new getID3;
$getid3->encoding = 'UTF-8';

$idnum[0] = $_SESSION['idnum'];
$sess_id = session_id();
$key = mktime();
$TbleGrp = GenerateTableGroup($idnum[0]);
$BaseDir = "/cluster/harry/aud/mp3/" . GenerateFullImageDirectoryPath($idnum[0]) . $idnum[0] . ".";

$num_files = intval($_POST["num"]);

for ($cnt = 1; $cnt <= $num_files; $cnt++)
{	$status[$cnt] = 0;
	if (!(empty($_FILES["file_{$cnt}"]['name'])))
	{
		$str = $_FILES["file_{$cnt}"]['name'];
		$pext = strtolower(substr($str,strrpos($str,".")+1,strlen($str)-strrpos($str,".")));
		if ( ($pext != "mp3")  && ($pext != "m4a") )
			unlink($_FILES["file_{$cnt}"]['tmp_name']);
		
		else
		{	$name = $key+$cnt;
			$UploadFile = $BaseDir . $name . ".mp3";
			$sh_SetPerm = "chmod a+rw '{$UploadFile}'";
			
			if ($pext == "m4a")
			{	$sh_get =	"/opt/local/bin/faad -i '". $_FILES["file_{$cnt}"]['tmp_name'] ."' 2>&1 | grep 'title: ';";
				exec($sh_get,$info);	$meta['tt'] = escapeshellarg(substr($info[0],7));	unset($info);
				$sh_get =	"/opt/local/bin/faad -i '". $_FILES["file_{$cnt}"]['tmp_name'] ."' 2>&1 | grep 'artist: ';";
				exec($sh_get,$info);	$meta['ta'] = escapeshellarg(substr($info[0],8));	unset($info);
				$sh_get =	"/opt/local/bin/faad -i '". $_FILES["file_{$cnt}"]['tmp_name'] ."' 2>&1 | grep 'album: ';";
				exec($sh_get,$info);	$meta['tl'] = escapeshellarg(substr($info[0],7));	unset($info);
				$sh_get =	"/opt/local/bin/faad -i '". $_FILES["file_{$cnt}"]['tmp_name'] ."' 2>&1 | grep 'genre: ';";
				exec($sh_get,$info);	$meta['tg'] = escapeshellarg(substr($info[0],7));	unset($info);
				$sh_get =	"/opt/local/bin/faad -i '". $_FILES["file_{$cnt}"]['tmp_name'] ."' 2>&1 | grep 'track: ';";
				exec($sh_get,$info);	$meta['tn'] = escapeshellarg(substr($info[0],7));	unset($info);
				
				$sh_conv =	"/opt/local/bin/faad -q -o - '". $_FILES["file_{$cnt}"]['tmp_name'] ."' | "
						.	"/opt/local/bin/lame --silent --vbr-new -b 128 -B 160";
						if (!(empty($meta['tt']))) $sh_conv .= " --tt " . $meta['tt'];
						if (!(empty($meta['ta']))) $sh_conv .= " --ta " . $meta['ta'];
						if (!(empty($meta['tl']))) $sh_conv .= " --tl " . $meta['tl'];
						if (!(empty($meta['tg']))) $sh_conv .= " --tg " . $meta['tg'];
						if (!(empty($meta['tn']))) $sh_conv .= " --tn " . $meta['tn'];
						$sh_conv .= " -h - '{$UploadFile}'";
				exec($sh_conv);
				unlink($_FILES["file_{$cnt}"]['tmp_name']);
				unset($sh_get,$meta,$sh_conv);
				$status[$cnt] = 1;		
			}
			
			elseif ($pext == "mp3")
			{	if (move_uploaded_file($_FILES["file_{$cnt}"]['tmp_name'],$UploadFile))
				$status[$cnt] = 1;	
			}
			
			if ($status[$cnt] == 1)
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
				
				if (!(empty($clean['title'])))		$clean['title'] = str_replace("'","`",$clean['title']);
					else	$clean['title'] = "Please Provide Title";
				if (!(empty($clean['artist'])))		$clean['artist'] = str_replace("'","`",$clean['artist']);
					else	$clean['artist'] = "Please Provide Artist";
				if (!(empty($clean['album'])))		$clean['album'] = str_replace("'","`",$clean['album']);
					else	$clean['album'] = "No Album";
				if (!(empty($clean['lngth'])))		$clean['lngth'] = str_replace("'","`",$clean['lngth']);
					else	$clean['lngth'] = "Unknown";
				if (!(empty($clean['bitrate'])))	$clean['bitrate'] = str_replace("'","`",$clean['bitrate']);
					else	$clean['bitrate'] = 1;
				if (!(empty($clean['enc'])))		$clean['enc'] = str_replace("'","`",$clean['enc']);
					else	$clean['enc'] = "cbr";
				if (!(empty($clean['size'])))		$clean['size'] = str_replace("'","`",$clean['size']);
					else	$clean['size'] = 1;
				if (!(empty($clean['trck'])))		$clean['trck'] = str_replace("'","`",$clean['trck']);
					else	$clean['trck'] = 1;
				if (!(empty($clean['gnre'])))		$clean['gnre'] = str_replace("'","`",$clean['gnre']);
					else	$clean['gnre'] = 'Unspecified';
	
	//Fix this for length variations
			
				if (strtolower(substr($clean['artist'],0,4)) == "the ")
				{	$clean['artist'] = substr($clean['artist'],4) . "_the";	}
				if (strtolower(substr($clean['album'],0,4)) == "the ")
				{	$clean['album'] = substr($clean['album'],4) . "_the";	}
										
				$meta['title'] = mysqlclean($clean,'title',50,$connection);
				$meta['artist'] = mysqlclean($clean,'artist',50,$connection);
				$meta['album'] = mysqlclean($clean,'album',50,$connection);
				$meta['lngth'] = mysqlclean($clean,'lngth',7,$connection);
				$meta['bitrate'] = mysqlclean($clean,'bitrate',3,$connection);
				$meta['enc'] = mysqlclean($clean,'enc',3,$connection);
				$meta['size'] = mysqlclean($clean,'size',5,$connection);
				$meta['trck'] = mysqlclean($clean,'trck',3,$connection);
				$meta['gnre'] = mysqlclean($clean,'gnre',25,$connection);
				
				unset($clean);
				
				$query['UploadTable'] = "INSERT INTO {$TbleGrp['uploads']} SET "
									.	"idnum={$idnum[0]}, type='aud', file={$name}, "
									.	"title=trim('{$meta['title']}'), artist=trim('{$meta['artist']}'), ext='mp3', "
									.	"album=trim('{$meta['album']}'), lngth='{$meta['lngth']}', bitrate={$meta['bitrate']}, "
									.	"genre='{$meta['gnre']}', enc='{$meta['enc']}', size={$meta['size']}, "
									.	"MD5artist=md5(lower(trim('{$meta['artist']}'))), "
									.	"MD5album=md5(lower(trim('{$meta['album']}'))), "
									.	"MD5genre=md5(lower(trim('{$meta['gnre']}'))), "
									.	"trck='{$meta['trck']}'"
									;
				$query['AudioCount'] = "UPDATE filecount SET numaudio=numaudio+1 WHERE idnum='{$idnum[0]}'";
				$query['GetRefNum'] = "SELECT rank FROM {$TbleGrp['uploads']} WHERE idnum={$idnum[0]} AND file='{$name}'";
				$query['AlbExist'] = "SELECT rank FROM {$TbleGrp['albms']} WHERE idnum={$idnum[0]} AND "
						."MD5s=concat(md5(lower(trim('{$meta['artist']}'))),'_',md5(lower(trim('{$meta['album']}'))))";
				$query['AlbCreate'] = "INSERT INTO {$TbleGrp['albms']} SET idnum={$idnum[0]}, "
						."MD5s=concat(md5(lower(trim('{$meta['artist']}'))),'_',md5(lower(trim('{$meta['album']}'))))";
				
				unset($meta);
				
				if (@mysql_query($query['UploadTable'],$connection))
				{	$query['UploadTable'] = "";
					if (@mysql_query($query['AudioCount'],$connection))
					{	$query['AudioCount'] = "";
						if ($RefNum = @mysql_fetch_array(@mysql_query($query['GetRefNum'],$connection)))
						{	$query['GetRefNum'] = "";
							$DoesExist = @mysql_fetch_array(@mysql_query($query['AlbExist'],$connection));
							$query['AlbExist'] = "";
							if (empty($DoesExist['rank']))
							{	@mysql_query($query['AlbCreate'],$connection);
								$query['AlbCreate'] = "";
							}
							$stat[$cnt] = 1;
				}	}	}
			}	
		}
	}
}

for ($cnt=1;$cnt<=$num_files;$cnt++)
{	if ($stat[$cnt] != 1)
	{	header("Location: upl.php?sess={$sess_id}&key={$key}&up=n");	
		exit;
	}
}

header("Location: upl.php?sess={$sess_id}&key={$key}&up=y");	
exit;

?>