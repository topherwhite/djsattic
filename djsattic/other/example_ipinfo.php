<?php
include("ipinfo.class.php");


$ipinfo = new ipinfo;

echo "<b>Check my IP:</b><br><br>";
$ipinfo->check();

echo	"IP Address: ".$ipinfo->address;
echo	"<br>Country: ".$ipinfo->country;
echo	"<br>State: ".$ipinfo->state;
echo	"<br>City: ".$ipinfo->city;
echo	"<br>ISP :".$ipinfo->isp;
echo	"<br> Organization :".$ipinfo->organization."<br><br><br>";

echo "<b>Check custom IP:</b><br><br>";
$ipinfo->check("72.14.221.99");

echo	"IP Address: ".$ipinfo->address;
echo	"<br>Country: ".$ipinfo->country;
echo	"<br>State: ".$ipinfo->state;
echo	"<br>City: ".$ipinfo->city;
echo	"<br>ISP :".$ipinfo->isp;
echo	"<br> Organization :".$ipinfo->organization;
?>