<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class MyTp extends Template {
  
  function Mytp($fs) {
    return parent::Template($fs);
  }

  function setTemplatesPath($fs)
  {
    $this->templatesPath = $fs;
  }

  function tp($file, $vars = null)
  {
    if (isset($vars) && count($vars)) {
      foreach ($vars as $varName => $varValue) {
	$this->set($varName, $varValue);
      }
    }

    $piece = $this->fetch($file);
    return $piece;

   
  } /// tp



} /// class


?>