<?php echo $form->begin(); ?>

<?php echo  $form->outputErrors(); ?>
<table border="0" cellspacing="0" cellpadding="3">
<tr>
  <td>Nume produs</td>
  <td><?php echo  $form->text('productName'); ?></td>
</tr>
<tr>
  <td>Categorie</td>
  <td><?php echo  $form->select('catId'); ?></td>
</tr>
<tr>
  <td>Pret</td>
  <td><?php echo  $form->text('price'); ?></td>
</tr>
<tr>
  <td>Descriere</td>
  <td><?php echo  $form->textarea('productDesc', 80, 20); ?></td>
</tr>
<tr>
  <td>Poza mica</td>
  <td><?php echo  $form->upload('picSmall'); ?> <?php echo  $form->outputError('picSmall') ?></td>
</tr>
<tr>
  <td>Poza mare</td>
  <td><?php echo  $form->upload('picLarge'); ?><?php echo  $form->outputError('picLarge') ?></td>
</tr>
<tr>
<td></td>
  <td><?php echo  $form->button('b','Trimite');  ?></td>
</tr>
</table>

<?php echo $form->end(); ?>
