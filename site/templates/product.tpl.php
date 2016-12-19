<?php
if (empty($data))   {
  echo 'Informatiile produsului nu au fost gasite in baza de date !';

 } else {
  $d = $data;
?>

<?php
   echo $form->begin();  
  echo  $form->hidden('productId', $d["productId"]); 
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
   <td width="1" align="center"><img class="imgLarge" src="products/<?=$d["picLarge"]?>" border="0">
   <br /><br />
<?php 
    echo '<div style="float: left;">' . $form->outputErrors() . '</div><br style="clear:both" />';
    if(isset($_SESSION['uid'])) {
        echo '<div class="labelQty">Cantitate</div>';
        echo $form->text('qty', ' class="qtyInput" ', 1);
        echo $form->buttonImage('addToCart', 'img/add-to-cart.gif', ' class="addToCart" ');
    }
?>
   </td>
   <td valign="top" align="left">
   <div class="productName"><?=$d["productName"]?></div> <br /><br />
   <div class="productDesc"><?=nl2br($d["productDesc"])?></div>
    </td>
</tr>
</table>
<?php  echo $form->end();   ?>
<?php
} /// else if data
?>       