<?phprequire_once '../../includes/mySQL_Sessions.inc';require_once '../../includes/ValidateEmail.inc';session_start();	if (empty($_SESSION['state']))	{ header("Location: http://www.djsattic.com/"); exit; }$sess_id = session_id();$status = "";if ( ($_POST['type'] == 'art') || ($_POST['type'] == 'lis') || ($_POST['type'] == 'rev') || ($_POST['type'] == 'ven') ){				$val['type'] = mysqlclean($_POST, 'type', 3, $connection);				$_SESSION['type'] = $val['type'];}else			$_SESSION['type'] = 'art';if ( ($_POST['country'] == 'USA') || ($_POST['country'] == 'Canada') ){				$val['country'] = mysqlclean($_POST, 'country', 6, $connection);				$_SESSION['country'] = $val['country'];}else			$_SESSION['country'] = 'none';if  (	($_POST['state']=='AL') || ($_POST['state']=='AK') || ($_POST['state']=='AZ') || ($_POST['state']=='AR')	||	($_POST['state']=='CA') || ($_POST['state']=='CO') || ($_POST['state']=='CT') || ($_POST['state']=='DE')	||	($_POST['state']=='DC') || ($_POST['state']=='FL') || ($_POST['state']=='GA') || ($_POST['state']=='HI')	||	($_POST['state']=='ID') || ($_POST['state']=='IL') || ($_POST['state']=='IN') || ($_POST['state']=='IA')	||	($_POST['state']=='KS') || ($_POST['state']=='KY') || ($_POST['state']=='LA') || ($_POST['state']=='ME')	||	($_POST['state']=='MD') || ($_POST['state']=='MA') || ($_POST['state']=='MI') || ($_POST['state']=='MN')	||	($_POST['state']=='MS') || ($_POST['state']=='MO') || ($_POST['state']=='MT') || ($_POST['state']=='NE')	||	($_POST['state']=='NV') || ($_POST['state']=='NH') || ($_POST['state']=='NJ') || ($_POST['state']=='NM')	||	($_POST['state']=='NY') || ($_POST['state']=='ND') || ($_POST['state']=='OH') || ($_POST['state']=='OK')	||	($_POST['state']=='OR') || ($_POST['state']=='PA') || ($_POST['state']=='RI') || ($_POST['state']=='SC')	||	($_POST['state']=='SD') || ($_POST['state']=='TN') || ($_POST['state']=='TX') || ($_POST['state']=='UT')	||	($_POST['state']=='VT') || ($_POST['state']=='VA') || ($_POST['state']=='WA') || ($_POST['state']=='WV')	||	($_POST['state']=='WI') || ($_POST['state']=='WY')	||	($_POST['state']=='AS') || ($_POST['state']=='FM') || ($_POST['state']=='GU') || ($_POST['state']=='MH')	||	($_POST['state']=='MP') || ($_POST['state']=='PW') || ($_POST['state']=='PR') || ($_POST['state']=='VI')	){				$val['state'] = mysqlclean($_POST, 'state', 2, $connection);				$_SESSION['state'] = $val['state'];				$_SESSION['country'] = "USA";}		elseif	(	($_POST['state']=='AB') || ($_POST['state']=='BC') || ($_POST['state']=='MB') || ($_POST['state']=='NB') ||			($_POST['state']=='NF') || ($_POST['state']=='NT') || ($_POST['state']=='NS') || ($_POST['state']=='NU') ||			($_POST['state']=='ON') || ($_POST['state']=='PE') || ($_POST['state']=='QC') || ($_POST['state']=='SK') ||			($_POST['state']=='YT')		){				$val['state'] = mysqlclean($_POST, 'state', 2, $connection);				$_SESSION['state'] = $val['state'];				$_SESSION['country'] = "Canada";}elseif	($_POST['state']=='XX'){				$val['state'] = mysqlclean($_POST, 'state', 2, $connection);				$_SESSION['state'] = $val['state'];}else			$_SESSION['state'] = 'none';		if (!(empty($_POST['city']))){				$val['city'] = mysqlclean($_POST, 'city', 100, $connection);				$_SESSION['city'] = $val['city'];}else			$_SESSION['city'] = "";if (!(empty($_POST['zip']))){				$val['zip'] = mysqlclean($_POST, 'zip', 10, $connection);				$_SESSION['zip'] = $val['zip'];}else			$_SESSION['zip'] = "";if (!(empty($_POST['first']))){				$val['first'] = mysqlclean($_POST, 'first', 100, $connection);				$_SESSION['first'] = $val['first'];}else			$_SESSION['first'] = "";if (!(empty($_POST['last']))){				$val['last'] = mysqlclean($_POST, 'last', 100, $connection);				$_SESSION['last'] = $val['last'];}else			$_SESSION['last'] = "";if (!(empty($_POST['email1']))){				$val['email1'] = mysqlclean($_POST, 'email1', 50, $connection);				$_SESSION['email1'] = $val['email1'];}else			$_SESSION['email1'] = "";if (!(empty($_POST['email2']))){				$val['email2'] = mysqlclean($_POST, 'email2', 50, $connection);				$_SESSION['email2'] = $val['email2'];}else			$_SESSION['email2'] = "";if (!(empty($_POST['pswd1']))){				$val['pswd1'] = mysqlclean($_POST, 'pswd1', 20, $connection);				$_SESSION['pswd1'] = $val['pswd1'];}else			$_SESSION['pswd1'] = "";if (!(empty($_POST['pswd2']))){				$val['pswd2'] = mysqlclean($_POST, 'pswd2', 20, $connection);				$_SESSION['pswd2'] = $val['pswd2'];}else			$_SESSION['pswd2'] = "";if ( ($_POST['agreement'] == 'yes') || ($_POST['agreement'] == 'no') ){				$val['agreement'] = mysqlclean($_POST, 'agreement', 3, $connection);				$_SESSION['agreement'] = $val['agreement'];}else			$_SESSION['agreement'] = 'no';//$email_msg = "abcdefghijkl";$lngth[1] = strlen($_POST['email1']);$lngth[2] = strlen($_POST['email2']);if ( strtoupper($_POST['captcha']) != strtoupper($_SESSION['captcha_msg']) ){	$_SESSION['captcha_lbl'] = "ff";	$status = "bad";}	if (	($_POST['email1'] != $_POST['email2'])		||	( ($lngth[1] < 8)	||	($lngth[2] < 8) )	||	( ($lngth[1] > 50)	||	($lngth[2] > 50) )	){													$_SESSION['email_lbl'] = "ff";													$status = "bad";//	if ($_POST['email1'] != $_POST['email2'])		substr_replace($email_msg,'mtch',0);//	if ( ($lngth_1 < 8) && ($lngth_2 < 8) )			substr_replace($email_msg,'shrt',4);//	if ( ($lngth_1 > 50) && ($lngth_2 > 50) )		substr_replace($email_msg,'long',8);//$_SESSION['email_msg'] = $email_msg;									}else{	if	(CheckEmail($_POST['email1']) != 'valid')	{												$_SESSION['email_lbl'] = "ff";													$status = "bad";	}	else	{		//Check if email already has an account		$email_addr = mysqlclean($_POST, 'email1', 50, $connection);		$query['CheckEmail'] = 	"SELECT idnum FROM login WHERE email='{$email_addr}'";		if ($idcheck = @mysql_fetch_array(@mysql_query ($query['CheckEmail'], $connection)))		{	$_SESSION['email_lbl'] = "ff";			$status = "bad";		}		// No such account exists--all is good		else		{	$_SESSION['email_lbl'] = "00";	//		$_SESSION['email_msg'] = $email_msg;		}												}}//$pswd_msg = "------------";$lngth[1] = strlen($_POST['pswd1']);$lngth[2] = strlen($_POST['pswd2']);if (	($_POST['pswd1'] != $_POST['pswd2'])		||	( ($lngth[1] < 5)	||	($lngth[2] < 5) )	||	( ($lngth[1] > 20)	||	($lngth[2] > 20) )	){													$_SESSION['pswd_lbl'] = "ff";													$status = "bad";//	if ($_POST['pswd1'] != $_POST['pswd2'])			substr_replace($pswd_msg,'mtch',0,4);//	if ( ($lngth_1 < 5) && ($lngth_2 < 5) )			substr_replace($pswd_msg,'shrt',4,4);//	if ( ($lngth_1 > 20) && ($lngth_2 > 20) )		substr_replace($pswd_msg,'long',8,4);//$_SESSION['pswd_msg'] = $pswd_msg;									}else{										//			$_SESSION['pswd_msg'] = $pswd_msg;													$_SESSION['pswd_lbl'] = "00";}if (	(empty($_POST['first']))	||	(strlen($_POST['first']) > 100)		){														$_SESSION['first_lbl'] = "ff";														$status = "bad";}else													$_SESSION['first_lbl'] = "00";if (	(empty($_POST['last']))	||	(strlen($_POST['last']) > 100)		){														$_SESSION['last_lbl'] = "ff";														$status = "bad";}else													$_SESSION['last_lbl'] = "00";if (	(empty($_POST['zip']))	||	(strlen($_POST['zip']) > 10)		){														$_SESSION['zip_lbl'] = "ff";														$status = "bad";}else													$_SESSION['zip_lbl'] = "00";if	($_POST['agreement'] != 'yes'){														$_SESSION['agree_lbl'] = "ff";														$status = "bad";}else													$_SESSION['agree_lbl'] = "00";if ($status == 'bad'){	header("Location: reg.php?sess={$sess_id}");	exit;}else{	header("Location: reg_sub.php?sess={$sess_id}");	exit;}?>