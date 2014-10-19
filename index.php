<?php

include 'init.php';
include 'templates/head.php';

if (isset($_POST['flatmate'])){
	$data=editFlatmate($_POST['flatmate']);
	include 'templates/flatmate_man.php';
} else if (isset($_POST['newflatmate'])){
	$data=addFlatmate($_POST['newflatmate']);
	include 'templates/flatmate_man.php';
} else if (isset($_POST['manage_flatmates'])){
	$data=getData();
	include 'templates/flatmate_man.php';
} else if (isset($_POST['manage_invoices'])){
	include 'templates/invoice_man.php';
} else if (isset($_POST['manage_distributions'])){
	include 'templates/distribution_man.php';
} else if (isset($_POST['room'])){
  $data=editRoom($_POST['room']);
  include 'templates/room_man.php';
} else if (isset($_POST['manage_rooms'])){
  $data=getData();
	include 'templates/room_man.php';
} else {
	include 'templates/overview.php';	
}

include 'templates/foot.php';
