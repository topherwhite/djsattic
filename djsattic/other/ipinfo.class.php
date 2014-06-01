<?php
/*
+--------------------------------------------------------------------------
|   IpInfo
|   ========================================
|   by Seregwethrin
|	Mail To: seregwethrin@gmail.com (send me bugs if found)
|   ========================================
|   
+---------------------------------------------------------------------------
|
|   > Finds city, country, isp, state, organization by ip address
|   > Script written by Seregwethrin
|   > Revision: 1 
|   > Date: 2007-01-20
|   > Date started: 2007-01-20
|
+--------------------------------------------------------------------------
|
|	> This is a test script. I don't know anything about copyrights of ip-adress.com.
|	> Get your permissions at ip-adress.com before using this script!
|
+--------------------------------------------------------------------------
*/

class ipinfo
{
	var $remote_addr;
	var $address;
	var $country;
	var $state;
	var $city;
	var $isp;
	var $organization;
	
	function ipinfo()
	{
		$this->remote_addr = $_SERVER["HTTP_PC_REMOTE_ADDR"];
	}
	
	function check($ip = false)
	{
		if ($ip == false)
		$ip = $this->remote_addr;

		$postfields = "custom_ip_address=".urlencode($ip)."&submit=".urlencode("lookup any ip");
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'http://www.ip-adress.com/index.php');
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		curl_setopt($ch, CURLOPT_REFERER, "http://www.ip-adress.com");
		//curl_setopt($ch, CURLOPT_PROXY, '211.233.74.24:80'); //To use proxy!
		$html = curl_exec($ch);
		curl_close($ch);
				
		if($html)
		{
			$start = strpos($html, '</form>');
			$end = strpos($html, '<p align="left"></p>') - $start;
			
			$html2 = trim(substr($html, $start, $end));
			$html2 = trim(ereg_replace("<([^>]+)>", "", $html2));
			$html2 = ereg_replace("\n", "<br>", $html2);
			
			$html3 = explode("<br>", $html2);
			
			/* //If you want to use arrays
			$ipinfo = array();
			$ipinfo["address"] = trim($html3[1]);
			$ipinfo["country"] = trim($html3[10]);
			$ipinfo["state"] = trim($html3[15]);
			$ipinfo["city"] = trim($html3[19]);
			$ipinfo["isp"] = trim($html3[31]);
			$ipinfo["organization"] = trim($html3[35]);
			$this->ipinfo = $ipinfo;
			*/
			
			$this->address = trim($html3[1]);
			$this->country = trim($html3[10]);
			$this->state = trim($html3[15]);
			$this->city = trim($html3[19]);
			$this->isp = trim($html3[31]);
			$this->organization = trim($html3[35]);
		}
	}
}

?>