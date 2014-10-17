<?php
  function getData(){
  	global $data;
  	if (!isset($data)){
  		$parser=xml_parser_create();
  		$xml=file_get_contents("data.xml");
  		$data=array();
  		$result=xml_parse_into_struct($parser, $xml, $data);
  		if ($result==0){
  			print "error";
  			return FALSE;
  		}
  	}
  	return $data;
  }

  function readFlatmates(){
  	$data=getData();
  	print_r($data);
  	die();
  }