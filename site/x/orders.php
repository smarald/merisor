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

$form = new MyForm('ordersSearch', 'get');
$vars["form"] = $form;


if ($form->pushed()) {
  $from = smartDate($form->formData["from"]);
  $to = smartDate($form->formData["to"]);

  $o = new Orders();

  $from = $from . ' 00:00:00';
  $to = $to . ' 23:59:59';

  $sql = 'select o.*, u.username, u.firstName, u.lastName

FROM 

orders o 
INNER JOIN users u ON o.uid = u.uid

WHERE

o.dateAdded >= "'.$from.'"
AND o.dateAdded <= "'.$to.'"
AND o.orderSent = 1 

order by o.dateAdded desc';

  $data =  $o->fetchAll($sql);

  $total = 0;


  if (!empty($data)) {
    foreach ($data as &$d) {
      $d["dateAdded"] = db2Display($d["dateAdded"], 'long');
      $total += $d["orderValue"];
    }

    unset($d);

    $vars["data"] = $data;
    $vars["total"]= $total;

  }

 } /// if form pushed

$p = new XPage($site);
echo $p->output('orders.tpl.php', $vars);

?>