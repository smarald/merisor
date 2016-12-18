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

$workshop = new Workshops();
$vars['data'] = $workshop->fetch($_GET["workshopId"]);

try {
$form = new ParticipateForm();
$form->make();
} catch (MyErrorException $e) {
  $form->errors['other'] = $e->getMessage();
}

$vars["form"] = $form;

$p = new MainPage($site, 'Pagina workshop');
echo $p->output('workshop.tpl.php', $vars)
?>