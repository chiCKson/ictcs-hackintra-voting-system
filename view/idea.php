<?php 
include_once('header.php');
include_once('con/con.php');
?>
<?php

$sql ="select team,comments FROM `votes` WHERE team in (select team from proposal where email ='".$_COOKIE['userEmail']."') and comments is not null and comments >''";
$db=new DB();
$conn = $db->connect();
$result=$db->get_data($conn,$sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='container' style='padding-top:10px'><div style=' box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;'>
        
          ".$row['comments']."
       
      </div></div>";
    }
}
?>

</body>
</html>