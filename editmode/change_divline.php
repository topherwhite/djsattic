<?phprequire '../includes/mySQL_Sessions.inc';session_start();	if (empty($_SESSION['idnum']))	{ header("Location: http://www.mysimum.com/"); exit; }$idnum = $_SESSION['idnum'];$sess_id = session_id();$loc = $_GET['loc'];$th = $_GET['th'];$key = dechex(mktime());$divline = mysqlclean($_GET,'div',3,$connection);if (($divline == 0) || ($divline == 50) || ($divline == 100)){	$query['ChangeUserPageInfo'] = "UPDATE pageinfo SET divline={$divline} WHERE idnum={$idnum}";	if (@mysql_query($query['ChangeUserPageInfo'],$connection))		$status = 'divSucc';	else															$status = 'divFail';}header("Location: ../user/items.php?sess={$sess_id}&loc={$loc}&th={$th}&key={$key}&edit=1&m=dv{$divline}");exit;?>