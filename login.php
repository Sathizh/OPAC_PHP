<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
  require('connection.php');
  session_start();
    if (isset($_POST['submit'])){
    
    $username = stripslashes($_POST['username']); 
    $username = mysqli_real_escape_string($con,$username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($con,$password);
    
        $query = "SELECT * FROM `pub_user` WHERE name='$username' and password='".md5($password)."'";
    $result = mysqli_query($con,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    $roll = mysqli_fetch_assoc($result);
        if($rows==1){
      $_SESSION['username'] = $username;
            header("location:index.php?username=".$username);
            
            }else{

              header("location:login.php?error=urp&uname=".$username);
        }
    }elseif(!isset($_REQUEST['pass']) and !isset($_REQUEST['sub']) and !isset($_REQUEST['next'])){
?>
<form class="box"  method="POST" >
  <h1>Login</h1>
  <input type="text" name="username" placeholder="Username" required/>
  <input type="password" name="password" placeholder="Password" maxlength="13" required/>
  <input type="submit" name="submit" value="Login"/>
  <a href="signup.php">New Registration</a><br><br>
  <a href="login.php?pass=passd">Forget Password?</a><br><br>
  <a href='index.php'>&laquo; GoBack</a>

</form>
  </body>
<?php } if (isset($_GET['error'])) {
       if ($_GET['error'] == 'urp') {
        echo "<a href='javascript:history.go(-1)'><h4 class='error'>Username Or Password Is Incorrect</h4></a>";
      }
      
    }
    if (isset($_REQUEST['pass']))
      {
        ?>
    <form class="box"  method="POST">
     <h3>Forget Passwod</h3>
   <input type="text" name="username" placeholder="Username" required/>
     <input id="positive" type="submit" name="sub" value="Send"  style="width: 120px" />
   <a id="negative" href="login.php" style="width: 45px" >Cancel</a>
    </form>
            <?php 
            if (isset($_REQUEST['sub']) and isset($_REQUEST['username']))
             {
                  $username = stripslashes($_POST['username']); 
                  $username = mysqli_real_escape_string($con,$username);
                  $query = "SELECT * FROM `pub_user` WHERE name='$username' ";
                  $result = mysqli_query($con,$query) or die(mysql_error());
                  $rows = mysqli_num_rows($result);
                  $data = mysqli_fetch_assoc($result);
                  $mail_id=$data['email'];
                  $name=$data['name'];
                  $password=$data['password'];
                  $mail_id1=substr($mail_id,0,3);
                  $mail_id2=substr($mail_id,7);
              if($rows == 1)
              {                  
                  $headers = "From:sathishm.17msc@kongu.edu\r\n";
                  $headers .= "Reply-To: ". $mail_id . "\r\n";
                  $headers .= "CC: ". $mail_id ."\r\n";
                  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                  $message = '<p><strong>Username : </strong>'.$name.'<br><br><strong>Password : </strong>'.$password.'</p>';
                  if(mail($mail_id, 'OPAC message',$message,$headers)){
                      echo "<div class='box'><h4 style='color:white'> Password was send to your registerd Email id of '' $mail_id1 ... $mail_id2''</h4><br/> <a href='login.php?next=go'>Okay</a></div>";
                      }
                  else
                    echo "<div class='box'><h4 style='color:white'>Something went wron! try after few minits or check your internet connection.</h4><br/> <a href='login.php'>Okay</a></div>";
                
                }
              else
                  echo "<div class='box'><h4 style='color:white'> username is incorrect !</h4><br/> <a href='javascript:history.go(-1)'>Okay</a></div>";
            }
            
      } 
      if(isset($_REQUEST['next']))
      {?>
        <form class="box" method="post">
          <h3>Resetting Password</h3>
          <input type="text" name="username" placeholder="Username" required/>
          <input type="password" name="password" placeholder="Password" required="">
           <input id="positive" type="submit" name="reset" value="Reset"  style="width: 120px" />
        </form>
                        
                    <?php
        if (isset($_REQUEST['reset'])) {
          $username = stripslashes($_POST['username']); 
          $username = mysqli_real_escape_string($con,$username);
          $password = stripslashes($_POST['password']); 
          $password = mysqli_real_escape_string($con,$password);
          $query = "SELECT * FROM `pub_user` WHERE name='$username' and password='$password' ";
          $result = mysqli_query($con,$query) or die(mysql_error());
          $rows = mysqli_num_rows($result);
          if($rows == 1)
          { ?>
            <form class="box" method="post">
              <h3>New Password</h3>
              <input type="hidden" name="username" value="<?php echo $username; ?>">
              <input type="password" name="password" placeholder="password" maxlength="13" required/>
              <input type="password" name="cpassword" placeholder="Confrim password" maxlength="13"  required/>
              <input id="positive" type="submit" name="change" value="Change"  style="width: 120px" />
              
            </form>
            
         <?php 
       }
          else{
            echo "<div class='box'><h4 style='color:white'> Check your details</h4><br/> <a href='javascript:history.go(-1)'>Okay</a></div>";
          }
         
        }

      if(isset($_REQUEST['change'])){
          $username = stripslashes($_POST['username']); 
          $username = mysqli_real_escape_string($con,$username);
          $password = stripslashes($_POST['password']); 
          $password = mysqli_real_escape_string($con,$password);
          $cpassword = stripslashes($_POST['cpassword']); 
          $cpassword = mysqli_real_escape_string($con,$cpassword);
          if($password === $cpassword)
          {
            $cpassword=md5($cpassword);
            $query = "UPDATE `pub_user` SET `password`= '$cpassword' WHERE name='$username'";
            $result = mysqli_query($con,$query) or die(mysql_error());
            echo "<div class='box'><h4 style='color:white'> Password resetted successfully</h4><br/> <a href='login.php'>Okay</a></div>";
          }
          else
            echo "<div class='box'><h4 style='color:white'> Password and confrim password is not match </h4><br/> <a href='javascript:history.go(-2)'>GoBack</a></div>";

         }
                      }
             ?>   
</body>
</html>
