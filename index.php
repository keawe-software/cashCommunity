<?php

include 'init.php';
include 'templates/head.php';
include 'templates/overview.php';
if (isset($_POST['edit'])){
	$edit=$_POST['edit'];
	if ($edit=='flatmate'){
		editFlatmate($_POST['flatmate']);
		include 'templates/flatmate_man.php';		
	} else if ($edit=='association'){
		include 'templates/association_man.php';
	} else if ($edit=='room'){
		editRoom($_POST['room']);
		include 'templates/room_man.php';		
	}
} else if (isset($_POST['newflatmate'])){
	addFlatmate($_POST['newflatmate']);
	include 'templates/flatmate_man.php';
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
