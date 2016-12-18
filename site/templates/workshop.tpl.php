<?php
if (empty($data))   {
  echo 'Informatiile workshop-ului nu au fost gasite in baza de date !';

 } else {
  $workshop = $data;
?>

<?php
   echo $form->begin();  
  echo  $form->hidden('workshopId', $workshop["workshopId"]);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="0">
        <input type="hidden" id='workshopId' value="<?=$workshop["workshopId"]?>" />
    </td>
    <td>
        <div class="workshopName"><?=$workshop["workshopName"]?></div>
    </td>
    <td>
        <div class="workshopDesc"><?=nl2br($workshop["workshopDesc"])?></div>
    </td>
    <td>
        <div class="workshopLocation"><?=$workshop["workshopLocation"]?></div>
    </td>
    <td>
        <div class="workshopPrice"><?=$workshop["price"]?></div>
    </td>
    <td>
        <div class="workshopDate"><?=$workshop["date"]?></div>
    </td>
    <td>
        <?php
        echo '<div style="float: left;">' . $form->outputErrors() . '</div><br style="clear:both" />';

        echo '<div class="labelQty">Participa</div>';
        echo   $form->buttonImage('addToCart', 'img/add-to-cart.gif', ' class="addToCart" ');

        ?>
    </td>
</tr>
</table>
<?php  echo $form->end();   ?>
<?php
} /// else if data
?>       