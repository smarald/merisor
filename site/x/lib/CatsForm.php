<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class CatsForm extends MyForm {
  
  function __construct()
  {
    parent::__construct('categories', 'get');
  }


  function validate($action = 'insert')
  {

    $f = $this->formData;
    $e = &$this->errors;
    $table = $this->table;

    if (empty($f["catName"])) {
	$e["catName"] = 'Completeaza categoria';
    } else {
      if ($action == 'insert') {
	$count = $table->countRows('catName="' . $f["catName"].'"');
	if ($count) $e["catName"] = 'Exista deja aceasta categorie';
      }
    }



  } /// validate


}


?>