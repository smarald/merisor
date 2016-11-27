<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


class MyTable {

  private static $mysqlTypes;
  public static $db;  

  public  $tableName;
  private $pkName;
  private $pkValue;

  function __construct($tableName)
  {

    self::$db = MyDb::getInstance();
    self::$mysqlTypes["numeric"] = array('int', 'decimal', 'float', 'real', 'double', 'numeric');

    $this->tableName = $tableName;
    $this->setPkName();
  }

  function setPkValue($pkValue)
  {
    $this->pkValue = $pkValue;
  }

  function delete($pkValue)
  {
    $sql = ' delete from '.$this->tableName.' where ' . $this->getPkName() .'=' . $pkValue;
    self::$db->query($sql);
  }


  function getColsData() {
    $cols = array();

    $sql = ' show columns from ' . $this->tableName;
    $res = self::$db->query($sql);

    while ($col = $res->fetch_assoc()) {
      $cols[$col["Field"]] = $col;
    }    

    return $cols;

  } /// getColsData()


  function getColData($name) {
    $cols = $this->getColsData();
    if (!isset($cols[$name])) throw new MyErrorException('Coloana ' . $name . ' nu a fost gasita in tabel');

    return $cols[$name];
  }


  function countRows($condition)
  {
    $sql = ' select count(*) from ' . $this->tableName.' WHERE '.$condition;
    $res = self::$db->query($sql);
    $d = $res->fetch_array();

    return $d[0];
  }


   function setPkName()
  {
    $sql = ' show columns from ' . $this->tableName;
    $res = self::$db->query($sql);

    while ($col = $res->fetch_assoc()) {
      if ($col["Key"] == 'PRI') $pkName = $col["Field"];      
    }

    $this->pkName = $pkName;

    return $this->pkName;
  }


  function getPkName()
  {
    return $this->pkName;
  }


  function getPkValue()
  {
    return $this->pkValue;
  }


  function fetchSingle($condition, $cols = '*', $fetchingCol = null)
  {
    $sql =   'select '.$cols.' from ' . $this->tableName . ' where ' . $condition;
    $data = $this->fetchAll($sql);

    if (isset($data[0]))
      $single = $data[0];
    else 
      return null;

    if (!empty($fetchingCol) && isset($single[$fetchingCol]))  return $single[$fetchingCol];

    return $single;
  }


  function fetch($pkValue, $cols = '*')
  {
    $pkName = $this->getPkName();
    if (empty($pkValue)) throw new MyErrorException('No data found for key '.$pkName.', value '.$pkValue.' and table '.$this->tableName.'');

    $data = $this->fetchAll('select '.$cols.' from ' . $this->tableName . ' where ' . $pkName . ' = ' . $pkValue);

    if (empty($data[0])) throw new MyErrorException('No data found for key '.$pkName.', value '.$pkValue.' and table '.$this->tableName.'');

    return $data[0];
  }


  function fetchField($pkValue, $fetchingCol)
  {
    return $this->fetchSingle($this->pkName . ' = ' . $pkValue, $fetchingCol, $fetchingCol);
  }



  function fetchCol($key, $value, $params = '')
  {

    $sql = 'select '.$key.', '.$value.' from ' . $this->tableName . ' ' . $params;

    try {
      $res = self::$db->query($sql);

      if ($res->num_rows > 0) {
	while ($d = $res->fetch_assoc()) {
	  $data[$d[$key]] = $d[$value];

	}
	return $data;

      }  else {
	return null;
      }

    } catch (MyErrorException $e) {
      $e->doError();
    }

  } /// fetchCol

  function fetchAll($sql)
  {

    try {
      $res = self::$db->query($sql);

      if ($res->num_rows > 0) {
	while ($d = $res->fetch_assoc()) {
	  $data[] = $d;

	}
	return $data;

      }  else {
	return null;
      }

    } catch (MyErrorException $e) {
      $e->doError();
    }


  } /// fetchAll();


  static function isNumeric($type)
  {
    foreach (self::$mysqlTypes["numeric"] as $numericType) {
      if (strpos($type, $numericType) !== FALSE) {
	return 1;
      }
    }

    return false;
  }


  function doData($data, $action = 'insert', $parameters = '')
  {
    $tableName = $this->tableName;
    $bk_data = $data;
    $data = null;
    $tableCols = $this->getColsData();

    foreach ($tableCols as $col) {
      $field = $col["Field"];
      $type = $col["Type"];

      if (isset($bk_data[$field])) {
	$data[$field]["value"] = $bk_data[$field];
	$data[$field]["type"] = $type;
      }
    }

    if (empty($data)) throw new MyErrorException('Incorrect data to update/insert');

    reset($data);

    if ($action == 'insert') {

      $query = 'insert into ' . $tableName . ' (';
      while (list($columns, ) = each($data)) {
        $query .= $columns . ', ';
      }
      $query = substr($query, 0, -2) . ') values (';
      reset($data);
      while (list(, $colData) = each($data)) {
	$value = $colData["value"];
	$type = $colData["type"];

        if (self::isNumeric($type)) {
	  if (empty($value)) $value = 0;
          $query .= $value . ', ';
        } else {
          if ($value == 'now()') {
            $query .= 'now(), ';
          } elseif ($value == 'null') {
            $query .= 'null, ';
          } else {
            $query .= '\'' . MyDb::getInstance()->prepare($value) . '\', ';
          }
        }
      }
      $query = substr($query, 0, -2) . ')';
    } elseif ($action == 'update') {
      $query = 'update ' . $tableName . ' set ';
      while (list($columns, $colData) = each($data)) {
	$value = $colData["value"];
	$type = $colData["type"];

        if (self::isNumeric($type)) { 
	  if (empty($value)) $value = 0;
          $query .= $columns . ' = ' . $value . ', ';
        } else {
          if ($value == 'now()') {
            $query .= $columns . ' = now(), ';
          } elseif ($value == 'null') {
            $query .= $columns .= ' = null, ';
          } else {
            $query .= $columns . ' = \'' . MyDb::getInstance()->prepare($value) . '\', ';
          }
        }
      }
      $query = substr($query, 0, -2) . ' where ' . $parameters;
    }

    self::$db->query($query);

    if ($action == 'insert') {
      return self::$db->mysqli->insert_id;
    } else {
      return self::$db->mysqli->affected_rows;
    }

  } /// doData()



  } /// class




?>