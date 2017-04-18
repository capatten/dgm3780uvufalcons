<?php
    require_once("config.php");
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Tic Tac Toe Payment</title>
</head>
    
<body>            
        <!-- Stripe API -->
        <h1>Payment</h1>
        
        <form action="charge.php" method="POST">
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