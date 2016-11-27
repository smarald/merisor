<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

function pageFromUrl($url)
{
  $assoc = @parse_url($url);
  if (!$assoc) return 'index.php';
  return basename($assoc["path"]);

}


// redirect
function redirect($page) { 
  Header("Location: ".$page); 
}
/// redirect()


function addParams($url, $arrParams)
{

  foreach ($arrParams as $param =>  $value) {
    $url = addParam($url, $param, $value);
  }

  return $url;
}


function addParam($url, $param, $value)
{

  if (preg_match('/'.$param.'=/', $url)) {
    $url = preg_replace('/(\?|&)('.$param.')(=)([^&])*/', '', $url);    
  }


// corrects the url becoming of: page.php&param=value 
// transforms in: page.php?param=value
  if (preg_match('/&/', $url) && !preg_match('/\?/', $url)) {

    // replace just first occurence of & so finds the position of first occurence, splits in two, replaces & with ? in first occurence, then glues the parts
    $pos = strpos($url, '&');
    $firstPart = substr($url, 0, $pos+1);
    $lastPart = substr($url, $pos+1);
    $firstPart = str_replace('&', '?', $firstPart);
    $url = $firstPart . $lastPart;
  }


  // if there is a ? then we use &. if not use ?
  if (preg_match('/\?/', $url)) {
    $sign = '&';
  } else {
    $sign = '?';
  }

  $url = $url.$sign.$param.'='.$value;
  return $url;
}


?>