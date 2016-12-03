<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("lib/start.php");
$site->start();
if( ! ini_get('date.timezone') )
{
  date_default_timezone_set('GMT');
}

if ($site->isLogged()) redirect('index.php');

$p = new MainPage($site, 'Login');
echo $p->output('login.tpl.php');

?>