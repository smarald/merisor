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

// get udata for this uid
$uid = (int)$_GET["uid"];

$u = new Users();
$udata = $u->getFullData($uid);
$vu["udata"] = $udata;



// get order list for this user
$o = new Orders();
$vu['ordersData'] = $o->getListByUser($uid);
$vu['ordersTotal'] = $o->getTotalByUser($uid);

$p = new XPage($site);
$vu['userDetails'] = $p->fetch('userDetails.tpl.php', $vu);


echo $p->output('userPage.tpl.php', $vu)


?>