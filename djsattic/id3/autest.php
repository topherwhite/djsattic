<?php
require_once('audioconvert_class_inc.php');
$au = new audioconvert();
$au->mp32OggFile('/path/to/audiofile.mp3);
$au->wma2Ogg('/path/to/wmaAudio.wma');