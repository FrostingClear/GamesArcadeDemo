<!-- All References are in the Reference.txt file in the project folder -->

<?php session_start();
    // Enter Valid Details Here
	// $conn = new mysqli("localhost", "validusername", "validpassword", "ArcadeDatabase");

    if (isset($_REQUEST['username']) && isset($_REQUEST['password'])){

        //Get the user inputs from the form
        $userInputUsername = $_REQUEST['username'];
        $userInputPassword = $_REQUEST['password'];

        //Find a matching user
        $result = $conn->query("SELECT * FROM users WHERE users.username = '$userInputUsername' AND users.password = '$userInputPassword';");

        //There should only be one user
        if ($result->num_rows == 1){
            echo "YES";

            //Assign the active user variable to session
            //We already know there's only one person
            foreach ($result as $theOneUser){
                $_SESSION['activeUser'] = $theOneUser['username'];
            }
            
            echo $_SESSION['activeUser'];

            //Assign the ID to the session too by querying the SQL database for the corresponding ID
            $idLookup = $conn->query("SELECT userID FROM users where username = '$userInputUsername';");

            if ($idLookup->num_rows == 1){
                
                foreach ($idLookup as $id){
                    $userID = $id['userID'];
                    echo $userID;
                }

                $_SESSION['activeID'] = $userID;
            }
    }
    else {
        echo "Wrong";
        $_SESSION['badlogin'] = true;
    }
}
    
   header("Location: index.php");
?>



