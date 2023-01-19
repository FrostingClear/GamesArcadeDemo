<!-- All References are in the Reference.txt file in the project folder -->

<?php session_start();
include "functions.php"; 
goToHomepage();
?>

<!-- The actual login / entrance page of the website -->
<!DOCTYPE html>

<html>

	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Games Arcade</title>
		<link rel="stylesheet" href="style.css">
		<script type="text/javascript" src="script.js"></script>
	</head>

	<body id="loginBody">
	
		<div id="loginLayout">
		
		<div>
			<h1 id="loginTitle">Games Arcade</h1>
		</div>
		
		<!-- Alerts for failed login and valid registration !-->
		<?php
			if (isset($_SESSION['badlogin'])){
				if($_SESSION['badlogin'] == true){
					echo "<script>alert('Incorrect Login Details - please note that passwords are case sensitive')</script>";
					$_SESSION['badlogin'] = false; //prevent alert from popping up if the user just presses refresh
				}
			}

			if (isset($_SESSION['regSuccess'])){
				if ($_SESSION['regSuccess'] == true){
					echo "<script>alert('You are now registered, please try logging in')</script>";
					$_SESSION['regSuccess'] = false; //flip the value for the next registration
				}
			}
		?>
		
		<!--Arcade machine image !-->
		<div><img id="index_arcade" src="images/general/arcade.png" alt="arcade machine"></div>

		<div>	
			<!--Button to trigger the login prompt !-->
			<button class="loginButton" id="modalPopUp" onclick="document.getElementById('modalBox').style.display='block'">Login</button>
			
			<!-- The Modal Box Itself -->
			<div id="modalBox" class="modal">
			<span onclick="document.getElementById('modalBox').style.display='none'" class="close" title="Close Modal">&times;</span>

			<!-- The actual login form -->
			<form class="modal-content animate" action="login.php" action="post">
				<div class="modalSection">

					<div class="loginEntry">
						<label for="username"><b>Username</b></label>
						<input type="text" placeholder="Enter Username(Assignment Example: 'tester')" name="username" required>
					</div>

					<div class="loginEntry">
						<label for="password"><b>Password</b></label>
						<input type="password" placeholder="Enter Password (Assignment Example:'abcd')" name="password" required>
					</div>
					
					<div style="display: flex; justify-content:space-around; min-width:30vw;">
						<button class="loginButton miniLoginButton" type="submit">Login</button>
						<button type="button" class="loginButton miniLoginButton" onclick="document.getElementById('modalBox').style.display='none'" class="cancelbtn">Cancel</button>
					</div>
				</div>
			</form>
			</div>
		</div>

		<!-- Apply final details to the modal box !-->
		<script>
			modalBoxSetup();
		</script>
 
		<!-- Registration button !-->
		<div>
		<a style="width:30vw;" href="register.php"><button style="width: 100%; font-weight:700;" class="loginButton" id="registerButton">Register</button></a>
		</div>

		</div><!-- login layout end div !-->
		
	</body>
</html>

