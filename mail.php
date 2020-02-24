<?php 
		// if(mail('sathizh20@gmail.com', 'OPAC message','Username: ','From:sathishm.17msc@kongu.edu'))
		// 	echo "sent succc";
		// else
		// 	echo "error";
		$to = 'sathizh20@gmail.com';

$subject = 'Password Change Reqest';

$headers = "From: " . $to . "\r\n";
$headers .= "Reply-To: ". $to . "\r\n";
$headers .= "CC: sathizh20@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$message = '<p><strong>This is strong text</strong> while this is not.</p>';


mail($to, $subject, $message, $headers);
 ?>