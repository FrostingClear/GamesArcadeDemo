<!-- All References are in the Reference.txt file in the project folder -->

<?php session_start();
include "../functions.php";
checkIfLoggedIn(2);

$conn = new mysqli("localhost", "root", "", "ArcadeDatabase"); 

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


//Again ensuring we've ended up here through the intended way
if (!isset($_REQUEST['uplay'])){
    header("Location: ../homepage.php");
    return;
}

if (!isset($_REQUEST['oplay'])){
    header("Location: ../homepage.php");
    return;
}

$userID = $_SESSION['activeID'];
$uplay = $_REQUEST['uplay'];
$oplay = $_REQUEST['oplay'];
$winState = determineWin($uplay, $oplay); //Have to logically determine win to prevent a user from abusing this by entering "win" when it shouldn't be a win

//Send data to sql database
$query = $conn->prepare("INSERT INTO RPSResults (`round_id`, `user_id`, `User_Move`, `Opponent_Move`, `round_result`) VALUES (NULL, ?, ?, ?, ?);");
$query->bind_param("isss", $userID, $uplay, $oplay, $winState);
$query->execute();


//Record details of the last play into session so it can used for the eventual restorestate function
$_SESSION['PSRlastResult'] = $winState;
$_SESSION['PSRlastUplay'] = convertPlayToInt($uplay);
$_SESSION['PSRlastOplay'] = convertPlayToInt($oplay);
$_SESSION['PSRrestore'] = true;

//Redirect back to the game page
header("Location: PapSciRock2.php");
?>

