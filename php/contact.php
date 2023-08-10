<?php

if(!$_POST) exit;
require_once '../admin/db_connect.php';

$firstname     = $_POST['firstname'];
$lastname     = $_POST['lastname'];
$email    = $_POST['email'];
$comments = $_POST['comments'];
$phone = $_POST['phone'];


$query = "INSERT INTO `messages` (`message_id`, `firstname`, `lastname`, `email`, `phone`, `message`) 
VALUES 
(NULL, '$firstname', '$lastname', '$email', '$phone', '$comments');";


$send = mysqli_query($con,$query) or die('mysql error');

if($send) {

	
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	//$headers .= 'From: <'.$email.'>' . "\r\n";

	//mail('araz.masiki@gmail.com','you have new message',$comments,$headers);

	
	echo "<fieldset>";
	echo "<div id='success_page'>";
	echo "<h5 class='text-success'>Message Sent Successfully.</h5>";
	echo "<p>Thank you <strong>$firstname</strong>, your message has been submitted to us.</p>";
	echo "</div>";
	echo "</fieldset>";

} else {

	echo 'ERROR!';

}