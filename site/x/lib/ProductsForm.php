<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class ProductsForm extends MyForm {
  function __construct()
  {
    parent::__construct('products', 'post');
    $this->prepareForUpload();

    $cats = new Categories();
    $catsList = $cats->getList();

    $this->setInitData('catId', $catsList);

  }

  function validate($action='')
  {
    global $site;

    if (empty($this->formData["productName"])) 
	$this->errors["productName"] = 'Completeaza numele produsului';

    if (empty($this->formData["price"])) 
	$this->errors["price"] = 'Completeaza pretul produsului';

    $upload = new MyUpload($site["fs_products"]);

    $mimeTypes = array('image/gif', 'image/jpeg', 'image/png');
    $maxSize = 1000 * 500;

    if ($action == 'insert') $required = 1;
    else $required = 0;

    $upload->addFile('picSmall', $required, $mimeTypes, $maxSize);
    $upload->addFile('picLarge', $required, $mimeTypes, $maxSize);

    $upload->doUpload(1);

    if ($upload->hasErrors()) {
      $this->errors['upload'] = $upload->outputError('other');
      $this->errors["picSmall"] =  $upload->outputError("picSmall");
      $this->errors["picLarge"] = $upload->outputError("picLarge");
    } else {

	$this->formData["picSmall"]  = $upload->getUploadedName('picSmall');	  
	$this->formData["picLarge"]  = $upload->getUploadedName('picLarge');	  

	if (empty($this->formData["picSmall"])) unset($this->formData["picSmall"]);
	if (empty($this->formData["picLarge"])) unset($this->formData["picLarge"]);

    }
  } /// validate();
}
?>