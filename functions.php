<!-- All References are in the Reference.txt file in this folder -->

<?php 

//Some variables to keep track of
$PSRopponentNeutralImgSrc = "../images/PSR/OpponentNeutral.png";
$PSRopponentWinningImgSrc = "../images/PSR/OpponentWins.png";
$PSRopponentLosingImgSrc = "../images/PSR/OpponentLost.png";

//If user is already logged in then take them straight to their homepage
function goToHomepage(){
    if (isset($_SESSION['activeUser']) && isset($_SESSION['activeID'])){

        header("Location: homepage.php");
    }
}

//To be called on any page that the user should be logged into to access, redirects to login if necessary
function checkIfLoggedIn($level){

    if (!(isset($_SESSION['activeUser'])) || !isset($_SESSION['activeID'])){
			
        if ($level == 1){
            header("Location: ./index.php");
        }
        else if ($level == 2){
            header("Location: ../index.php");
        }
        else {
            echo "relative filepath issue in function.php checkIfLoggedIn";
        }
    }
}

//A Paper Scissors Rock player and their stats
class player {

    public $name;
    public $wins;
    public $totalGamesPlayed;
    public $winRate;

    function __construct($name, $wins, $totalGamesPlayed){

        $this->name = $name;
        $this->wins = $wins;
        $this->totalGamesPlayed = $totalGamesPlayed;
        
        //Account for a divide by 0 type error
        if ($totalGamesPlayed > 0){
            $this->winRate = $wins / $totalGamesPlayed * 100;
        }
        else{
            $this->winRate = 0;
        }
    }

}

//To allow sorting based on highest #wins. If same number of wins, then whoever played LESS games is greater
//since that implies a higher win ratio
function playerSorter($player1, $player2){

    $returnValue = $player2->wins - $player1->wins;

    if ($returnValue != 0){
        return $returnValue;
    }
    else {

        return $player1->totalGamesPlayed - $player2->totalGamesPlayed;
    }
}

//The basic logic of this is similar to the one in PSR.js
//If you change the logic in this you MUST update the php one too!!!
function convertPlayToInt($playString){

    if ($playString == "rock"){return 0;}
    else if ($playString == "paper"){return 1;}
    else if ($playString == "scissors"){return 2;}
}

function determineWin($userPlay, $opponentPlay){

    $user = convertPlayToInt($userPlay);
    $opponent = convertPlayToInt($opponentPlay);

    $result = "loss";

    if ($user -1 == $opponent || ($user==0 && $opponent==2)){return "win";}
    else if ($user == $opponent){return "tie";}

    return $result;
}

?>


