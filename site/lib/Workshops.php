<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class Workshops extends MyTable {
  
  function __construct()
  {
    return parent::__construct('workshops');
  }

  function fetchList()
  {
    $d = $this->fetchAll('select * from workshops where 1');

    return $d;
  }

  function delete($workshopId)
  {
    parent::delete($workshopId);
  }

} /// class Workshops

?>