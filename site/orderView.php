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
$processed = 0;

 if (isset($_GET['processed'])) {
   $processed = (int)($_GET["processed"]);
 } 

$login = $site->login;

// get order data
$order = new Orders($login);


// build and perhaps process form
$form = new OrderForm();
$form->setOrder($order);
$form->make();

$countOp = $order->countCurrentOp();

if ($countOp) {
$odata = $order->getCurrentOrderData();
$form->loadData($odata);

 $vars["form"] = $form;
 $vars["odata"] = $odata;
 }

$vars["countOp"] = $countOp;

 $vars["processed"]  = $processed;

$p = new MainPage($site, 'Comanda');
echo $p->output('orderView.tpl.php', $vars)

?>