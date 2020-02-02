<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team Login</title>
    

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
</head>
<body class="text-center">
<div class="form-signin">
  <img class="mb-4" src="img/logo.png" alt="" width="275" height="50">
  <h1 class="h3 mb-3 font-weight-normal">Please sign in using team leader's gmail account which used to submit your proposal</h1>
  
  <div class="checkbox mb-3">
   
  </div>
  <button class="btn btn-lg btn-primary btn-block" onclick="signin()">Sign in Using Google</button>
  
  <p class="mt-5 mb-3 text-muted">&copy; 2020</p>

</div>
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-auth.js"></script>
    <script>

var firebaseConfig = {
    apiKey: "AIzaSyBwWcCh-6nQ65TIodcRKbR5_NntPs_Urk4",
    authDomain: "hackintra-idea.firebaseapp.com",
    databaseURL: "https://hackintra-idea.firebaseio.com",
    projectId: "hackintra-idea",
    storageBucket: "hackintra-idea.appspot.com",
    messagingSenderId: "386702843769",
    appId: "1:386702843769:web:7109861339c731bc5d99a8",
    measurementId: "G-HSE6BWD6RP"
  };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            // User is signed in.
            location.href="idea";
        } else {
            // No user is signed in.
        }
        });
        function signin(){
           

            base_provider=new firebase.auth.GoogleAuthProvider();
            firebase.auth().signInWithPopup(base_provider).then(function(result){
                location.href="idea";
                console.log("Success");
            }).catch(function(err){
                console.log(err);
                console.log("Error");
            })
        }    
    
    </script>
</body>
</html>