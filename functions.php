<?php
  function getData(){ // TODO: dies is nun typ-spezifisch und muss nochmal angepasst werden!
  	global $data;
  	if (!isset($data)){
  		$data=json_decode(file_get_contents('data.json'),true);
  		if (empty($data)){
  			$data=array();
  		}
  	}
  }

  function saveData($data){
  	print_r($_POST);
  	print_r($data);
  	file_put_contents('data.json', json_encode($data));
  }

  function addFlatmate($flatmate){
    global $data;
    if (isset($data['flatmates'])){
    	$num=count($data['flatmates']);
    } else {
    	$num=0;
    }
    $flatmate['id']=$num;
    $data['flatmates'][]=$flatmate;
    saveData($data);
  }
  
  function editFlatmate($flatmate){
  	global $data;
    $id=$flatmate['id'];
  	foreach ($data['flatmates'] as $mate){
  		if ($mate['id']==$id){
  			foreach ($flatmate as $key => $val){
  				$data['flatmates'][$id][$key]=$val;
  			}
  			break;
  		}
  	}
  	saveData($data);
  }

  function addRoom($room){
    global $data;
    if (isset($data['rooms'])){
    	$num=count($data['rooms']);
    } else { 	
    	$num=0;
    }
    $room['id']=$num;
    $data['rooms'][]=$room;
    saveData($data);
  }

  function editRoom($room){
  	global $data;
    $id=$room['id'];
  	foreach ($data['rooms'] as $r){
  		if ($r['id']==$id){
  			foreach ($room as $key => $val){
  				$data['rooms'][$id][$key]=$val;
  			}
  			break;
  		}
  	}
  	saveData($data);
  }
