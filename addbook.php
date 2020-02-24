<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>AddBook</title>
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
    if (isset($_REQUEST['submit'])){
		$title = stripslashes($_REQUEST['title']);
		$title = mysqli_real_escape_string($con,$title); 
		$name = stripslashes($_REQUEST['name']);
		$name = mysqli_real_escape_string($con,$name);
		$ISBN = stripslashes($_REQUEST['ISBN']);
		$ISBN = mysqli_real_escape_string($con,$ISBN);
        $criteria = stripslashes($_REQUEST['criteria']);
        $criteria = mysqli_real_escape_string($con,$criteria);
		$Qty = stripslashes($_REQUEST['Qty']);
		$Qty = mysqli_real_escape_string($con,$Qty);
    $location = stripslashes($_REQUEST['location']);
    $location = mysqli_real_escape_string($con,$location);
    $book_check_query ="SELECT * FROM bookdata WHERE ISBN ='$ISBN'";
    $results = mysqli_query($con,$book_check_query)or die(mysql_error());
    $bookdata = mysqli_fetch_assoc($results);
    if($results)
    {
      if($bookdata['ISBN'] === $ISBN)
        {
         echo "<div class='box'><h3>Book already exist!.</h3><br/>Click here to <a href='javascript:history.go(-1)'>Add More Book</a></div>";
        }
        else{
          ?>
          <div>
          <table class='box'>
            <th>NEW BOOK</th><tr><th> Title <td>:</td></th><td><?php echo $title ?></td></tr><tr><th>Name <td>:</td><td><?php echo $name ?></td> </th></tr><tr><th> ISBN <td>:</td> </th><td><?php echo $ISBN ?></td></tr><tr><th> Criteria <td>:</td></th><td><?php echo $criteria ?></td></tr><tr><th> Qty <td>:</td></th><td><?php echo $Qty ?></td></tr><tr><th> Location<td>:</td></th><td><?php echo $location ?></td></tr>
            <tr><td>

           <a  id="positive" href="cadd.php?name= <?php echo ucwords($name);?>&title=<?php echo  ucwords(urlencode($title)); ?>&ISBN=<?php echo $ISBN; ?>&criteria=<?php echo urlencode($criteria); ?>&Qty=<?php echo $Qty ;?>&location=<?php echo urlencode($location); ?>">confirm</a>
            </td>

              <td><a href='javascript:history.go(-1)' id="negative">cancel</a></td></tr>
            </table></div>
            ?>

<?php  }
        }
    }else{
?>
<div class="box">
<h1>Add Book</h1>
<form name="addbook" method="get">
<input type="text" name="title" placeholder="Title name" required />
<input type="text" name="name" placeholder="Author Name" required />
<input type="text" name="ISBN" placeholder="ISBN(0-13)/ISSN"  pattern="[0-9]{13}"   />
<input type="text" name="criteria" placeholder="Criteria" required />
<input type="number" name="Qty" placeholder="Qty" required />
<input type="text" name="location" placeholder="Location" required />
<input type="submit" name="submit" value="Add" /><a href='javascript:history.go(-1)'>&laquo; GoBack</a>
</form>
</div>
<?php }
}else{
    $name=$_SESSION['username'];
   echo "<div class='box'><h4 style='color:white'>You are $name not an Admin</h4><br/>Click here to <a href='javascript:history.go(-1)'>&laquo; GoBack</a></div>";
}

 ?>
</body>
</html>
