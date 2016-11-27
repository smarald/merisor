<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class FrontLogin extends MyLogin {
  

protected  function getLoginTable()
  {
    return 'users';
  }


protected  function getMainVar()
  {
    return 'uid';
  }

protected  function getVarsToSet()
  {
    return array('username', 'email');
  }




}



?>