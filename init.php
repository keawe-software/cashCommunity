<?php

	session_start();
  $secondsperday=60*60*24;
  
  require 'config/db.php';  
  require 'locale/de.php';
  include 'functions.php';
  

  $db = connectToDb($host,$database,$user,$pass);
  checkTables($db);
  
  if (isset($_POST['action'])){
  	if ($_POST['action']=='login' && isset($_POST['username']) && isset($_POST['password'])){
  		session_destroy();
  		session_start();
			$pass=sha1($_POST['password']);
			unset($_POST['password']);
			$sql='SELECT count(*) FROM data WHERE username=:username AND password=:password';
			$stm=$db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$stm->execute(array(':username'=>$_POST['username'],':password'=>$pass));
			$results=$stm->fetchAll();				
  		if ($results[0][0]==1){
				$_SESSION['user']=$_POST['username'];				
			}				
  	}
  }
  
  if (isset($_SESSION['user'])){
  	getData();
  	calculate();
  }
  $warnings=array();
  
  function t($text){
		global $locale;
		if (isset($locale) && array_key_exists($text,$locale)){
			return $locale[$text];
		}
		return $text;
  }
