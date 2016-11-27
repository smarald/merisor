<?php

$menu = array (


	       array (
		      'label' => 'Categorii',
		      'lk' => 'categories.php',
		      ),


	       array (
		      'label' => 'Produse',
		      'lk' => 'products.php',
		      ),


	       array (
		      'label' => 'Cauta utilizator',
		      'lk' => 'users.php',
		      ),


	       array (
		      'label' => 'Comenzi',
		      'lk' => 'orders.php',
		      ),



	       array (
		      'label' => 'Logout',
		      'lk' => 'logout.php',
		      ),

	       );

$s = '';
foreach ($menu as $m) {
  $sy = '';
  $s .= '<a class="lkMenu" ' . $sy . ' href="' . $m["lk"] . '">'.$m["label"].'</a>';
}
?>


<div id="menu"><?php echo  $s ?></div>