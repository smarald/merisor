<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class QtyForm extends MyForm {
  

  function __construct()
  {
    $name = 'qtyForm';
    $method = 'get';
    $action = 'product.php';

    parent::__construct($name, $method, $action);

  }


  function process()
  {
    global $site;

    $login = $site->login;
    $x = new Orders($login);
    $x->addOp($this->formData);
    redirect('orderView.php');

  }

  function validate()
  {
    $qty = (int)($this->formData["qty"]);

    if (!$qty) $this->errors["qty"] = 'Completeaza cantitatea';
  }



}


?>