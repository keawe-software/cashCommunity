<?php
  include 'functions.php';

  getData();
  calculateSize();
  $warnings=array();
  
  function t($message){
  	return 't_'.$message;
  }
