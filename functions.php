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
	
      $base_dist=array();
      $base_dist['name']=t('basic distribution by area');
      $base_dist['rooms']=array();      
      foreach ($data['rooms'] as $room_id => $room){
      	$base_dist['rooms'][$room_id]=100*$room['size']/$flat_size;
      }      
    }
  }

  function saveData($data){
  	file_put_contents('data.json', json_encode($data));
  }

  function addFlatmate($flatmate){
    global $data;
    if (!isset($data['flatmates'])){
    	$data['flatmates']=array();
    }
    $num=count($data['flatmates']);
    $flatmate['id']=$num;
    $data['flatmates'][]=$flatmate;
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
    $dist['id']=count($data['distributions']);
    $data['distributions'][]=$dist;
    saveData($data);
  }

  function editDistribution($dist){
  	global $data;
    $id=$dist['id'];
    $data['distributions'][$id]=$dist;
    saveData($data);
  }
  
  function editFlatmate($flatmate){
  	global $data;
  	$id=$flatmate['id'];
  	$data['flatmates'][$id]=$flatmate;
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
  
  function editInvoice($invoice){
  	global $data, $warnings;
  	if (isset($invoice['value'])){
  		$invoice['value']=str_replace(',','.',$invoice['value']);
  		if (!is_numeric($invoice['value'])){
  			$warnings[]=t('given invoice value is not a number');
  			return;
  		}
  	} else {
  		$warnings[]=t('no invoice value given!');
  		return;
  	}
  	$id=$invoice['id'];
  	$data['invoices'][$id]=$invoice;
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
  	if (!isset($data['rooms'])){
  		$data['rooms']=array();
  	}
  	$num=count($data['rooms']);
  	$room['id']=$num;
  	$data['rooms'][]=$room;
  	saveData($data);
  }
  
  function addInvoice($invoice){
  	global $data, $warnings;
  	if (isset($invoice['value'])){
  		$invoice['value']=str_replace(',','.',$invoice['value']);
  		if (!is_numeric($invoice['value'])){
  			$warnings[]=t('given invoice value is not a number');
  			return;
  		}
  	} else {
  		$warnings[]=t('no invoice value given!');
  		return;
  	}
  	if (!isset($data['invoices'])){
  		$data['invoices']=array();
  	}
		$num=count($data['invoices']);
  	$invoice['id']=$num;
  	$data['invoices'][]=$invoice;
  	saveData($data);
  }
  
  function addAssociation($assoc){
  	global $data;
  	$room_id=$assoc['room'];
  	$from=$assoc['from'];
  	if (!isset($data['rooms'][$room_id]['associations'])){
  		$data['rooms'][$room_id]['associations']=array();
  	}
  	$data['rooms'][$room_id]['associations'][$from]=$assoc;
  	saveData($data);  	
  }

  function editAssociation($assoc){
  	global $data;
  	$room_id=$assoc['room'];
  	$from=$assoc['from'];
  	if (!isset($data['rooms'][$room_id]['associations'])){
  		$data['rooms'][$room_id]['associations']=array();
  	}
  	$data['rooms'][$room_id]['associations'][$from]=$assoc;
  	saveData($data);
  }
  