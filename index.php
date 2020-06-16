<?php
	// Message Vars
	$msg = '';
	$msgClass = '';

	// Check For Submit
	if(filter_has_var(INPUT_POST, 'submit')){
		// Get Form Data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$phonenumber = htmlspecialchars($_POST['phonenumber']);

		// Check Required Fields
		if(!empty($email) && !empty($name) && !empty($message)){
			// Passed
			// Check Email
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				// Failed
				$msg = 'Please use a valid email';
				$msgClass = 'alert-danger';
			} else {
				// Passed
				$toEmail = 'support@traversymedia.com';
				$subject = 'Contact Request From '.$name;
				$body = '<h2>Contact Request</h2>
					<h4>Name</h4><p>'.$name.'</p>
					<h4>Email</h4><p>'.$email.'</p>
					<h4>phonenumber</h4><p>'.$phonenumber.'</p>
				';

				// Email Headers
				$headers = "MIME-Version: 1.0" ."\r\n";
				$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

				// Additional Headers
				$headers .= "From: " .$name. "<".$email.">". "\r\n";

				if(mail($toEmail, $subject, $body, $headers)){
					// Email Sent
					$msg = 'Your email has been sent';
					$msgClass = 'alert-success';
				} else {
					// Failed
					$msg = 'Your email was not sent';
					$msgClass = 'alert-danger';
				}
			}
		} else {
			// Failed
			$msg = 'Please fill in all fields';
			$msgClass = 'alert-danger';
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Registration form</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Register Form</a>
			</div>
		</div>
	</nav>
	<div class="container">
		<form method="post" action="<? php echo $_SERVER['PHP_SELF']; ?>"
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="name" class="form-control" value="">
			</div>
			<div class="form-group">
				<label>E-mail</label>
				<input type="e-mail" name="email" class="form-control" value="">
			</div>
			<div class="form-group">
				<label>Phone Number</label>
				<input type="text" name="phonenumber" class="form-control" value="">
			</div>
			<div class="form-group">
				<label>Branch</label>
				<input type="text" name="branch" class="form-control" value="">
			</div>
   			<br>
			<button type="submit" name="submit" class="btn btn-primary">Submit</button>

	</div>

</body>
</html>