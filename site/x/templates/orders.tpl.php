<?php echo  $form->begin() ?>

  <b>Cauta comenzi</b>  <br /><br />
  Dupa data: <?php echo  $form->text('from'); ?> <br /><br />
  Pana in data: <?php echo  $form->text('to'); ?> <br /><br />
 <?php echo  $form->button('search', 'Cauta') ?>
<br /><br />

<?php if (!empty($data)) {  ?>

<table class="tdata">
<?php foreach ($data as $d) {  ?>

<tr>
<td><a href="orderDetails.php?orderId=<?php echo  $d["orderId"] ?>">Detalii complete</a></td>
<td><?php echo  $d["firstName"] .' ' . $d["lastName"] . '(' . $d["username"] . ')' ?></td>
      <td align="right"><?php echo  moneyDisplay($d["orderValue"], 'RON'); ?></td>
<td><?php echo  $d["dateAdded"] ?></td>
<td><a href="delete.php?action=orders&orderId=<?php echo  $d["orderId"] ?>">Delete</a></td>
</tr>
<?php }  ?>


<tr>
   <td colspan="2" align="right">Total valoare comenzi <br /> (fara tva):</td>
   <td align="right" style="font-weight: bold"><?php echo  moneyDisplay($total, 'RON'); ?></td>
   <td></td>
</tr>
</table>

<?php }  ?>


<?php echo  $form->end() ?>