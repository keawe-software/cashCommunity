<?php

include 'init.php';
include 'templates/head.php';

if (isset($_POST['flatmate'])){
	editFlatmate($_POST['flatmate']);
	include 'templates/flatmate_man.php';
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
} else if (isset($_POST['room'])){
  editRoom($_POST['room']);
  include 'templates/room_man.php';
} else if (isset($_POST['newroom'])){
  addRoom($_POST['newroom']);
  include 'templates/room_man.php';
} else if (isset($_POST['manage_rooms'])){
  include 'templates/room_man.php';
} else if (isset($_POST['newdistribution'])){
  print_r($_POST);
  addDistribution($_POST['newdistribution']);
  include 'templates/manage_distributions';
} else {
	include 'templates/overview.php';	
}

include 'templates/foot.php';
