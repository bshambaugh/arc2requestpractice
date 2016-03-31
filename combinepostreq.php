<?php
include('./Requests/library/Requests.php');
Requests::register_autoloader();

/*
// start of code for the test
    $inputfile ='./long-march-3b.ttl';
    $handle = fopen($inputfile,'r');
    $data = fread($handle,filesize($inputfile));
  // end of code for the test
  // start of code for the test
$containertitle = 'Elepants-are-big-4';
// end of code for the test
*/

postandputtoldp($containertitle,$data);

/*
// code for the test
fclose($handle);

// end of code for the test
*/
function postandputtoldp($containertitle,$data) {
$url = 'http://localhost:8080/marmotta/ldp';
$headers = array('Content-Type' => 'text/turtle','Slug' => $containertitle);
$response = Requests::post($url, $headers);

$url = $url.'/'.$containertitle;

$existingheaders = get_headers($url);

$etag = preg_replace('/ETag: /i','',$existingheaders[5]);

$headers = array('Content-Type' => 'text/turtle',
                 'If-Match' => $etag ,
                  'Slug' => $containertitle);

$response = Requests::put($url,$headers,$data);
}

 ?>
