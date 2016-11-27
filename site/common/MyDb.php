<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

class MyDb {

  public $mysqli;
  static $instance;  


  private function __construct()
  {

  }


  static function getInstance() {

    if ( empty( self::$instance ) ) {

      self::$instance = new MyDb();

    }

    return self::$instance;

  } // getInstance
  

  public function prepare($s) {
    $s = mysqli_real_escape_string($this->mysqli, $s);
    return $s;  
  }



  function connect($db_host, $db_user, $db_pass, $db_name)
  {
    $mysqli = @new MySQLi($db_host, $db_user, $db_pass, $db_name);

    if (!$mysqli) {
      throw new MyException(mysqli_connect_error());
    }

    $this->mysqli = $mysqli;
    
  }

  function query($sql)
  {
    $mysqli = $this->mysqli;

    $result = $mysqli->query($sql);

    if (!$result) {
      throw new MyErrorException($mysqli->error, 1);
    }

    return $result;
  }
  } /// class Mydb

?>