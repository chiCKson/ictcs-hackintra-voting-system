<!-- href links different in integration, collaspe in class added server side in integration --> 
		<!-- sidebar --> 
		<div id="sidebar" class="sidebar-toggle">
			<ul class="nav nav-sidebar">
					<li>
					<table><tr><th>Team</th><th>Score</th></tr><?php
					$sql="select sum(score) as total,team FROM `votes` GROUP by team order by total DESC";
    $db=new DB();
	$conn = $db->connect();
	$count =0;
    $dataPoints = array();
    $result=$db->get_data($conn,$sql);
      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
			  if ($count<10){
				echo "<tr style='background-color:green'><td>".$row['team']." </td><td> ".$row['total']."</td></tr>";
			  }else{ 
				  echo "<tr><td>".$row['team']." </td><td> ".$row['total']."</td></tr>";
			  }
            $count=$count+1;
          }
        } else {
            echo "0 results";
        }
		$db->disconnect($conn);
		
    ?>
			</table>		</li>
					
			</ul>
		</div>
		<!-- /sidebar -->