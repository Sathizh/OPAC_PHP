<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>BarrowBook</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php
    require('connection.php'); 
     require('sess.php');
        $username=$_SESSION['username'];
       $ISBN=$_GET['num'];
       $tit=$_GET['tit'];
       $nam=$_GET['nam'];
       $days=$_GET['days'];
       $type=$_GET['typ'];
          $book_check_query ="SELECT * from `bookdata`  WHERE `bookdata`.`ISBN` = $ISBN";
        $results = mysqli_query($con,$book_check_query)or die(mysql_error());
        $book = mysqli_fetch_assoc($results);
        if($results)
        {
           
            if($book['ISBN'] == $ISBN and $days >=0){
                 $query = "DELETE from  `borrow` WHERE `title` ='$tit' and `name`='$username'";
                $result = mysqli_query($con,$query)or die(mysql_error());
                if($result){
                    $query = "UPDATE `bookdata` SET `bookdata`.`Qty` = `Qty`+1  WHERE `bookdata`.`ISBN` = '$ISBN' ";
                $result = mysqli_query($con,$query)or die(mysql_error());
                if($result){
            echo "<div class='box'><h3>Your selected book returned successfully !</h3><br/>Click here to ";
               } 
        }
                ?>
                <a href='myhistory.php'>&laquo; GoBack</a>
                <?php
            echo "</div>";
        }
        elseif($book['ISBN'] != $ISBN){
            $query = "INSERT into `bookdata` (title,name,ISBN,criteria,Qty,location) VALUES ('$tit', '$nam', '$ISBN','$type',1,'Return center')";
                $result = mysqli_query($con,$query)or die(mysql_error());
                 if($result){
            echo "<div class='box'><h3>Your selected book returned successfully !</h3><br/>Click here to ";
            } 
               ?>
                <a href='myhistory.php'>&laquo; GoBack</a>
                <?php
            echo "</div>";

        }
        else{
          $days=abs($days);
          echo "<div class='box'><h3>Pay your fine amount..! Rs.$days</h3><br/>Click here to ";
           ?>
                <a href='myhistory.php'>&laquo; GoBack</a>
                <?php
        }
      }
        
?>
</body>
</html>
