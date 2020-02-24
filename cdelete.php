<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DeleteBook</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<form method="post">
<?php 
 require_once("deletebook.php");
                        $ISBN=$_GET['ISBN'];
                        $query = "DELETE FROM `bookdata` WHERE `bookdata`.`ISBN` = $ISBN";
                         $result = mysqli_query($con,$query)or die(mysql_error());
                        if ($result)
                            {
                            	
                                echo "<div class='box'><h3>Book deleted successfully.</h3><br/>Click here to <a href='javascript:history.go(-1)'>Delete More Book</a></div>";
                            }
                        else{
                                 header("Location: addbook.php");
                            }
     ?>
  </form>   </body>
</html>