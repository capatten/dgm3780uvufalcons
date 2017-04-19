<?php
session_start();
$fbuid = $_SESSION["fbuid"];
if(intval($fbuid) == 0){
	header("Location: ../");
}

echo "<img style='max-height:100px;' src='https://graph.facebook.com/$fbuid/picture?type=large'>  User Id: " . $fbuid . "<br>";
?>
<?php
require_once("config.php");
      
$token = $_POST['stripeToken'];
    
$customer = \Stripe\Customer::create(array(
		'email' => 'customer@example.com',
		'source' => $token
	));
      
$charge = \Stripe\Charge::create(array(
		'customer' => $customer->id,
		'amount' => 379,
		'description' => 'Example Charge',
		'currency' => 'usd'
	));
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Payment Successful</title>
        <link rel="icon" href="../assets/img/tictactoe-1.png">

        <link href="../assets/css/stripe.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Bahiana" rel="stylesheet">
        <link href="./assets/css/phone-default.css" rel="stylesheet">
    
	</head>

	<body class="stripeBody">
	
		<script>
			var fbuid = "<?php echo "$fbuid" ?>";
		</script>
			
    
		<h1>Successfully charged $3.79</h1>
		
		<a href="../public/checkForPending.php?fbuid=<?php echo $fbuid; ?>">Return to Game</a>
    
	</body>
</html>
