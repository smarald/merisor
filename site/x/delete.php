<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("../lib/start.php");
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