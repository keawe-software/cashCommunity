<?php
  function getData(){ // TODO: dies is nun typ-spezifisch und muss nochmal angepasst werden!
  	global $data;
  	if (!isset($data)){
  		$data=json_decode(file_get_contents('data.json'),true);
  		if (empty($data)){
  			$data=array();
  		}
  	}
  	return $data;
  }

  function saveData($data){
  	file_put_contents('data.json', json_encode($data));
  }

  function addFlatmate($flatmate){
    $data=getData();
    $num=count($data['flatmates']);
    $flatmate['id']=$num;
    $data['flatmates'][]=$flatmate;
    saveData($data);
    return $data;
  }
  
  function editFlatmate($flatmate){
  	$data=getData();
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
  	return $data;
  }

  function addRoom($room){
    $data=getData();
    if (isset($data['rooms'])){
    	$num=count($data['rooms']);
    } else { 	
    	$num=0;
    }
    $room['id']=$num;
    $data['rooms'][]=$room;
    saveData($data);
    return $data;
  }

  function editRoom($room){
  	$data=getData();
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
  	return $data;
  }