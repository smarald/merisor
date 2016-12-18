<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class ParticipateForm extends MyForm {
  

  function __construct()
  {
    $name = 'participateForm';
    $method = 'get';
    $action = 'workshop.php';

    parent::__construct($name, $method, $action);

  }


  function process()
  {
    global $site;

    $login = $site->login;
    $x = new Orders($login);
    $x->participateWorkshop($this->formData);
  }
}


?>