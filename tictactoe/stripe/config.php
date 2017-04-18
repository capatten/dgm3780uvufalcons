<?php
    require_once('vendor/autoload.php');

    $stripe = array(
        "secret_key" =>  "sk_test_J4r3fwQxmEiarW6miXsTtiry",
        "publishable_key" => "pk_test_IHvB8u9l7twFuVjSde6EEYop"
    );

    \Stripe\Stripe::setApiKey($stripe['secret_key']);
?>