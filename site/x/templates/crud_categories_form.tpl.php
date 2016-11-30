<?php echo $form->begin(); ?>

<?php echo  $form->outputErrors(); ?>
<table border="0" cellspacing="0" cellpadding="3">
<tr>
  <td>Nume categorie</td>
  <td><?php echo  $form->text('catName'); ?></td>
</tr>
<tr>
  <td>Numar ordine</td>
  <td><?php echo  $form->text('sortOrder'); ?></td>
</tr>
<tr>
  <td></td>
  <td><?php echo  $form->button('b','Trimite');  ?></td>
</tr>
</table>

<?php echo $form->end(); ?>
