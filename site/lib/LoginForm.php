<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class LoginForm extends MyForm {
  const minUsername = 3;
  const maxUsername = 20;
  const minPass = 5;
  const maxPass = 30;
  
  function validate()
  {

    if (!$this->pushed()) return;

    $d = $this->formData;

    if (!MyValidation::checkLen($d["username"], array(self::minUsername, self::maxUsername))) {
      $this->errors["username"] = 'Username invalid';
    }


      if (!MyValidation::checkLen($d["pass"], array(self::minPass, self::maxPass))) {
      $this->errors["username"] = 'Parola invalida';
    }



  } /// validate



  }




?>