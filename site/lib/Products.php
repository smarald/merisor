<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class Products extends MyTable {
  
  function __construct()
  {
    return parent::__construct('products');
  }



  function fetchList($catId)
  {
    $catId = (int)($catId);


    $d = $this->fetchAll('select * from products where catId = '.$catId);

    return $d;
  }


  function delete($productId)
  {
    global $site;

    $db = Products::$db;
    $sql = 'select productId, orderId from order_products where productId = ' . $productId;
    $res = $db->query($sql);

    if ($res->num_rows > 0) {
      $a = array();
      while ($d = $res->fetch_assoc()) {
	$a[] = $d["orderId"];
      }
      $orderIds = join(',', $a);
      throw new MyErrorException ('Produsul nu poate fi sters. Exista acest produs deja comandat in comenzile: ' .$orderIds);
    }

    $data = $this->fetchSingle('productId = ' . $productId, 'picSmall, picLarge');
    $path = $site["fs_products"];

    try {
    if (!empty($data["picSmall"])) unlink($path . $data["picSmall"]);
    if (!empty($data["picLarge"])) unlink($path . $data["picLarge"]);
    } catch (MyErrorException $e) {
      echo $e->getMessage();
    }

    parent::delete($productId);
  }




} /// class Products






?>