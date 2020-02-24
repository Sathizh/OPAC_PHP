<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
    <title>OPAC</title>
    <link rel="stylesheet" href="style_new.css">
    <link rel="stylesheet" href="index_style_new.css">
    <link rel="stylesheet"  href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="bootstrap-4.3.1-dist/js/jQuery v3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
          {
       ?>
      <!--Navbar-->
      <!-- Nav animation Script -->
      <script type="text/javascript">
      $(document).ready(function () {

        $('.first-button').on('click', function () {

          $('.animated-icon1').toggleClass('open');
        });
        $('.second-button').on('click', function () {

          $('.animated-icon2').toggleClass('open');
        });
        $('.third-button').on('click', function () {

          $('.animated-icon3').toggleClass('open');
        });
      });

      </script>
      <nav class="navbar navbar-light m-4 fixed-top" role="navigation">
      <!-- Collapse button -->
        <button class="navbar-toggler first-button btn border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent20"
        aria-controls="navbarSupportedContent20" aria-expanded="false" aria-label="Toggle navigation" style="background-color:transparent;">
            <div class="animated-icon1"><span></span><span></span><span></span></div>
        </button>

      <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent20">
        <!-- Links -->
          <ul class="navbar-nav mr-auto font-weight-bold">
            <li class="nav-item active pt-4">
              <a href="#profile" id="thum" class="text-dark nav-link">
                <img src="image/icon-of-user.png" style="height: 50px ;text-align: center; border-radius: 50%"><br><?php echo ucwords($username) ?>
              </a>
            </li>
            <!-- Admin Mode -->
            <?php if ($data['roll']==="Admin") {?>
              <?php if(empty($_REQUEST['username'])){?>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
              <?php } ?>
            <li class="nav-item">
              <a class="nav-link" href="addbook.php">Add Book</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="deletebook.php">Delete Book</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="myhistory.php">My History</a>
            </li>
            <?php if(!empty($_REQUEST['username'])){ ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php }
              else{ ?>
                <li class="nav-item">
                  <a class="nav-link" href="signup.php">SignUp</a>
                </li>
              <?php }}
              else { ?>
                <?php if(empty($_REQUEST['username']) or $_REQUEST['username']=="Welcome!" ){?>
                  <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                  </li>
                <?php } ?>
                <li class="nav-item">
                  <a class="nav-link" href="myhistory.php">My History</a>
                </li>
                <?php if(!empty($_REQUEST['username'])){ ?>
                  <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                  </li>
                <?php }
                  else { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="signup.php">SignUp</a>
                    </li>
                  <?php } } ?>
          </ul>
        </div>
      </nav>
    <?php } ?>
    <script>
      function myFunction() {
        var x = document.getElementById("myLinks");
          if (x.style.display === "block") {
              x.style.display = "none";
          }
          else {
              x.style.display = "block";
          }
        }
    </script>
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

                $query = "SELECT * from `bookdata`  WHERE (`bookdata`.`name`  LIKE '$criteria%' and criteria=null or `bookdata`.`ISBN`  LIKE '$criteria%' and criteria = '$opt'or `bookdata`.`title`  LIKE '$criteria%' and criteria = '$opt ' and `Qty` >=0) LIMIT $StartFrom,10";
              }
              else{
                $query = "SELECT * from `bookdata`  WHERE (`bookdata`.`name`  LIKE '$criteria%' and criteria=null or `bookdata`.`ISBN`  LIKE '$criteria%' and criteria = '$opt'or `bookdata`.`title`  LIKE '$criteria%' and criteria = '$opt ' and `Qty` >=0) ";
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
                  } ?>
                <tr><td>
                  <a href='index.php?username=<?php echo $username ?>'>GoBack  &laquo; </a>
                </td></tr>
                </table>
              </div>
            </div>
          </div>
          <nav style="margin-left: 550px; background-attachment: fixed;">
              <ul class="pagination">
                  <?php
                      if($page>1 )
                      {
                          ?><li><a href="index.php?opt=<?php echo $opt;?>&criteria=<?php echo $criteria;?>&submit=Search&page=<?php echo $page-1;?>"> &laquo; </a></li>
                     <?php }
                          $paging="SELECT COUNT(*) FROM `bookdata` WHERE criteria = '$opt'";
                          $result = mysqli_query($con,$paging)or die(mysql_error());
                          $rowpg=mysqli_fetch_array($result);
                          $total=array_shift($rowpg);
                          $item_per_pg=ceil($total/10);
                      if($total >= 10)
                      {
                          for($i=1;$i<=$item_per_pg;$i++)
                          {
                              if($i==$page){?>
                                 <li class="actives"><a href="index.php?opt=<?php echo $opt;?>&criteria=<?php echo $criteria;?>&submit=Search&page=<?php echo $i;?>"><?php echo $i;?></a></li>
                            <?php  }
                            else{ ?>
                              <li><a href="index.php?opt=<?php echo $opt;?>&criteria=<?php echo $criteria;?>&submit=Search&page=<?php echo $i;?>"><?php echo $i;?></a></li>
                            <?php }
                          ?>
                      <?php }
                    }
                      if($page+1<=$item_per_pg)
                      { ?>
                          <li><a href="index.php?opt=<?php echo $opt;?>&criteria=<?php echo $criteria;?>&submit=Search&page=<?php echo $page+1;?>"> &raquo; </a></li>
                          <?php }
                  ?>
                     </ul>
                  </nav>
          <?php
        }
      if($c == 1){?>
        <h3 style='text-align:center;color:white'>- No record found -</h3>
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
      <div class="container">
        <div class="row h-50 w-100 align-items-end justify-content-center p-0 m-0">
          <!-- Small Device Form -->
            <form name="addbook"  method="post" class="form-inline text-center w-75 d-block d-sm-none">
              <div class="col-12 p-0">
                <select name="opt" class="form-control form-control-lg border-0 w-100 m-md-2 m-lg-0" style="border-radius:10vh;">
                  <option >select</option>
                  <option >Book</option>
                  <option >Article</option>
                  <option >Digital</option>
                  <option >Journal</option>
                </select>
              </div>
              <div class="col-12 p-0 m-2">
                <input type="text" name="criteria" placeholder="Type something" class="form-control form-control-lg border-0 w-100 h-100" style="border-radius:10vh;"/>
              </div>
              <div class="col-12 p-0">
                <input type="submit" name="submit" value="Search" class ="btn btn-lg btn-danger w-100" style="border-radius:10vh;" />
              </div>
                <input type="hidden" name="page" value="0">
            </form>
            <!-- Large Device Form -->
            <form name="addbook"  method="post" class="form-inline text-center w-100 d-none d-sm-block p-0 m-0">
                <select name="opt" class="form-control form-control-lg border-0" style="border-radius:8vh;">
                  <option >select</option>
                  <option >Book</option>
                  <option >Article</option>
                  <option >Digital</option>
                  <option >Journal</option>
                </select>
                <input type="text" name="criteria" placeholder="Type something" class="form-control form-control-lg border-0 h-100 w-50" style="height:100%; border-radius:8vh;"/>
                <input type="submit" name="submit" value="Search" class ="btn btn-lg btn-danger" style="border-radius:8vh;"/>
                <input type="hidden" name="page" value="0">
            </form>
        </div>

      <?php }
      if (!isset($_REQUEST['submit']) and empty($_REQUEST['opt']))
          {?>
          <div class="row h-50 w-100 align-items-center justify-content-center">
            <div class="col-sm-5 col-lg-2 col-md-2">
                <img src="image/ybook.png" class="w-75">
                <?php
                $CountQuery="SELECT COUNT(*) FROM bookdata WHERE `bookdata`.`criteria`= 'book' ";
                $count=mysqli_query($con,$CountQuery)or die(mysql_error());
                $try=mysqli_fetch_assoc($count);
                $result=array_shift($try);
             echo "<span class='badge badge-info' id='badg1' style='background-color: red;font-family: cursive;';>$result</span> " ?>
           </div>
           <div class="col-sm-5 col-lg-2 col-md-2">
                <img src="image/imagefiles_seal_circle_pink_Article.png" class="w-75">
             <?php
                $CountQuery="SELECT COUNT(*) FROM bookdata WHERE `bookdata`.`criteria`= 'Article' ";
                $count=mysqli_query($con,$CountQuery)or die(mysql_error());
                $try=mysqli_fetch_assoc($count);
                $result=array_shift($try);
             echo "<span class='badge badge-info' id='badg2' style='background-color:  #00f100;font-family: cursive;';>$result</span> " ?>
           </div>
           <div class="col-sm-5 col-lg-2 col-md-2">
                <img src="image/imagefiles_seal_circle_light_green_digital.png" class="w-75">
             <?php
                $CountQuery="SELECT COUNT(*) FROM bookdata WHERE `bookdata`.`criteria`= 'Digital' ";
                $count=mysqli_query($con,$CountQuery)or die(mysql_error());
                $try=mysqli_fetch_assoc($count);
                $result=array_shift($try);
             echo "<span class='badge badge-primary'id='badg3' style='background-color:  blue;font-family: cursive;';>$result</span> " ?>
           </div>
           <div class="col-sm-5 col-lg-2 col-md-2">
                <img src="image/imagefiles_seal_circle_light_blue_journal.png" class="w-75">
             <?php
                $CountQuery="SELECT COUNT(*) FROM bookdata WHERE `bookdata`.`criteria`= 'Journal' ";
                $count=mysqli_query($con,$CountQuery)or die(mysql_error());
                $try=mysqli_fetch_assoc($count);
                $result=array_shift($try);
             echo "<span class='badge badge-info' id='badg4' style='background-color: #ff0077;font-family: cursive;';>$result</span> " ?>
           </div>
          </div>
            <?php } ?>
          </div>
  </body>
</html>
