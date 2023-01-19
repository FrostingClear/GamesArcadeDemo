<!-- All References are in the Reference.txt file in the project folder -->

<?php session_start();
include "../functions.php";
checkIfLoggedIn(2);
?>

<html>

	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Paper Scissors Rock</title>
		<link rel="stylesheet" href="../style.css" type="text/css">
		<link rel="stylesheet" href="PSRstyle.css" type="text/css">

        <script type="text/javascript" src="../script.js"></script>

	</head>

	<body>

		<!-- Navbar -->
		<div class="navbar">
			<a href="../homepage.php">Home</a>
			<div class="dropdown">
				<button class="dropbtn">Games 
				<i class="fa fa-caret-down"></i>
				</button>
				<div class="dropdown-content">
					<a href="./PapSciRock2.php">Paper, Scissors, Rock</a>
					<a href="./pickup52.php">Pickup 52</a>
				</div>
			</div> 
			<a href="../stats.php">My Stats</a>
			<a class="logout" href="../logout.php">Log Out</a>
		</div>
	
		<!-- Overall Layout -->
        <div id="PSRgameSpace">

			<!-- The opponent and the speech bubble -->
			<div id="opponentContainer">
				<img id="PSRopponent" src="../images/PSR/OpponentNeutral.png" alt="Neutral Opponent">

				<div id="bubbleContainer">
					<p id="speechBubble">Hmmm</p>
				</div>
			</div>
			
			<!-- The 'tabletop' of the play area -->
			<div id="PSRmatchArea">
				<div class="matchAreaSection"><img id="matchAreaTop" src="../images/PSR/placeholder.jpeg"></div>
				<div class="matchAreaSection" id="matchAreaMid">Make Your Move</div>
				<div class="matchAreaSection"><img id="matchAreaBot" src="../images/PSR/placeholder.jpeg"></div>
			</div>


			<!-- User interaction area !-->
			<div id="optionsLabel">Choose Your Move</div>
			<div id="PSRplayerOptions">
				<img class="rpsOpt" id="rock" src="../images/PSR/rock.jpeg" alt="rock" onmouseover="changeImage(this, '../images/PSR/rockInv.png')" onmouseout="changeImage(this, '../images/PSR/rock.jpeg')" onmousedown="changeImage(this, '../images/PSR/rock.jpeg')" onmouseup="changeImage(this, '../images/PSR/rockInv.png')" >
				<img class="rpsOpt" id="paper" src="../images/PSR/paper.jpeg" alt="paper" onmouseover="changeImage(this, '../images/PSR/paperInv.png')" onmouseout="changeImage(this, '../images/PSR/paper.jpeg')" onmousedown="changeImage(this, '../images/PSR/paper.jpeg')" onmouseup="changeImage(this, '../images/PSR/paperInv.png')">
				<img class="rpsOpt" id="scissors" src="../images/PSR/scissors.jpeg" alt="scissors" onmouseover="changeImage(this, '../images/PSR/scissorsInv.png')" onmouseout="changeImage(this, '../images/PSR/scissors.jpeg')" onmousedown="changeImage(this, '../images/PSR/scissors.jpeg')" onmouseup="changeImage(this, '../images/PSR/scissorsInv.png')">
			</div>
		</div>

		<!-- Now safe to load the script which will attach the listeners to the play options !-->
		<script type="text/javascript" src="PSR.js"></script>


		<!-- If the user had previously made a play, restore that state when they pop back into that page !-->
		<?php
			if (isset($_SESSION['PSRlastResult'])){

				 $lastRoundResult = $_SESSION['PSRlastResult'];
				 $lastUserPlay = $_SESSION['PSRlastUplay'];
				 $lastOpponentPlay = $_SESSION['PSRlastOplay'];
				//e.g. $script = "<script>restoreStateBasedOn('win', 2, 1)</script>";
				echo "<script>restoreStateBasedOn('$lastRoundResult', '$lastUserPlay', '$lastOpponentPlay');</script>";
			}
		?>
	</body>
</html>

