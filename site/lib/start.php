<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

if (file_exists('lib/start.php')) {
  $isX = 0;
  $rel = '';
 } else {
  $isX = 1;
  $rel = '../';
 }


function __autoload($name)
{
  global $rel;

  $paths[] =  'lib/' . $name . '.php';
  $paths[] = $rel . 'common/' . $name . '.php';
  $paths[] = $rel . 'lib/' . $name . '.php';

  foreach ($paths as $path) {
    if (is_file($path)) require_once $path;
  }

} /// __autoload

include($rel . "common/f-url.php");
include($rel . "common/f-date.php");
include($rel . "common/f-money.php");


if ($isX) {
  $site = new XSite();
 } else {
  $site = new FrontSite();  
 }


//print_r($_SERVER);

?>
