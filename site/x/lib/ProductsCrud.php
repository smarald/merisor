<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class ProductsCrud extends MyCrud {
  


  function prepareForDisplay($data)
  {
    global $site;

    if (empty($data)) return;

    foreach ($data as $d => &$row) {
      foreach ($row as $field => &$value) {
	if ($field == 'picSmall' or $field == 'picLarge') {
	  $src = $site["ws_products"] . $value;
	  $value = '<img src="'.$src.'" border="0" alt="" />';
	}

	if ($field == 'productDesc') {
	  $value = nl2br($value);
	}
      }
    } /// outer foreach

    return $data;


  } /// prepare...


 }

?>