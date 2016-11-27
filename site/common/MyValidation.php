<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class MyValidation {
  
  function __construct()
  {

  }

  static  function check($regex, $str)
  {

    if (preg_match($regex . 'i', $str)) {
      return 1;
    } else {
      return 0;
    }

  }

  static function checkLen($s, $a)
  {
    $min = $a[0];
    $max = $a[1];

    if (strlen($s) < $min or strlen($s) > $max) return 0;
    else return 1;
  }


  static function checkForQuotes($str)
  {
    $str = urldecode($str);
    $pattern = '/[\'"]/';
    return self::check($pattern, $str);
  }



  static function checkUsername($str)
  {
    $pattern = '/^[a-zA-Z_0-9]{3,10}$/';
    return self::check($pattern, $str);
  }


  static function checkPassword($str) {
    $pattern = '/^.{5,30}$/';
    return self::check($pattern, $str);
  }


  static function checkEmail($str) {

    $pattern = '/[-._a-z0-9]+@[-.a-z0-9]+\.[a-z]{2,4}/';

//    $pattern = '/^((\"[^\"\f\n\r\t\v\b]+\")|([\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+(\.[\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+)*))@((\[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\])|(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))$/'; // varianta PEAR pentru validarea emailului (din HTML_QuickForm)

    return self::check($pattern, $str);
  }


  static function checkCompany($str) 
  {
    $pattern = '/^.{2,75}$/';
    return self::check($pattern, $str);
  }



  static function checkRegNumber($str) 
  {
    $pattern = '/^J.{10,18}$/';
    return self::check($pattern, $str);
  }


  static function checkFiscalCode($str) 
  {
    $pattern = '/^(RO){0,1}\s*\d{4,12}$/';
    return self::check($pattern, $str);
  }


  static function checkBank($str) 
  {
    $pattern = '/^[-.a-z0-9&]{5,20}$/';
    return self::check($pattern, $str);
  }


  static function checkBankBranch($str) 
  {
    $pattern = '/^[-.a-z0-9&,]{5,20}$/';
    return self::check($pattern, $str);
  }


  static function checkIban($str) 
  {
    $pattern = '/^[a-z0-9]{24}$/';
    return self::check($pattern, $str);
  }


  static function checkName($str)
  {
    $pattern = '/^[a-zA-Z\-\s\']{2,40}$/';
    return self::check($pattern, $str);
  }


  static function checkPhone($str)
  {
    $pattern = '/^[0-9\s\-\+\.]{7,20}$/';
    return self::check($pattern, $str);
  }


  static function checkCnp($str)
  {
    $pattern = '/^[0-9]{13}$/';
    return self::check($pattern, $str);
  }


  static function checkAddress($str)
  {
    $pattern = '/^[0-9a-zA-Z\/\.\-\'\,\s]{10,120}$/';
    return self::check($pattern, $str);
  }

  static function checkCity($str)
  {
    $pattern = '/^[0-9a-zA-Z\s\-]{3,30}$/';
    return self::check($pattern, $str);
  }


  } /// MyValidation




?>