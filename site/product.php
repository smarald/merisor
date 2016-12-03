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

$oProduct = new Products();
$vars['data'] = $oProduct->fetch($_GET["productId"]);

try {
$form = new QtyForm();
$form->make();
} catch (MyErrorException $e) {
  $form->errors['other'] = $e->getMessage();
}

$vars["form"] = $form;

$p = new MainPage($site, 'Pagina produs');
echo $p->output('product.tpl.php', $vars)
?>