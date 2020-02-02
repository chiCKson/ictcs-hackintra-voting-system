<?php
include_once('con/con.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ideas - Hackintra</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    //createCookie("userEmail", user.email, "10");
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
    location.href="teams";
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
    <button  class="btn btn-danger" onclick="back()">Back</button>
    </div></div>
  </div>
  <div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-0">Team Proposals</h6>
  
    <?php
    if(isset($_GET['voteteam'])){
      $com=str_replace("'","\'",$_POST['comment']);
      $sqlVote="insert into votes (email,score,team,comments) values('".$_COOKIE["userEmail"]."',".$_POST['vote'].",'".$_GET['voteteam']."','".$com."')";
      echo '<div class="alert alert-danger">
      <strong>Evaluation finished.Thank You!.
    </div>';
    }else if(isset($_GET['updatevoteteam'])){
      
      $sqlVote="update  votes set score=".$_POST['vote']." where team='".$_GET['updatevoteteam']."' and email='".$_COOKIE["userEmail"]."'";
      
      echo '<div class="alert alert-danger">
      <strong>Evaluation finished.Thank You!.
    </div>';
    }
     
    ?>
    <?php
  
    if(isset($_GET['team'])){
      $db=new DB();
      $conn = $db->connect();
      $sql="select * from proposal where team='".$_GET['team']."'";
      $result=$db->get_data($conn,$sql);
      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
              echo "<table border=><tr><td>Team Name:</td><td> " . $row["team"]." </td><tr><td> Problem Specification: </td><td>" . $row["problem"]. " </td></tr><tr><td>Solution:</td><td>" . $row["solution"]. "</td><tr><td>Technologies use:</td><td>". $row["technology"]."</td><tr><td> business model:</td><td>". $row["business"]."</td></tr><tr><td>
              
    
              </td></tr>";
              if($row["url"]!=''){
                  echo "</table>".$row["url"]."
                  <form action='ideas?voteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' checked>Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
              <br>
              <textarea name='comment' placeholder='Add any comments about the their idea' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
          
            
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
              }else{
                  echo "</table>
                  <form action='ideas?voteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' checked>Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
              <br>
              <textarea name='comment' placeholder='Add any comments about the their idea' rows='5' style='resize:none; 
              width: 100%;
              box-sizing: border-box;
              height: 100%;
              '></textarea>
          <br>
      
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
              }
            
          }
      } else {
          echo "0 results";
      }
      $db->disconnect($conn);
    }else if(isset($_GET['updateteam'])){
      $db=new DB();
      $conn = $db->connect();
     $sql="select * FROM `proposal` as p  inner join votes as v on p.team=v.team where v.email='".$_COOKIE['userEmail']."' and v.team='".$_GET['updateteam']."'";

      $result=$db->get_data($conn,$sql);
      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
              echo "<table border=><tr><td>Team Name:</td><td> " . $row["team"]." </td><tr><td> Problem Specification: </td><td>" . $row["problem"]. " </td></tr><tr><td>Solution:</td><td>" . $row["solution"]. "</td><tr><td>Technologies use:</td><td>". $row["technology"]."</td><tr><td> business model:</td><td>". $row["business"]."</td></tr><tr><td>
              
    
              </td></tr>";
              if($row["url"]!=''){
                if($row['score']==1){
                  echo "</table>".$row["url"]."
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' checked>Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
          
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }else if($row['score']==2){
                  echo "</table>".$row["url"]."
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1'>Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2' checked>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
             
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }else if($row['score']==3){
                  echo "</table>".$row["url"]."
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' >Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3' checked> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
          
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }else if($row['score']==4){
                  echo "</table>".$row["url"]."
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' >Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4' checked>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
          
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }else{
                  echo "</table>".$row["url"]."
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' >Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5' checked> Very Good
          
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }
               
              }else{
                if($row['score']==1){
                  echo "</table>
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' checked>Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
             
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }else if($row['score']==2){
                  echo "</table>
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1'>Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2' checked>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
             
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }else if($row['score']==3){
                  echo "</table>
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' >Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3' checked> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
          
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }else if($row['score']==4){
                  echo "</table>
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' >Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4' checked>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5'> Very Good
          
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }else{
                  echo "</table>
                  <form action='ideas?updatevoteteam=".$row["team"]."' method='post'>
              <input type='radio' name='vote' value='1' >Very Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='2'>Poor &nbsp;&nbsp;
              <input type='radio' name='vote' value='3'> Normal &nbsp;&nbsp;
              <input type='radio' name='vote' value='4'>Good &nbsp;&nbsp;
              <input type='radio' name='vote' value='5' checked> Very Good
          
              <br>
              <textarea name='comment' placeholder='".$row['comments']."' rows='5' style=' resize:none; width: 100%;
              box-sizing: border-box;
              height: 100%;'></textarea>
      <br>
                <button type='submit' class='btn btn-primary'>Vote</button>
                </form><hr>";
                }
              }
            
          }
      } else {
          echo "0 results";
      }
      $db->disconnect($conn);
    }else{
      echo "error no team selected";
    }
      ?>

    
      </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/script-ideas.js"></script>
</body>
</html>