<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/


abstract class MyLogin {

  public $form;
  protected $seconds;
  protected $name;
  protected $path;
  protected $mainVar;
  protected $error;
  protected $savePath;

  protected static $authorizationPage = 'authPage.php';
  protected static $userCol = 'username';
  protected static $passCol = 'pass';


  function __construct($name, $seconds = 0, $path = "/", $savePath = '')
  {
    $_SESSION['uid'] = $this->mainVar = $this->getMainVar();

    $this->name = $name;
    $this->seconds = $seconds;
    $this->path = $path;
    $this->savePath = $savePath;

    $this->sessionStart();

    if (!$this->isLogged()) {
      $this->form = new LoginForm('loginForm', 'post');
      $this->make();
    }

    return $this;
  }


  abstract protected function getLoginTable();


  function getError()
  {
    return (string)($this->error);
  }

  function outputError($otherParams = '')
  {
    $s = '<div class="error" '.$otherParams.'>'.$this->getError().'</div>';
    return $s;
  }

  function make()
  {

    if (!$this->form->pushed()) return;
	$this->form->validate();

	if ($this->form->hasErrors()) {
	  $this->error = 'Username sau parola incorecta';
	} else {
	  $ok = $this->authenticate($this->form->formData['username'], $this->form->formData["pass"]);
	  if (!$ok) $this->error = 'Nu exista un cont cu acest username si parola';
	    
	}

  } /// make()


  function authenticate($username, $pass)
  {
    $username = MyDb::getInstance()->prepare($username);
    $pass = MyDb::getInstance()->prepare($pass);

    $db = MyDb::getInstance();
    $sql = 'SELECT * FROM '.$this->getLoginTable().' WHERE '.self::$userCol.' = "'.$username.'" AND '.self::$passCol.' = "'.sha1($pass).'"';
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
      $udata = $result->fetch_assoc();
      $this->login($udata);
    } else {
      return false;
    }
  }



  function setMainVar($mainVar)
  {
    $this->mainVar = $mainVar;
  }


  abstract protected function getMainVar();
  abstract  protected function getVarsToSet();


  function getSavePath()
  {
    return $this->savePath;
  }

  function sessionStart()
  {

    // session_start()
    ini_set('session.use_cookies', 1);
    ini_set('session.cookie_lifetime', $this->seconds);
    ini_set('session.cookie_path', $this->path);
    ini_set('session.gc_maxlifetime', $this->seconds);

    $savePath = $this->getSavePath();
    if (!empty($savePath))   ini_set('session.save_path', $savePath);

    session_name($this->name);
    session_start();
    setcookie($this->name, session_id(), time() + $this->seconds, $this->path);

  }


  function authorize()
  {
    if ($this->isLogged()) {
      return 1;
    }
    else {
      redirect(self::$authorizationPage); 
      return 0;
    }
  }


  function isLogged()
  {

    if (isset($_SESSION[$this->mainVar])) {
      return 1;
    } else {
      return 0;
    }

  }


  function login($udata)
  {
    $_SESSION[$this->mainVar] = $udata[$this->mainVar];

    $varsToSet = $this->getVarsToSet();

    foreach ($varsToSet as $var) {
      $_SESSION[$var] = $udata[$var];
    }


    $this->redirectAfterLogin();
  }


  function logout()
  {
    setcookie($this->name, FALSE, 1, $this->path); // sterge cookie-ul de sesiune (1 reprezinta prima secunda din anul 1970, deci mult in trecut)
    $_SESSION = array(); // se sterg datele din $_SESSION
    session_destroy(); // se sterg datele din fisierul de sesiune
 
    $this->redirectAfterLogout();
  }



  protected function redirectAfterLogin()
  {

  }


  protected function redirectAfterLogout()
  {
    Header("Location: index.php");
  }

  }



?>