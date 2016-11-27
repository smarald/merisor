<?php
$menu = array (


	       array (
		      'label' => 'Acasa',
		      'lk' => 'index.php',
		      ),

	       array (
		      'label' => 'Despre Noi',
		      'lk' => 'about.php',
		      ),

	       array (
		      'label' => 'Contact',
		      'lk' => 'contact.php',
		      ),

	       );


$menuRegister =    array (
			  array (
				 'label' => 'Inregistreaza-te',
				 'lk' => 'register.php',
				 )
			  );


if (!$isLogged)   $menu = array_merge($menu, $menuRegister);
?>


<div id="menu">
<?php foreach ($menu as $m) {  

    if ($m["lk"] == 'register.php') $sy = ' style="float:left;font-weight: bold;" ';
    else $sy = ' style="float: right" ' ;
?>
<a class="lkMenu" <?php echo  $sy ?> href="<?php echo $m["lk"]?>"><?php echo $m["label"]?></a>
<?php }  ?>
<br style="clear:both" />
</div>