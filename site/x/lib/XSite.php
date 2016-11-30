<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

class XSite extends FrontSite {
  private $skipAuth = false;
  function start()
  {
    parent::start();
  }

  function checkLogin()
  {
    $login = new XLogin('x', 7200, $this->config["ws_site"] . 'x/', $this->config["session_path"]);
    $this->login = $login;

    $this->authorize();
  }

  function skipAuth($b = false)
  {
    $this->skipAuth = $b;
  }

  function getSkipAuth()
  {
    return $this->skipAuth;
  }

  function authorize()
  {
    if (empty($this->login)) throw new MyErrorException('No login object for authorize in site class');

    if ($this->getSkipAuth()) return;

    return $this->login->authorize();
  }
}
?>