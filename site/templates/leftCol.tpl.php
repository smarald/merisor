<?php

function hasCart()
{
  return 0;
}

?>

<div id="leftCol">

<div class="title">Login</div>

<div class="box">
  <?php if (!$isLogged) {  ?>
<?php echo  $form->begin(); ?>
<table border="0" cellspacing="0" width="100%">
<tr>
	<td ><br /><?php echo  $error ?></td>
</tr>
<tr>
  <td>Utilizator: </td>
  <td><?php echo  $form->text('username', ' class="loginInput" ') ?></td>
</tr>
<tr>
  <td>Parola: </td>
  <td><?php echo  $form->password('pass', ' class="loginInput" ') ?></td>
</tr>
<tr>
<td align="center"><input type="submit" name="btnSubmit" value="Login" class="button"></td>
</tr>
<tr>
<td align="right"><br /><br />
<a href="register.php">Inregistreaza-te</a>
</td>
</tr>
</table>
<?php echo  $form->end();  ?>


<?php } else {  ?>

  Esti logat ca: <b><?=$_SESSION['username']?></b> <br /><br />

<?php if ($countOp) {  ?>

<a href="orderView.php">Comanda curenta (<?php echo  $countOp ?>)</a> |

<?php }  ?>

<a href="logout.php">Logout</a>


<?php }  ?>



</div>


<div class="title">Categorii</div>

<div class="box">
<?php if (!empty($cats)) {  ?>

<ul class="brands">
<?php foreach ($cats as $catId => $c)  { ?>
<li><a href="catView.php?catId=<?=$catId?>"><?=$c?></a></li>
<?php }  ?>
</ul>

<?php }   else { ?>

Nu exista categorii definite.

<?php }  ?>

</div>

</div>