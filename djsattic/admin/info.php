<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><title>DJsAttic.com Diagnostics</title></head><body style="font:normal 14px arial;"><?php$admin_pswd = "odysseus";$pg = $_GET['pg'];require_once '../../includes/mySQL_Sessions.inc';require_once '../../includes/TableRelated.inc';if (!($connection = @mysql_connect($sqlserver,$sqlusername,$sqluserpswd)))	die("Could not connect to database");if (!(mysql_select_db($databasename,$connection)))							showerror();$key = mktime();echo	"<input type=\"button\" value=\"general stats\" onClick=\"top.location='info.php?pg=stats&key=' + Math.random();\" />"	.	" -- "	.	"<input type=\"button\" value=\"user list\" onClick=\"top.location='info.php?pg=users&key=' + Math.random();\" />"	.	" -- "	.	"<input type=\"button\" value=\"disk usage\" onClick=\"top.location='info.php?pg=disk&key=' + Math.random();\" />"	.	" -- "	.	"<input type=\"button\" value=\"php info\" onClick=\"top.location='info.php?pg=phpi&key=' + Math.random();\" />"	.	" -- "	.	"<input type=\"button\" value=\"convert timestamp\" onClick=\"top.location='info.php?pg=time&key=' + Math.random();\" />"	.	" -- "	.	"<input type=\"button\" value=\"backup database\" onClick=\"top.location='info.php?pg=dbbk&key=' + Math.random();\" />"		.	"<br /><br /><input type=\"button\" value=\"update info\" onClick=\"top.location.reload();\" />"	;if ($pg == 'users'){$limit = 50;$query['total'] = "SELECT COUNT(*) AS tot FROM user_info.login";$total = @mysql_fetch_array(@mysql_query($query['total'],$connection));$query['GetUsers'] = 		"SELECT usrlst.idnum,info.email,info.nm,info.cr,info.loc "	.	"FROM ("	.			"SELECT DISTINCT lgn.lgn_fffe60_fffff0.idnum FROM lgn.lgn_fffe60_fffff0 ORDER BY date DESC LIMIT {$limit}"	.		") AS usrlst, "	.		"("	.			"SELECT user_info.login.idnum"	.					",user_info.login.email"	.					",CONCAT(user_info.names.firstname,' ',user_info.names.lastname) AS nm"	.					",user_info.acct_info.created AS cr"	.					",CONCAT("	.							"user_info.location.city"	.							",', ',user_info.location.state"	.							",', ',user_info.location.country"	.							",', ',user_info.location.zip"	.					") AS loc "	.			"FROM user_info.login,user_info.names,user_info.acct_info,user_info.location "	.			"WHERE user_info.login.idnum=user_info.names.idnum "	.			"AND user_info.login.idnum=user_info.acct_info.idnum "	.			"AND user_info.login.idnum=user_info.location.idnum"	.		") AS info "	.	"WHERE usrlst.idnum=info.idnum";		$Info = @mysql_query($query['GetUsers'],$connection);echo "<br /><br /><table style=\"font-size:10px;\">"	."<tr><td style=\"font-weight:bold;\">total users: {$total['tot']}</td></tr>"	."<tr><td style=\"font-weight:bold;\">-</td></tr>"	."<tr><td style=\"font-weight:bold;\">displaying last {$limit} users to have logged in, although currently they are out of order.</td></tr>"	."<tr><td style=\"font-weight:bold;\">-</td></tr>"	."<tr style=\"font-weight:bold;text-decoration:underline;\">"	.	"<td>email --</td>"	.		"<td>--</td>"	.	"<td>name --</td>"	.		"<td>--</td>"	.	"<td>id # --</td>"	.		"<td>--</td>"	.	"<td>songs --</td>"	.		"<td>--</td>"	.	"<td>location --</td>"	.		"<td>--</td>"	.	"<td>last login --</td>"	.		"<td>--</td>"	.	"<td>registered --</td>"	."</tr>";for ($i = 1; $i <= $limit; $i++){	$info[$i] = @mysql_fetch_array($Info);	$TbleGrp = GenerateTableGroup($info[$i]['idnum']);		$query['extras'] =	"SELECT lastlgn.lstlgn,libsize.libsz FROM "					.	"(SELECT idnum,MAX(date) AS lstlgn FROM {$TbleGrp['lgn']} WHERE idnum={$info[$i]['idnum']} GROUP BY idnum) AS lastlgn"					.	",(SELECT idnum,COUNT(*) AS libsz FROM {$TbleGrp['uploads']} WHERE idnum={$info[$i]['idnum']} AND type='aud' "					.		"GROUP BY idnum) AS libsize "					.	"WHERE lastlgn.idnum=libsize.idnum";	$extras[$i] = @mysql_fetch_array(@mysql_query($query['extras'],$connection));}for ($i = 1; $i <= $limit; $i++)	echo "<tr>"		."<td>" . $info[$i]['email']						. "</td><td></td>"		."<td>" . $info[$i]['nm']							. "</td><td></td>"		."<td>" . $info[$i]['idnum']						. "</td><td></td>"		."<td>" . $extras[$i]['libsz']						. "</td><td></td>"		."<td>" . $info[$i]['loc']							. "</td><td></td>"		."<td>" . date("m-d-y, H:i",$extras[$i]['lstlgn'])	. "</td><td></td>"		."<td>" . date("m-d-y, H:i",$info[$i]['cr'])		. "</td>"		."</tr>";echo "</table>";}elseif ($pg == 'disk'){$total_space['harry'] = intval((((disk_total_space("/cluster/harry"))/1024)/1024)/10.24)/100;$free_space['harry'] = intval((((disk_free_space("/cluster/harry"))/1024)/1024)/10.24)/100;$used_space['harry'] = $total_space['harry'] - $free_space['harry'];$total_space['leo'] = intval((((disk_total_space("/cluster/leo"))/1024)/1024)/10.24)/100;$free_space['leo'] = intval((((disk_free_space("/cluster/leo"))/1024)/1024)/10.24)/100;$used_space['leo'] = $total_space['leo'] - $free_space['leo'];$total_space['both'] = $total_space['harry'] + $total_space['leo'] - 100;$free_space['both'] = $free_space['harry'] + $free_space['leo'];$used_space['both'] = $used_space['harry'] + $used_space['leo'] - 100;$pct_used = intval(($used_space['both'] / $total_space['both']) * 10000) / 100;echo	"<br /><br />DISK USAGE:<br />--<br />"	.	"{$used_space['both']} GBs of {$total_space['both']} GBs total. {$pct_used}% used.<br />"	.	"<br /><br /><br />";}elseif ( ($pg == 'stats') || (empty($pg)) ){$day = 60*60*24;$week = $day*7;// Account Information$query['NumTotal'] = "SELECT COUNT(*) AS tot FROM user_info.login";$query['NumLast24'] = "SELECT COUNT(*) AS lst24 FROM user_info.acct_info WHERE created >= " . ($key-$day);$query['NumLast7d'] = "SELECT COUNT(*) AS lst7d FROM user_info.acct_info WHERE created >= " . ($key-$week);$NumTotal = @mysql_fetch_array(@mysql_query($query['NumTotal'],$connection));$NumLast24 = @mysql_fetch_array(@mysql_query($query['NumLast24'],$connection));$NumLast7d = @mysql_fetch_array(@mysql_query($query['NumLast7d'],$connection));echo	"<br /><br />REGISTRATION STATISTICS:<br />--<br />"	.	"Total Registered Users --- <b>" . $NumTotal['tot'] . "</b><br />"	.	"Registrations in the last 24 hours --- <b>" . $NumLast24['lst24'] . "</b><br />"	.	"Registrations in the last 7 days --- <b>" . $NumLast7d['lst7d'] . "</b><br />";	// Login Information$query['NumLast24'] = "SELECT COUNT(*) AS lst24 FROM lgn.lgn_fffe60_fffff0 WHERE date >= " . ($key-$day);$query['NumLast7d'] = "SELECT COUNT(*) AS lst7d FROM lgn.lgn_fffe60_fffff0 WHERE date >= " . ($key-$week);$NumLast24 = @mysql_fetch_array(@mysql_query($query['NumLast24'],$connection));$NumLast7d = @mysql_fetch_array(@mysql_query($query['NumLast7d'],$connection));echo	"<br /><br />LOGIN STATISTICS:<br />--<br />"	.	"Logins in the last 24 hours --- <b>" . $NumLast24['lst24'] . "</b><br />"	.	"Logins in the last 7 days --- <b>" . $NumLast7d['lst7d'] . "</b><br />";// Number of Songs$query['GetCnt'] = "SELECT COUNT(*) AS cnt FROM uploads.uploads_fffe60_fffff0 WHERE type='aud'";$cnt = @mysql_fetch_array(@mysql_query($query['GetCnt'],$connection));echo	"<br /><br />COMBINED NUMBER OF SONGS IN ALL REGISTERED LIBRARIES:<br />--<br />"	.	"Total --- <b>" . $cnt['cnt'] . "</b><br />"	.	"<br /><br /><br />";	}elseif ($pg == 'phpi'){	phpinfo();}elseif ($pg == 'time'){	if (empty($_POST['timestamp']))	$msg = "enter a 10 digit unix timestamp above.";	else	$msg = $_POST['timestamp'] . ": " . date("M j, Y, H:i",$_POST['timestamp']) . ".";	echo "<br /><br /><form method=\"post\" enctype=\"multipart/form-data\" action=\"info.php?pg=time&key={$key}\">"	.	"<input type=\"text\" name=\"timestamp\" length=\"12\" value=\"{$_POST['timestamp']}\" />"	.	"<br /><input type=\"submit\" value=\"convert unix timestamp\" />"	.	"<br /><br />" . $msg	.	"</form>"	;}elseif ($pg == 'dbbk'){	$filename = date("Y.m.d_H.i");	$sh =	"mysqldump -h{$srvr} -u{$user} -p{$pswd} --databases"		.	" ads"		.	" albms"		.	" forum"		.	" frnds"		.	" grps"		.	" lgn"		.	" lists"		.	" msgs"		.	" uploads"		.	" user_info"		.	" visits"		.	" www2007"		.	" > djsattic_{$filename}.sql;"		.	"gzip djsattic_{$filename}.sql --best;"		.	"rm -R db_backups;"		.	"mkdir db_backups;"		.	"mv djsattic_{$filename}.sql.gz db_backups/djsattic_{$filename}.sql.gz;"		;	exec($sh);	echo "<br /><br />The database has been fully archived to a file named djsattic_{$filename}.sql"	."<br /><br />Download a zipped copy of the archive here: "	."<a href=\"db_backups/djsattic_{$filename}.sql.gz\">djsattic_{$filename}.sql.gz</a>"	;}else{	echo "<br /><br />Please choose a category from above.";}	?></body></html>