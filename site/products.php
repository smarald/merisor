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
$vars['data'] = $oProduct->fetchProducts();

$p = new MainPage($site, 'Pagina produse');
echo $p->output('products.tpl.php', $vars)
?>