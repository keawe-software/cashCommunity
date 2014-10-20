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

  function calculate(){
    global $data, $flat_size, $base_dist;
    if (!isset($data)){
      $warnings[]=t('no data given for flat size calculation');
    } else if (!isset($data['rooms']) || empty($data['rooms'])){
      $warnings[]=t('no rooms given for flat size calculation');
    } else {
      $flat_size=0;
      foreach ($data['rooms'] as $room){
        $flat_size+=$room['size'];
      }

      if (isset($data['flatmates']) && !empty($data['flatmates'])){
        $base_dist=array();
        $separate=0;
        $base_dist=array();
        $count=0;
        foreach ($data['flatmates'] as $mate){
          $mate_id=$mate['id'];
          $room_id=$mate['room'];
          $room_size=$data['rooms'][$room_id]['size'];
          $separate+=$room_size;
          $base_dist[$mate_id]=$room_size;
          $count+=1;
        }
        $common=($flat_size-$separate)/$count;
        foreach ($base_dist as $mate_id => $percentage){
          $base_dist[$mate_id] = 100*($percentage + $common)/$flat_size;
        }
      }
    }
  }

  function saveData($data){
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
    global $data, $warnings;
    if (isset($room['size'])){
      $room['size']=str_replace(',','.',$room['size']);
      if (!is_numeric($room['size'])){
        $warnings[]=t('given room size is not a number');
        return;
      }
    } else {
      $warnings[]=t('no room size given!');
      return;
    }
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
    global $data, $warnings;
    if (isset($room['size'])){
      $room['size']=str_replace(',','.',$room['size']);
      if (!is_numeric($room['size'])){
        $warnings[]=t('given room size is not a number');
        return;
      }
    } else {
      $warnings[]=t('no room size given!');
      return;
    }
    $id=$room['id'];
    $data['rooms'][$id]=$room;
  	saveData($data);
  }

  function no_date($raw){
    return false; // TODO: implement
  }

  function addDistribution($dist){
    global $data, $warnings;
    if (empty($dist)){
      $warnings[]=t('no distribution data given');
      return;
    }
    if (!isset($dist['from']) || no_date($dist['from'])){
      $warnings[]=t('no valid start date');
      return;
    }
    if (isset($dist['till']) && no_date($dist['till'])){
      $warnings[]=t('no valid end date');
      return;
    }
    if (empty($dist['rooms'])){
      $warnings[]=t('distribution contains no values!');
      return;
    }
    foreach ($dist['rooms'] as $room){
      if (!is_numeric($room)){
        $warnings[]=str_replace('%d',$room,t('%d is not a valid value'));
        return;
      }
    }
    if (!isset($data['distributions'])){
      $data['distributions']=array();
    }
    $data['distributions'][]=$dist;
    print_r($data);
    saveData($data);
  }

  function editDistribution($dist){
    print_r($dist);
    $id=$dist['id'];
    $data['distributions'][$id]=$dist;
    saveData($data);
  }
