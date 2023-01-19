<!-- All References are in the Reference.txt file in the project folder -->

<?php session_start();
include "functions.php";
checkIfLoggedIn(1); 

// Set timezone, in my testing if I don't do this it says am instead of pm vice-versa
date_default_timezone_set('Pacific/Auckland');?> 

<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Arcade Home</title>
		<link rel="stylesheet" href="style.css" type="text/css">
		<script defer type="text/javascript" src="script.js"></script>

	</head>

	<body>
	
    <div class="navbar">
			<a href="homepage.php">Home</a>
			<div class="dropdown">
				<button class="dropbtn">Games 
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
	
        <!--Layout !-->
        <div id="homepageContent">

        <!-- Greets the user with their name and displays the current time !-->
        <h1 id="userGreeting">Hi <?php echo $_SESSION['activeUser'] , "!" , "<br><br>Today is " .date("l") , " " , date("d-m-Y") ,
        ". The time is currently " , date("h:ia"), ".<br><br> It's time for some games!";?>
        </h1>
		
            <!-- A gallery with icons for games and possibly other things the user might want to do !-->
            <!-- Sorry for all the inline styling, I know it isn't best practice -->
            <div #id=galleryContainer>

                <!-- paper scissors rock -->
                <div class="gallery" style="padding-top: 35px;">
                    <a href="Games/PapSciRock2.php">
                        <img style = "margin-bottom: 1.5em" src="./images/gameIcons/RPSicon.png" alt="Paper/Scissors/Rock" width="300" height="300">
                    </a>
                <div class="desc";>Paper Scissors Rock</div>
                </div>
                
                <!-- Pickup 52 -->
                <div class="gallery" style="padding-top: 17px;">
                    <a href="./Games/pickup52.php">
                        <img src="./images/gameIcons/52PickupIcon.png" alt="Pickup 52" width="300" height="300">
                    </a>
                <div class="desc">Pickup 52</div>
                </div>

                <!-- Email me -->
                <div class="gallery">
                    <a href="mailto:vane-sigmas0r@icloud.com?subject=I%20Have%20An%20Idea">
                        <img src="images/gameIcons/questionmark.png" alt="Pickup 52" width="300" height="300">
                    </a>
                <div class="desc">Send Me A Game Idea</div>
                </div>
            </div>
	</body>
</html>
