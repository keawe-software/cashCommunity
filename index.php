<?php

include 'init.php';
include 'templates/head.php';

if (isset($_POST['manage_invoices'])){
	include 'templates/invoice_man';
} else if (isset($_POST['manage_flatmates'])){
	
	include 'templates/flatmate_man';
} else if (isset($_POST['manage_distributions'])){
	include 'templates/distribution_man';
} else if (isset($_POST['manage_rooms'])){
	include 'templates/room_man';
} else {
	include 'templates/overview.php';	
}

include 'templates/foot.php';