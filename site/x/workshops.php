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

$table = new Workshops();
$form = new WorkshopsForm();
$form->setTable($table);

$crud = new WorkshopsCrud($form);
$sql = 'select w.* from workshops as w where 1';
$crud->setDisplaySql($sql);
$crud->setDisplayCols(array('workshopId', 'workshopName', 'workshopLocation', 'price','workshopDesc', 'date'));
$crud->go();

$p = new XPage($site);
echo $p->output($crud->getTemplate(), $crud->getTemplateVars());
?>