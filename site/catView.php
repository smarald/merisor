<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("lib/start.php");
$site->start();

$oProduct = new Products();
$vars['data'] = $oProduct->fetchList($_GET["catId"]);



$p = new MainPage($site, 'Categorie produs');
echo $p->output('catView.tpl.php', $vars)
?>