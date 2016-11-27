<?php echo  $userDetails; ?>


<br /><br />
<h4>Comenzi</h4>


<?php if (!empty($ordersData)) {  ?>
<table class="tdata">
<?php 
foreach ($ordersData as $o) {
?>

<tr>
       <td><a href="orderDetails.php?orderId=<?php echo  $o["orderId"] ?>">Detalii comanda</a></td>
      <td><?php echo  db2Display($o["dateAdded"]) ?></td>
      <td align="right"><?php echo  moneyDisplay($o['orderValue'], 'RON'); ?></td>


</tr>

<?php }  ?>

<tr>
<td colspan="2" align="right"><b>Total</b></td>
<td align="right"><b><?php echo  $ordersTotal ?></b></td>

</tr>
</table>

   <?php } else {  ?>

Nu exista comenzi pentru acest utilizator.
    <?php }  ?>