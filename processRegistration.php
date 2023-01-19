<!-- All References are in the Reference.txt file in the project folder -->

<?php session_start();
include "functions.php"; 

//Enter valid details here
// $conn = new mysqli("localhost", "validusername", "validpassword", "ArcadeDatabase");

if (isset($_REQUEST['regUsername']) && isset($_REQUEST['regPassword'])){
    $newUsername = $_REQUEST['regUsername'];
    $newUserpwd = $_REQUEST['regPassword'];

    //Check if there is already a user with that username and prevent it
    $query1 = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query1->bind_param("s", $_REQUEST['regUsername']);
    $query1->execute();
    $existingLookup = $query1->get_result();

    echo $existingLookup->num_rows;

    //Any result that isn't 0 would imply there is already a user with that name
    if ($existingLookup->num_rows > 0){

        $_SESSION['duplicateName'] = true;
        echo "uh-oh";
        header("Location: register.php");
    }
    else {

        //Insert the new user into the database, that table has an auto-increment for userID
        $query2 = $conn->prepare("INSERT INTO `users` (`userID`, `username`, `password`) VALUES (NULL, ?, ?);");
        $query2->bind_param("ss", $newUsername, $newUserpwd); #the ? will be an integer ('i') with the value from $team
        $query2->execute(); 

        //Redirect to the login page
        $_SESSION['regSuccess'] = true;
        header("Location: index.php");
    }
}






?>