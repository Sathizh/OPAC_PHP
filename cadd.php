<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AddBook</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php 
 require_once("addbook.php");
                        $title=$_GET['title'];
                        $name=$_GET['name'];
                        $ISBN=$_GET['ISBN'];
                        $criteria=$_GET['criteria'];
                        $Qty=$_GET['Qty'];
                        $location=$_GET['location'];
                        $query = "INSERT into `bookdata` (title,name,ISBN,criteria,Qty,location) VALUES ('$title', '$name', '$ISBN','$criteria', '$Qty','$location')";
               $result = mysqli_query($con,$query)or die(mysql_error());
                        if ($result)
                            {
                            	
                                echo "<div class='box'><h3>Book added successfully !</h3><br/>Click here to <a href='javascript:history.go(-2)'>Add More Book</a></div>";
                            }
                        else{
                                header("Location: addbook.php");
                            }
     ?>
     </body>
</html>