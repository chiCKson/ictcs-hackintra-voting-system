<?php
include_once('con/con.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View All Voted Ideas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
<link href="css/style.css" rel="stylesheet">
</head>
<body>
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
  apiKey: "API_KEY",
    authDomain: "URL",
    databaseURL: "https://hackintra-idea.firebaseio.com",
    projectId: "hackintra-idea",
    storageBucket: "hackintra-idea.appspot.com",
    messagingSenderId: "386702843769",
    appId: "APP_ID",
    measurementId: "G-ID"
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
function back(){
  location.href="teams"
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
    <button class="btn btn-danger" onclick="back()">Back</button>
    </div></div>
  </div>
  <table>
<tr><th>In.</th><th>Team</th><th>Problem</th><th>Solution</th><th>Comment</th><th>Voted As</th><th>change Vote</th></tr>
<?php

$db=new DB();
$conn = $db->connect();
$sql="select * FROM `votes` as v inner join proposal as p on p.team=v.team where v.email='".$_COOKIE["userEmail"]."'";
$count =1;
$result=$db->get_data($conn,$sql);
$vote='';
if (mysqli_num_rows($result) > 0) {
   while($row = mysqli_fetch_assoc($result)) {
        if($row['score']==1)
            $vote="Very Poor";
        else if($row['score']==2)
            $vote="Poor";
        else if($row['score']==3)
            $vote="Normal";
        else if($row['score']==4)
            $vote="Good";
        else if($row['score']==5)
            $vote="Very Good";

        echo "<tr><td>".$count."</td><td>".$row['team']."</td><td>".$row['problem']."</td><td>".$row['solution']."</td><td>".$row['comments']."</td><td>".$vote."</td><td><a href='ideas?updateteam=".$row['team']."'>Vote</a></td>";
         $count=$count+1;
       }
}
$db->disconnect($conn);
?>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/script-ideas.js"></script>
</body>
</html>