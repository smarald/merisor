<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/



class XLogin extends MyLogin {


protected  function getLoginTable()
  {
    return 'admins';
  }


protected  function getMainVar()
  {
    return 'adminId';
  }

protected  function getVarsToSet()
  {
    return array('username');
  }


  protected function redirectAfterLogin()
  {
    redirect('index.php');
  }

  
}

?>