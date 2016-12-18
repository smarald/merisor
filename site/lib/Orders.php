<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class Orders extends MyTable {

  const VAT_RATE = 0.19;
  private $orderId;
  private $login;
  private $orderProduct;
  private $participateWorkshop;
  

  function __construct($login = null)
  {
    parent::__construct('orders');

    if (!empty($login)) {
      $this->checkLogin($login);
      $this->setCurrentOrderId();
    }

    $this->orderProduct = new Order_Products($this);
    $this->participateWorkshop = new Participate_Workshop($this);
    $this->login = $login;

  }

  function setOrderId($orderId)
  {
    $this->orderId = $orderId;
  }


  function countCurrentOp()
  {
    $count = $this->orderProduct->countCurrent();
    return $count;
  }



  function placeOrder($formData)
  {
    $odata = $this->getCurrentOrderData();
    if (!$this->orderId) throw new MyErrorException('this->orderId is empty');


    $updateData = array (
			 'orderValue' => $odata["totals"]["value"],
			 'orderVat' => $odata["totals"]["vat"],
			 'orderSent' => 1,
			 'dateAdded' => 'now()',
			 );
    $updateCondition = ' orderId = ' . $this->orderId;

    $this->doData($updateData, 'update', $updateCondition);
  }


  function hasVat()
  {
    return 1;
  }

  function getVatRate()
  {
    return self::VAT_RATE;
  }


  function getVatFrom($value)
  {
    $vat = $value * self::VAT_RATE;
    $vat= round($vat, 2);
    return $vat;
  }

  function setQty($productId, $qty)
  {
    if (!$this->orderId) throw new MyErrorException('No orderId to update');
    $this->orderProduct->setQty($this->orderId, $productId, $qty);
  }


  function updateQty($productId, $qty)
  {
    if (!$this->orderId) throw new MyErrorException('No orderId to update');
    $this->orderProduct->updateQty($this->orderId, $productId, $qty);
  }

  function getCurrentOrderData()
  {
    $opData = $this->getOpData($this->orderId);

    return $opData;
  }

  function getOpData($orderId)
  {
    return $this->orderProduct->getOpData($orderId);
  }


  function addOp($formData)
  {
    $this->orderProduct->add($formData['productId'], $formData['qty']);
  }

  function participateWorkshop($formData)
  {
    $userId = $_SESSION['uid'];
    $workshopId = $formData['workshopId'];
    $this->participateWorkshop->add($userId, $workshopId);
  }

  function checkLogin($login)
  {
    if (!$login->isLogged()) {
      throw new MyErrorException('Trebuie sa fii logat');
    }
  }

  function initOrder()
  {
    $d = array('uid' => $_SESSION['uid'], 'orderValue' => 0, 'orderSent' => 0);
    $id = $this->doData($d);
    return $id;
  }

  function getOrderId()
  {
    return $this->orderId;
  }

  function setCurrentOrderId($create = true)
  {
    $data = $this->fetchSingle('orderSent = 0 AND uid='.$_SESSION['uid'].'');
    if (!empty($data)) $orderId = $data["orderId"];
    else {
      $orderId = $this->initOrder();
    }

    $this->orderId = $orderId;
  }


  function delete($orderId)
  {

    $orderId = (int)($orderId);
    if (!$orderId) return;

    $sql = ' DELETE FROM order_products WHERE orderId = ' .$orderId;
    self::$db->query($sql);

    return parent::delete($orderId);
  }


  function doData($data, $action = 'insert', $parameters = '')
  {
    if ($action == 'insert') {
      $data["dateAdded"] = 'now()';
    }

    return parent::doData($data, $action, $parameters);
  }



  function getListByUser($uid)
  {
    $sql = 'select * from orders where uid = '.$uid.' and orderSent = 1 order by dateAdded desc ';
    $data =  $this->fetchAll($sql);
    return $data;
  }


  function getTotalByUser($uid)
  {
    $sql = ' select sum(orderValue) from orders where uid='.$uid.' and orderSent = 1';
    $res = self::$db->query($sql);
    $d = $res->fetch_array();
    return $d[0];
  }

}



?>