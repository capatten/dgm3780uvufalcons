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
</head>

<body>
    
    <h1>Successfully charged $3.79</h1>
    
</body>
</html>
