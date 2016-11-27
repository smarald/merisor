<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

function moneyDisplay($sum, $currency, $decimals=0) {
	return number_format($sum, $decimals, '.', '\'') .' '. $currency;

}


function rol2ron($sumRol) {
	$sumRon = (float)($sumRol/10000);
	$sumRon = round($sumRon, 2);
	return $sumRon;
}


?>
