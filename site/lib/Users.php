<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class Users extends MyTable {
  

  function __construct()
  {
    parent::__construct('users');
  }


  function doData($data, $action = 'insert', $parameters = '')
  {
    $data["pass"] = sha1($data["pass"]);

    if ($action == 'insert') {
      $data["dateAdded"] = 'now()';
    }

    return parent::doData($data, $action, $parameters);
  }


  function getFullData($uid)
  {
    $main = $this->fetchSingle('uid = '.$uid);


      $b = new MyTable('billingPerson');
      $billing = $b->fetchSingle('uid=' . $uid);

      $data["main"] = $main;
      $data["billing"] = $billing;

      return $data;
  }

}


?>