<?phprequire_once '../../includes/mySQL_Sessions.inc';session_start();$sess_id = session_id();	if (empty($_SESSION['idnum']))	{ header("Location: http://www.djsattic.com/"); exit; }$SymLink = substr($_SESSION['tmpdir'],0,11);$BaseDir = "/Library/WebServer/Documents/-mySimum-/web-content/djsattic/tmp/";$sh_DelSymLinks = "rm {$BaseDir}img/{$SymLink}"	  			. " {$BaseDir}aud/{$SymLink}"		//		. " {$BaseDir}img/{$SymLink}.prf"	  			;	 		exec($sh_DelSymLinks);$query['SetOrgBy'] = "UPDATE user_info.pageinfo SET orgby='{$_SESSION['orgby']}' WHERE idnum={$_SESSION['idnum']}";@mysql_query($query['SetOrgBy'],$connection);session_destroy();header("Location: http://www.djsattic.com/");exit;	?>