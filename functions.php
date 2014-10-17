<?php
  function getData(){
  	global $data;
  	if (!isset($data)){
  		$data=simplexml_load_file('data.xml');
  		if ($data===FALSE){
  			print "error";
  			return FALSE;
  		}
  	}
  	return $data;
  }

  function readFlatmates(){
  	$data=getData();
  	$flatmates=array();
  	foreach ($data->flatmates->flatmate as $flatmate){
  		$flatmates[]=$flatmate;
  	}
  	return $flatmates;
  }
  
  function editFlatmate($flatmate){
  	$mates=readFlatmates();
  	return $mates;
  }