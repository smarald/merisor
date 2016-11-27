<?php
if (empty($data))   {
  echo 'Informatiile workshop-ului nu au fost gasite in baza de date !';

 } else {
  $d = $data;
?>

<?php
   echo $form->begin();  
  echo  $form->hidden('workshopId', $d["workshopId"]);
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
   </td>
   <td width="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
   <td valign="top" align="left">
   <div class="workshopName"><?=$d["workshopName"]?></div> <br /><br />
   <div class="workshopDesc"><?=nl2br($d["workshopDesc"])?></div>
    </td>
</tr>
</table>
<?php  echo $form->end();   ?>
<?php
} /// else if data
?>       