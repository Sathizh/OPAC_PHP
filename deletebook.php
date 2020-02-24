<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>DeleteBook</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php

    require_once('connection.php'); 
     include("sess.php");
     
   $username=$_SESSION['username'];
    $query = "SELECT * FROM `pub_user` WHERE name='$username' and roll='admin'";
    $result = mysqli_query($con,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
  if($rows==1)
  {
    if (isset($_REQUEST['ISBN'])){
		$ISBN = stripslashes($_REQUEST['ISBN']);
		
		$ISBN = mysqli_real_escape_string($con,$ISBN);
        $book_check_query ="SELECT * from `bookdata`  WHERE `bookdata`.`ISBN` = $ISBN";
        $results = mysqli_query($con,$book_check_query)or die(mysql_error());
        $book = mysqli_fetch_assoc($results);
        if($results)
        {
            if($book['ISBN'] === $ISBN)
                { ?>
                	<div class='box'><h3>are you sure to delete the ISBN/ISSN <?php echo "<br><br>'' $ISBN ''" ?> </h3><br/>  <a id="positive" style="width: 80px" href="cdelete.php?ISBN=<?php echo $ISBN ?>">Yes<a href='javascript:history.go(-1)' id="negative" style="width: 80px">No</a></div>
            <?php }
                
            
                else{ 
                    echo "<div class='box'><h3>Book not exist !</h3><br/>Click here to <a href='javascript:history.go(-1)'>&laquo; GoBack</a></div>";
                }
    }}
    else {
?>
<div class="box">
<h1>Delete Book</h1>
<form name="deletebook"  method="post">
<input type="text" name="ISBN" placeholder="ISBN(0-13)/ISSN" pattern="[0-9]{13}" required />
<input type="submit" name="submit" value="Delete" id="negative"/><a href='javascript:history.go(-1)'>&laquo; GoBack</a>
</form>
</div>
<?php } 
}
else{
    $name=$_SESSION['username'];
   echo "<div class='box'><h4 style='color:white'>You are $name not an Admin</h4><br/>Click here to <a href='javascript:history.go(-1)'>&laquo; GoBack</a></div>";
}

?>
</body>
</html>