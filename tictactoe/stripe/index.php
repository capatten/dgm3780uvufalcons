<?php
    require_once("config.php");
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Tic Tac Toe</title>
    <link rel="icon" href="../assets/img/tictactoe-1.png">
    
    <link href="../assets/css/stripe.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Bahiana" rel="stylesheet">
	<link href="./assets/css/phone-default.css" rel="stylesheet">
    
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