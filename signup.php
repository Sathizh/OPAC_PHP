
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
  require('connection.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username);	 //escapes special characters in a string
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$ph = $_REQUEST['ph'];
		$address = stripslashes($_REQUEST['address']);
		$address = mysqli_real_escape_string($con,$address);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		$cpassword = stripslashes($_REQUEST['cpassword']);
		$cpassword = mysqli_real_escape_string($con,$cpassword);
		if($password === $cpassword)
		{
        $user_check_query ="SELECT * FROM pub_user WHERE name ='$username' or email ='$email' or ph='$ph' LIMIT 1";
		$results = mysqli_query($con,$user_check_query)or die(mysql_error());
		$user = mysqli_fetch_assoc($results);
		if($results)
		{
			  $query = "SELECT * FROM `pub_user` WHERE name='$username'";
   			  $result = mysqli_query($con,$query) or die(mysql_error());
    		  $rows = mysqli_num_rows($result);
			if($rows===1)
				{
		           header("location:signup.php?error=ere&type=Username");
				}
			if($user['email'] === $email)
				{
        			 header("location:signup.php?error=ere&type=Email");

				}
				if($user['ph'] === $ph)
				{
         header("location:signup.php?error=ere&type=Phone Number");

				}

			if($rows != 1 and $user['email'] != $email and $user['ph'] != $ph){
				$query = "INSERT into `pub_user` (name, password,ph, email,address,roll) VALUES ('$username', '".md5($password)."', '$ph', '$email', '$address','Public')";
        		$result = mysqli_query($con,$query)or die(mysql_error());
				if($result){
            echo "<div class='box'><h3>You are registered successfully.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
        }

        }
		}
	}
	else{
			header("location:signup.php?error=pac&type=Password and Confrim Password are Mismatch!");
	}
    }else{
?>
<form class="box" action="" method="post">
<h1>Registration</h1>
<input type="text" name="username" placeholder="Username" required />
<input type="password" name="password" placeholder="Password" maxlength="13" required />
<input type="password" name="cpassword" placeholder="Confrim Password" maxlength="13" required />
<input type="email" name="email" placeholder="Email" required />
<input type="text" name="ph" placeholder="Phone Number"  pattern="[0-9]{10}" maxlength="10" required/>   
<input type="text" name="address" placeholder="Address" required />
<input type="submit" name="submit" value="Register" /><a href='login.php'>&laquo; GoBack</a> 
<?php 
    if (isset($_GET['error'])) {
       if ($_GET['error'] == 'ere') {
       		$type=$_GET['type'];
        echo "<a href='javascript:history.go(-1)'><h4 class='error'>$type Is already exist!</h4></a>";
      }
      elseif ($_GET['error'] == 'pac') {
      	$type=$_GET['type'];
      	echo "<a href='javascript:history.go(-1)'><h4 class='error'>$type</h4></a>";
      }
    }

  ?> 
</form>
<?php } ?>
</body>
</html>