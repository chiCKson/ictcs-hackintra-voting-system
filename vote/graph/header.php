<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		<title>Teams Scores</title>
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
}</style>

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
    <script>
			$(function () {
				// #sidebar-toggle-button
				$('#sidebar-toggle-button').on('click', function () {
						$('#sidebar').toggleClass('sidebar-toggle');
						$('#page-content-wrapper').toggleClass('page-content-toggle');	
						fireResize();					
				});
				
				// sidebar collapse behavior
				$('#sidebar').on('show.bs.collapse', function () {
					$('#sidebar').find('.collapse.in').collapse('hide');
				});
				
				// To make current link active
				var pageURL = $(location).attr('href');
				var URLSplits = pageURL.split('/');

				//console.log(pageURL + "; " + URLSplits.length);
				//$(".sub-menu .collapse .in").removeClass("in");

				if (URLSplits.length === 5) {
					var routeURL = '/' + URLSplits[URLSplits.length - 2] + '/' + URLSplits[URLSplits.length - 1];
					var activeNestedList = $('.sub-menu > li > a[href="' + routeURL + '"]').parent();

					if (activeNestedList.length !== 0 && !activeNestedList.hasClass('active')) {
						$('.sub-menu > li').removeClass('active');
						activeNestedList.addClass('active');
						activeNestedList.parent().addClass("in");
					}
				}

				function fireResize() {
					if (document.createEvent) { // W3C
						var ev = document.createEvent('Event');
						ev.initEvent('resize', true, true);
						window.dispatchEvent(ev);
					}
					else { // IE
						element = document.documentElement;
						var event = document.createEventObject();
						element.fireEvent("onresize", event);
					}
            	}
			})
		</script>

		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		
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
    //createCookie("userEmail", user.email, "10");
} else {
    // No user is signed in.
    location.href="../index";
}
});

function signout(){
  firebase.auth().signOut().then(function() {
  // Sign-out successful.
  location.href="../index";
}).catch(function(error) {
  // An error happened.
});


}
function back(){
    location.href="../teams";
}

</script>
	<body>
		<!-- header -->
		<nav id="header" class="navbar navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
        <div id="sidebar-toggle-button">
						<i class="fa fa-bars" aria-hidden="true"></i>
					</div>
					<div class="brand">
					
    <button class="btn btn-success" onclick="signout()">SignOut</button>
   
 
    <button  class="btn btn-danger" onclick="back()">Back</button>
   
					</div>
					
				</div>
			</div>
		</nav> 
		<!-- /header -->         