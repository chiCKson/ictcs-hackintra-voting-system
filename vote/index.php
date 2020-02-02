<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Judge Panel Login</title>
    

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
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  
  <div class="checkbox mb-3">
   
  </div>
  <button class="btn btn-lg btn-primary btn-block" onclick="signin()">Google Sign in</button>
  
  <p class="mt-5 mb-3 text-muted">&copy; 2020</p>

</div>
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.6.0/firebase-auth.js"></script>
    <script>

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
            location.href="teams";
        } else {
            // No user is signed in.
        }
        });
        function signin(){
           

            base_provider=new firebase.auth.GoogleAuthProvider();
            firebase.auth().signInWithPopup(base_provider).then(function(result){
                location.href="ideas";
                console.log("Success");
            }).catch(function(err){
                console.log(err);
                console.log("Error");
            })
        }    
    
    </script>
</body>
</html>