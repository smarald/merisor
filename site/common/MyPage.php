<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


abstract class MyPage {

  protected $oTemplate;
  private $fsTemplates;
  private $vars;
  protected $site;
  private $cssFiles;
  private $jsFiles;


  function __construct($site, $title, $fsTemplates = null)
  {
    $this->site = $site;
    $this->setTitle($title);
    if (empty($fsTemplates)) {
      $fsTemplates = $site["fs_templates"];
    }
    $this->fsTemplates = $fsTemplates;
    $this->oTemplate = new Template($fsTemplates);
  }

  function setTitle($title) {
    $this->title = $title;    
  }

  function setVars($vars)
  {
    $this->vars = $vars;
  }

  function fetch($tpName, $vars = null)
  {
    $this->oTemplate->set_vars($vars);
    $html = $this->oTemplate->fetch($tpName);
    return $html;
  }

  function getJsFiles()
  {
    return $this->jsFiles;
  }

  function getCssFiles()
  {
    return $this->cssFiles;
  }


  function addCss($cssPath)
  {
    $this->cssFiles[] = $cssPath;
  }

  function addJs($jsPath)
  {
    $this->jsFiles[] = $jsPath;
  }


  abstract function output($tpName, array $vars = null);


  }  /// MyPage



?>