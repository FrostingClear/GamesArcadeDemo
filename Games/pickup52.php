<!-- All References are in the Reference.txt file in the project folder -->

<?php session_start();
include "../functions.php";
checkIfLoggedIn(2);
?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<link rel="stylesheet" href="p52style.css" type="text/css">
		<link rel="stylesheet" href="../style.css" type="text/css">
		<script type="text/javascript" src="p52.js"></script>

	</head>

	
	<body id="playSurface">

		<div class="navbar">
				<a href="../homepage.php">Home</a>
				<div class="dropdown">
					<button class="dropbtn">Games 
					</button>
					<div class="dropdown-content">
						<a href="./PapSciRock2.php">Paper, Scissors, Rock</a>
						<a href="./pickup52.php">Pickup 52</a>
					</div>
				</div> 
				<a href="../stats.php">My Stats</a>
				<a class="logout" href="../logout.php">Log Out</a>
		</div>
	
		<!-- Run the scripts to make the game operate including a user guide-->
        <script>
			buildDeck();
			playPickup(52);
			alert("The rules are simple: click on the cards to pick them up. Receive a reward at the end (To the marker: yes, this is a joke game from my childhood)");
		</script>
		
	</body>

</html>
