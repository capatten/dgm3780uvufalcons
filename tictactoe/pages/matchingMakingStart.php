<?php
/*
//infinjj4_tictactoeadmin
//Z~KRyXJk8dzP
session_start();

require ("pgConnect.php");

$waiting_userid = intval($_SESSION['userid']);
echo "Your facebook id: " . $waiting_userid . "<br>";

$sql= 'SELECT * FROM "matchmaking"';

			 
$STH = $DBH->prepare($sql);
$STH->execute();
if($STH->errorCode() > 0){
	echo $STH->errorCode() . " - " . print_r($STH->errorInfo()) . "<br>";}
			
//$queryResults = $STH->fetch(PDO::FETCH_ASSOC);	
$results = $STH->fetchAll();
			
//echo "<br />Results found: " . $STH->rowCount() . "<br />";
		
$rowCount = $STH->rowCount();
			
foreach($results as $row){
	
	$arr = array('waiting_user' => $row['waiting_userid']);

	echo json_encode($arr);	
}

if($rowCount == 0){
	
	$sql= 'INSERT INTO "matchmaking" 
	("waiting_userid", "time") 
	VALUES (?,?)';

	$STH = $DBH->prepare($sql);

	$STH->execute(array($waiting_userid,time()));
	if($STH->errorCode() > 0){
		echo $STH->errorCode() . " - " . print_r($STH->errorInfo()) . "<br>";			
	}
	else
	{
		$arr = array('waiting_user' => $waiting_userid);
	}
}

*/



?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tic Tac Toe</title>
    <link rel="icon" href="../assets/img/tictactoe-1.png">
	<link href="https://fonts.googleapis.com/css?family=Bahiana" rel="stylesheet">
	<link href="./assets/css/phone-default.css" rel="stylesheet">
	<script
	  src="https://code.jquery.com/jquery-3.1.1.min.js"
	  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
	  crossorigin="anonymous">
	</script>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=590347651155605";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		
		function statusChangeCallback(response) {
			if (response.status === 'connected') {
				// Logged into your app and Facebook.
				getUserID(response);
			}
		}
		
		function checkLoginState() {
			FB.getLoginStatus(function(response) {
				statusChangeCallback(response);
			});
		}
		
		function logoutFacebook() {
			FB.logout(function(response) {
			});
		}
		
		window.fbAsyncInit = function() {
			FB.init({
					appId      : '{590347651155605}',
					cookie     : true,  // enable cookies to allow the server to access the session
					xfbml      : true,  // parse social plugins on this page
					version    : 'v2.8' // use graph api version 2.8
			});
		
			FB.getLoginStatus(function(response) {
				if (response.status === 'connected') {
					getUserID(response);
				  }
			});
		};
		
		function getUserID(response){
			var userID = response.authResponse.userID;
			alert(userID);
			var $fbUID = $("#fb-UID");
			var $checkForPending_frm = $("#checkForPending_frm");
			$fbUID.val(userID)
			checkForPending_frm.submit();
		}
	</script>
</head>
<body>
	<header>
		<h1>TIC TAC TOE</h1>
	</header>

	<div class="container">
		<div class="tictactoe">
			<img src="../assets/img/tictactoe-1.png" class="tictactoe">
		</div>	
		<div id="fbLoginContainer">
			<fb:login-button autologoutlink="true" scope="public_profile,email,user_friends" onlogin="checkLoginState();">
			</fb:login-button></div>
		</div>
	</div>
	
	<form id="checkForPending_frm" action="./pages/checkForPending.php" method="POST">
		<input type="hidden" id="fb-UID" name="fb-UID" />
	</form>
</body>
</html>
