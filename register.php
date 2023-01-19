<!-- All References are in the Reference.txt file in the project folder -->
<?php session_start();
include "functions.php"; 
?>

<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Arcade</title>
		<link rel="stylesheet" href="style.css">
		<script defer type="text/javascript" src="script.js"></script>

	</head>

	<body id="loginBody">
	
		<div id="loginLayout">
		
		<div>
			<h1 id="loginTitle">Happy to have you!</h1>
		</div>
		
		<?php
			//Alert user if the registration attempt had a duplicate name
			if (isset($_SESSION['duplicateName'])){
				if($_SESSION['duplicateName'] == true){
					echo "<script>alert('Your selected username has already been taken, try a different one')</script>";
					$_SESSION['duplicateName'] = false;//prevent alert from popping up if the user just presses refresh
				}
			}
		?>
		
		<div style="display:flex; justify-content:center;">
		<div>
            <form action="processRegistration.php" action="post">
				

					<!-- I set database to accept username's of varchar 50, and passwords to varchar 100, If I change this update these too! -->
					<div class="loginEntry">
						<label for="username"><b>Username</b></label>
						<input maxlength="50" style="margin-bottom: 2em;" type="text" placeholder="Choose a Username" name="regUsername" required>
					</div>

					<div class="loginEntry">
						<label for="password"><b>Password</b></label>
						<input maxlength="100" style="margin-bottom: 2em;" type="password" placeholder="Choose a Password" name="regPassword" required>
					</div>

					<div style="min-width: 30vw; display:flex; justify-content: center">
						<button type="submit" style="min-width: 170px; font-weight:700;" class="loginButton" id="registerButton">Complete Registration</button>
					</div>
					
			</form>
			</div>
			</div>

			<div>
				<button onclick="window.location.href='index.php'" class="loginButton">Go Back</button>
			</div>

		</div>
		
	</body>

</html>