<?php

if (count($data)) {

  echo '<table class="tdata">' . "\n";
  $i = 0;
  $colNo = 3;

  foreach ($data as $d) {
    $i++;
    $productPage = 'product.php?productId=' . $d["productId"];

    // echo the product list here  
    if ($i % $colNo == 1)  echo '<tr>' . "\n";
    echo '<td width="200" align="center">';
    echo '<a href="'.$productPage.'"><img src="products/'.$d["picSmall"].'" border="0"></a>';
    echo '<br />';
    echo '<div class="productName"><a class="productNameLk" href="'.$productPage.'">'.$d["productName"].'</a></div>';
    echo '</td>' . "\n";

    if ($i % $colNo == 0)    echo '</tr>' . "\n";

  } /// foreach


  if ($i % $colNo > 0) {

    $restOfCols = $colNo - ($i % $colNo);
    for ($j = 0; $j < $restOfCols; $j++) {
      echo "\n<td>&nbsp;</td>\n";
    }

  } /// if


  echo "\n</table>\n";

 } else {
  echo 'Nu sunt produse in baza de date pentru aceasta categorie';
 }



?>