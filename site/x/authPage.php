<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

include("../lib/start.php");
$site->skipAuth(true);
$site->start();

$login = $site->login;

if ($login->isLogged()) redirect('index.php');
$form = $login->form;

echo $login->outputError('style="color: red"');


echo $form->begin();
?>

<table cellpadding="4">
<tr>
  <td>User</td>
  <td><?php echo  $form->text('username'); ?></td>
</tr>

<tr>
<td>Parola</td>
  <td><?php echo  $form->password('pass') ?></td>
</tr>

<tr>
<td></td>
  <td><?php echo  $form->button('btnSubmit', 'Login'); ?></td>
</tr>
</table>
<?php echo  $form->end(); ?>