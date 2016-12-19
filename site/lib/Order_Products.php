<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class Order_Products extends MyTable {
  private $order;  


  function __construct($order)
  {
    parent::__construct('order_products');
    $this->order = $order;
  }

  function remove($opId)
  {
    if (empty($opId)) throw new MyErrorException('opId este empty. Nu se poate sterge');

    $sql = ' delete from order_products where id = '.$opId;
    self::$db->query($sql);
  }

  function computeValue($price, $quantity)
  {
    $x = $price * $quantity;
    $x = round($x, 2);
    return $x;
  }

  function getOpData($orderId)
  {
    $sql = 'select op.*, p.productName from order_products as op inner join products p ON op.productId = p.productId where orderId = '.$orderId;
    $res = self::$db->query($sql);
    $totals = array('vat' => 0, 'value' => '0', 'total' => 0);

    while ($d = $res->fetch_assoc()) {
      $opId = $d["orderId"];

      $opData[$opId] = $d;
      $opData[$opId]["value"] = $value = $this->computeValue($d["price"], $d["quantity"]);

      if ($this->order->hasVat()) {
	$opData[$opId]["vatValue"] = $vatValue = $this->order->getVatFrom($value);
	$totals["vat"] += $vatValue;
      }

      $totals["value"] += $value;
    }

    if ($this->order->hasVat()) {
      $totals["total"] = $totals["vat"] + $totals["value"];
    } else {
      $totals["total"] = $totals["value"];
    }

    if (empty($opData)) throw new MyErrorException('Nu exista produse pentru aceasta comanda. orderId ' . $orderId);

    $opAllData["opData"] = $opData;
    $opAllData["totals"] = $totals;

    return $opAllData;
  }


  function updateQty($orderId, $productId, $qty)
  {
    $data = $this->fetchSingle('orderId = '.$orderId.' AND productId = '.$productId);
    $currentQty = $data["qty"];
    $opId = $data["id"];

    $updatedQty = $currentQty + $qty;

    if ($updatedQty < 0) $updatedQty = 0;

    if ($updatedQty == 0) $this->remove($opId);
    else {
      $updateData = array('qty' => $updatedQty);
      $updateCondition = ' id = '.$opId;
      $this->doData($updateData, 'update', $updateCondition);
    }

  }


  function countCurrent()
  {
    $orderId = $this->order->getOrderId();
    if (empty($orderId)) throw new MyErrorException('No orderId to count current op');

    $count = $this->countRows('orderId = '.$orderId);
    return $count;
  }


  function setQty($orderId, $productId, $qty)
  {
    $qty = (int)($qty);
    $data = $this->fetchSingle('orderId = '.$orderId.' AND productId = '.$productId);
    $opId = $data["id"];

    if (empty($opId)) throw new MyErrorException('No opId to update');

    if ($qty <= 0) $this->remove($opId);

      $updateData = array('qty' => $qty);
      $updateCondition = ' id = '.$opId;
      $this->doData($updateData, 'update', $updateCondition);

  }


  function add($productId, $qty)
  {
    // qty
    $qty = (int)($qty);

    // productId
    $productId = (int)($productId);

    // orderId
    $orderId = $this->order->getOrderId();

    $count = $this->countRows('productId = ' . $productId.' AND orderId = '.$orderId);

    if ($count > 0) {
      $this->updateQty($orderId, $productId, $qty);
      return;
    }

    if ($qty < 1 or $qty > 99) $qty = 1;

    // price
    $product = new Products();
    $productData = $product->fetch($productId, 'price');
    $price = $productData["price"];
var_dump($price);die;
    $data = array (
		   'orderId' => $orderId,
		   'productId' => $productId,
		   'price' => $price,
		   'qty' => $qty,
		   );

    $this->doData($data);
  }


}



?>