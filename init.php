<?php
  $secondsperday=60*60*24;
  include 'functions.php';	
  
  getData();
  calculate();
  $warnings=array();
  
  function t($message){
  	return 't_'.$message;
  }
