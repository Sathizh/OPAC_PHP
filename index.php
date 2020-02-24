<!DOCTYPE html class="html">
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
<title>OPAC</title>
<link rel="stylesheet"  href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootstrap-4.3.1-dist/js/jQuery v3.4.1.min.js"></script>
<link rel="stylesheet" href="index_style.css" />
</head>
<body>
<?php 
require("connection.php");
if(isset($_REQUEST['username'])){
   $username = stripslashes($_REQUEST['username']); 
        $username = mysqli_real_escape_string($con,$username);
}
    else{
        $username="Welcome!";
        $roll="";
}
 $query ="SELECT * from `pub_user`  WHERE name = '$username' and roll='Admin'";
        $results = mysqli_query($con,$query)or die(mysql_error());
        $data = mysqli_fetch_assoc($results);
if (!isset($_REQUEST['submit']) and empty($_REQUEST['opt']))
    {?>
<nav role="navigation ">
    <div id="menuToggle">
 <input type="checkbox" />
    <span></span>  
    <span></span>
    <span></span>
    <ul id="menu">

     <a href="#profile" id="thum"><li><img src="image/icon-of-user.png" style="height: 50px ;text-align: center; border-radius: 50%"><br><?php echo ucwords($username) ?></li></a>
     <!-- admin mode -->
    <?php if($data['roll']==="Admin"){ ?>
    <?php if(empty($_REQUEST['username'])){?>
    <a href="login.php"  ><li>Login</li></a>
    <?php } ?>
    <a href="addbook.php"   ><li>Add book</li></a>
     <a href="deletebook.php"  ><li>Delete book</li></a>
    <a href="myhistory.php"  ><li>My history</li></a>
    <?php if(!empty($_REQUEST['username'])){ ?>
    <a href="logout.php"  ><li>Logout</li></a>
    <?php } 
    // public mode
    else{ ?><a href="signup.php"><li>Signup</li></a><?php }}else{ ?>
        <?php if(empty($_REQUEST['username']) or $_REQUEST['username']=="Welcome!" ){?>
        <a href="login.php"  ><li>Login</li></a>
    <?php } ?>
         <a href="myhistory.php"  ><li>My history</li></a>
         <?php if(!empty($_REQUEST['username'])){ ?>
    <a href="logout.php"  ><li>Logout</li></a>
    <?php } else{ ?><a href="signup.php"  ><li>Signup</li></a><?php } }
    ?>
</ul>
    </div>
</nav>

<?php } ?>
<br>
<?php
    require('connection.php');
    if (isset($_REQUEST['criteria'])){
    $criteria = ucwords(stripslashes($_REQUEST['criteria'])) ;
        $criteria = mysqli_real_escape_string($con,$criteria); 
        $criteria=ucwords(strtolower($criteria));
        $opt = stripslashes($_REQUEST['opt']);
        $opt = mysqli_real_escape_string($con,$opt);
        if(isset($_REQUEST['page']) and isset($_REQUEST['opt']))
        {
            $page=$_REQUEST['page'];

            if($page<=1)
            {

                 $StartFrom=0;
            }
            else{

                 $StartFrom=($page*10)-10;
            }
           
        $query = "SELECT * from `bookdata` WHERE (`bookdata`.`name`  LIKE '$criteria%' and criteria=null or `bookdata`.`ISBN`  LIKE '$criteria%' and criteria = '$opt'or `bookdata`.`title`  LIKE '$criteria%' and criteria = '$opt ' and `Qty` >=0) LIMIT $StartFrom,10";
        }
        else{
            $query = "SELECT * from `bookdata`  WHERE (`bookdata`.`name`  LIKE '$criteria%' and criteria=null or `bookdata`.`ISBN`  LIKE '$criteria%' or criteria = '$opt'or `bookdata`.`title`  LIKE '$criteria%' or criteria = '$opt ' and `Qty` >=0) ";
        }
        $result = mysqli_query($con,$query)or die(mysql_error());
        $c=1;$i=0;
        if($result){
            echo "<div class='table-responsive'>";
        	echo "<table class='table table-striped ' id='tbl'>";
            echo "<div><h3 style='color:white'> $opt Details.</h3></div>";
            echo "<div class='col-sm-1'><tr><th> S.No </th><th>Title </th><th> Name </th><th> ISBN / ISSN </th><th> Qty </th><th> Location </th><th> Borrow </th></tr>";
        	while ($row = mysqli_fetch_assoc($result)) {$c=2;$i+=1;
        		$nam=$row["name"];$tit=$row["title"];$num =$row["ISBN"];$q=$row["Qty"];$l=$row["location"];
        		echo "<div class='col-sm-7'><tr><td>$i</td><td> $tit </td><td> $nam </td><td> $num </td><td> $q </td><td> $l </td><td>";
                ?>
                <a class='btn-hover color-br' href='borrow.php?num=<?php echo $num ?>&nam=<?php echo $nam ?>&tit=<?php echo $tit ?>&opt=<?php echo $opt ?>&criteria=<?php echo $criteria ?>'>borrow</a></td><td></td></tr>
                <?php
        	}?>
            <tr><td> <a href='index.php?username=<?php echo $username ?>'>GoBack  &laquo; </a></td></tr>
           </table></div></div></div>

            <nav>

                <ul class="pagination justify-content-center">

                    <?php                      
                        if($page>1 )
                        {
                            
                            ?><li class="page-item"><a class="page-link" href="index.php?opt=<?php echo $opt;?>&criteria=<?php echo $criteria;?>&submit=Search&page=<?php echo $page-1;?>&username=<?php echo $username;?>"> &laquo; </a></li>
                       <?php }
                    $paging="SELECT COUNT(*) FROM `bookdata` WHERE (`bookdata`.`name`  LIKE '$criteria%' and criteria=null or `bookdata`.`ISBN`  LIKE '$criteria%' and criteria = '$opt'or `bookdata`.`title`  LIKE '$criteria%' and criteria = '$opt ' and `Qty` >=0) ";
                            $result = mysqli_query($con,$paging)or die(mysql_error());
                            $rowpg=mysqli_fetch_array($result);
                            $total=array_shift($rowpg);
                            $item_per_pg=ceil($total/10);
                        if($total >= 10)
                        {

                            for($i=1;$i<=$item_per_pg;$i++)
                            {
                                
                                if($i==$page){?>
                                   <li  class="page-item actives"><a class="page-link" href="index.php?opt=<?php echo $opt;?>&criteria=<?php echo $criteria;?>&submit=Search&page=<?php echo $i;?>&username=<?php echo $username;?>"><?php echo $i;?></a></li>
                              <?php  }

                              else{ ?>
                                <li class="page-item"><a class="page-link" href="index.php?opt=<?php echo $opt;?>&criteria=<?php echo $criteria;?>&submit=Search&page=<?php echo $i;?>&username=<?php echo $username;?>"><?php echo $i;?></a></li>
                              <?php }
                            ?>
                        <?php }
                    }
                    // echo $page;
                    // echo $item_per_pg;
                        if($page+2 <= $item_per_pg)
                        { ?>
                            <li class="page-item"><a class="page-link" href="index.php?opt=<?php echo $opt;?>&criteria=<?php echo $criteria;?>&submit=Search&page=<?php echo $page+1;?>&username=<?php echo $username;?>"> &raquo; </a></li>
                            <?php } 
                    ?>
                       </ul></nav> 
            <?php
        
    }
        if($c == 1){?>
        	<h3 style='text-align:center;color:white'>- No <?php echo $opt ?> found -</h3>
       <?php }
       
    }
    else{
?>
    <?php 
if(isset($_REQUEST['barr']))
    {
          header("location:index.php");
    }
     ?>

<!-- <div class="col-sm-5"> -->
<div style="margin: 0 auto;">
<form name="addbook"  method="post" class="form">
    <select name="opt" class="opt">
        <option >select</option>
        <option >Book</option>
        <option >Article</option>
        <option >Digital</option>
        <option >Journal</option>
    </select>
<input type="text" name="criteria" placeholder="Type something"  />
<input type="submit" name="submit" value="Search" class ="find"  />
<input type="hidden" name="page" value="0">
</form>
</div>
<?php } 
if (!isset($_REQUEST['submit']) and empty($_REQUEST['opt']))
    {?>
<div class="col-sm-offset-5 col-sm-6" id="count" style="margin: 0 auto;">
    <img src="image/ybook.png" style="width: 13%;left: 30%">
    <?php 
    $CountQuery="SELECT COUNT(*) FROM bookdata WHERE `bookdata`.`criteria`= 'book' ";
    $count=mysqli_query($con,$CountQuery)or die(mysql_error());
    $try=mysqli_fetch_assoc($count);
    $result=array_shift($try);
 echo "<span class='badge badge-info' id='badg1' style='background-color: red;font-family: cursive;';>$result</span> " ?>
 
<span>
    <img src="image/imagefiles_seal_circle_pink_Article.png" style="width: 13%;">
 <?php 
    $CountQuery="SELECT COUNT(*) FROM bookdata WHERE `bookdata`.`criteria`= 'Article' ";
    $count=mysqli_query($con,$CountQuery)or die(mysql_error());
    $try=mysqli_fetch_assoc($count);
    $result=array_shift($try);
 echo "<span class='badge badge-info' id='badg2' style='background-color:  #00f100;font-family: cursive;';>$result</span> " ?>
 </span>
<span>
    <img src="image/imagefiles_seal_circle_light_green_digital.png" style="width: 13%;">
 <?php 
    $CountQuery="SELECT COUNT(*) FROM bookdata WHERE `bookdata`.`criteria`= 'Digital' ";
    $count=mysqli_query($con,$CountQuery)or die(mysql_error());
    $try=mysqli_fetch_assoc($count);
    $result=array_shift($try);
 echo "<span class='badge badge-primary'id='badg3' style='background-color:  blue;font-family: cursive;';>$result</span> " ?>
 </span>
 <span>
    <img src="image/imagefiles_seal_circle_light_blue_journal.png" style="width: 13%;">
 <?php 
    $CountQuery="SELECT COUNT(*) FROM bookdata WHERE `bookdata`.`criteria`= 'Journal' ";
    $count=mysqli_query($con,$CountQuery)or die(mysql_error());
    $try=mysqli_fetch_assoc($count);
    $result=array_shift($try);
 echo "<span class='badge badge-info' id='badg4' style='background-color: #ff0077;font-family: cursive;';>$result</span> " ?>
 </span>
</div>
<?php } ?>
</body>
</html>
