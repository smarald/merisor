<?php
if (empty($data))   {
  echo 'Lista de produse nu a fost gasita in baza de date !';

 } else {
  $products = $data;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <td></td>
            <td>Nume</td>
            <td>Descriere</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($products as $product): ?>
        <tr>
            <td align="center">
                <img class="imgLarge" src="products/<?=$product["picLarge"]?>" border="0">
            </td>
            <td>
                <div class="productName"><?=$product["productName"]?></div>
            </td>
            <td>
                <div class="productDesc"><?=nl2br($product["productDesc"])?></div>
            </td>
            <td>
                <a href="product.php?productId=<?= $product["productId"] ?>">Detalii</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php
}
?>