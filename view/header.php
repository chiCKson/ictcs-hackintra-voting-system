<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		<title>Teams Scores</title>
		<style>
</style>

		<!-- stylesheets -->
		<link href="assets/bootstrap.min.css" rel="stylesheet">
		<link href="assets/style.css" rel="stylesheet">
		<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- scripts -->
		
		<!--[if lt IE 9 ]> 
		<script src="/assets/js/html5shiv.min.js"></script>
		<script src="/assets/js/respond.min.js"></script>
		<![endif]-->
		
		<!--script src="/assets/js/	"></script-->
		<script src="assets/js/jquery-1.12.4.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
   
	</head>
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


</script>

	<body>
		<!-- header -->
		<nav id="header" class="navbar navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
      
					<div class="brand">
					
    <button class="btn btn-success" onclick="signout()">Sign Out</button>
   
 
    
   
					</div>
					
				</div>
			</div>
		</nav> 
		<!-- /header -->         