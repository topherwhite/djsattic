<?php
$errors[0] = '';//means no error. (Change it and things can become very strange)
$errors[1] = 'File Name not set';
$errors[2] = 'Unable to open MP3 file';
$errors[3] = 'ID3v2 Tag not found on this file';
$errors[4] = 'TAG not Supported';
$errors[5] = 'Tag not found(maybe you need to call getInfo() first?)';


class ID3
{	var $file_name=''; //full path to the file
	var $tags;   //array with ID3 tags extracted from the file
	var $last_error_num=0; //keep the number of the last error ocurred
	var $tags_count = 0; // the number of elements at the tags array
	
	function hex2bin($data)
	{	$len = strlen($data);
		for($i=0;$i<$len;$i+=2)		$newdata .= pack("C",hexdec(substr($data,$i,2)));
		return $newdata;
	}
	
	function get_frame_size($fourBytes)
	{	$tamanho[0] = str_pad(base_convert(substr($fourBytes,0,2),16,2),7,0,STR_PAD_LEFT);
		$tamanho[1] = str_pad(base_convert(substr($fourBytes,2,2),16,2),7,0,STR_PAD_LEFT);
		$tamanho[2] = str_pad(base_convert(substr($fourBytes,4,2),16,2),7,0,STR_PAD_LEFT);
		$tamanho[3] = str_pad(base_convert(substr($fourBytes,6,2),16,2),7,0,STR_PAD_LEFT);
		$total = $tamanho[0].$tamanho[1].$tamanho[2].$tamanho[3];
		$tamanho[0] = substr($total,0,8);
		$tamanho[1] = substr($total,8,8);
		$tamanho[2] = substr($total,16,8);
		$tamanho[3] = substr($total,24,8);
		$total = $tamanho[0].$tamanho[1].$tamanho[2].$tamanho[3];
		$total = base_convert($total,2,10);
		return $total;
	}
	
	function extractTags($text,&$tags)
	{	$size = -1;
		while ((strlen($text) != 0) and ($size != 0))
		{	$ID    = substr($text,0,4);
			$aux   = substr($text,4,4);
			$aux   = bin2hex($aux);
			$size  = $this->get_frame_size($aux);
			$flags = substr($text,8,2);
			$info  = substr($text,11,$size-1);
			if ($size != 0)
			{	$tags[$ID] = $info;
				$this->tags_count++;
			}
			$text = substr($text,10+$size,strlen($text));
	}	}
	
	function ID3($file_name)
	{	$this->file_name = $file_name;
		$this->last_error_num = 0;
	}
	
	function getInfo()
	{	if ($this->file_name != '')
		{	$mp3 = @fopen($this->file_name,"r");
			$header = @fread($mp3,10);
			if (!$header)
			{	$this->last_error_num = 2;
				return false;
				die();
			}
			if (substr($header,0,3) != "ID3")
			{	$this->last_error_num = 3;
				return false;
				die();
			}
			$header = bin2hex($header);
			$version = base_convert(substr($header,6,2),16,10).".".base_convert(substr($header,8,2),16,10);
			$flags = base_convert(substr($header,10,2),16,2);
			$flags = str_pad($flags,8,0,STR_PAD_LEFT);
			if ($flags[7] == 1)
			{	//echo('with Unsynchronisation<br>');
			}
			if ($flags[6] == 1)
			{	//echo('with Extended header<br>');
			}
			if ($flags[5] == 1)
			{	//Esperimental tag
				$this->last_error_num = 4;
				return false;
				die();
			}
			$total = $this->get_frame_size(substr($header,12,8));
			$text = @fread($mp3,$total);
			fclose($mp3);
			$this->extractTags($text,$this->tags);
		}
		else
		{	$this->last_error_num = 1;	//file not set
			return false;
			die();
		}
	return true;
	}
	
	function getArtist()
	{	if (array_key_exists('TPE1',$this->tags))
		return $this->tags['TPE1'];
		else
		{	$this->last_error_num = 5;
			return false;
	}	}
	
	function getTrack()
	{	if (array_key_exists('TRCK',$this->tags))
		return $this->tags['TRCK'];
		else
		{	$this->last_error_num = 5;
			return false;
	}	}
   
   function getTitle()
   {	if (array_key_exists('TIT2',$this->tags))
      		return $this->tags['TIT2'];
   		else
   		{	$this->last_error_num = 5;
         	return false;
   }	}
   
   function getAlbum()
   {	if (array_key_exists('TALB',$this->tags))
      		return $this->tags['TALB'];
   		else
   		{	$this->last_error_num = 5;
         	return false;
   }	}
   
   function getYear()
   {	if (array_key_exists('TYER',$this->tags))
      		return $this->tags['TYER'];
   		else
   		{	$this->last_error_num = 5;
         	return false;
   }	}
  

}
?>
