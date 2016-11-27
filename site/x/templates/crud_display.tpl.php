<?php

echo '<a href="'.$insertPage.'">Adauga inregistrare</a><br /><br />';

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
      if ($col == 'editLk')   echo '<td><a href="' . $d[$col] . '">Edit</a></td>';
      else if ($col == 'deleteLk') echo '<td><a href="' . $d[$col] . '">Delete</a></td>';
      else {
	echo '<td>' . $d[$col] . '</td>';
      }

    } /// inner foreach

    echo '</tr>';
  } /// outer foreach

  echo '</table>';


 } /// else if data

?>