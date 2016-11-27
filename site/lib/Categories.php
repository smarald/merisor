<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class Categories extends MyTable {
  

  function __construct()
  {
    parent::__construct('categories');
  }


  function getList()
  {
    $data = $this->fetchCol(self::getPkName(), 'catName', 'order by sortOrder asc');
    return $data;
  }



  function delete($pkValue)
  {
    $db = Categories::$db;
    $sql = ' select productId from products where catId = '.$pkValue;

    $res = $db->query($sql);

    try {

    if ($res->num_rows > 0) {
      while ($d = $res->fetch_assoc()) {
	$p = new Products();
	$p->delete($d["productId"]);
      }
    } /// if products

    parent::delete($pkValue);

    } catch (MyErrorException $e) {
      $msg =  'Categoria contine produse ce nu pot fi sterse: <br />';
      $msg .= $e->getMessage();
      die($msg);
    }


  } /// delete

}


?>