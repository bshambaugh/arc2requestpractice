<?php

$multiarray = array('key' => array('innerkey' => 'value'),'key2' => array('innerkey2' => 'value2'));



/*
 $subarray[0] = $multiarray[0][1];
 $subarray[1] = $multiarray[1][1];

 print_r($subarray);
*/

foreach($secondarray as $a => $b) {
  $subarray = array();
   $subarraymulti = array();
  $astring = strval($a).'.txt';
  preg_match('/([^\\/])*txt/',$astring,$matches);
  $filename = $matches[0];
  echo($filename);
  echo("\r\n");

  $fp = fopen($filename,'w');
  // echo("\r\n");
 foreach($b as $c => $d) {
// echo($multiarray[$a][$c]);
//echo(strval($c).' '.strval($secondarray[$a][$c]));
$subarraymulti[$c] = strval($c).' '.strval($secondarray[$a][$c]);
//echo("\r\n");
// $subarray[$c] = $secondarray[$a][$c];
// echo strval($subarray[$c]);
 //$subarraymulti[$c] = strval($c).' '.strval($subarray[$c]);
 //echo($subarraymulti[$c]);
 }
 $withcomma = implode("\n",$subarraymulti);
 echo($withcomma);
 echo('-------');
 echo("\r\n");
//$withcomma = implode("\n",$subarraymulti);
 fwrite($fp, $withcomma);
 fclose($fp);
 
}

//print_r($subarray);



//echo($withcomma);
