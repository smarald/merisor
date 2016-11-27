<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("../lib/start.php");
$site->start();

$table = new Workshops();

$form = new WorkshopsForm();
$form->setTable($table);

$crud = new WorkshopsCrud($form);
$sql = 'select count(wa.catName) as number_attendees, w.*
from 
workshops w
inner join workshop_attend as wa on w.workshopId = wa.workshopId
order by productName asc';
$crud->setDisplaySql($sql);
$crud->setDisplayCols(array('workshopName', 'workshopDesc', 'workshopLocation', 'price', 'data', 'number_attendees'));
$crud->go();


$p = new XPage($site);
echo $p->output($crud->getTemplate(), $crud->getTemplateVars());
?>