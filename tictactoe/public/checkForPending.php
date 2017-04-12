<?php
session_start();
$fbuid = intval($_REQUEST["fb-UID"]);
if(intval($fbuid) == 0){
	header("Location: ../");
}

echo "<img style='max-height:100px;' src='https://graph.facebook.com/$fbuid/picture?type=large'>  User Id: " . $fbuid . "<br>";
?>
<script>
	var fbuid = "<?php echo "$fbuid" ?>";
</script>
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
					firebase.database().ref('users/' + fbuid).set({
							fbuid: fbuid,
							totalWins: 0,
							totalLosses: 0
						});
				});
		  
		  
		  
			$(document).on("click",".btn-loaddata", function ()
				{
			  
					return firebase.database().ref('/users/' + fbuid).once('value').then(function(snapshot) {
							var fbuid = snapshot.val().fbuid;
							var totalWins = snapshot.val().totalWins;
							var totalLosses = snapshot.val().totalLosses;
							alert ("Facebook id: " + fbuid + "\nTotal Wins: " + totalWins + "\nTotal Losses: " + totalLosses);
				  
						});
				});
		  
		  
		  
			$(document).on("click",".btn-removedata", function ()
				{			  
					return firebase.database().ref('/users/' + fbuid).remove();
				});
				
				
			$(document).on("click",".btn-find-match", function ()
				{			
				
					//enter user as pending in database  
					firebase.database().ref('pending-match/' + fbuid).set({
							fbuid: fbuid,
							time: Math.floor(Date.now() / 1000)
						});
						
						
					var player1 = "";
					var player2 = "";
					//match all possible pending users
					return firebase.database().ref('/pending-match').once('value').then(function(snapshot) {
							//load all users that are pending a match.
							//console.log(snapshot.val());
													
													
							//iterate through users pending match
							
							
							
							//$.each( obj, function( key, value ) {
							$.each( snapshot.val(), function( key, value ) {
									if (value['fbuid'] != undefined || value['fbuid'] != "")
									{
										console.log('Working with id: ' + value['fbuid']);
										if (player1 == "")
										{
											player1 = value['fbuid'];
										}
										else if (player2 == "")
										{
											player2 = value['fbuid'];
										}
									
										if (player1 != "" && player2 != "")
										{
											//2 players populated - remove them from pending
											console.log('Matched: ' + player1 + ' with: ' + player2);
											removePlayerFromPending(player1);
											removePlayerFromPending(player2);
											
											// add players to a match
											addPlayersToMatch(player1,player2);
											
											player1 = "";
											player2 = "";
										}
									
									}
								});
							startCheckingForMatch();
						});					
				});
	 
			function removePlayerFromPending(userFBUID)
			{
				return firebase.database().ref('/pending-match/' + userFBUID).remove();
			}
			
			function addPlayersToMatch(player1, player2)
			{
				firebase.database().ref('activeMatches/' + player1 + 'vs' + player2).set({
						player1: player1,
						player2: player2
					});
				firebase.database().ref('users/' + player1).set({
						activeMatch: player1 + 'vs' + player2
					});
				firebase.database().ref('users/' + player2).set({
						activeMatch: player1 + 'vs' + player2
					});
			}
			
			function startCheckingForMatch()
			{
				$(document).find('.find-match-searching-image-span').html('<img style="max-height:25px;" src="https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif">');
				checkMatchFoundTimer = setInterval(checkMatchFound, 5000);				
			}
			
			// set interval
			var checkMatchFoundTimer;
			function checkMatchFound() {
				console.log("Checking if match was found..");
				
				return firebase.database().ref('/users/' + fbuid).once('value').then(function(snapshot) {
						try
						{
					
				
							var activeMatch = snapshot.val().activeMatch;	
							if (activeMatch != undefined || activeMatch != "")
							{
								abortTimer();
								var matchIdsArray = activeMatch.split('vs');
								$(document).find('.find-match-div').html("<img style='max-height:100px;' src='https://graph.facebook.com/"+matchIdsArray[0]+"/picture?type=large'> vs <img style='max-height:100px;' src='https://graph.facebook.com/"+matchIdsArray[1]+"/picture?type=large'>");
							}					
						}
						catch (err)
						{
					
						}	  
					});
			}
			function abortTimer() { // to be called when you want to stop the timer
				clearInterval(checkMatchFoundTimer);
			}
			
	 
		

		</script>
	</head>
	<body>
		<!--<input class="txtEmail" type="text" placeholder="Email" value="encoreeric@gmail.com">
		<input class="txtPassword" type="text" placeholder="Password" value="testtt">
		<br>
		<button class="btn-login">Login</button>
		<br>
		<button class="btn-register">Register</button>
		<button class="btn-forgot">Forgot</button>-->
		<button class="btn-savedata">send data</button>
		<button class="btn-loaddata">load data</button>
		<button class="btn-removedata">remove data</button>
		<br>
		<br>
		<div class="find-match-div">
			<span class="find-match-searching-image-span"></span><button class="btn-find-match">Find Match</button>
		</div>
	</body>
</html>
