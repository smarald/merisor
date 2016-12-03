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

if ($site->isLogged()) redirect('index.php');

$form = new MyForm('registerForm', 'post');
$m = new RegisterForm($form, array(1, 2, 3));

$m->make();
$step = $m->getCurrentStep();


$vars["step"] = $step;
$vars["m"] = $m;
$vars["form"] = $form;

if ($m->getProcess()) {
  $vars["username"] = $form->formData["username"];
  }

$p = new MainPage($site, 'Inregistrare');
echo $p->output('register.tpl.php', $vars);

?>