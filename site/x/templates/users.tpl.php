<?php echo  $form->begin() ?>

  Cauta utilizator: <?php echo  $form->text('q'); ?>
 <?php echo  $form->button('search', 'Cauta') ?>
<br /><br />

<?php if (!empty($data)) {  ?>

<table class="tdata">
<?php foreach ($data as $d) {  

      if ($d["billingType"] == 'pf') $billing = 'Persoana fizica';
      else $billing = 'Firma';
?>

<tr>
<td><a href="userPage.php?uid=<?php echo  $d["uid"] ?>">Detalii complete</a></td>
<td><?php echo  $d["username"] ?></td>
<td><?php echo  $d["firstName"] ?></td>
<td><?php echo  $d["lastName"] ?></td>
<td><?php echo  $d["phone"] ?></td>
<td><?php echo  $d["email"] ?></td>
<td><?php echo  $billing ?></td>

</tr>



<?php }  ?>
</table>

<?php }  ?>


<?php echo  $form->end() ?>