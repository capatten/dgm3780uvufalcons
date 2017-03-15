<?php
session_start();
$fbuid = $_REQUEST["fb-UID"];
?>

<!DOCTYPE html>
<html>
	  <head>
	  <meta charset="utf-8">
	  <title>Welcome to Firebase Hosting</title>
	  <style media="screen"></style>
	  <script src="https://www.gstatic.com/firebasejs/3.7.0/firebase.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	  <script src="https://www.gstatic.com/firebasejs/3.6.10/firebase-app.js"></script>
	  <script src="https://www.gstatic.com/firebasejs/3.6.10/firebase-auth.js"></script>
	  <script src="https://www.gstatic.com/firebasejs/3.6.10/firebase-database.js"></script>
	  <script src="https://www.gstatic.com/firebasejs/3.6.10/firebase-messaging.js"></script>
	  <script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyALwnsnwRHcliN-8rdC89tfYAQ2HIyeZHI",
    authDomain: "uvu-falcons.firebaseapp.com",
    databaseURL: "https://uvu-falcons.firebaseio.com",
    storageBucket: "uvu-falcons.appspot.com",
    messagingSenderId: "515391920741"
  };
  firebase.initializeApp(config);
</script>
	  <script>
	  $(document).on("click",".btn-login", function ()
					{
		  var email = $(document).find(".txtEmail").val();

	 var password = $(document).find(".txtEmail").val();
	  
	 
	 const auth = firebase.auth();
		  
		  const promise = auth.signInWithEmailAndPassword(email, password);
		  
		  
		  alert("completed login");
	 
	 });
	 
	 $(document).on("click",".btn-register", function ()
					{
		  var email = $(document).find(".txtEmail").val();

	 var password = $(document).find(".txtEmail").val();
	  
	 
	 const auth = firebase.auth();
		  
		  const promise = auth.createUserWithEmailAndPassword(email, password);
		 
		 
		  
		  
	 
	 });
	 
	 $(document).on("click",".btn-forgot", function ()
					{
		  var email = $(document).find(".txtEmail").val();

	 var password = $(document).find(".txtEmail").val();
	  
	 
	 const auth = firebase.auth();
		  
		  const promise = auth.sendPasswordResetEmail(email);
		 
		 
		 
		  
		  
	 
	 });
	 
		  
		  
		  
		  $(document).on("click",".btn-savedata", function ()
					{
	 			firebase.database().ref('users/' + "userId2").set({
    username: "ne4",
    email: "email",
    profile_picture : "imageUrl"
	 });
		  });
		  
		  
		  
		  $(document).on("click",".btn-loaddata", function ()
					{
			  
			  return firebase.database().ref('/users/' + "userId").once('value').then(function(snapshot) {
  var username = snapshot.val().username;
				  alert (username);
				  
	 });
		  });
		  
		  
		  
		  $(document).on("click",".btn-removedata", function ()
					{			  
			  return firebase.database().ref('/users/' + "userId").remove();
		  });
	 

	 
		

	  </script>
	  </head>
	  <body>
	  <?php echo $fbuid; ?>
<input class="txtEmail" type="text" placeholder="Email" value="encoreeric@gmail.com">
<input class="txtPassword" type="text" placeholder="Password" value="testtt">
<br>
<button class="btn-login">Login</button>
<br>
<button class="btn-register">Register</button>
<button class="btn-forgot">Forgot</button>
<button class="btn-savedata">send data</button>
<button class="btn-loaddata">load data</button>
<button class="btn-removedata">remove data</button>
</body>
</html>
