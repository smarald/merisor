<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class MyForm {

  public $formData;  
  public $initData;

  public $errors;

  protected $hiddenFields;
  protected $submitName;
  protected $formName;
  protected $method;
  protected $formParams;
  protected $enctype;

  protected $hiddenFormName;

  public $table;

  function __construct($formName, $method, $action = '', $formParams = '')
  {
    $this->formName = $formName;
    $this->method = strtolower($method);
    $this->enctype = '';
    $this->action = $action;
    $this->formParams = $formParams;

    $this->hiddenFormName = 'hidden_' . $formName;

    if ($this->method == 'get' && $this->pushed()) $this->setFormData($_GET);

    if ($this->method == 'post' && $this->pushed())  {
      $this->setFormData($_POST);
    }

  }


  function setTable($table)
  {
    $this->table = $table;
  }

  function validate()
  {

  }

  function make()
  {

    if ($this->pushed()) {
      $this->validate();

      if (!$this->hasErrors()) {
	
	$this->process();

      } /// hasErrors
    

    }

  }


  function process()
  {
    // no implementation here
  }


  function pushed()
  {
    if ($this->method == 'get' && isset($_GET[$this->hiddenFormName])) return true;
    if ($this->method == 'post' && isset($_POST[$this->hiddenFormName]))   return true;

    return false;
  }


  function hasErrors()
  {
    if (isset($this->errors) && is_array($this->errors) && count($this->errors)) {
      foreach ($this->errors as $er) {
	if (!empty($er)) return true;
      }
    }
    return false;
  }



  function getError($name)
  {
    if (isset($this->errors[$name])) return $this->errors[$name];
    return false;
  }

  function outputError($name)
  {
    $err = $this->getError($name);
    if (!empty($err)) {
      $s = '';
      $s .= '<div class="error">';
      $s .= $this->getError($name);
      $s .= '</div>';
      return $s;
    }

    return '';
  }


  function getErrors()
  {
    return $this->errors;
  }


  function outputErrors()
  {
    $str = '';

    if (isset($this->errors) && is_array($this->errors) && count($this->errors)) {
      $ers = $this->errors;

      foreach ($ers as $e) {
	$str .= $e . '<br />';
      }

      $str = '<div class="errors">' . $str . '</div>';

    }

    return $str;
  }


  function setFormData(array $formData)
  {
    $this->formData = $formData;
    if (isset($formData) && is_array($formData)) {
      foreach ($this->formData as $i  => $v) {
	if (!is_array($v)) {
	  $this->formData[$i] = trim($v);
	} else {
	  $this->formData[$i] = $v;
	}
      }
    }
  } /// setFormData



  function begin()
  {
    $this->hidden($this->hiddenFormName, 1);

    if (!empty($this->enctype)) {
      $this->formParams .= ' enctype="'.$this->enctype.'" ';      
    }
    $html = '<form name="'.$this->formName.'" id="'.$this->formName.'" method="'.$this->method.'"  action="'.$this->action.'" '.$this->formParams.'>';

    foreach ($this->hiddenFields as $hf) {
      $html .= $hf;
    }


    return $html;
  }


  function end()
  {
    $html = '</form>';
    return $html;
  }

  function getSubmitName()
  {
    return $this->submitName;
  }


  function setInitData($fieldName, $idata)
  {
    $this->initData[$fieldName] = $idata;
  }

  function addInitData($initData)
  {
    if (isset($this->initData) && is_array($this->initData)) {
      $initData = array_merge($initData, $this->initData);
    }

    $this->initData = $initData;
  }


  function setInitDataFromEnum()
  {
    if (!isset($this->table)) throw new MyErrorException('No table set for the form');

    $colsData = $this->table->getColsData();

    foreach ($colsData as $col) {
      if (strpos($col["Type"], 'enum') !== FALSE) {
	$enum        = str_replace('enum(', '', $col['Type']);
	$enum        = preg_replace('/\\)$/', '', $enum);
	$enum        = explode('\',\'', substr($enum, 1, -1));
	$enum_cnt    = count($enum);

	foreach ($enum as $value) {
	  $enum2[$value] = $value;
	}
	
	$this->initData[$col["Field"]] = $enum2;
      }
    }

  } /// setInitDataFromEnum


  function fetchFromArraySintax($s)
  {
    $pieces = preg_split('/\[|\]/', $s);
    $name = $pieces[0];
    $key = $pieces[1];
    return array('name' => $name, 'key' => $key);

  }


  function text($name, $params = '', $type='text', $value = null)
  {
    if (isset($this->formData[$name])) {
      $elementData = $this->formData[$name];      
    } elseif (strpos($name, '[') !== FALSE) {
      $x = $this->fetchFromArraySintax($name);
      $aName = $x["name"];
      $aKey = $x["key"];
      if (isset($this->formData[$aName][$aKey])) $elementData = $this->formData[$aName][$aKey];
    }

    if (isset($value)) $elementData = $value;

    $field = '<input type="'.$type.'" id ="'.$name.'" name="' . $name . '" ';
    if (!empty($elementData)) $field .= ' value="'.$elementData.'" ';

    if ($params != '') {
      $field .= ' ' . $params;
    }
    $field .= ' />';

    return $field;

  }


  function password($name, $params = '')
  {
    $field = $this->text($name, $params, 'password');
    return $field;
  }


  function hidden($name, $value)
  {

    $field = $this->text($name, '', 'hidden', $value);
    $this->hiddenFields[$name] = $field;
    return $field;
  }


  function ck($name, $value, $params = '', $type = 'checkbox')
  {

    $checked = false;

    if (isset($this->formData[$name])) {
      $elementData = $this->formData[$name];
    
      if (is_array($elementData) && in_array($value, $elementData)) {
	$checked = true;
      } else {
	if ($elementData == $value) $checked = true;
      }
    }

    if ($checked) {
      $ck_str = ' checked = "checked" ';
    } else {
      $ck_str = '';
    }

    if ($type == 'checkbox') {
      $name .= '[]';
    }

    $field = '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" '.$params.' '.$ck_str.' />';

    return $field;

  } /// ck()


  function radio($name, $value, $params = '')
  {
    $field = $this->ck($name, $value, $params, 'radio');
    return $field;
  }


  function select($name, $type = 'single', $params = '')
  {

    $initData = $this->initData[$name];

    if (isset($this->formData[$name])) {
      $elementData = $this->formData[$name];
    }

    if (empty($initData)) throw new MyErrorException('No initData for select element');

    if ($type == 'multiple') {
      $name .= '[]';
      $params .= ' multiple = "multiple" ';
    }

    $field = '<select name="'.$name.'" id="'.$name.'"  '.$params.'>';

    foreach ($initData as $k => $v) {

      $selected = false;

      if (isset($elementData)) {
	if ($type == 'single') {
	  if ($elementData == $k) {
	    $selected = true;
	  }
	} elseif ($type == 'multiple') {
	  if (is_array($elementData) && in_array($k, $elementData)) {
	    $selected = true;
	  }
	}

      }
      if ($selected) {
	$str_selected = ' selected="selected" ';
      } else {
	$str_selected = '';
      }

      $field .= '<option value="'.$k.'" '.$str_selected.'>'.$v.'</option>';
    }

    $field .= '</select>';

    return $field;

  } /// select()




  function textarea($name, $width = 10, $height = 10, $params = '')
  {
    if (isset($this->formData[$name])) $elementData = $this->formData[$name];

    $field = '<textarea name="'.$name.'" id="'.$name.'" cols="'.$width.'" rows="'.$height.'" '.$params.'>';
    if (isset($elementData))  $field .= $elementData;
    $field .= '</textarea>';

    return $field;
  }

  function buttonImage($name, $src, $params = '')
  {
    $field = '<input type="image" src="'.$src.'"  '.$params.' />';
    return $field;
  }

  function prepareForUpload()
  {
    $this->method = 'post';
    $this->enctype = 'multipart/form-data';
  }


  function upload($name, $params = '')
  {
    $field = '<input name="'.$name.'" type="file"  '.$params.' />';
    return $field;
  }

  function button($name, $value, $type="submit", $params = '')
  {

    if ($type == 'submit') {
      $this->submitName = $name;
    }

    $field = '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" '.$params.'>';
    return $field;
  }




  } //// MyForm





?>