<?php 

	require ("pgConnectInfo.php");
			try {
			$DBH = new PDO("pgsql:dbname=$pgDBName;host=$pgDBHost", $pgDBUsername, $pgDBPassword);
				}
			catch(PDOException $e)
				{
				echo $e->getMessage();
				}
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );  

?>