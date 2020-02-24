<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>BorowBook</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<?php
    require('connection.php'); 
     require('sess.php');
        $username=$_SESSION['username'];
       $ISBN=$_GET['num'];
       $opt=$_REQUEST['opt'];
       $tit=$_GET['tit'];
       $nam=$_GET['nam'];
       $criteria=$_GET['criteria'];
       $query = "SELECT * FROM `borrow` WHERE name='$username' and title ='$tit' and author='$nam'";
    $result = mysqli_query($con,$query)or die(mysql_error());
    $rows = mysqli_num_rows($result);
        if($rows==0)
        {
          $book_check_query ="SELECT * from `bookdata`  WHERE `bookdata`.`ISBN` = $ISBN and `bookdata`.`Qty` >= 0";
        $results = mysqli_query($con,$book_check_query)or die(mysql_error());
        $book = mysqli_fetch_assoc($results);
        if($results)
        {
            if($book['ISBN'] === $ISBN)
                {
                     if($book['Qty'] <= 0)
                {

                     $due_check_query ="SELECT * from `borrow`  WHERE `ISBN` = $ISBN";
                     $results = mysqli_query($con,$due_check_query)or die(mysql_error());
                     $c=0;
                     while($book = mysqli_fetch_assoc($results))
                     {

                        if($c==0)
                        {
                            $big=strtotime($book["Due"]);
                            $c+=1;
                            continue;
                        }
                        else{
                            $temp=strtotime($book["Due"]);
                            if($big > $temp)
                            {
                                $big=strtotime($book["Due"]);
                            }
                        }
                     }
                     $may=date('d-M-Y',$big);
                    echo "<div class='box'><h3>Your selected book not available now ! it may be available at $may</h3><br/>Click here to <a here to <a href='javascript:history.go(-1)'>&laquo; GoBack</a></div>";
                }
                }
                else{
                    echo "<div class='box'><h3>Book not exist !</h3><br/>Click here to <a href='javascript:history.go(-2)'>&laquo; &laquo; GoBack</a></div>";
                }
           
            if($book['ISBN'] == $ISBN and $book['Qty'] > 0){
                $query = "UPDATE `bookdata` SET `bookdata`.`Qty` = `Qty`-1  WHERE `bookdata`.`ISBN` = $ISBN and `bookdata`.`Qty`>0";
                $result = mysqli_query($con,$query)or die(mysql_error());

                if($result){
                    $date=date('Y-M-d',strtotime(date('Y-M-d').' + 7 day'));
                    $query = "INSERT into `borrow` (name,title,ISBN,author,type,Due) VALUES ('$username', '$tit','$ISBN', '$nam', '$opt','$date')";
                $result = mysqli_query($con,$query) or die(mysql_error());
            echo "<div class='box'><h3>Your selected book borrowed successfully !</h3><br/>Click here to ";
                ?>
                <a href='index.php?opt=<?php echo $opt ?>&criteria=<?php echo $criteria ?>&username=<?php echo $username ?>&page=0'>&laquo; GoBack</a>
                <?php
            echo "</div>";
        }

        }
        }
    }
        else{
            echo "<div class='box'><h3>Your selected book alredy borrowed by you !</h3><br/>Click here to ";
            ?>
                <a href='javascript:history.go(-1)'>Okay</a>
                <?php
            echo "</div>";
//session_destroy();



        }
?>
</body>
</html>
