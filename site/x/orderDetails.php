<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("../lib/start.php");
$site->start();

// get uid for the current order
$orderId = (int)($_GET["orderId"]);
$o = new Orders();
$a = $o->fetch($orderId);
$uid = $a["uid"];

// get udata for this uid
$u = new Users();
$udata = $u->getFullData($uid);
$vu["udata"] = $udata;


// get opData
$o->setOrderId($orderId);
$odata = $o->getCurrentOrderData($orderId);
$vo["odata"] = $odata;

$p = new XPage($site);

$userDetails = $p->fetch('userDetails.tpl.php', $vu);
$vo["userDetails"] = $userDetails;
$vo["uid"] = $uid;



echo $p->output('orderDetails.tpl.php', $vo)


?>