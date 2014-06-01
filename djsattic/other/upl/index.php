<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>uploadprogress example</title>

<script src="prototype.lite.js" type="text/javascript">
</script>
<script src="moo.ajax.js" type="text/javascript">
</script>

<script src="progress.js" type="text/javascript">
</script>
</head>
<body>
<form  target="target_upload" action="upload.php" enctype="multipart/form-data" onsubmit="return progressStart();"  method="post">

<input type="hidden" name="UPLOAD_IDENTIFIER" id="UPLOAD_IDENTIFIER"  value="1325a38f55c0b1b4"/> <!-- <?php print "foo";//rand(0,1000000);?>" />-->
<input id="foo" name="foo" type="file" /><br />
<input id="bar" name="bar" type="file" /><br />
<input type="submit" />

</form>
<br/>
<iframe id='target_upload' name='target_upload' src='blank.html' style='' ></iframe>
<br/><br/>
Output of uploadprogress_get_info():<br/>
<pre id="output">

</pre>
        
</body>
</html>
