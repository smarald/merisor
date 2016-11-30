<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("../lib/start.php");
if( ! ini_get('date.timezone') )
{
    date_default_timezone_set('GMT');
}
$site->start();
$site->authorize();

$site->login->logout();
?>