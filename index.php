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
		
	} else if ($action=='add room'){
		addRoom($_POST['room']);
		include 'templates/room_man.php';
		
	} else if ($action=='edit association'){
		editAssociation($_POST['association']);
		$_POST['room']=array('id'=>$_POST['association']['room']); // needed for assoc manager
		include 'templates/association_man.php';
		
	} else if ($action=='edit flatmate'){
		editFlatmate($_POST['flatmate']);
		include 'templates/flatmate_man.php';
				
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
		
	} else 	if ($action=='new flatmate'){
		addFlatmate($_POST['flatmate']);
		include 'templates/flatmate_man.php';
				
	}
} else if (isset($_POST['newdistribution'])){
  print_r($_POST);
  addDistribution($_POST['newdistribution']);
  include 'templates/distribution_man.php';
} else if (isset($_POST['distribution'])){
  editDistribution($_POST['distribution']);
  include 'templates/distribution_man.php';
  print_r($data);
} 	
?><pre>POST:
<?php 
print_r($_POST);
?>DATA:
<?php
print_r($data);
?></pre><?php

include 'templates/foot.php';
