<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("lib/start.php");
$site->start();



$p = new MainPage($site, 'Despre noi');
echo $p->output('about.tpl.php')
?>