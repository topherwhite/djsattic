<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="content-type" content="text/html;charset=utf-8" /><title>DJsAttic.com: manage your music</title><?phprequire_once "../includes/home_dim.inc";echo	"<style>"		."input{position:absolute;}"		."div{position:absolute;}"		."div.lgnd{left:{$x}px;width:40px;text-align:right;font-family:arial;font-size:12px;}"		."div.tour,div.reg{left:100px;font:normal 16px arial;border:solid 1px #787878;width:285px;text-align:center;background-color:#a9a9a9;}"		."div.reg{left:-100px;width:160px;}"		."div.or{font:bold 16px arial;}"		."div.tour:hover,div.reg:hover{background-color:gray;}"				."div.tour a,div.reg a,div.or a{text-decoration:none;cursor:pointer;color:black;font-weight:bold;color:black;}"		.$footer['styles']	 	."</style>"	 		 	."</head>"	 	."<body>"	 		 	.$img['tran']		.$div		.$footer['inline']				."<div class=\"tour\" style=\"top:".(-65)."px;\" onClick=\"top.location='../gen/whatis_tour.php';\">"		."<a>take a visual tour of DJsAttic.com!</a>"		."</div>"		."<div class=\"reg\" style=\"top:".($foot['top']-36)."px;\" onClick=\"top.location='../reg/reg_prep.php';\">"		."<a>register (it's free)</a>"		."</div>"		."<div class=\"or\" style=\"left:60px;top:".($foot['top']-36)."px;width:40px;text-align:center;\">"		."<a>or</a>"		."</div>"		."<div class=\"tour\" style=\"top:".($foot['top']-36)."px;\" onClick=\"top.location='../gen/whatis_tour.php';\">"		."<a>take a visual tour of DJsAttic.com!</a>"		."</div>"		//		."<div style=\"top:-43px;left:-250px;width:116px;font:bold 16px arial;text-align:right;\">Our Mission:</div>"//		."<div style=\"top:-40px;left:-130px;font:12px arial;font-weight:normal;width:530px;text-align:left;\">"//		."DJsAttic.com and our parent Simum Innovations, Inc. are dedicated to flattening the music industry."//		." We want to encourage the creation of music and we want to make it easier to distribute music."//		." Most importantly, we want to make it easy to listen to and enjoy music."//		."<br />After all, music can soothe even the savage beast."//		."</div>"				."<div style=\"top:-36px;left:-250px;width:116px;font:bold 16px arial;text-align:right;\">Our Service:</div>"		."<div style=\"top:-35px;left:-130px;font:14px arial;font-weight:normal;width:530px;text-align:left;\">"		."DJsAttic.com lets you to upload your entire music library to our remote servers and we stream it"		.	" back to you live anytime, anywhere that you have an internet connection."		."<br /><br />But what good is this to me..."		."</div>"						."<div style=\"top:70px;left:-240px;width:310px;font:12px arial;text-align:left;\">"		."<a style=\"text-decoration:none;font:bold 14px arial;\">Your music, always available...</a><br />Have you ever being dying just to hear THAT song? Maybe you were at work or at a friends house or dorm room and didn't have your laptop or iPod but wanted to share your new favorite lick with friends or co-workers. Normally you would be out of luck, but now you just just log on to DJsAttic.com and access your entire music library anytime, anywhere that you have internet access."		."<br /><br /><a style=\"text-decoration:none;font:bold 15px arial;\">Free up disk space...</a><br />Storing music, especially high quality music, on your own hard drive can be costly as it can quickly take up drive space that you may need to run other applications on your computer. Why not store your music on our hard drives for FREE?"		."</div>"				."<div style=\"top:70px;left:80px;width:310px;font:12px arial;text-align:left;\">"		."<a style=\"text-decoration:none;font:bold 14px arial;\">Reduce risk of loss...</a><br />Ever had your computer stolen or had your hard drive crash? Your computer is replaceable. Replacing all of your music is often not so easy. By storing music in DJsAttic.com you can protect yourself from theft and hard drive failure today."		."<br /><br /><a style=\"text-decoration:none;font:bold 15px arial;\">Get organized...</a><br />DJsAttic.com is designed to help you find your music in an instant. No more wasting time digging through folder after folder after folder trying to remember where you stored that last song you added to your library. Our filtering system makes it easy to search by Genre, Artist, Album and more and even allows you to create and store your own custom playlists."			."</div>"							."</div>"		;		echo $img['load'];		?></body></html>