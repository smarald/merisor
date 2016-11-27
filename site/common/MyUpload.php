<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class MyUpload {
  private $myFiles;
  private $fsUpload;
  private $errors;
  private $standardErrors;
  private $uploadedFiles;

  function __construct($fsUpload)
  {
    $this->fsUpload = $fsUpload;
    $this->setStandardErrors();
  }

  function addFile($fieldName, $required, $mimeTypes, $maxSize)
  {
    $this->myFiles[$fieldName]["required"] = $required;
    $this->myFiles[$fieldName]["mimeTypes"] = $mimeTypes;
    $this->myFiles[$fieldName]["maxSize"] = $maxSize;
  }


  function getError($which)
  {
    if (isset($this->errors[$which]) && !empty($this->errors[$which])) return $this->errors[$which];

    return false;
  }

  function outputError($which)
  {
    if ($e = $this->getError($which)) {
      return $which . ' - ' . $e;
    }
    return false;

  }

  function hasErrors()
  {
    if (!empty($this->errors)) return true;
    else return false;
  }

  function setError($key, $error)
  {
    $this->errors[$key] = $error;
  }


  function doUpload($errorIfNoData = 1)
  {

    foreach ($this->myFiles as $field => $myFile) { // trecem prin fiecare camp de formular
 
      if (!isset($_FILES[$field])) {
	if ($myFile["required"]) $this->setError($field, 'Fisierul trebuie uploadat');
	continue;
      } 


      $fileData = $_FILES[$field];
 
      if ($fileData["error"]) { // daca e o eroare standard de upload, o scriem in $errors["nume_camp"]
	$errorNumber = $fileData["error"];
	
	if ($errorNumber == UPLOAD_ERR_NO_FILE && !$myFile["required"]) {
	  // nu e eroare, insa continuam cu urmatorul fisier
	  continue;
	} elseif ($errorNumber) {
	  $this->setError($field, $this->standardErrors[$errorNumber]);
	  continue;
	}

      } /// if $fileData["error"]


      // daca nu sunt erori, fac propriile verificari -> sa fie un mime type permis, si marimea fisierului sa nu fie mai mare de maxFileSize bytes
      if (!in_array($fileData["type"], $myFile["mimeTypes"])) {
	$this->setError($field, 'Extensie nepermisa');
	continue;
      }
 
      if ($fileData["size"] > $myFile["maxSize"]) {
	$this->setError($field, 'Fisierul este prea mare. Dimensiunea maxima este ' . ($myFile["maxSize"] / 1000) . ' KB ');
	continue;
      }
 
      // daca trece si de verificarile mele, incerc mutarea fisierului in  calea relativa formata din uploadPath si numele fisierului extras din $fileData["name"] (alias $_FILES["nume_camp"]["name"])

      $destination = $this->fsUpload . basename($fileData["name"]);
      try {
      $ok = move_uploaded_file($fileData["tmp_name"], $destination);
      } catch (Exception $e) {
	$this->setError($field, $e->getMessage());
	continue;
      }
 
      if (!isset($ok) or !$ok) { // daca nu s-a mutat in destinatia finala de pe server, avem pana la urma tot o eroare de upload
	$this->setError($field, 'Fisierul a fost incarcat, dar nu s-a mutat in destinatia finala');
	continue;
      } else {
	$this->addUploaded($field, $fileData["name"], $destination);	
      }
	  

 
    } /// foreach



  } /// doUpload()


  function getUploadedName($field)
  {
    if (!isset($this->uploadedFiles[$field]["name"])) return '';
    return $this->uploadedFiles[$field]["name"];
  }

  function addUploaded($field, $name, $destination)
  {
    $this->uploadedFiles[$field]["name"] = $name;
    $this->uploadedFiles[$field]["destination"] = $destination;
  }



  function setStandardErrors()
  {
    $standardErrors[UPLOAD_ERR_INI_SIZE] = 'The uploaded file exceeds the upload_max_filesize directive in php.ini. ';
    $standardErrors[UPLOAD_ERR_FORM_SIZE] = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form. ';
    $standardErrors[UPLOAD_ERR_PARTIAL] = 'The uploaded file was only partially uploaded.';
    $standardErrors[UPLOAD_ERR_NO_FILE] = 'No file was uploaded. ';
    $standardErrors[UPLOAD_ERR_NO_TMP_DIR] = 'Missing a temporary folder';
    $standardErrors[UPLOAD_ERR_CANT_WRITE] = 'Failed to write file to disk.';
    $standardErrors[UPLOAD_ERR_EXTENSION] = 'File upload stopped by extension.';

    $this->standardErrors = $standardErrors;
  }



  }







?>