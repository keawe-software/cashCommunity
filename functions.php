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
  
  function today(){
  	return dateToDay(date('Y-m-d'));
  }

  /* calculates flat size and basic distribution by room sizes */
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
  
  /* convert a date to a day-timestamp */
  function dateToDay($date){
  	global $secondsperday;
  	return round(strtotime($date)/$secondsperday);
  }
  
  /* convert a day-timestamp to a date in format yyyy-mm-dd */
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
  
  /* get length of a time span in days, including first and last day (from and till) */
  function getNumberOfDays($object){
  	if (!isset($object['from'])){
  		return 0;
  	}
  	if (!isset($object['till'])){
  		return 0;
  	}
  	return $object['till']-$object['from']+1;
  }
  
  /* calculate common time span of two time spans */
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
  
  /* get time slices with room-to-flatmate associations in a timespan */
  function getAssociationsFor($timespan){
  	global $data;
  	$from=$timespan['from'];
  	$till=$timespan['till'];
  	$slices=array();
  	$slices[$from]=array('from'=>$from,'till'=>$till,'rooms'=>array());
  	foreach ($data['associations'] as $association){
  		$from=$association['from'];
  		$till=$association['till'];
  		if ($till==0){
  			$till=today();
  		}
  		$room=$association['room'];
  		$mate=$association['flatmate'];
  		foreach ($slices as $start=>$slice){
  			$end=$slice['till'];
  			$checksum=0;
  			if ($from>$end) continue;
  			if ($till<$start) continue;
  			if ($from <= $start && $end <=$till){ // range contains slice < [ ] > 
  				$slices[$start]['rooms'][$room]=$mate; // add new roommate to current slice
  				$checksum+=1;
  			}
  			if ($start < $from && $till < $end){ // sclice contains range [ < > ] -- result: [ | | ]
  				$slices[$from]=$slice;   // only good, if we copy by value, not by reference!!!
  				$slices[$from]['from']=$from; // write first new slice 
  				$slices[$from]['till']=$till;
  				$slices[$from]['rooms'][$room]=$mate;
  				
  				$slices[$till+1]=$slice; // only good, if we copy by value, not by reference!!!
  				$slices[$till+1]['from']=$till+1; // write second new slice
  				$slices[$till+1]['till']=$slice['till'];
  				
  				$slices[$start]['till']=$from-1; // update old slice
  				$checksum+=1;
  			}
  			if ($start<$from && $end <=$till){ // range starts in sclice [ < } or [ < ] > -- result: [ | ]
  				$slices[$from]=$slice; // create new slice
  				$slices[$from]['from']=$from;
  				$slices[$from]['rooms'][$room]=$mate;
  				
  				$slices[$start]['till']=$from-1; // update old slice
  				$checksum+=1;
  			}
  			if ($from <= $start && $till < $end){ // range ends in slice < [ > ] or { > ] -- result: [ | ]
  				$slices[$till+1]=$slice; // create new slice
  				$slices[$till+1]['from']=$till+1;
  				
  				$slices[$start]['till']=$till; // update old slice 
  				$slices[$start]['rooms'][$room]=$mate;
  				$checksum+=1;
  			}
  			if ($checksum>1){
  				print "checksum = $checksum:\n";
  				die('something went wrong in getAssociationsFor()');
  			}
  		} 
  	}  	
  	return $slices;
  }
  
  /* calculated distribution of an invoice to the flatmates present during the invoice duration */
  function distributeInvoice($invoice,&$balances){
  	global $data;
  	$invoice_id=$invoice['id'];
  	$dist_id=$invoice['distribution'];
  	 
  	$slices=getAssociationsFor($invoice); // get the time slices for flatmate assignments in this time
  	ksort($slices);
  	$distribution=$data['distributions'][$dist_id];
  	$len=getNumberOfDays($invoice);
  	$invoice_bal=array();
  	foreach ($slices as $slice){  		
  		$slice_len=getNumberOfDays($slice);
  		$invoice_part=$slice_len/$len;
  		$unpaid=0;
  		$members=0;
  		$partsum=0;
  		$rooms=$slice['rooms'];
  		foreach ($distribution['rooms'] as $room_id => $part){
  			$partsum+=$part;  			
  		}
			foreach ($distribution['rooms'] as $room_id => $part){
  			if (isset($rooms[$room_id])){ // room was occupied for this slice of time
  				$mate=$rooms[$room_id];
  				if (!isset($invoice_bal[$mate])){
  					$invoice_bal[$mate]=0;
  				}
  				$invoice_bal[$mate]=$invoice_bal[$mate]+$invoice_part*$part/$partsum;
  				$members+=1;
  			} else { // room was not occupied => allotment shall be splitted evenly
  				$unpaid+=$invoice_part*$part/$partsum;
  			}  			
  		}
  		foreach ($rooms as $room_id => $mate){ // evenly split allotment of unoccupied rooms
  			$invoice_bal[$mate]=$invoice_bal[$mate]+$unpaid/$members;
  		}
  	}
  	foreach ($invoice_bal as $mate => $part){
  		if ($part==0) continue;
  		if ($part<0) die('For some reason, a flatmate has a negative part on an invoice. This should not be the case.');
  		if (!isset($balances[$mate])){
  			$balances[$mate]=array();
  		}
  		$balances[$mate][$invoice_id]=array('value'=>$invoice['value'],'description'=>$invoice['description'],'part'=>$part);
  	}
  }
  
  function readBalance($flatmate){
  	global $data, $balance;
  	$balances=array();
  	foreach ($data['invoices'] as $invoice){
  		distributeInvoice($invoice,$balances);
  	}
  	$balance=$balances[$flatmate['id']];
  }
  
  function addPayment($mate_id,$payment){
  	global $data, $warnings;
  	if (!isset($payment['value'])){
  		$warnings[]=t('You can not add a payment without value!');
  		return;
  	}
  	$payment['value']=str_replace(',','.',$payment['value']);
  	if (!is_numeric($payment['value'])){
  		$warnings[]=t('given payment value is not a number');
  		return;
  	}  	 
  	if ($payment['value']==0){
  		$warnings[]=t('You must not add payments with zero value!');
  		return;
  	}  	
  	if (!isset($data['payments'])){
  		$data['payments']=array();
  	}
  	if (!isset($data['payments'][$mate_id])){
  		$data['payments'][$mate_id]=array();
  	}
  	$id=count($data['payments'][$mate_id]);
  	$payment['id']=$id;
  	$data['payments'][$mate_id][$id]=$payment;
  }