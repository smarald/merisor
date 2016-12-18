<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class Participate_Workshop extends MyTable {

  function __construct($order)
  {
    parent::__construct('workshop_attend');
    $this->order = $order;
  }

  function add($userId, $workshopId)
  {
    $data = array (
		   'userId' => $userId,
		   'workshopId' => $workshopId,
		   );

    $this->doData($data);
  }


}



?>