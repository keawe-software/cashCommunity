<?php
  include 'functions.php';

  getData();
  calculate();
  $warnings=array();
  
  function t($message){
  	return 't_'.$message;
  }
