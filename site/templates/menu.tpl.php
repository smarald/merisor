<?php
$menu = array (

	       array (
		      'label' => 'Home',
		      'lk' => 'index.php',
		      ),

	       array (
		      'label' => 'Produse',
		      'lk' => 'products.php',
		      ),

	       array (
		      'label' => 'Workshops',
		      'lk' => 'workshops.php',
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

$menuProducts = array (
				array(
					'label' => 'Traditionale',
					'lk' => 'products.php?cat=1',
				),
				array(
					'label' => 'Indraznete',
					'lk' => 'products.php?cat=2',
				),
				array(
					'label' => 'Lejere',
					'lk' => 'products.php?cat=3',
				),
				array(
					'label' => 'Din alta poveste',
					'lk' => 'products.php?cat=4',
				),
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
	<?php if($m["lk"] == 'products.php'):?>
		<li>
			<a class="lkMenu" href="<?php echo $m["lk"]?>"><?php echo $m["label"]?></a>
			<ul class="dropdown">
			<?php foreach ($menuProducts as $menuProduct) {?>
				<li>
					<a class="lkMenu" href="<?php echo $menuProduct["lk"]?>"><?php echo $menuProduct["label"]?></a>
				</li>
			<?php } ?>
			</ul>
		</li>
	<?php else: ?>
		<li><a class="lkMenu" <?php echo  $sy ?> href="<?php echo $m["lk"]?>"><?php echo $m["label"]?></a> </li>
	<?php endif ?>
<?php }  ?>
	</ul>
<br style="clear:both" />
</div>