// All References are in the Reference.txt file in the project folder

//When the script runs
attachListenersToOptions();

//Variables 
let rockimgsrc = "../images/PSR/rock.jpeg";
let paperimgsrc = "../images/PSR/paper.jpeg";
let scissorsimgsrc = "../images/PSR/scissors.jpeg";
let playImageSrcs = [rockimgsrc, paperimgsrc, scissorsimgsrc];


function attachListenersToOptions(){
    document.getElementById('rock').addEventListener('click', function(){
        makePlay("rock");});

    document.getElementById('paper').addEventListener('click', function(){
        makePlay("paper");});

    document.getElementById('scissors').addEventListener('click', function(){
        makePlay("scissors");});
}

//The logic for the actual game
//The underlying win determination code is the same as the php one, if you change this don't forget to change that too
function makePlay(play){

    let playerPlay = 0;

    //Convert button id value into an integer
    //rock = 0;
    //paper = 1;
    //scissors = 2;
    if (play == "rock"){playerPlay = 0;}
    else if (play == "paper"){playerPlay = 1;}
    else (playerPlay = 2);

    //Generate a number 0, 1 or 2 to represent the player move
    let opponentPlay = Math.floor(Math.random() * 3);

    //Update the visual tabletop
    updateOpponentPlayIcon(opponentPlay);
    updateUserPlayIcon(playerPlay);

    //Determine who ron
    let roundResult = "loss";

                                        //rock beats scissors
    if (playerPlay - 1 == opponentPlay || (playerPlay == 0 && opponentPlay == 2)){
        roundResult = "win";
    }
    else if (playerPlay == opponentPlay){
        roundResult = "tie";
        updateOpponentExpression("neutral");
    }

    //Update the opponent representation and the tabletop feedback
    updateOpponent(roundResult);
    roundFeedback(roundResult);

    //Indirectly send a form request using get method using this slighly convoluted method
    //e.g. PSRprocessResult.php?uplay=scissors&oplay=rock
    let oplay = "rock";
    if (opponentPlay == 1){oplay="paper";}
    else if (opponentPlay == 2){oplay="scissors";}

    let requestAction = "PSRprocessResult.php?uplay=" + play + "&oplay=" + oplay;

    window.location.href = requestAction;
}



function restoreStateBasedOn(roundResult, userPlay, opponentPlay){

    updateOpponentPlayIcon(opponentPlay);
    updateUserPlayIcon(userPlay);
    roundFeedback(roundResult);
    updateOpponent(roundResult);

}

function updateOpponentPlayIcon(opponentPlay){

    document.getElementById('matchAreaTop').src = playImageSrcs[opponentPlay];
    document.getElementById('matchAreaTop').style = "transform: rotate(180deg)";
}

function updateUserPlayIcon(playerPlay){

    document.getElementById('matchAreaBot').src = playImageSrcs[playerPlay];
}


function roundFeedback(roundResult){

    let feedbackRoulette = ["Huzzah", "Blimey", "Whammo", "Crikey", "Woah", "Shazam"];

    //Makes it easier for the easier to tell that they definitely clicked on an option correctly
    //E.g. If the user and opponent played the same move, you wouldn't necessarily be able to tell that things
    //had actually updated.
    let randomIndex = Math.floor(Math.random() * 6);

    feedbackTag = feedbackRoulette[randomIndex];    

    let resultDisplay = "The round was a tie";
    if (roundResult == "win"){resultDisplay = "You won this round";}
    else if (roundResult == "loss"){resultDisplay = "You lost this round";}
    

    document.getElementById('matchAreaMid').innerHTML = feedbackTag + "! " + resultDisplay;

}

function updateOpponent(roundResult){


    if (roundResult == "win"){
        updateOpponentExpression("losing");
        document.getElementById('speechBubble').innerHTML = "Darn!";
    }
    else if (roundResult == "tie"){
        updateOpponentExpression("neutral");
        document.getElementById('speechBubble').innerHTML = "Hmm..";
    }
    else if (roundResult == "loss"){
        updateOpponentExpression("winning");
        document.getElementById('speechBubble').innerHTML = "Haha!";
    }
}

//If you change the image source, don't forget to adjust the referenced ones in functions.php too
function updateOpponentExpression(state){

    let PSRopponent = document.getElementById("PSRopponent");

    if (state == "neutral"){PSRopponent.src = "../images/PSR/OpponentNeutral.png";}  
    else if (state == "winning"){PSRopponent.src = "../images/PSR/OpponentWins.png";}
    else if (state == "losing"){PSRopponent.src = "../images/PSR/OpponentLost.png";}
}







