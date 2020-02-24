<!DOCTYPE html>
<html>
<head>
	<title>My History</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet"  href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
<script type="text/javascript" src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bootstrap-4.3.1-dist/js/jQuery v3.4.1.min.js"></script>
<link rel="stylesheet" href="index_style.css" />
</head>
<body>
<?php 
$i=0;$c=0;
require("sess.php");
require("connection.php");
	$username=$_SESSION['username'];
	$query = "SELECT * FROM `borrow` WHERE name='$username'";
    $result = mysqli_query($con,$query)or die(mysql_error());
            if($result){
            echo "<div class='table-responsive'>";
        	echo "<table class='table table-striped' id='tbl'style='text-align:center'>";
            echo "<div><h3 style='color:white'>My History</h3></div>";
            echo "<div class='col-sm-1'><tr><th> S.No </th><th>Title </th><th>ISBN / ISSN </th><th> Author Name </th><th> Type </th><th> Due Date </th><th>Return</th><th>Fine</th></tr>";
        	while ($row = mysqli_fetch_assoc($result)) {$i+=1;$c=1;
        		$nam=$row["author"];$tit=$row["title"];$num=$row["ISBN"];$typ=$row["type"];$Due=$row["Due"];$typ=$row["type"];
        		echo "<div class='col-sm-7'><tr><td>$i</td><td> $tit </td><td> $num </td><td> $nam </td><td> $typ </td>";?>
                <td 
                    <?php
                        $now=date('Y-M-d');
                        $temp=(strtotime($Due)-strtotime($now));
                        // $years =floor($temp/(360*60*60*24));
                        // $month=floor(($temp - $years * 365*60*60*24)/(30*60*60*24));
                        // $days=floor(($temp - $years *365*60*60*24 -$month*30*60*60*24)/(60*60*24));
                        $days=$temp/86400;
                        if($days == 3 or $days == 4)
                            {?>
                style="color:yellow"
                    <?php }
                    elseif($days <= 2){
                        ?>style="color:red"
                    <?php
                    }
                    else{
                         ?>style="color:white"
                    <?php
                    } ?>
                >
                <?php echo "$Due"; ?></td>
                <td><a class='btn-hover color-br' href='return.php?num=<?php echo $num ?>&nam=<?php echo $nam ?>&tit=<?php echo $tit ?>&typ=<?php echo $typ ?>&days=<?php echo $days ?>'>Return</a></td><td
                <?php 
                    $Due=strtotime($Due);
                    $now=strtotime($now);
                    $diff=(($Due-$now)/86400);
                if($diff<=0){ ?>
                 class='badge badge-danger' style="padding: 7px "><?PHP echo "Rs.".abs($diff);  }else{echo "-";}?><td></tr><?php 
        	}
        	
             if($c==0){
        	echo "<h3 style='text-align:center;color:white'>- No record found -</h3>";
        }
                  ?>
            <tr><td> <a href='index.php?username=<?php echo $username ?>'>&laquo; GoBack </a></td></tr>
            <?php
echo "</table></div></div></div>";
        }
       
 ?>
</body>
</html>