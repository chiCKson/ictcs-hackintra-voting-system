<?php
include_once('con/con.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Teams Hackintra</title>
    <link href="css/style.css" rel="stylesheet">
    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body class="bg-light">
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-auth.js"></script>
<script>
function createCookie(name, value, days) {
  var expires;
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  }
  else {
    expires = "";
  }
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

var firebaseConfig = {
    apiKey: "AIzaSyDs0Ta7z2trxgw9seJdLtafxxZh-4TIk0c",
    authDomain: "hackintra-68883.firebaseapp.com",
    databaseURL: "https://hackintra-68883.firebaseio.com",
    projectId: "hackintra-68883",
    storageBucket: "hackintra-68883.appspot.com",
    messagingSenderId: "270370944465",
    appId: "1:270370944465:web:f52919e08de25d19af5cf0",
    measurementId: "G-RZ934R2VLK"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
firebase.auth().onAuthStateChanged(function(user) {
if (user) {
    // User is signed in.
    createCookie("userEmail", user.email, "10");
} else {
    // No user is signed in.
    location.href="index";
}
});

function signout(){
  firebase.auth().signOut().then(function() {
  // Sign-out successful.
  location.href="index";
}).catch(function(error) {
  // An error happened.
});

}
function viewall(){
  location.href="view-all"
}
</script>
<main role="main" class="container">
  <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
  <div class="row">
    <div class="col-sm">
    <img class="mr-3" src="img/logo.png" alt="" width="275" height="48">
    </div>
    <div class="col-sm">
    <button class="btn btn-success" onclick="signout()">SignOut</button>
   
    </div>
    <div class="col-sm">
    <button class="btn btn-danger" onclick="viewall()">View All Voted</button>
    </div></div>
  </div>
  <div class="my-3 p-3 bg-white rounded shadow-sm">
 <?php
 if(isset($_GET['team'])){
    echo "<div class='alert alert-success'>
    <strong>Success!</strong> You have voted to ".$_GET['team'].".</div>";
 }
 ?>
  <div class="row">
    <div class="col">
      
   
<table>
<tr><th>In.</th><th>Team Not Voted</th></tr>
 <?php
 
 $db=new DB();
 $conn = $db->connect();
 $count =1;
 $sql="select * FROM proposal WHERE team not in (select team from votes where email='".$_COOKIE["userEmail"]."')";
 $result=$db->get_data($conn,$sql);
 if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo '<tr><td>'.$count.'</td><td> <a href="ideas?team='.$row['team'].'">'.$row['team'].'</a></td></tr>';
    $count=$count+1;
    }
}
$db->disconnect($conn);
 ?>
</table>
</div>
    <div class="col">
    
<table>
<tr><th>In.</th><th>Team  Voted</th><th>Voted as</th></tr>
<?php

$db=new DB();
$conn = $db->connect();
$sql="select * FROM `votes` as v inner join proposal as p on p.team=v.team where v.email='".$_COOKIE["userEmail"]."'";
$count =1;
$result=$db->get_data($conn,$sql);
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
        if($row['score']==1)
         echo '<tr><td>'.$count.'</td><td><a href="ideas?updateteam='.$row['team'].'">'.$row['team'].'</a></td><td>Very Poor</td></tr>';
        else if($row['score']==2)
         echo '<tr><td>'.$count.'</td><td><a href="ideas?updateteam='.$row['team'].'">'.$row['team'].'</a></td><td>Poor</td></tr>';
        else if($row['score']==3)
         echo '<tr><td>'.$count.'</td><td><a href="ideas?updateteam='.$row['team'].'">'.$row['team'].'</a></td><td>Normal</td></tr>';
        else if($row['score']==4)
         echo '<tr><td>'.$count.'</td><td><a href="ideas?updateteam='.$row['team'].'">'.$row['team'].'</a></td><td>Good</td></tr>';
        else if($row['score']==5)
         echo '<tr><td>'.$count.'</td><td><a href="ideas?updateteam='.$row['team'].'">'.$row['team'].'</a></td><td>Very Good</td></tr>';
         $count=$count+1;
       }
}
$db->disconnect($conn);
?>
</table>

    </div>
  </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/script-ideas.js"></script>
</body>
</html>