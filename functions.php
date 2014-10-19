<?php
  function getData(){ // TODO: dies is nun typ-spezifisch und muss nochmal angepasst werden!
  	global $data;
  	if (!isset($data)){
  		$data=json_decode(file_get_contents('data.json'),true);
  		if ($data===FALSE){
  			print "error";
  			return FALSE;
  		}
  	}
  	return $data;
  }

  function saveData($data){
  	file_put_contents('data.json', json_encode($data));
  }
  
  function editFlatmate($flatmate){
  	$data=getData()
  	foreach ($data['flatmates'] as $mate){
  		if ($mate['id']==$flatmate['id']){
  			foreach ($flatmate as $key => $val){
  				$data['flatmates'][$key]=$val;
  			}
  			break;
  		}
  	}
  	saveData($data);
  	return $data;
  }
