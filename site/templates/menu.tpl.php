<?php
$menu = array (

	       array (
		      'label' => 'Home',
		      'lk' => 'index.php',
		      ),

	       array (
		      'label' => 'Produse',
		      'lk' => 'product.php',
		      ),

	       array (
		      'label' => 'Workshops',
		      'lk' => 'workshop.php',
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
				 ),
			  array (
				 'label' => 'Login',
				 'lk' => 'login.php',
				 )
			  );

$menuLogout = array(
				array(
					'label' => 'Log out',
					'lk' => 'logout.php',
				)
			);


if (!$isLogged)   $menu = array_merge($menu, $menuRegister);
if ($isLogged)   $menu = array_merge($menu, $menuLogout);
?>

<div id="menu" class="navbar-default">
	<ul>
<?php foreach ($menu as $m) {

    if ($m["lk"] == 'register.php') $sy = ' style="float:left;font-weight: bold;" ';
    else $sy = ' style="float: right" ' ;
?>
		<li><a class="lkMenu" <?php echo  $sy ?> href="<?php echo $m["lk"]?>"><?php echo $m["label"]?></a> </li>

<?php }  ?>
	</ul>
<br style="clear:both" />
</div>