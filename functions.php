<?php
	
	function getJson(){
		global $db;
		if (!isset($_SESSION['user'])){
			die('Error: getJson called for unknown user!');
		}
		$sql="SELECT data FROM data WHERE username=:username";
		$stm=$db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$stm->execute(array(':username'=>$_SESSION['user']));
		$results=$stm->fetchAll();
		return $results[0]['data'];
	}

  function getData(){ // TODO: dies is nun typ-spezifisch und muss nochmal angepasst werden!
  	global $data;
  	if (!isset($data)){
  		$data=json_decode(getJson(),true);
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
    global $data, $flat_size, $base_dist, $warnings;
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
  	global $warnings;
  	if ($_SESSION['expired']){
  		$warnings[]=t('Your test period expired. You can still view your data, but any changes will be lost immediately. Please purchase a license to continue using all features');
  		return;
  	}
  	$json=json_encode($data);
  	global $db;
  	if (!isset($_SESSION['user'])){
  		die('Error: saveData called for unknown user!');
  	}
  	$sql="UPDATE data SET data=:json WHERE username=:username";
  	$stm=$db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  	$stm->execute(array(':json'=>$json,':username'=>$_SESSION['user']));
  }

  function editDistribution($dist){
  	global $data, $warnings;
  	if (empty($dist)){
  		$warnings[]=t('no distribution data given');
  		return;
  	}
  	if (empty($dist['rooms'])){
  		$warnings[]=t('distribution contains no values!');
  		return;
  	}
  	foreach ($dist['rooms'] as $room_id => $room){
  		$room=str_replace(',','.',$room);
  		$dist['rooms'][$room_id]=$room;  		  		
  		if (!is_numeric($room)){
  			$warnings[]=str_replace('%d',$room,t('%d is not a valid value'));
  			return;
  		}
  	}
  	if (!isset($data['distributions'])){
  		$data['distributions']=array();
  	}  	 
  	$id=$dist['id'];
    $data['distributions'][$id]=$dist;
    saveData($data);
  }
  
  function addDistribution($dist){
  	global $data;
  	$dist['id']=count($data['distributions']);
  	editDistribution($dist);
  }
  
  function editFlatmate($flatmate){
  	global $data;
    if (!isset($data['flatmates'])){
    	$data['flatmates']=array();
    }
  	$id=$flatmate['id'];
  	$data['flatmates'][$id]=$flatmate;
  	saveData($data);
  }
  
  function addFlatmate($flatmate){
    global $data;
    $flatmate['id']=count($data['flatmates']);
    editFlatmate($flatmate);
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
  	if (!isset($data['rooms'])){
  		$data['rooms']=array();
  	}
		$id=$room['id'];
  	$data['rooms'][$id]=$room;
  	saveData($data);
  }
  
	function addRoom($room){
  	global $data;
  	if (!isset($data['rooms'])){
  		$data['rooms']=array();
  	}  	
  	$room['id']=count($data['rooms']);
  	editRoom($room);
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
  	if (!isset($data['invoices'])){
  		$data['invoices']=array();
  	}
  	if (isset($invoice['from']) && !empty($invoice['from'])){  		
  		$invoice['from']=dateToDay($invoice['from']);
  		if (isset($invoice['till'])){
  			$invoice['till']=dateToDay($invoice['till']);
  		}  		
  	} else {
  		if (isset($invoice['till']) && !empty($invoice['till'])){
  			$invoice['from']=dateToDay(substr($invoice['till'], 0,7));
				$oneMonthLater=$invoice['from']+31;						
				$invoice['till']=dateToDay(substr(daysToDate($oneMonthLater),0,7))-1;
  		} else {
  			$warnings[]=t('No date given for invoice!');
  		}  		
  	}
  	$id=$invoice['id'];
  	$data['invoices'][$id]=$invoice;
  	saveData($data);
  }
  
  
  function addInvoice($invoice){
  	global $data;
  	if (!isset($data['invoices'])){
  		$data['invoices']=array();
  	}		
  	$invoice['id']=count($data['invoices']);
  	editInvoice($invoice);
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
  
  function addAssociation($assoc){
  	global $data;  	  	  	
  	$assoc['id']=count($data['associations']);
  	editAssociation($assoc);
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
  		$balances[$mate][$invoice_id]=array('value'=>$invoice['value'],'description'=>$invoice['description'],'part'=>$part,'date'=>daysToDate($invoice['from']));
  	}
  }
  
  function readBalance($flatmate){
  	global $data, $balance;
  	$balances=array();
  	foreach ($data['invoices'] as $invoice){
  		distributeInvoice($invoice,$balances);
  	}
  	if (isset($flatmate['id']) && isset($balances[$flatmate['id']])){
  		$balance=$balances[$flatmate['id']];
  	} else {
  		$balance=array();
  	}
  }
  
  function editPayment($mate_id,$payment){  	
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
  	if (isset($payment['date'])){
  		$payment['date']=dateToDay($payment['date']);
  	}
  	if (!isset($data['payments'])){
  		$data['payments']=array();
  	}
  	if (!isset($data['payments'][$mate_id])){
  		$data['payments'][$mate_id]=array();
  	}
  	$id=$payment['id'];
  	$data['payments'][$mate_id][$id]=$payment;
  	saveData($data);
  	
  }
  
  function addPayment($mate_id,$payment){
  	global $data;
  	if (!isset($data['payments'][$mate_id])){
  		$data['payments'][$mate_id]=array();
  	}
  	$payment['id']=count($data['payments'][$mate_id]);
  	editPayment($mate_id, $payment);
  }
  
  /* assures the existence of all required database tables */
  function checkTables($db){
  	$results=$db->query("SHOW TABLES LIKE 'data'");
  	if (!$results){
  		die(print_r($dbh->errorInfo(), TRUE));
  	}
  	if ($results->rowCount()<1){
  		//      echo "table doesn't exist\n";
  		$sql = 'CREATE TABLE data (username VARCHAR(100) PRIMARY KEY, password VARCHAR(100), validity INT NOT NULL, data TEXT);';
  		$db->exec($sql);
  		//    } else {
  		//      echo "table exists\n";
  	}
  }
  
  /* this was written using http://code.tutsplus.com/tutorials/why-you-should-be-using-phps-pdo-for-database-access--net-12059 */
  function connectToDb($host,$database,$user,$pass){
  	try {
  		$db = new PDO("mysql:host=$host;dbname=$database", $user, $pass, array(PDO::ATTR_PERSISTENT => true)); // open db connection and cache it
  		//      print "databse opened\n";
  		return $db;
  	} catch (PDOException $pdoex) {
  		die($pdoex->getMessage());
  	}
  }
  
  function addUser($user){
  	global $warnings, $db, $testdays;
  	$minlen=6;
  	$nick=trim($user['nick']);
		$pass1=trim($user['password']);
		$pass2=trim($user['password2']);
		if (strlen($pass1)<$minlen){
			$warnings[]=str_replace('%length', $minlen, t('Password must be at least %length characters long!'));
			return false;
		}
		if ($pass1!=$pass2){
			$warnings[]=t('passwords do not match!');
			return false;
		}
		$sql="SELECT count(*) FROM data WHERE username=:username";
    $stm=$db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stm->execute(array(':username'=>$nick));
    $results=$stm->fetchAll();
    if ($results[0][0]>0){
    	$warnings[]=str_replace('%username', $nick, t('Username <strong>%username</strong> already registerd!'));
    	return false;
    }
    $pass=sha1($pass1);
    $validity=today()+$testdays;
    $sql="INSERT INTO data (username,password,validity) VALUES (:username,:password,$validity)";		
    $stm=$db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stm->execute(array(':username'=>$nick,':password'=>$pass));
    $_SESSION['user']=$nick;
    return true;
  }
