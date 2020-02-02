<?php include 'header.php'; ?>
<?php include '../con/con.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include 'content.php'; ?>
<h1>Home</h1>
<div id="chartContainer"></div>

<?php

    $sql="select sum(score) as total,team FROM `votes` GROUP by team";
    $db=new DB();
    $conn = $db->connect();
    $dataPoints = array();
    $result=$db->get_data($conn,$sql);
      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
              $data=array("y"=>$row['total'],"label"=>$row['team']);
              array_push($dataPoints, $data);
          }
        } else {
            echo "0 results";
        }
        $db->disconnect($conn);
    
?>

<script type="text/javascript">

    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2",
            animationEnabled: true,
            title: {
                text: "Teams"
            },
            data: [
            {
                type: "column",                
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }
            ]
        });
        chart.render();
    });
</script>

