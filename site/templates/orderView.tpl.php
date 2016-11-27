<br /><br />

<?php if (!$countOp or $processed) {  ?>

  <?php if ($processed) {  ?>
Comanda Dvs a fost trimisa !
    <?php } else {  ?>
Nu sunt produse pentru comanda curenta.
    <?php }  ?>

  <?php }  else { ?>
<?php echo  $form->begin(); ?>
<table class="tdata">
<tr>
  <td>Nr</td>
  <td>Produs/Serviciu</td>
  <td>Cantitate</td>
  <td>Pret unitar <br />
  (fara TVA)
  </td>
<td>Valoarea</td>
<td>Valoarea TVA</td>
</tr>


<?php
  $i = 0;
 foreach($odata["opData"] as $d) {  
  $i++;

?>
<tr>
<td><?php echo  $i ?></td>
<td><?php echo  $d["productName"] ?></td>
   <td align="center" nowrap = "nowrap" ><?php echo $form->text('qty['.$d["productId"].']', ' class="qtyInput"  ') ?>
   <?php echo  $form->outputError('qty[' . $d["productId"] . ']'); ?>

</td>
   <td align="right"><?php echo  $d["price"] ?></td>
   <td align="right"><?php echo  $d["value"] ?></td>
   <td align="right"><?php echo  $d["vatValue"] ?></td>
</tr>

<?php }  ?>

<tr>
<td colspan="4">&nbsp;</td>
<td align="right"><?php echo  $odata["totals"]["value"] ?></td>
<td align="right"><?php echo  $odata["totals"]["vat"] ?></td>
</tr>

<tr>
<td colspan="4">&nbsp;</td>
<td colspan="2" style="font-weight: bold" align="center"><?php echo  $odata["totals"]["total"] ?></td>
</tr>

<tr>
<td colspan="6" align="right">
   <?php echo  $form->button('btnUpdate', 'Actualizeaza', 'submit', 'class="orderButton"'); ?>
   <?php echo  $form->button('btnOrder', 'Trimite comanda', 'submit', 'class="orderFinalButton"'); ?>

</td>

</tr>

</table>
<?php echo  $form->end(); ?>

    <?php } /// else nu sunt produse  ?>