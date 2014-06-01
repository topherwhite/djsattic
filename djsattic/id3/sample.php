<?php
    require('id3.inc');
    $name  = '001.mp3';
	 $myId3 = new ID3($name);
	 if ($myId3->getInfo()){
         echo('<HTML>');
         echo('<a href= "'.$name.'">Clique para baixar: </a><br>');
         echo('<table border=1>
               <tr>
                  <td><strong>Artist</strong></td>
                  <td><strong>Title</strong></font></div></td>
                  <td><strong>Track</strong></font></div></td>
                  <td><strong>Album</strong></font></div></td>
                  <td><strong>Year</strong></font></div></td>
               </tr>
               <tr>
                  <td>'. $myId3->getArtist() . '&nbsp</td>
                  <td>'. $myId3->getTitle()  . '&nbsp</td>
                  <td>'. $myId3->getTrack()  . '&nbsp</td>
                  <td>'. $myId3->getAlbum()  . '&nbsp</td>
                  <td>'. $myId3->getYear()  . '&nbsp</td>
               </tr>
            </table>');
         echo('</HTML>');
   	}else{
    	echo($errors[$myId3->last_error_num]);
   }
?>
