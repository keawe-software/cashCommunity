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
  	$invoice['from']=dateToDay($invoice['from']);
  	if (isset($invoice['till'])){
  		$invoice['till']=dateToDay($invoice['till']);
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
  	$invoice['from']=dateToDay($invoice['from']);
  	if (isset($invoice['till'])){
  		$invoice['till']=dateToDay($invoice['till']);
  	}  	 
		$num=count($data['invoices']);
  	$invoice['id']=$num;
  	$data['invoices'][]=$invoice;
  	saveData($data);
  }
  
  function dateToDay($date){
  	global $secondsperday;
  	return round(strtotime($date)/$secondsperday);
  }
  
  function daysToDate($days){
  	global $secondsperday;
  	if ($days<10){
  		return date('Y-m-d');
  	}
  	return date('Y-m-d',$days*$secondsperday);
  }
  
  function addAssociation($assoc){
  	global $data;  	  	  	
  	$assoc['from']=dateToDay($assoc['from']);
  	if (isset($assoc['till'])){
  		$assoc['till']=dateToDay($assoc['till']);
  	}
  	$room_id=$assoc['room'];
  	$from=$assoc['from'];
  	if (!isset($data['associations'])){
  		$data['associations']=array();
  	}
  	$id=count($data['associations']);
  	$assoc['id']=$id;
  	$data['associations'][$id]=$assoc;
  	saveData($data);  	  	
  }

  function editAssociation($assoc){
  	global $data;
  	$id=$assoc['id'];
  	$assoc['from']=dateToDay($assoc['from']);
  	if (isset($assoc['till'])){
  		$assoc['till']=dateToDay($assoc['till']);
  	}  	 
  	$room_id=$assoc['room'];
  	$from=$assoc['from'];
  	if (!isset($data['associations'])){
  		$data['associations']=array();
  	}
  	$data['associations'][$id]=$assoc;
  	saveData($data);
  }
  
  function getRooms($flatmate){
  	global $data;
  	$associations=array();
  	foreach ($data['rooms'] as $room){
  		if (isset($room['associations'])){
  			foreach ($room['associations'] as $assoc){
  				if ($assoc['flatmate']==$flatmate){
  					$associations[]=$assoc;
  				}
  			}
  		}
  	}
  	return $associations;
  }
  
  function getNumberOfDays($object){
  	if (!isset($object['from'])){
  		return 0;
  	}
  	if (!isset($object['till'])){
  		return 0;
  	}
  	return $object['till']-$object['from']+1;
  }
  
  function getOverlap($object1,$object2){
  	if (!isset($object1['from'])){
  		return 0;
  	}
  	if (!isset($object1['till'])){
  		return 0;
  	}
  	if (!isset($object2['from'])){
  		return 0;
  	}
  	if (!isset($object2['till'])){
  		return 0;
  	}
    $from=max($object1['from'],$object2['from']);    
    $till=min($object1['till'],$object2['till']);
    if ($from>$till){
    	return null;
    }
    return array('from'=>$from,'till'=>$till);        
  }
  
  function getAssociationsFor($timespan){
  	global $data;
  	$from=$timespan['from'];
  	$till=$timespan['till'];
  	print "from: $from<br/>\n";
  	print "till: $till<br/>\n";
  	$associations=array();
  	foreach ($data['associations'] as $association){  		
  		if (($from <= $association['from'] && $association['from'] <= $till) ||
  				($from <= $association['till'] && $association['till'] <= $till) ||
  				($till <= $association['till'] && $association['from'] <= $from))	{
  			if ($association['from']<$from){
  				$association['from']=$from;
  			}
  			if ($association['till']>$till){
  				$association['till']=$till;
  			}  				
  			$associations[$association['id']]=$association;
  		}
  	}
  	return $associations;
  }
  
  function distributeInvoice($invoice,&$balances){
  	$from=$invoice['from'];
  	$till=$invoice['till'];
  	$associations=getAssociationsFor($invoice);
  	print '<pre>';
  	print_r($associations);
  	print '</pre>';
  }
  
  function readBalance($flatmate){
  	global $data;
  	$balances=array();
  	foreach ($data['invoices'] as $invoice){
  		distributeInvoice($invoice,$balances);
  	}
  	//print $balances[$flatmate['id']];
  }
  