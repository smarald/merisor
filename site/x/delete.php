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

$action = $_GET["action"];


switch ($action) {
  
 case 'orders':
   $orderId = $_GET["orderId"];

   $o = new Orders;
   $o->delete($orderId);

  
   redirect('orders.php');
   break;



 }

?>