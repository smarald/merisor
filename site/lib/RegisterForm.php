<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class RegisterForm extends MultiStepForm {
  


  function loadState()
  {
    parent::loadState();

    if (empty($this->form->formData["bFirstName"]) && !empty($this->form->formData["firstName"])) 
      $this->form->formData["bFirstName"] = $this->form->formData["firstName"];

    if (empty($this->form->formData["bLastName"])  && !empty($this->form->formData["lastName"])) 
      $this->form->formData["bLastName"] = $this->form->formData["lastName"];


  }

  function process()
  {
    parent::process();

    $u = new Users();
    $uid = $u->doData($this->form->formData);

    $this->form->formData["uid"] = $uid;

  }


  function validate()
  {

    $d = $this->form->formData;
    $f = $this->form;

    $min_user = LoginForm::minUsername;
    $max_user = LoginForm::maxUsername;
    $min_pass = LoginForm::minPass;
    $max_pass = LoginForm::maxPass;

    switch ($this->getCurrentStep()) {


    case 1:

      if (!MyValidation::checkLen($d["username"], array($min_user, $max_user))) {
	$f->errors["username"] = 'Numele de utilizator trebuie sa aiba intre '.$min_user.' si '.$max_user.' caractere';
      } elseif (!MyValidation::checkUsername($d["username"])) {
	$f->errors["username"] = 'Numele de utilizator contine caractere invalide';
      }

      $u = new Users();      
      $userExists = $u->countRows('username="'.$d["username"] . '"');

      if ($userExists) {
	$f->errors["username"] = 'Numele de utilizator exista deja in baza de date';
      }

      if (!MyValidation::checkLen($d["pass"], array($min_pass,$max_pass))) {
	$f->errors["pass"] = 'Parola trebuie sa aiba intre '.$min_pass.' si '.$max_pass.' caractere';
      }


      if (!MyValidation::checkPhone($d["phone"])) {
	$f->errors["phone"] = 'Telefon incorect';
      }

      if (!MyValidation::checkEmail($d["email"])) {
	$f->errors["email"] = 'Email incorect';
      }


      if (!MyValidation::checkName($d["firstName"])) {
	$f->errors["firstName"] = 'Prenume incorect';
      }

      if (!MyValidation::checkName($d["lastName"])) {
	$f->errors["lastName"] = 'Nume incorect';
      }

      break;


    case 2:

      if (!MyValidation::checkName($d["bFirstName"])) {
	$f->errors["bFirstName"] = 'Prenume incorect';
      }

      if (!MyValidation::checkName($d["bLastName"])) {
	$f->errors["bLastName"] = 'Nume incorect';
      }

      if (!MyValidation::checkCnp($d["cnp"])) {
	$f->errors["cnp"] = 'Cnp incorect';
      }

      break;

    } /// end switch


    if ($this->getCurrentStep() == 2 or $this->getCurrentStep() == 3) {

      if (!MyValidation::checkAddress($d["address"])) {
	$f->errors["address"] = 'Adresa incorecta';
      }


      if (!MyValidation::checkCity($d["city"])) {
	$f->errors["city"] = 'Oras incorect';
      }


      if (!MyValidation::checkCity($d["county"])) {
	$f->errors["county"] = 'Judet incorect';
      }

      
    }



  } /// validate



  function getNextStep()
  {
    if ($this->getCurrentStep() == 1) {
      if (isset($this->form->formData["billingType"]) && $this->form->formData["billingType"] == 'pf') return 2;
      else return 3;
    }
  }


  function getPrevStep()
  {
    if ($this->getCurrentStep() == 3 or $this->getCurrentStep() == 2) return 1;
  }


  function getButtonLabelProcess()
  {
    return 'Trimite date';
  }





  } /// RegisterForm

?>