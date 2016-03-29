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
  $filename = strval($a).'.txt';
  $fp = fopen($filename,'w');
  // echo("\r\n");
 foreach($b as $c => $d) {
// echo($multiarray[$a][$c]);
 $subarray[$c] = $multiarray[$a][$c];
 $subarraymulti[$c] = strval($c).' '.strval($subarray[$c]);
// echo($subarraymulti[$c]);
 }
 $withcomma = implode("\n",$subarraymulti);
 fwrite($fp, $withcomma);
 fclose($fp);
}

//print_r($subarray);



//echo($withcomma);
