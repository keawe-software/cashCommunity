<?php

include 'init.php';

include 'templates/head.php';
include 'templates/overview.php';
if (isset($_POST['action'])){
	$action=$_POST['action'];
	if ($action=='add association'){
		addAssociation($_POST['association']);
		$_POST['room']=array('id'=>$_POST['association']['room']); // needed for assoc manager
		include 'templates/association_man.php';
		
	} else if ($action=='add distribution'){
		addDistribution($_POST['distribution']);
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
		include 'templates/room_man.php';
		
	} else if ($action=='edit association'){
		editAssociation($_POST['association']);
		$_POST['room']=array('id'=>$_POST['association']['room']); // needed for assoc manager
		include 'templates/association_man.php';
		
	} else if ($action=='edit distribution'){
		editDistribution($_POST['distribution']);
		include 'templates/distribution_man.php';
		
	} else if ($action=='edit flatmate'){
		editFlatmate($_POST['flatmate']);
		include 'templates/flatmate_man.php';
				
	} else if ($action=='edit invoice'){
		editInvoice($_POST['invoice']);
		include 'templates/invoice_man.php';
				
	} else if ($action=='edit payment'){
		$flatmate_id=$_POST['flatmate'];
		editPayment($flatmate_id,$_POST['payment']);
		$_POST['flatmate']=$data['flatmates'][$flatmate_id];
		include 'templates/payment_man.php';
		
	} else if ($action=='edit room'){
		editRoom($_POST['room']);
		include 'templates/room_man.php';
						
	} else if ($action=='manage associations'){
		include 'templates/association_man.php';

	} else if ($action=='manage distributions'){
		include 'templates/distribution_man.php';
		
	} else if ($action=='manage flatmates'){
		include 'templates/flatmate_man.php';
		
	} else if ($action=='manage invoices'){
		include 'templates/invoice_man.php';
		
	} else if ($action=='manage rooms'){
		include 'templates/room_man.php';
			
	} else if ($action=='show balance'){
		readBalance($_POST['flatmate']);
		include 'templates/balance_man.php';
			
	} else if ($action=='show payments'){
		include 'templates/payment_man.php';
	
	}
} 	


include 'templates/foot.php';
