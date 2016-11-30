<?php echo $form->begin(); ?>

<?php echo  $form->outputErrors(); ?>
<table border="0" cellspacing="0" cellpadding="3">
<tr>
  <td>Nume workshop</td>
  <td><?php echo  $form->text('workshopName'); ?></td>
</tr>
<tr>
  <td>Locatie workshop</td>
  <td><?php echo  $form->text('workshopLocation'); ?></td>
</tr>
<tr>
  <td>Pret</td>
  <td><?php echo  $form->text('price'); ?></td>
</tr>
<tr>
  <td>Descriere</td>
  <td><?php echo  $form->textarea('workshopDesc', 80, 20); ?></td>
</tr>
<tr>
  <td>Data</td>
  <td><?php echo  $form->text('date', 80, 20); ?></td>
</tr>
<tr>
<td></td>
  <td><?php echo  $form->button('b','Trimite');  ?></td>
</tr>
</table>

<?php echo $form->end(); ?>
