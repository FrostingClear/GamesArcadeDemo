// All References are in the Reference.txt file in the project folder

let cardsPickedUp = 0;
/**
 * Removes a card from the play area, tracks when 52 cards have been removed/picked up and alerts the
 * user and redirects them back to homepage
 * @param {Meant to be used for elements of class card} card 
 */
function pickup(card){
    card.remove();
    
    cardsPickedUp++;

    if (cardsPickedUp==52){
        alert("You did It! You demonstrated perserverence, that in itself is a reward. But we'll take you home now");
        window.location.href="../homepage.php"
    }
}


let deckOfCards = [];
/**
 * Fills the deck of card array with all the standard deck cards (except for the Joker cards)
 */
function buildDeck(){

    let suits = ["  Spade", "  Club", "Diamond", "  Heart"];//spacing is to help 'center' the suit name on the card
    
    //put the card values into this array 2 -> Ace
    let values = [];

    for (let i = 2; i <= 10; i++){
        values.push(i);
    }

    values.push("J");
    values.push("Q");
    values.push("K");
    values.push("A");

    //nested loop to put every possible card combination into the deck
    for (let j = 0; j < 4; j++){

        for (let k = 0; k < values.length; k++){

            let cardsuit = suits[j];
            let cardvalue = values[k];

            //cardString = cardsuit + "<br><br>-----" + cardvalue + "-----"; 
            cardString = cardvalue + "<br></br>" + cardsuit + "<br><br>";

            deckOfCards.push(cardString);
        }
    }
}

/**
 * Randomly places the cards on the play area
 * @param {Should not exceed 52 } number 
 */
function playPickup(number){

    for (let i = 0; i < number; i++){

        //A card is pretty much just a piece of text in a paragraph which has been styled with CSS and set to position: absolute
        let card = document.createElement('div');
        card.innerHTML = deckOfCards[i];

        //Generate random shift values from its absolute position, apply the styles and apply the 
        let leftwardshift = Math.floor(Math.random() * 720);
        let downwardshift = Math.floor(Math.random() * 550) + 50; //+50 helps account for the navbar height

        card.style.left = leftwardshift + "px";
        card.style.top = downwardshift + "px";

        card.setAttribute("onclick", "pickup(this)");
        card.setAttribute("class", "card");

        document.getElementById('playSurface').appendChild(card);
    }
}