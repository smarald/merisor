<?php
$s = '';

function myFormRow($label, $name, $formMethod = null)
{
  global $form;

  if (!empty($formMethod)) $method = $formMethod;
  else $method = 'text';

  $s = '';
   $s .= '<tr>';
   $s .= '<td width="150">'.$label.'</td>';
   $s .= '<td>' . $form->$method($name) . '</td>';
   $s .= '<td>' . $form->outputError($name) . '</td>';
   $s .= '</tr>';

   return $s;
}


if ($step) {

  $s .= $form->begin();
// echo '#debug: pasul: ' . $m->getCurrentStep() . ' <br />';
// echo $form->outputErrors();
 $s.= '<table class="tdata" border="0">';
  
}


switch ($step) {

 case 1:

   $s .= myFormRow('Username', 'username');
   $s .= myFormRow('Parola', 'pass', 'password');
   $s .= myFormRow('Prenume', 'firstName');
   $s .= myFormRow('Nume', 'lastName');
   $s .= myFormRow('Telefon', 'phone');
   $s .= myFormRow('Email', 'email');

   $s .= '<tr>';
   $s .= '<td>Forma juridica</td>';
   $s .= '<td nowrap = "nowrap">' . 
                    '<div class="labelJuridic">Persoana fizica</div> ' . $form->radio('billingType', 'pf') . ' <br /> ' .
                    '<div class="labelJuridic">Persoana juridica</div>' . $form->radio('billingType', 'pj') . 
             '</td>';
   $s .= '<td>' . $form->outputError('billingType') . '</td>';
   $s .= '</tr>';


   break;

 case 2:

   $s .= myFormRow('Prenume (facturare)', 'bFirstName');
   $s .= myFormRow('Nume (facturare)', 'bLastName');
   $s .= myFormRow('Cnp', 'cnp');
   $s .= myFormRow('Adresa', 'address');
   $s .= myFormRow('Oras', 'city');
   $s .= myFormRow('Judet', 'county');

   break;


 case 3:

   $s .= myFormRow('Nume firma', 'companyName');
   $s .= myFormRow('Nr inregistrare (J)', 'regNumber');
   $s .= myFormRow('Cod fiscal', 'fiscalCode');
   $s .= myFormRow('Banca', 'bank');
   $s .= myFormRow('Sucursala', 'bankBranch');
   $s .= myFormRow('IBAN', 'iban');
   $s .= myFormRow('Adresa', 'address');
   $s .= myFormRow('Oras', 'city');
   $s .= myFormRow('Judet', 'county');




   break;

}



if ($step) {
  $s .= '<td></td><td>'.$m->getPrevButton() . ' ' . $m->getNextButton() . '</td>';

  $s .=  '</table>';
  $s .=  $form->end();

  echo '<div class="title">Inregistrare</div><br /><br />';
  echo $s;


 }


if ($m->getProcess()) {
  echo 'Va multumim, ati fost inregistrat cu succes. Va puteti loga cu username: '.$username.' si parola completata la inscriere.';
}

?>