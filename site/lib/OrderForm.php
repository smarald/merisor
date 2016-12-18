<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class OrderForm extends MyForm {
  private $processed;  
  private $order;

  function __construct()
  {
    $name = 'orderForm';
    $method = 'get';
    $action = 'orderView.php';

    parent::__construct($name, $method, $action);

  }

  function setOrder($order)
  {
    $this->order = $order;
  }


  function loadData($odata)
  {
    foreach ($odata["opData"] as $op) {
      $f["quantity"][$op["productId"]] = $op["quantity"];
    }
    $this->setFormData($f);
  }


  function process()
  {
    global $site;

    $login = $site->login;
    $formData = $this->formData;

    if (isset($formData["btnUpdate"])) {
      // just update
      foreach ($formData["qty"] as $productId => $eachQty) {
	try {
	$this->order->setQty($productId, $eachQty);	
	} catch (Exception $e) {
	  // silently fail
	}
      }


    } else {

      $this->processed = 1;
      $this->order->placeOrder($formData);
      redirect('orderView.php?processed=1');
    }



  }

  function getProcessed()
  {
    return $this->processed;
  }



  function validate()
  {
    foreach ($this->formData["qty"] as $productId => $qty) {
      $qty = (int)($qty);
      if (!$qty) $this->errors['qty['.$productId.']'] = '!eroare';
    }
  }





}



?>