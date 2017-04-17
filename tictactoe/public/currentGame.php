<!--------------------------------- BOOTSTRAP CSS --------------------------------->
	<link href="../assets/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!--------------------------------- CUSTOM CSS --------------------------------->
	<link href="../assets/css/public/currentGame.css" rel="stylesheet">
	
<h1>Current Game</h1>

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
</script>
		
<script>
	var $fbuid = <?php echo $_GET['fbuid']; ?>;
	var $player1 = <?php echo $_GET['player1']; ?>;
	var $player2 = <?php echo $_GET['player2']; ?>;
	var $sgn = "";
	var $sgn_string = "";
	var $signCount = 0;
	var $moveArea = $(".moveArea");

	$(document).ready(function(){
		//if statement to assign sign value
		if($fbuid == $player1){
			$sgn = "x";
		}else{
			$sgn = "o";
		}
	});

	$moveArea.on('click', function(){
		var className = "sign_"+$sgn; //create variable to hold className to be assigned when user makes move

		$(this).find('span').addClass(className); //add the class name to the span in the area clicked
		$(this).find('span').text($sgn.toUpperCase()); // add the X or O symbol to area click
		$(this).removeClass("moveArea"); //remove moveArea class, this will prevent other user from making a move in a spot that is not available

		$sgn_string = ".sign_" + $sgn.toLowerCase(); // create class string
		$signCount = $($sgn_string).length; // count number of classes 

		// if number of class cound is greater then 2, then look for winner
		if($signCount > 2){
		  checkRowWin(); //look for horizontal win
		  checkColWin(); //look for vertical win
		  checkDiagWin(); //look for diagonal win
		}
	});

	function checkRowWin(){
		var row1_count = $("div.row1").find('span' + $sgn_string).length;
		var row2_count = $("div.row2").find('span' + $sgn_string).length;
		var row3_count = $("div.row3").find('span' + $sgn_string).length;
		  
		if( row1_count == 3 || row2_count == 3 || row3_count == 3 ){
			alert("Horizontal Winner");
		}
	}

	function checkColWin(){
		var col1_count = $("div.col1").find('span' + $sgn_string).length;
		var col2_count = $("div.col2").find('span' + $sgn_string).length;
		var col3_count = $("div.col3").find('span' + $sgn_string).length;
		  
		if( col1_count == 3 || col2_count == 3 || col3_count == 3 ){
			alert("Vertical winner");
		}
	}

	function checkDiagWin(){
		if($("#r2c2").find('span' + $sgn_string).length !== 0 ){
			if(($("#r1c1").find('span' + $sgn_string).length !== 0 && $("#r3c3").find('span' + $sgn_string).length !== 0 )){
				alert("Diagnal LR winner");
			}else if($("#r1c3").find('span' + $sgn_string).length !== 0 && $("#r3c1").find('span' + $sgn_string).length !== 0 ){
				alert("Diagnal RL winner");
			}
		}
	}
</script>