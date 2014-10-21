<?php

include 'init.php';
include 'templates/head.php';
include 'templates/overview.php';
if (isset($_POST['action'])){
	$action=$_POST['action'];
	if ($action=='edit flatmate'){
		editFlatmate($_POST['flatmate']);
		include 'templates/flatmate_man.php';
				
	} else 	if ($action=='new flatmate'){
		addFlatmate($_POST['flatmate']);
		include 'templates/flatmate_man.php';
				
	} else if ($action=='association'){
		include 'templates/association_man.php';
		
	} else if ($action=='room'){
		editRoom($_POST['room']);
		include 'templates/room_man.php';		
	}
} else if (isset($_POST['manage_flatmates'])){
	getData();
	include 'templates/flatmate_man.php';
} else if (isset($_POST['manage_invoices'])){
	include 'templates/invoice_man.php';
} else if (isset($_POST['manage_distributions'])){
	include 'templates/distribution_man.php';
} else if (isset($_POST['newroom'])){
  addRoom($_POST['newroom']);
  include 'templates/room_man.php';
} else if (isset($_POST['manage_rooms'])){
  include 'templates/room_man.php';
} else if (isset($_POST['newdistribution'])){
  print_r($_POST);
  addDistribution($_POST['newdistribution']);
  include 'templates/distribution_man.php';
} else if (isset($_POST['distribution'])){
  editDistribution($_POST['distribution']);
  include 'templates/distribution_man.php';
  print_r($data);
} 	
?><pre><?php 
print_r($_POST);
?></pre><?php

include 'templates/foot.php';
