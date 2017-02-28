<?php
//infinjj4_tictactoeadmin
//Z~KRyXJk8dzP
session_start();

require ("pgConnect.php");

$waiting_userid = intval($_SESSION['userid']);


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





?>