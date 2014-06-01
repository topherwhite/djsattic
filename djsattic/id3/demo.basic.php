<?php
// +----------------------------------------------------------------------+
// | PHP version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 2002-2004 James Heinrich                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2 of the GPL license,         |
// | that is bundled with this package in the file license.txt and is     |
// | available through the world-wide-web at the following url:           |
// | http://www.gnu.org/copyleft/gpl.html                                 |
// +----------------------------------------------------------------------+
// | getID3() - http://getid3.sourceforge.net or http://www.getid3.org    |
// +----------------------------------------------------------------------+
// | Authors: James Heinrich <info?getid3*org>                            |
// |          Allan Hansen <ah?artemis*dk>                                |
// +----------------------------------------------------------------------+
// | demo.basic.php                                                       |
// | getID3() demo file - showing the most basic use of getID3().         |
// | dependencies: getid3                                                 |
// +----------------------------------------------------------------------+
//
// $Id: demo.basic.php,v 1.1.1.1 2004/08/23 00:01:26 ah Exp $


// Enter your filename here 
$filename = '05.mp3';

// Include getID3() library (can be in a different directory if full path is specified)
require_once('../getid3/getid3.php');

// Initialize getID3 engine
$getid3 = new getID3;

// Tell getID3() to use UTF-8 encoding - must send proper header as well.
$getid3->encoding = 'UTF-8';

// Tell browser telling it use UTF-8 encoding as well.
header('Content-Type: text/html; charset=UTF-8');

// Analyze file 
try {

    $getid3->Analyze($filename);

    // Show audio bitrate and length
    echo 'Bitrate:  ' . @$getid3->info['audio']['bitrate'] . '<br>';     echo 'Playtime: ' . @$getid3->info['playtime_string']  . '<br>';
    echo 'Playtime: ' . @$getid3->info['tags']['id3v2']['genre'][0]  . '<br>';
}
catch (Exception $e) {
    
    echo 'An error occured: ' .  $e->message;
}?>