<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class XPage extends MyPage {
  

  function __construct($site, $title = '')
  {
    $fsTemplates = $site["fs_x_templates"];
    parent::__construct($site, $title, $fsTemplates);

  }


  function output($tpName, array $vars = null)
  {
    if (!isset($vars)) $vars = array();
    if (!isset($this->vars)) $this->vars = array();

    $vars = array_merge($vars, $this->vars);


    $varsMainSite["content"] = $this->fetch($tpName, $vars);
    $varsMainSite["menu"] = $this->fetch('menu.tpl.php');
    $outputMainSite = $this->fetch('mainsite.tpl.php', $varsMainSite);

    $varsOuter["body"] = $outputMainSite;
    $varsOuter["jsFiles"] = $this->getJsFiles();
    $varsOuter["cssFiles"] = $this->getCssFiles();
    $varsOuter["title"] = $this->title;

    $outputOuter = $this->fetch('outer.tpl.php', $varsOuter);

    return $outputOuter;

  }



}



?>