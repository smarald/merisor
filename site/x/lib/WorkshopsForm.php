<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class WorkshopsForm extends MyForm {
  
  
  function __construct()
  {
    parent::__construct('workshops', 'post');
    $this->prepareForUpload();

  }



  function validate($action='')
  {
    global $site;


    if (empty($this->formData["workshopName"]))
	$this->errors["workshopName"] = 'Completeaza numele workshop-ului';

    if (empty($this->formData["workshopLocation"]))
	$this->errors["workshopLocation"] = 'Completeaza locatia workshop-ului';

    if (empty($this->formData["workshopDescription"]))
	$this->errors["workshopDescription"] = 'Completeaza descrierea workshop-ului';

    if (empty($this->formData["price"])) 
	$this->errors["price"] = 'Completeaza pretul workshop-ului';

    if (empty($this->formData["date"]))
	$this->errors["date"] = 'Completeaza data workshop-ului';

  } /// validate();
}


?>