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