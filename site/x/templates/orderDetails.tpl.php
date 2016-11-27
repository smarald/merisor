<?php
echo $userDetails;
?>

<br /><br />

<a href="userPage.php?uid=<?php echo  $uid ?>">Pagina utilizator</a>

<br /><br />

<h4>Detalii comanda</h4>
<br />
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
   <td align="center"><?php echo  $d["qty"] ?></td>
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
</table>