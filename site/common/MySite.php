<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

abstract class MySite implements ArrayAccess {

  protected $config;

  public $debug;
  public $login;

  function __construct()
  {

  }

  abstract protected  function doConfig();


  function setDebug($d)
  {
    $this->debug = $d;
  }


  private function handleErrors()
  {
    $eh = new MyErrorHandler($this->debug);
    $eh->init();
  }


  function start()
  {
    $this->doConfig();

    $this->handleErrors();

    $this->dbConnect();

    $this->checkLogin();

  } /// start()


  function isLogged()
  {
    return $this->login->isLogged();
  }

  function checkLogin()
  {
    $login = new MyLogin('site', 7200);
    $this->login = $login;
  }


  function dbConnect()
  {
    global $db;

    $cf = $this->config;
    $db = MyDb::getInstance();
    $db->connect($cf["db_host"], $cf["db_user"], $cf["db_pass"], $cf["db_name"]);
  }


  function isOnline()
  {
    if ($_SERVER['SERVER_NAME'] == $this->config["host"]) {
      return 1;
    } else {
      return 0;
    }

  } /// isOnline()


  /************************************* functii ArrayAccess *********************************************/

  function offsetExists($offset)
  {
    return array_key_exists($offset, $this->config);
  }
 

  function offsetUnset($offset)
  {
    unset($this->config[$offset]);
  }
 

  function offsetGet($offset)
  {
    return $this->config[$offset];
  }
 

  function offsetSet($offset, $value)
  {
    $this->config[$offset] = $value;
  }





  } /// end class MySite


?>