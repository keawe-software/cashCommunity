<?php

  $secondsperday=60*60*24;
  $warnings=array();
  
  require 'locale/de.php';
  include 'functions.php';	
  
  getData();
  calculate();
  
  function t($text){
		global $locale;
		if (isset($locale) && array_key_exists($text,$locale)){
			return $locale[$text];
		}
		return $text;
  }
