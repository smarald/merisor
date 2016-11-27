<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class FrontSite extends MySite  {
  

  function checkLogin()
  {
    $login = new FrontLogin('site', 7200, '/', $this->config["session_path"]);
    $this->login = $login;
  }


  protected function doConfig()
  {

    $this->config["os_user"] = 'razvan';
    $this->config["domain"] = 'merisor.ro';
    $this->config["host"] = 'www.' . $this->config["domain"];
    $this->config["url"] = 'http://' . $this->config["host"] . '/';

    if ($this->isOnline()) {
      $this->debug = 0;
      $this->config['fs_site'] = $fs_site = '/home/'.$this->config["os_user"].'/public_html/';
      $this->config["ws_site"] = $ws_site = '/';
      $this->config["db_host"] = 'localhost';
      $this->config["db_user"] = 'root';
      $this->config["db_pass"] = '';
      $this->config["db_name"] = 'merisor';

    } else {
      if (!isset($this->debug))    $this->debug = 1;

      $this->config['fs_site'] = $fs_site = 'c:/Ampps/www/merisor/site/';
      $this->config["ws_site"] = $ws_site = 'merisor/site/'; // calea din url ce urmeaza dupa domeniu . ex: http://localhost/laptops/site/ va avea ws_site = /laptops/site/
      $this->config["db_host"] = 'localhost';
      $this->config["db_user"] = 'root';
      $this->config["db_pass"] = 'mysql';
      $this->config["db_name"] = 'merisor';

    }

    $this->config['session_path'] = $fs_site . '../sessions/';
    $this->config['ws_products'] = $ws_site . 'products/';
    $this->config['fs_products'] = $fs_site . 'products/';
    $this->config['ws_workshops'] = $ws_site . 'workshops/';
    $this->config['fs_workshops'] = $fs_site . 'workshops/';
    $this->config["error_log1"] = $fs_site . '../logs/error_log1.txt';
    $this->config["error_log2"] = $fs_site . '../logs/error_log2.txt';
    $this->config['fs_templates'] = $fs_site . 'templates/';
    $this->config['fs_x_templates'] = $fs_site . 'x/templates/';

  } /// doConfig()




}



?>