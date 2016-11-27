<?php
$main = $udata["main"];
$billing = $udata["billing"];
$billingType = 'Persoana fizica';

?>

<a href="javascript:history.go(-1)">inapoi</a>
<br /><br />

<h4>Date utilizator</h4>

<table class="tdata">
<tr>
    <td>Username</td>
    <td>Prenume</td>
    <td>Nume</td>
    <td>Tel.</td>
    <td>Email</td>
    <td>Adaugat la</td>
</tr>

<tr>
<td><?php echo  $main["username"] ?></td>
<td><?php echo  $main["firstName"] ?></td>
<td><?php echo  $main["lastName"] ?></td>
<td><?php echo  $main["phone"] ?></td>
<td><?php echo  $main["email"] ?></td>
<td><?php echo  $main["dateAdded"] ?></td>
</tr>
</table>

<br /><br />

  <h4>Date facturare (<?php echo $billingType ?>)</h4>


  <?php if ($main["billingType"]  == 'pf') {?>

<table class="tdata">
<tr>
    <td>Prenume</td>
    <td>Nume</td>
    <td>Adresa</td>
    <td>Oras</td>
    <td>Judet</td>
    <td>Cnp</td>
</tr>

<tr>
<td><?php echo  $billing["bFirstName"] ?></td>
<td><?php echo  $billing["bLastName"] ?></td>
<td><?php echo  $billing["address"] ?></td>
<td><?php echo  $billing["city"] ?></td>
<td><?php echo  $billing["county"] ?></td>
<td><?php echo  $billing["cnp"] ?></td>
</tr>
</table>


<?php } else {  ?>

<table class="tdata">
<tr>
    <td>Firma</td>
    <td>Nr. inregistrare</td>
    <td>Cod fiscal</td>
    <td>Banca</td>
    <td>IBAN</td>
    <td>Adresa</td>
    <td>Oras</td>
    <td>Judet</td>
</tr>

<tr>
<td><?php echo  $billing["companyName"] ?></td>
<td><?php echo  $billing["regNumber"] ?></td>
<td><?php echo  $billing["fiscalCode"] ?></td>

<td><?php echo  $billing["bank"] .' - ' .$billing["bankBranch"] ?></td>
<td><?php echo  $billing["iban"] ?></td>

<td><?php echo  $billing["address"] ?></td>
<td><?php echo  $billing["city"] ?></td>
<td><?php echo  $billing["county"] ?></td>
</tr>

</table>
<?php }  ?>