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
  $astring = strval($a).'.ttl';
  preg_match('/([^\\/])*ttl/',$astring,$matches);
  $filename = $matches[0];
  echo($filename);
  echo("\r\n");

  $fp = fopen($filename,'w');
  // echo("\r\n");
 foreach($b as $c => $d) {
// echo($multiarray[$a][$c]);
//echo(strval($c).' '.strval($secondarray[$a][$c]));
echo strval($c);
      if(preg_match('/dc\/terms\/date/', strval($c)) || preg_match('/dc\/terms\/created/', strval($c)) || preg_match('/dc\/terms\/modified/', strval($c)) == 1) {
        echo "I have a date or I am created or modified";
      } else {
        if(preg_match('/rss\/1.0\/modules\/content\/encoded/', strval($c)) == 1) {
          $string = strval($secondarray[$a][$c]);
          $stringproc = preg_replace('/</','&lt;',$string);
          $stringproc2 = preg_replace('/>/','&gt;',$stringproc);
          $subarraymulti[$c] = httpmatched(strval($c)).' '.httpmatched($stringproc2).' ;';
        } elseif (preg_match('/rss\/1.0\/modules\/content\/encoded/', strval($c)) != 1) {
           if(preg_match('/schema\.org\/name/', strval($c)) == 1) {
             $subarraymulti[$c] = httpmatched(strval($c)).' '.httpmatched(strval($secondarray[$a][$c])).' ;'."\n"
             .'<http://purl.org/dc/terms/title>'.' '.httpmatched(strval($secondarray[$a][$c])).' ;';
           } if(preg_match('/schema\.org\/name/', strval($c)) != 1) {
          $subarraymulti[$c] = httpmatched(strval($c)).' '.httpmatched(strval($secondarray[$a][$c])).' ;';
           }
        }

      }
echo(httpmatched(strval($c)));
echo("\r\n");
//$subarraymulti[$c] = strval($c).' '.strval($secondarray[$a][$c]);

//echo("\r\n");
// $subarray[$c] = $secondarray[$a][$c];
// echo strval($subarray[$c]);
 //$subarraymulti[$c] = strval($c).' '.strval($subarray[$c]);
 //echo($subarraymulti[$c]);
 }
 $withcommapre = implode("\n",$subarraymulti);
 // http://stackoverflow.com/questions/5592994/remove-the-last-character-from-string
 $withcommamid = substr($withcommapre, 0, -1);
 $withcomma = '<>'."\n".$withcommamid.'.';
 /*
 echo($withcomma);
 echo('-------');
 echo("\r\n");
 */
//$withcomma = implode("\n",$subarraymulti);
 fwrite($fp, $withcomma);
 fclose($fp);

}

//print_r($subarray);



//echo($withcomma);

function httpmatched($string) {
  $matched = preg_match('/^http/', $string);
  if ($matched == 1) {
    $newstring = '<'.$string.'>';
  } elseif ($matched == 0) {
    $newstring = '\''.$string.'\'';
  }
  return $newstring;
}
