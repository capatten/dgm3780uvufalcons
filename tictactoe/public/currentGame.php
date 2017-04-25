<?php

$player1 = htmlspecialchars($_GET['player1']);
$player2 = htmlspecialchars($_GET['player2']);
?>

<!--------------------------------- BOOTSTRAP CSS --------------------------------->
<link href="../assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!--------------------------------- CUSTOM CSS --------------------------------->
<link href="../assets/css/public/currentGame.css" rel="stylesheet">
<link href="../assets/css/currentgame.css" rel="stylesheet">	
<h1>Current Game</h1><span  class='vsDisplay'></span>

<img style='max-height:100px;' src='https://graph.facebook.com/<?php echo $player1; ?>/picture?type=large'> VS <img style='max-height:100px;' src='https://graph.facebook.com/<?php echo $player2; ?>/picture?type=large'><br>


<br><br><div class="winner-div">Turn: <span class='turnDisplaySpan'></span></div>

<div class="container">
	<div class="row row1">
		<div id="r1c1" class="col-sm-4 col1 moveArea"><span class="">&nbsp;</span></div>
		<div id="r1c2" class="col-sm-4 col2 moveArea"><span class="">&nbsp;</span></div>
		<div id="r1c3" class="col-sm-4 col3 moveArea"><span class="">&nbsp;</span></div>
	</div>
	<div class="row row2">
		<div id="r2c1" class="col-sm-4 col1 moveArea"><span class="">&nbsp;</span></div>
		<div id="r2c2" class="col-sm-4 col2 moveArea"><span class="">&nbsp;</span></div>
		<div id="r2c3" class="col-sm-4 col3 moveArea"><span class="">&nbsp;</span></div>
	</div>
	<div class="row row3">
		<div id="r3c1" class="col-sm-4 col1 moveArea"><span class="">&nbsp;</span></div>
		<div id="r3c2" class="col-sm-4 col2 moveArea"><span class="">&nbsp;</span></div>
		<div id="r3c3" class="col-sm-4 col3 moveArea"><span class="">&nbsp;</span></div>
	</div>
</div>

<script src="https://www.gstatic.com/firebasejs/3.7.0/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/3.6.10/firebase-database.js"></script>
<script src="../assets/js/bootstrap/js/bootstrap.min.js"></script>

<script>
	// Initialize Firebase
	var config = {
		apiKey: "AIzaSyALwnsnwRHcliN-8rdC89tfYAQ2HIyeZHI",
		authDomain: "uvu-falcons.firebaseapp.com",
		databaseURL: "https://uvu-falcons.firebaseio.com",
		storageBucket: "uvu-falcons.appspot.com",
		messagingSenderId: "515391920741"
	};
	firebase.initializeApp(config);
	
	
	
	var checkTurnTimer;
	$( document ).ready(function() {
			//start timer
			loadTurnData();
			checkTurnStatus();	
		});
	function checkTurnStatus() {
		checkTurnTimer = setInterval(loadTurnData, 1000);
	}
	function abortTimer() { // to be called when you want to stop the timer
		clearInterval(checkTurnTimer);
	}
	
	var matchString;
	var whoseTurn;
	var whoWon = "";
	function loadTurnData()
	{
		return firebase.database().ref('activeMatches/' + $player1 + 'vs' + $player2).once('value').then(function(snapshot) {
				try{
					matchString = snapshot.val().matchString;	
					matchArray = matchString.split(',');
					$(document).find('#r1c1').find('span').html(matchArray[0]);
					$(document).find('#r1c2').find('span').html(matchArray[1]);
					$(document).find('#r1c3').find('span').html(matchArray[2]);
					$(document).find('#r2c1').find('span').html(matchArray[3]);
					$(document).find('#r2c2').find('span').html(matchArray[4]);
					$(document).find('#r2c3').find('span').html(matchArray[5]);
					$(document).find('#r3c1').find('span').html(matchArray[6]);
					$(document).find('#r3c2').find('span').html(matchArray[7]);
					$(document).find('#r3c3').find('span').html(matchArray[8]);			
				} catch (e) {		
				}
				try{
					whoseTurn = snapshot.val().whoseTurn;	
						
					$(document).find('.turnDisplaySpan').html("<img style='max-height:100px;' src='https://graph.facebook.com/"+whoseTurn+"/picture?type=large'>");				
				} catch (e) {	
					whoseTurn = $fbuid;	
				}
				try{
					whoWon = snapshot.val().whoWon + "";
					if (whoWon != "" && whoWon != "undefined")
					{	
						if (whoWon == "NA")
						{
							$(document).find('.winner-div').html("No one is the winner! <button class='play-again-btn'>Play Again!</button>");		
						}
						else
						{
							$(document).find('.winner-div').html("<img style='max-height:100px;' src='https://graph.facebook.com/"+whoWon+"/picture?type=large'> is the winner! <button class='play-again-btn'>Play Again!</button>");	
						}
								
					}
				} catch (e) {	
					whoWon = "";	
	
				}

			});
	}
	
	function submitMoveData()
	{
		/*var r1c1 = $(document).find('#r1c1');
		r1c1 = $(r1c1).find('span').html();*/
		
		if (whoseTurn == $fbuid && whoWon == "" || whoWon == "undefined")
		{
			whoseTurn = $otherPlayersFbuid;
			
			var r1c1 = $(document).find('#r1c1').find('span').html();
			var r1c2 = $(document).find('#r1c2').find('span').html();
			var r1c3 = $(document).find('#r1c3').find('span').html();
			var r2c1 = $(document).find('#r2c1').find('span').html();
			var r2c2 = $(document).find('#r2c2').find('span').html();
			var r2c3 = $(document).find('#r2c3').find('span').html();
			var r3c1 = $(document).find('#r3c1').find('span').html();
			var r3c2 = $(document).find('#r3c2').find('span').html();
			var r3c3 = $(document).find('#r3c3').find('span').html();
			
			matchString = r1c1+','+r1c2+','+r1c3+','+r2c1+','+r2c2+','+r2c3+','+r3c1+','+r3c2+','+r3c3;
			
			firebase.database().ref('activeMatches/' + $player1 + 'vs' + $player2).set({
					matchString: matchString,
					whoseTurn: $otherPlayersFbuid
				});
		}
	}
</script>
		
<script>
	var $fbuid = "<?php echo $_GET['fbuid']; ?>";
	var $player1 = "<?php echo $_GET['player1']; ?>";
	var $player2 = "<?php echo $_GET['player2']; ?>";
	var $otherPlayersFbuid = ($fbuid == $player1) ? $player2 : $player1; 
	var $sgn = "";
	var $sgn_string = "";
	var $signCount = 0;
	var $moveArea = $(".moveArea");
	var $winner = "";

	$(document).ready(function(){
			//if statement to assign sign value
			if($fbuid == $player1){
				$sgn = "x";
			}else{
				$sgn = "o";
			}
		});

	$moveArea.on('click', function(){
		
			if ($(this).find('span').html() != '&nbsp;')
			{
				return null;
			}
			if (whoseTurn == $fbuid)
			{
				
				var className = "sign_"+$sgn; //create variable to hold className to be assigned when user makes move

				$(this).find('span').addClass(className); //add the class name to the span in the area clicked
				$(this).find('span').text($sgn.toUpperCase()); // add the X or O symbol to area click
				$(this).removeClass("moveArea"); //remove moveArea class, this will prevent other user from making a move in a spot that is not available

				$sgn_string = ".sign_" + $sgn.toLowerCase(); // create class string
				$signCount = $($sgn_string).length; // count number of classes 


				submitMoveData();
				
				
				// if number of class cound is greater then 2, then look for winner
				var finalResult = false;
				if($signCount > 2){
					result = checkRowWin(); //look for horizontal win
					if (result == true) {
						finalResult = true;
					}
					result = checkColWin(); //look for vertical win
					if (result == true) {
						finalResult = true;
					}
					result = checkDiagWin(); //look for diagonal win
					if (result == true) {
						finalResult = true;
					}
					if (finalResult == false)
					{
						checkTieGame();
					}					
				}
				whoseTurn = "other";
			}
			else
			{
				alert('It\'s ' + whoseTurn + '\'s turn right now.');
			}
		});

	function checkRowWin(){
		var row1_count = $("div.row1").find('span' + $sgn_string).length;
		var row2_count = $("div.row2").find('span' + $sgn_string).length;
		var row3_count = $("div.row3").find('span' + $sgn_string).length;
		  
		if( row1_count == 3 || row2_count == 3 || row3_count == 3 ){
			//alert("Horizontal Winner");
			endGame();
			return true;
		}
		
		return false;
	}

	function checkColWin(){
		var col1_count = $("div.col1").find('span' + $sgn_string).length;
		var col2_count = $("div.col2").find('span' + $sgn_string).length;
		var col3_count = $("div.col3").find('span' + $sgn_string).length;
		  
		if( col1_count == 3 || col2_count == 3 || col3_count == 3 ){
			//alert("Vertical winner");
			endGame();
			return true;
		}
		
		return false;
	}

	function checkDiagWin(){
		if($("#r2c2").find('span' + $sgn_string).length !== 0 ){
			if(($("#r1c1").find('span' + $sgn_string).length !== 0 && $("#r3c3").find('span' + $sgn_string).length !== 0 )){
				//alert("Diagnal LR winner");
				endGame();
				return true;
			}else if($("#r1c3").find('span' + $sgn_string).length !== 0 && $("#r3c1").find('span' + $sgn_string).length !== 0 ){
				//alert("Diagnal RL winner");
				endGame();
				return true;
			}
		}
		
		return false;
	}
	
	function checkTieGame()
	{
		var r1c1 = $(document).find('#r1c1').find('span').html();
		var r1c2 = $(document).find('#r1c2').find('span').html();
		var r1c3 = $(document).find('#r1c3').find('span').html();
		var r2c1 = $(document).find('#r2c1').find('span').html();
		var r2c2 = $(document).find('#r2c2').find('span').html();
		var r2c3 = $(document).find('#r2c3').find('span').html();
		var r3c1 = $(document).find('#r3c1').find('span').html();
		var r3c2 = $(document).find('#r3c2').find('span').html();
		var r3c3 = $(document).find('#r3c3').find('span').html();
			
		matchString = r1c1+','+r1c2+','+r1c3+','+r2c1+','+r2c2+','+r2c3+','+r3c1+','+r3c2+','+r3c3;
		
		if (matchString.indexOf("&nbsp") == -1)
		{
			submitWinner(tie = true);
		}
	}
	
	function endGame(){
		submitWinner();
	};

	function submitWinner(tie = false)
	{
		var r1c1 = $(document).find('#r1c1').find('span').html();
		var r1c2 = $(document).find('#r1c2').find('span').html();
		var r1c3 = $(document).find('#r1c3').find('span').html();
		var r2c1 = $(document).find('#r2c1').find('span').html();
		var r2c2 = $(document).find('#r2c2').find('span').html();
		var r2c3 = $(document).find('#r2c3').find('span').html();
		var r3c1 = $(document).find('#r3c1').find('span').html();
		var r3c2 = $(document).find('#r3c2').find('span').html();
		var r3c3 = $(document).find('#r3c3').find('span').html();
			
		matchString = r1c1+','+r1c2+','+r1c3+','+r2c1+','+r2c2+','+r2c3+','+r3c1+','+r3c2+','+r3c3;

		var winnerId = "";
		if (tie == false)
		{
			winnerId = $fbuid;
		}
		else
		{
			
			winnerId = "NA";
		}
		firebase.database().ref('activeMatches/' + $player1 + 'vs' + $player2).set({
				whoWon: winnerId,
				matchString: matchString
			});
			
		firebase.database().ref('completedMatches/' + $player1 + 'vs' + $player2).set({
				whoWon: winnerId
			});
		/*var r1c1 = $(document).find('#r1c1');
		r1c1 = $(r1c1).find('span').html();*/
		
		/*if (whoseTurn == $fbuid)
		{
		whoseTurn = $otherPlayersFbuid;
			
		var r1c1 = $(document).find('#r1c1').find('span').html();
		var r1c2 = $(document).find('#r1c2').find('span').html();
		var r1c3 = $(document).find('#r1c3').find('span').html();
		var r2c1 = $(document).find('#r2c1').find('span').html();
		var r2c2 = $(document).find('#r2c2').find('span').html();
		var r2c3 = $(document).find('#r2c3').find('span').html();
		var r3c1 = $(document).find('#r3c1').find('span').html();
		var r3c2 = $(document).find('#r3c2').find('span').html();
		var r3c3 = $(document).find('#r3c3').find('span').html();
			
		matchString = r1c1+','+r1c2+','+r1c3+','+r2c1+','+r2c2+','+r2c3+','+r3c1+','+r3c2+','+r3c3;
			
		firebase.database().ref('activeMatches/' + $player1 + 'vs' + $player2).set({
		matchString: matchString,
		whoseTurn: $otherPlayersFbuid
		});
		}*/
	}
	
	$(document).on('click','.play-again-btn',function() {
			firebase.database().ref('activeMatches/' + $player1 + 'vs' + $player2).remove();
			firebase.database().ref('users/' + $player1 + '/activeMatch').remove();
			firebase.database().ref('users/' + $player2 + '/activeMatch').remove();	
		
			window.location = "checkForPending.php?fbuid="+$fbuid;
		});
</script>