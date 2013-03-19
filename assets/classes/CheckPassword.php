<?php
class Ps2_CheckPassword{

  protected $_password;
  protected $_minimumChars;
  protected $_mixedCase = false;
  protected $_minimumNumbers = 0;
  protected $_minimumSymbols = 0;
  protected $_errors = array();

  public function __construct($password, $minimumChars = 6) {
	$this->_password = $password;
	$this->_minimumChars = $minimumChars;
  }

  /*
  public function requireMixedCase() {
	$this->_mixedCase = false; // Require at least 1 capital letter?
  }

  public function requireNumbers($num =1) {
	if (is_numeric($num) && $num > 0) {
	  $this->_minimumNumbers = (int) $num; 
	}
  }
  
  public function requireSymbols($num = 1) {
	if (is_numeric($num) && $num > 0) {
	  $this->_minimumSymbols = (int) $num; 
	}
  }
  */

  public function check() {
    if (preg_match('/\s/', $this->_password)) {
      $this->_errors[] = "<div class=\"alert alert-error\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">&times;</a>Password cannot contain spaces.</div>";	
    }
    if (strlen($this->_password) < $this->_minimumChars) {
	  $this->_errors[] = "<div class=\"alert alert-error\"><a class=\"close\" data-dismiss=\"alert\" href=\"#\">&times;</a>Password must be at least $this->_minimumChars characters.</div>";
    } 
    /*
	if ($this->_mixedCase) {
	  $pattern = '/(?=.*[a-z])(?=.*[A-Z])/';
	  if (!preg_match($pattern, $this->_password)) {
		$this->_errors[] = 'Password should include uppercase and lowercase characters.';
	  }
	}
	if ($this->_minimumNumbers) {
	  $pattern = '/\d/';
	  $found = preg_match_all($pattern, $this->_password, $matches);
	  if ($found < $this->_minimumNumbers) {
		$this->_errors[] = "Password should include at least $this->_minimumNumbers number(s).";
	  }
	}
	if ($this->_minimumSymbols) {
	  $pattern = "/[-!$%^&*(){}<>[\]'" . '"|#@:;.,?+=_\/\~]/';
	  $found = preg_match_all($pattern, $this->_password, $matches);
	  if ($found < $this->_minimumSymbols) {
		$this->_errors[] = "Password should include at least $this->_minimumSymbols nonalphanumeric character(s)."; 
	  }
	}
	*/
	return $this->_errors ? false : true;
  }

  public function getErrors() {
	return $this->_errors; 
  }

}