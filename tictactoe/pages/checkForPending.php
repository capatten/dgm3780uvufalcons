<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>
		<?php
			session_start();
			
			$_SESSION["userid"] = $_POST['fb-UID'];
			
			header('Location: ./matchingMakingStart.php') ;
			
			/*$fb_ID = $_POST['fb-UID'];
			
			
			
				//connect to the database
				$dbConnection = mysqli_connect('localhost','pattende_dgm3780','IK;3,{blz7_,','pattende_dgm3780') or die();
				
				//build query
				$query =
				"SELECT
					fb_user_id
				FROM
					pattende_dgm3780.pending_users as p
				WHERE
					1 = 1
					AND fb_user_id <> '$fb_ID'"
				;
				
				//run Query
				$result = mysqli_query($dbConnection, $query) or die ('Query Failed');
				
				//if no result is returned redirect to waiting page
				if (mysql_num_rows($result)==0){
					echo 'redirect to Waiting Page';
					header( 'Location: ./waiting.html' ) ;
				}else{
					//display result
					echo 'Player is Waiting';
					while($row = mysqli_fetch_array($result)){
						echo $row[fb_user_id].'</br/>';
					}
				}
				
				//close connection
				mysqli_close($dbConnection);
			*/
		?>
	</body>
</html>