<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class MyErrorException extends ErrorException
{

  public static $errorLog1;
  public static $errorLog2;
  public static $debug;

  // construiesc un array, cu cateva parti distincte ale mesajului de eroare
  static function errorPieces($errno, $errstr, $errfile, $errline, $errcontext = '')
  {
    $msg = array();

    $firstPart =   '[' . $errno . ']'; // nr erorii intre []
    $firstPart .= "\t";  // adaugam un tab
    $firstPart .= '{' . $errstr . '}';
 
    $secondPart = '(' . $errfile . ' - ' . $errline . ')';
    $msg[0] = date('d M Y H:i:s');
    $msg[1] = $firstPart;
    $msg[2] = $secondPart;
 
    return $msg;
  }
 
  // unesc  partile mesajului de eroare astfel incat sa aiba caracterul TAB (\t) intre ele, apoi adaug newline, pentru a obtine mesajul complet de eroare
  static function fullErrorMsg($errorPieces)
  {
    $msgLog = join("\t", $errorPieces);
    $msgLog .= "\n";
    return $msgLog;
  }
 
  function doError()
  {
    $stopScript = 0;
    $whiteMessage = 'An error occured. We have been notified';

    $errorPieces = self::errorPieces($this->getSeverity(), $this->getMessage(), $this->getFile(), $this->getLine());
    $userMessage = $errorPieces[1];
    $msgLog = self::fullErrorMsg($errorPieces);

    switch ($this->getSeverity()) {

    case E_USER_ERROR:
      echo '<br />';
      echo "<b>My ERROR</b><br />";
      echo $userMessage . '<br />';
      echo "Script terminated<br />";
      $stopScript = 1; // eroare grava. vreau sa ma opresc. dar nu inca
      break;
 
    case E_USER_WARNING:
      echo '<br />';
      echo '<b>My WARNING</b><br />';
      echo $userMessage . '<br />';
      break;
 
    case E_USER_NOTICE:
      echo '<br />';
      echo '<b>My NOTICE</b><br />';
      echo $userMessage . '<br />';
      break;
 

    } /// switch


    if (self::$debug) {

      switch ($this->getSeverity()) {
      case E_NOTICE:
	echo '<br />';
	echo '<b>NOTICE</b><br />';
	echo $msgLog . '<br />';
	break;
 
      case E_WARNING:
	echo '<br />';
	echo '<b>WARNING</b><br />';
	echo $msgLog . '<br />';
	break;
 
      default:
	echo '<br />';
	echo '<b>Unknown error</b><br />';
	echo $msgLog . '<br />';
	if (function_exists('xdebug_print_function_stack')) {
	  //	  xdebug_print_function_stack();
	  //var_dump(debug_backtrace());
	}
	break;
      }

    }  else {
      switch ($this->getSeverity()) {
      case E_NOTICE:
	break;

      case E_WARNING:
	echo '<br />';
	echo '<b>WARNING</b><br />';
	echo  $whiteMessage . '<br />';
	break;
 
      default:
	echo '<br />';
	echo '<b>Unknown error</b><br />';
	echo $whiteMessage;
	break;
      }
      
    }

    self::logError(self::$errorLog1, $msgLog);  // scriu mesajul erorii in fisierul definit in $error_log_file1
    if ($stopScript) {
      die(); // in caz ca $stopScript e true,  ma opresc.
    }
 

    /* Don't execute PHP internal error handler */
    return true;


  } /// doError()


  static  function logError($file, $message)
  {
    file_put_contents($file, $message, FILE_APPEND); 
  }


  static  function shutdown(){
    $isError = false;
 
    if ($error = error_get_last()) {
      switch($error['type']){
      case E_ERROR:
      case E_CORE_ERROR:
      case E_COMPILE_ERROR:
      case E_USER_ERROR:
	$isError = true;
	break;
      }
    }
 
    if ($isError){
 
      $errno = $error["type"];
      $errstr = $error["message"];
      $errline = $error["line"];
      $errfile = $error["file"];
 
      $errorPieces = self::errorPieces($errno, $errstr, $errfile, $errline);
      $msgLog = self::fullErrorMsg($errorPieces);
 
      /*
       directorul curent se schimba in functia definita cu register_shutdown_function(). (vezi manual). Adica, avem nevoie sa folosim cai absolute ($errorLog1), nu relative.
      */
      self::logError(self::$errorLog1, $msgLog);
 
      die('A nasty error occured. We have been notified.');
    } else {
      //    echo "Script completed";
    }
  } /// shutdown
 



} /// class MyErrorException

?>