<?php

include 'init.php';

include 'templates/head.php';

	
if (isset($_POST['action'])){
	if (isset($_SESSION['user'])){
	  include 'templates/overview.php';
	}
	$action=$_POST['action'];
	if ($action=='add association'){
		addAssociation($_POST['association']);
		$_POST['room']=array('id'=>$_POST['association']['room']); // needed for assoc manager
		include 'templates/association_man.php';
		
	} else if ($action=='add distribution'){
		addDistribution($_POST['distribution']);
		calculate();
		include 'templates/distribution_man.php';
		
	} else 	if ($action=='add flatmate'){
		addFlatmate($_POST['flatmate']);
		include 'templates/flatmate_man.php';
	
	} else 	if ($action=='add invoice'){
		addInvoice($_POST['invoice']);
		include 'templates/invoice_man.php';
	
	} else if ($action=='add payment'){
		$flatmate_id=$_POST['flatmate']['id'];
		addPayment($flatmate_id,$_POST['payment']);
		include 'templates/payment_man.php';
		
	} else if ($action=='add room'){
		addRoom($_POST['room']);
		calculate();
		include 'templates/room_man.php';
		
	} else if ($action=='edit association'){
		editAssociation($_POST['association']);
		$_POST['room']=array('id'=>$_POST['association']['room']); // needed for assoc manager
		include 'templates/association_man.php';
		
	} else if ($action=='edit distribution'){
		editDistribution($_POST['distribution']);
		calculate();
		include 'templates/distribution_man.php';
		
	} else if ($action=='edit flatmate'){
		editFlatmate($_POST['flatmate']);
		include 'templates/flatmate_man.php';
				
	} else if ($action=='edit invoice'){
		editInvoice($_POST['invoice']);
		include 'templates/invoice_man.php';
				
	} else if ($action=='edit payment'){
		$flatmate_id=$_POST['flatmate']['id'];
		editPayment($flatmate_id,$_POST['payment']);
		include 'templates/payment_man.php';
		
	} else if ($action=='edit room'){
		editRoom($_POST['room']);
		calculate();
		include 'templates/room_man.php';
						
	} else if ($action=='manage associations'){
		if (!isset($data['flatmates']) || empty($data['flatmates'])){
			$warnings[]=t('Can not assign flat mates: no flat mates given.');
			include 'templates/flatmate_man.php';
		} else {
			include 'templates/association_man.php';
		}

	} else if ($action=='manage distributions'){
		calculate();
		include 'templates/distribution_man.php';
		
	} else if ($action=='manage flatmates'){
		include 'templates/flatmate_man.php';
		
	} else if ($action=='manage invoices'){
		include 'templates/invoice_man.php';
		
	} else if ($action=='manage rooms'){
		calculate();
		include 'templates/room_man.php';
			
	} else if ($action=='register'){
		if (isset($_POST['newuser'])){
			if (addUser($_POST['newuser'])){
				include 'templates/overview.php';
				include 'templates/registered.php';				
			} else {
				$_POST['username']=$_POST['newuser']['nick'];
				include 'templates/register.php';
			}
		} else {
			include 'templates/register.php';
		}

  } else if ($action=='send account mail'){
		sendAccountMail();
		include 'templates/overview.php';
	} else if ($action=='show balance'){
		readBalance($_POST['flatmate']);
		include 'templates/balance_man.php';
			
	} else if ($action=='show payments'){
		include 'templates/payment_man.php';
	
	}
} else { // no action
	if (isset($_SESSION['user'])){
		include 'templates/overview.php';
	} else {	
		include 'templates/login_man.php';
	}
}

include 'templates/foot.php';
