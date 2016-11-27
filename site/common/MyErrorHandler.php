<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class MyErrorHandler {
  private $debug;

  function __construct($debug)
  {
    $this->debug = $debug;
  }

  function init()
  {
    global $site;

    error_reporting(E_ALL & ~E_STRICT);

    require 'MyErrorException.php';
    MyErrorException::$errorLog1 = $site["error_log1"];
    MyErrorException::$errorLog2 = $site["error_log2"];
    MyErrorException::$debug = $this->debug;


    if ($this->debug) {
      ini_set('display_startup_errors', 'on'); 
      ini_set('display_errors', 'on');
      ini_set('log_errors', 'off');
    } else {
      ini_set('display_startup_errors', 'off'); 
      ini_set('display_errors', 'off');
      ini_set('log_errors', 'on');
      ini_set('error_log', MyErrorException::$errorLog2);
    }


    set_error_handler(array('MyErrorHandler', 'error_handler'), E_ALL); 
    set_exception_handler(array('MyErrorHandler', 'exception_handler'));
    register_shutdown_function(array('MyErrorException', 'shutdown'));


  } /// init()


  static function error_handler($errno, $errstr, $errfile, $errline) {
    $e = new MyErrorException($errstr, 0, $errno, $errfile, $errline);
    if ($errno != E_NOTICE) { 
      throw $e;
    } else {
      $e->doError(); 
    }
  } /// function error_handler


static function exception_handler($e) {
 
   if ($e instanceof MyErrorException) { // daca e o exceptie de tipul MyErrorException, apelam metoda doError() care afiseaza si logheaza
      $e->doError();

    } else { // altfel, este o exceptie diferita de MyErroException, si neprinsa pana acum, afisam un mesaj fara detalii pentru utilizator, si scriem in log
     echo 'Unexpected error';
     $errorPieces = MyErrorException::errorPieces($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
     $msgLog = MyErrorException::fullErrorMsg($errorPieces);
     MyErrorException::logError(MyErrorException::$errorLog1, $msgLog); 
    } /// end if

} /// exception handler



} /// class MyErrorHandler



?>