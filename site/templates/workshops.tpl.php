<?php
if (empty($data))   {
  echo 'Informatiile produsului nu au fost gasite in baza de date !';

 } else {
  $workshops = $data;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <thead>
    <tr>
        <td></td>
        <td>Nume</td>
        <td>Descriere</td>
        <td>Locatie</td>
        <td>Pret</td>
        <td>Data</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($workshops as $workshop): ?>
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
                <a href="">Participa</a>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php
}
?>