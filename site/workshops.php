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

$Workshops = new Workshops();
$vars['data'] = $Workshops->fetchList();

$p = new MainPage($site, 'Pagina workshops');
echo $p->output('workshops.tpl.php', $vars)
?>