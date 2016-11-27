<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

class MainPage extends MyPage {
  
  function getHeader()
  {
    $s = $this->fetch('header.tpl.php');
    return $s;
  }


  function getMenu()
  {
    $login = $this->site->login;
    $vars["isLogged"] = $login->isLogged();

    $s = $this->fetch('menu.tpl.php', $vars);
    return $s;
  }



  function getLeftCol()
  {
    $ocats = new Categories('categories');
    $vars['categories'] = $ocats->getList();

    $login =& $this->site->login;

    $vars["isLogged"] = $login->isLogged();

    if (!$login->isLogged()) {
      $vars["form"] = $login->form;
      $vars["error"] = $login->outputError();
      $vars["countOp"] = 0;
    } else {
      $order = new Orders($login);
      $countOp = $order->countCurrentOp();
      $vars["countOp"] = $countOp;

    }

    $s = $this->fetch('leftCol.tpl.php', $vars);
    return $s;
  }


  function output($tpName, array $vars = null)
  {
    $this->addCss('css/global.css');

    if (!isset($vars)) $vars = array();
    if (!isset($this->vars)) $this->vars = array();

    $vars = array_merge($vars, $this->vars);

    $varsMainSite['header'] = $this->getHeader();
    $varsMainSite["leftCol"] = $this->getLeftCol();
    $varsMainSite["menu"] = $this->getMenu();
    $varsMainSite["footer"] = $this->fetch('footer.tpl.php');

    $varsMainSite["content"] = $this->fetch($tpName, $vars);

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