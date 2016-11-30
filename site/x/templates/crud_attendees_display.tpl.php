<?php

if (empty($displayData)) {
  echo 'Nu exista inregistrari';
 }  else {


  echo '<table class="tdata">';
  echo '<tr>';
  foreach ($headData as $name) {
    echo '<th>'.$name.'</th>';
  }
  echo '</tr>';
  foreach ($displayData as $d) {
    foreach ($d as $col => $value) {
	echo '<td>' . $d[$col] . '</td>';

    } /// inner foreach

    echo '</tr>';
  } /// outer foreach

  echo '</table>';


 } /// else if data

?>