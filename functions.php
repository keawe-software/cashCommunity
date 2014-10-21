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
  	if (!isset($data['rooms'][$room_id]['associations'])){
  		$data['rooms'][$room_id]['associations']=array();
  	}
  	$data['rooms'][$room_id]['associations'][$from]=$assoc;
  	saveData($data);  	
  }

  function editAssociation($assoc){
  	global $data;
  	$assoc['from']=dateToDay($assoc['from']);
  	if (isset($assoc['till'])){
  		$assoc['till']=dateToDay($assoc['till']);
  	}  	 
  	$room_id=$assoc['room'];
  	$from=$assoc['from'];
  	if (!isset($data['rooms'][$room_id]['associations'])){
  		$data['rooms'][$room_id]['associations']=array();
  	}
  	$data['rooms'][$room_id]['associations'][$from]=$assoc;
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
  	return $object['till']-$object['from'];
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
  	
  }
  
  function readBalance($flatmate){
  	global $data;
  	$rooms=getRooms($flatmate['id']);
  	print '<pre>';
  	print_r($rooms);
  	print '</pre>';
  	$balance=0;
  	$personalInvoices=array();
  	foreach ($data['invoices'] as $invoice){  		
  		$dist_id=$invoice['distribution'];
  		$distribution=$data['distributions'][$dist_id];
  		$invoiceDays=getNumberOfDays($invoice);
  		
  		$parts=array();
  		$part_sum=0;
  		foreach ($distribution['rooms'] as $room_id => $part){
  			$part_sum+=$part; // calculate overall
  		}
  	  foreach ($distribution['rooms'] as $room_id => $part){
  	  	$room_name=$data['rooms'][$room_id]['name'];  	  	
  			foreach ($rooms as $room){
  				if ($room['room']==$room_id){
  					$overlap=getOverlap($invoice,$room);
  					$overlapDays=getNumberOfDays($overlap);
  					if ($overlapDays>0){
  						$percent=100*$part/$part_sum;
  						$text=t('%name has lived for %days in room %room, which has allotment of %percent% on invoice "%invoice"');
  						$keys=array('%name',          '%days', '%room',  '%percent','%invoice');
  						$repl=array($flatmate['name'],$overlap,$room_name,$percent, $invoice['description']);
  						print str_replace($keys, $repl, $subject).'<br/>'.PHP_EOL;
							$balance+=($overlapDays/$invoiceDays) * $invoice['value'] * $part / $part_sum;
  					}
  				}
  			}
  		}
  	}
  }
  