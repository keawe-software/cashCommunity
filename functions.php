<?php
  function getData(){
  	global $data;
  	if (!isset($data)){
  		$data=simplexml_load_file('flatmates.xml');
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
  	foreach ($data->flatmate as $flatmate){
  		$flatmates[]=$flatmate;
  	}
  	return $flatmates;
  }
  
  function saveXML($name,$content){
  	$data ='<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
  	$data.='<xml>'.PHP_EOL;
  	foreach ($content as $entry){
  		$data.='<'.$name;
  		foreach ($entry->attributes() as $key => $val){
  			$data.=' '.$key.'="'.$val.'"';
  		}
  		$data.='/>'.PHP_EOL;
  	}
  	$data.='</xml>'.PHP_EOL;
  	file_put_contents($name.'s.xml', $data);
  }
  
  function editFlatmate($flatmate){
  	$mates=readFlatmates();
  	foreach ($mates as $mate){
  		if ($mate['id']==$flatmate['id']){
  			foreach ($flatmate as $key => $val){
  				$mate[$key]=$val;
  			}
  			break;
  		}
  	}
  	saveXML('flatmate',$mates);
  	return $mates;
  }