<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("../lib/start.php");
$site->start();

$table = new Products();

$form = new ProductsForm();
$form->setTable($table);

$crud = new ProductsCrud($form);
$sql = 'select c.catName, p.*
from 
products p
inner join categories c on p.catId = c.catId
order by productName asc';
$crud->setDisplaySql($sql);
$crud->setDisplayCols(array('catName', 'productName', 'productDesc', 'picSmall', 'picLarge', 'price', 'color'));
$crud->go();


$p = new XPage($site);
echo $p->output($crud->getTemplate(), $crud->getTemplateVars());
?>