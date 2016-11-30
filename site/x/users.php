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

$form = new MyForm('usersSearch', 'get');
$vars["form"] = $form;


if ($form->pushed()) {
  $q = $form->formData["q"];

  $u = new Users;

$sql = 'select * from users where 
username LIKE "%'.$q.'%" 
OR  firstName LIKE "%'.$q.'%" 
OR  lastName LIKE "%'.$q.'%" 

order by dateAdded desc';

$data =  $u->fetchAll($sql);

$vars["data"] = $data;

 } /// if form pushed




$p = new XPage($site);
echo $p->output('users.tpl.php', $vars);

?>