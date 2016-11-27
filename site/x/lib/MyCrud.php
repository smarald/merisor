<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class MyCrud {
  
  public $form;  
  public $table;

  protected $templates;
  protected $displayCols;
  protected $pkValues;

  private $tableName;

  private $formMethod;
  private $formData;
  private $actions = array('display', 'delete', 'insert', 'update');

  private $action;

  private $templateVars;

  private $processed;


  function __construct($form, $formMethod = 'post')
  {

    $this->form = $form;
    if (!isset($this->form->table)) throw new MyErrorException('The form must have a table');
    $this->table = $this->form->table;
    $this->tableName = $this->table->tableName;
    $this->formMethod = $this->formMethod;

    $this->setTemplates();


    if (isset($_GET["action"])) $req = $_GET;
    elseif (isset($_POST["action"])) $req = $_POST;

    if (isset($req)) {
      foreach ($this->actions as $a) {
	if ($req["action"] == $a) $this->action = $a;
      }
    }

  }


  function setTemplates($templates = null)
  {
    if (empty($templates)) {
      $templates = array(
			 'delete' => '',
			 'display' => 'crud_display.tpl.php',
			 'update' => 'crud_'.$this->tableName.'_form.tpl.php',
			 'insert' => 'crud_'.$this->tableName.'_form.tpl.php',
			 );
    }

    $this->templates = $templates;
  }

  function getTemplates($templates)
  {
    return $this->templates;
  }


  function go()
  {
    if (empty($this->action)) $this->action = $this->actions[0];

    $this->addTemplateVar('action', $this->action);

    if ($this->action == 'insert') {
      $this->insert();
    } elseif ($this->action == 'update') {
      $this->update();
    } elseif ($this->action == 'delete') {
      $this->delete();
    } elseif ($this->action == 'display') {
      $this->display();
    }

    $this->template = $this->templates[$this->action];

    } /// go


  function setDisplaySql($sql)
  {
    $this->displaySql = $sql;
  }

  function getDisplaySql()
  {
    if (!isset($this->displaySql)) {
      $this->displaySql = 'select * from ' . $this->table->tableName;
    }

    return $this->displaySql;

  }

  function prepareForDisplay($displayData)
  {
    return $displayData;
  }

  function getDisplayCols()
  {
    return $this->displayCols;
  }


  function setDisplayCols(array $cols)
  {
    $this->displayCols = $cols;
  }


  function updateByDisplayCols($displayData)
  {
    $displayCols = $this->getDisplayCols();
    $pkValues = array();
    $pkName = $this->table->getPkName();

    if (empty($displayCols)) return $displayData;

    $bk_displayData = $displayData;

    foreach ($displayData as $i => $d) {
      foreach ($d as $col => $value) {

	if ($col == $pkName) $pkValues[$i] = $d[$pkName];

	if (!in_array($col, $displayCols)) unset($bk_displayData[$i][$col]);

      } /// inner foreach
    } /// outer foreach

    $this->pkValues = $pkValues;

    return $bk_displayData;

  }


  function display()
  {
    $table = $this->table;


    $sql = $this->getDisplaySql($table->tableName);
    $displayData = $table->fetchAll($sql);

    if (empty($displayData)) {
          $this->addTemplateVar('insertPage', $this->getPage('insert'));
	  $this->addTemplateVar('displayData', null);
	  return;
    }


    $pkName = $table->getPkName();

    $displayData = $this->prepareForDisplay($displayData);
    $displayData = $this->updateByDisplayCols($displayData);


    foreach ($displayData as $i => &$d) {

      $pkValue = $this->pkValues[$i];
      $d["editLk"] = addParam($this->getPage('update'), $pkName, $pkValue);
      $d["deleteLk"] = addParam($this->getPage('delete'), $pkName, $pkValue);
    }

    $headData = array_keys($displayData[0]);

    foreach ($headData as &$v) {
      if ($v == 'editLk' or $v == 'deleteLk') $v = '';
    }

    $this->addTemplateVar('headData', $headData);


    unset($d);

    $this->addTemplateVar('insertPage', $this->getPage('insert'));
    $this->addTemplateVar('displayData', $displayData);
  }


  function delete()
  {
    $this->table->delete($this->fetchPkValue());
    redirect($this->getPage('display'));
  }


    function setForm($form)
    {
      $this->form = $form;
    }

    function getDefaultFormClass()
    {
      return 'MyForm';
    }


    function getForm()
    {
      return $this->form;
    }



    function buildForm($for)
    {

      $this->form->setInitDataFromEnum();
     $this->formData = &$this->form->formData;

     if ($for == 'update') {
       $pkValue = $this->fetchPkValue();
       $this->setPkValue($pkValue);
       $this->prepareFormForUpdate($pkValue);
     }

     $this->form->hidden('action', $this->action);

    }


  function prepareFormForUpdate($pkValue)
  {

    if (isset($pkValue)) {
      $this->form->hidden($this->getPkName(), $pkValue);      
      $this->formData[$this->getPkName()] = $pkValue;


      if (!$this->form->pushed()) {
	// get data from database, and update formData
	$d = $this->table->fetchSingle($this->getPkName() . ' = ' . $pkValue);
	if (empty($d)) throw new MyErrorException('No data fetched. pkValue: ' . $pkValue);
	$this->setFormData($d);
      }
      
    } else {
      throw new MyErrorException('No pkValue for update');

    } /// isset

  } // prepareFormForUpdate()



/************************** pk stuff ****************************************/


  function fetchPkValue()
  {

    $pkValue = null;
    $pkName = $this->getPkName();

    if (isset($this->formData[$pkName])) $pkValue = $this->formData[$pkName];
    if (!isset($pkValue) && isset($_REQUEST[$pkName])) $pkValue = $_REQUEST[$pkName];

    return $pkValue;
  }


  function getPkName()
  {
    $pkName = $this->table->getPkName();
    return $pkName;
  }

  function getPkValue()
  {
    $pkValue = $this->table->getPkValue();
    return $pkValue;
  }


  function setPkValue($pkValue)
  {
    $this->table->setPkValue($pkValue);
  }

/************************** end pk stuff ****************************************/
    function insert()
    {
      $this->buildForm('insert');
      $this->addTemplateVar('form', $this->form);
      $this->make();
    }


    function update()
    {
      $this->buildForm('update');
      $this->addTemplateVar('form', $this->form);
      $this->make();
    }


  function make()
  {

    if ($this->form->pushed()) {
      $this->form->validate($this->action);

      if (!$this->form->hasErrors()) {
	$this->process();
	$this->actionAfterProcessed();

      } /// hasErrors

    }

  } /// make()


  function getProcessed()
  {
    return $this->processed;
  }

  function setProcessed($p)
  {
    $this->processed = $p;
  }


  function process()
  {

	if ($this->action == 'insert') {
	  $this->insert2();
	} else {
	  $this->update2();
	}
	$this->setProcessed(1);
  }


  function setFormData($formData)
  {
    $this->formData = $formData;
  }


  function prepare($data)
  {
    foreach ($data as $k => $value) {
      if (is_array($value)) {
	$value = join(',', $value);
	$data[$k] = $value;
      }
    }
    reset($data);
    $this->setFormData($data);
  }

  function actionAfterProcessed()
  {
    Header("Location: " . $this->getPage('display'));
  }

  function getPage($action)
  {
    $page = $this->table->tableName . '.php';
    $page = $page . '?action=' . $action;
    return $page;
  }


    function insert2()
    {
      $this->prepare($this->formData);
      $id = $this->table->doData($this->formData);
      return $id;
    }


    function update2()
    {
      $this->prepare($this->formData);
      $id = $this->table->doData($this->formData, 'update', $this->getPkName() . '=' . $this->getPkValue());
      return $id;
    }


    function getTemplate()
    {
      return $this->template;
    }


    function addTemplateVar($name, $value)
    {
      $this->templateVars[$name] = $value;
    }


    function getTemplateVars()
    {
      return $this->templateVars;
    }


  }

?>