<!-- All References are in the Reference.txt file in this folder -->


<?php
    session_start();
    include "functions.php";
    checkIfLoggedIn(1);

	//Adjust this code as necessary to make run
	// $conn = new mysqli("localhost", "validusername", "validpassword", "ArcadeDatabase");

	$setMode = "History";
		
	if (isset($_REQUEST['mode'])){
		$setMode = $_REQUEST['mode'];
	}

?>


<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Game Statistics</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<link rel="stylesheet" href="statsStyle.css" type="text/css">
		<script defer type="text/javascript" src="script.js"></script>

	</head>

	<body>

		<div class="navbar">
			<a href="homepage.php">Home</a>
			<div class="dropdown">
				<button id="gamesBtn"class="dropbtn">Games 
				<i</i>
				</button>
				<div class="dropdown-content">
					<a href="./Games/PapSciRock2.php">Paper, Scissors, Rock</a>
                    <a href="./Games/pickup52.php">Pickup 52</a>
				</div>
			</div> 
            <a href="stats.php">My Stats</a>
			<a class="logout" href="logout.php">Log Out</a>
		</div>	

		<div id=sideAndContent>
			<div class="sidenav">
				<a href="?mode=History">History</a>
				<a href="?mode=WinRate">Win Rate</a>
				<!-- <a href="#">Compare To</a> -->
				<a href="?mode=Leaderboard">Leaderboard</a>
		</div>

			<div id="content">

				<h3>(Please note that statistics are currently only available for the 'Paper Scissors Rock Game)</h3>

				<?php
					$currentUser = $_SESSION['activeID'];

					//PAPER SCISSORS ROCK SUMMARY/HISTORY BRANCH
					if ($setMode == "History"){
						
						//All the play details for each match
						$query = $conn->prepare("SELECT users.username AS 'Player', User_Move AS 'You Played', Opponent_Move AS 'Opponent Played', round_result AS 'Result' 
						FROM RPSResults JOIN users ON users.userID = RPSResults.user_id WHERE user_id = ?;");
						$query->bind_param("i", $_SESSION['activeID']);
						$query->execute();
						$resultList = $query->get_result();

						//If the user has played any games
						if ($resultList->num_rows > 0){

							$count = 1; //ie. round #1

							echo "<table>";

							echo "<tr class='tableTitle'>
							<th>Your Paper Scissors Rock Play History</th>";
							for ($i = 0; $i < 4; $i++){echo "<th></th>";} //To fill in the rest of the top heading
							echo "<tr>";

							$tableHeader = "<tr><th>Match #</th><th>Player</th><th>Player Move</th><th>Opponent Move</th><th>Result</th></tr>";
							echo $tableHeader;

							foreach ($resultList as $result){

								echo "<tr>";

									$player = $result['Player'];
									$yourMove = $result['You Played'];
									$opponentMove = $result['Opponent Played'];
									$roundResult = $result['Result'];
									
									echo "<td>$count</td>";
									echo "<td>$player</td>";
									echo "<td>$yourMove</td>";
									echo "<td>$opponentMove</td>";
									echo "<td>$roundResult</td>";
									

								echo "</tr>";
								$count++;
							}
							echo "</table>";
							echo "Note: Match# x Refers To YOUR xth match, it is not necessarily the xth match on the overall database.<br><br>"; 
						}
						else {
							echo "<h1>You haven't played any rounds of Rock Paper Scissors Yet</h1>";
						}
					}
					else if ($setMode == "WinRate"){
						
						//Get total number of games played by user
						$query1 = $conn->prepare("SELECT * FROM `RPSResults` WHERE user_id = ?");
						$query1->bind_param("i", $_SESSION['activeID']);
						$query1->execute();
						$roundsPlayedByUser = $query1->get_result()->num_rows;

						//Get total number of games won
						$query2 = $conn->prepare("SELECT * FROM `RPSResults` WHERE user_id = ? AND round_result = 'win'");
						$query2->bind_param("i", $_SESSION['activeID']);
						$query2->execute();
						$roundsWonByUser = $query2->get_result()->num_rows;

						//Calculate win percentage
						//Account for a divide by 0 error e.g brand new players checking stats
						if ($roundsPlayedByUser != 0){
							$winRate = ($roundsWonByUser / $roundsPlayedByUser) * 100; //Percentage Value
						}
						else {
							$winRate = 0;
						}

						echo "<h1>", $_SESSION['activeUser'] , ", you have a win rate of ", "<span style=\"color:red\">", (round($winRate, 2)), "%</span></h1>";
						echo "<h2>(", $roundsWonByUser, " wins / ", ($roundsPlayedByUser - $roundsWonByUser), " losses / ", $roundsPlayedByUser, " rounds played)<br><br>";

						if ($winRate > 50){
							echo "<h1>You've got the better of your opponent</h1>";
						}
						else if ($winRate == 50){
							echo "<h1>You're tied! Wow, what are the chance of that</h1>";
						}
						else {
							echo "<h2>Your opponent is currently winning overall, maybe you should <a href='Games/PapSciRock2.php'>play more?</a></h2>";
						}
					}
					else if ($setMode == "Leaderboard"){

						$playerArrays = array();

						//Get all the player id's
						$allPlayerID = $conn->query("SELECT userID, username FROM `users`");

						//Loop through that list figure out their total number of games and wins and win ratio
						//then add them into the array
						foreach ($allPlayerID as $player){

							//Get total number of games played by user
							$query1 = $conn->prepare("SELECT * FROM `RPSResults` WHERE user_id = ?");
							$query1->bind_param("i", $player['userID']);
							$query1->execute();
							$roundsPlayedByUser = $query1->get_result()->num_rows;

							//Get total number of games won
							$query2 = $conn->prepare("SELECT * FROM `RPSResults` WHERE user_id = ? AND round_result = 'win'");
							$query2->bind_param("i", $player['userID']);
							$query2->execute();
							$roundsWonByUser = $query2->get_result()->num_rows;

							$playerName = $player['username'];
							
							array_push($playerArrays, new player($playerName, $roundsWonByUser, $roundsPlayedByUser));
						}

						//Sort out the player array based based on that sorting function
						uasort($playerArrays, "playerSorter");

						//Build a table to display player rank
						echo "<table>
						<tr class='tableTitle'>
							<th>Paper, Scissors, Rock Rank</th>";
							for ($i = 0; $i < 4; $i++){echo "<th></th>";}
						echo "<tr>
							<th>Rank</th>
							<th>Player</th>
							<th>Rounds Played</th>
							<th>Win Rate</th>
							<th>Wins</th>
						</tr>";

						//Initialise these variables
						$count = 1;//Lowest number should be 1 (e.g. you're #1)
						$playerRank = 1;

						foreach ($playerArrays as $player){
							
							$roundedWinRate = round($player->winRate, 2)."%";
							
							echo "<tr>

							<td>$count</td>
							<td>$player->name</td>
							<td>$player->totalGamesPlayed</td>
							<td>$roundedWinRate</td>
							<td>$player->wins</td>
							</tr>";

							//FIgure out the rank of the logged in user
							if ($_SESSION['activeUser'] == $player->name){$playerRank = $count;}

							$count++;
						}

						echo "</table>";
						echo "<h3>Rank based on total wins, followed by win rate</h3>";

						//Run a script to relay the player's position on the leaderboard and provide a bit of feedback to the user
						$player = $_SESSION['activeUser'];

						echo "<script>
							document.getElementById('content').insertAdjacentHTML('afterbegin', '<h1 id=\"rank\">$player, Your Rank is: $playerRank</h1>');
							if ($playerRank == 1){document.getElementById('rank').insertAdjacentHTML('afterend', '<h3>Congratulations!!!</h3>')}
							else {document.getElementById('rank').insertAdjacentHTML('afterend', '<h3>You\'ll get there!</h3>')};
						</script>";
					}
				?>
			</div>
		</div>

	</body>
</html>

