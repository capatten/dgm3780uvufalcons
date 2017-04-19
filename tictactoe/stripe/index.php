<?php
session_start();
$fbuid = htmlspecialchars($_REQUEST["fbuid"]);
$_SESSION["fbuid"] = $fbuid;
if(intval($fbuid) == 0){
	header("Location: ../");
}

echo "<img style='max-height:100px;' src='https://graph.facebook.com/$fbuid/picture?type=large'>  User Id: " . $fbuid . "<br>";
?>
<?php
require_once("config.php");
?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>Tic Tac Toe Payment</title>
		<link rel="icon" href="../assets/img/tictactoe-1.png">
    
		<link href="../assets/css/stripe.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Bahiana" rel="stylesheet">
		
		<script>
			var fbuid = "<?php echo "$fbuid" ?>";
		</script>
		
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
			
			$(document).ready(function(){
				
					return firebase.database().ref('/users/' + fbuid).once('value').then(function(snapshot) {
							
							try{
								var paid = snapshot.val().paid;
						
								if (paid == "true")
								{
									window.location.href = "/public/checkForPending.php?fbuid=<?php echo $fbuid; ?>";
								}
							} catch (e ) {
								
							}

				  
						});
				});
				
			
			
			
			
		</script>

	</head>
    

	<body class="stripeBody">            
		<!-- Stripe API -->
		<h1>Payment</h1>
        
		<form action="charge.php" method="POST" class="paymentButton">
			<script
                type="text/javascript"
                src="https://checkout.stripe.com/checkout.js" 
                class="stripe-button"
                data-key="<?php echo $stripe['publishable_key'];?>"
                data-name="Tic Tac Toe"
                data-description="One Time Payment"
                data-image="http://omniru.com/3780/tictactoe/assets/img/tictactoe-1.png"
                data-amount="379"
                data-locale="auto"
          ></script>
		</form>
	</body>
</html>