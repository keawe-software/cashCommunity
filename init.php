<?php

	session_start();
  $secondsperday=60*60*24;
  $testdays=14;
  
  require 'config/db.php';  
  require 'locale/de.php';
  include 'functions.php';
  
  $warnings=array();
  
  $db = connectToDb($host,$database,$user,$pass);
  checkTables($db);
  
  if (isset($_POST['action'])){
  	if ($_POST['action']=='logout'){
  		session_destroy();
  		session_start();
  		unset($_POST['action']);
  	} else if ($_POST['action']=='login' && isset($_POST['username']) && isset($_POST['password'])){
  		$wait=1;
  		if (isset($_SESSION['wait'])){
  			$wait=$_SESSION['wait']*2;
  		}  		
  		session_destroy();
  		session_start();
			$pass=sha1($_POST['password']);
			unset($_POST['password']);
			$sql='SELECT validity FROM data WHERE username=:username AND password=:password';
			$stm=$db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$stm->execute(array(':username'=>$_POST['username'],':password'=>$pass));			
			$results=$stm->fetchAll();
			if (count($results)==1){
				if ($results[0]['validity']<today()){
					$warnings[]=t('Your test period expired. You can still view your data, but any changes will be lost immediately. Please purchase a license to continue using all features');
				}
				$_SESSION['expired']=1;
				$_SESSION['user']=$_POST['username'];				
			} else {
				$warnings[]=t('Invalid username and/or password!');
				sleep($wait); // doubled everytime
				$_SESSION['wait']=$wait;								
			}				
  		unset($_POST['action']);
  	}
  }
  
  if (isset($_SESSION['user'])){
  	getData();
  	calculate();
  }
  
  function t($text){
		global $locale;
		if (isset($locale) && array_key_exists($text,$locale)){
			return $locale[$text];
		}
		return $text;
  }
