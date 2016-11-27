<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("../lib/start.php");
$site->start();

$table = new Categories();

$form = new CatsForm();
$form->setTable($table);

$crud = new MyCrud($form);
$crud->setDisplaySql('select * from categories order by sortOrder asc');
$crud->setDisplayCols(array('catName', 'sortOrder'));
$crud->go();


$p = new XPage($site);
echo $p->output($crud->getTemplate(), $crud->getTemplateVars());
?>