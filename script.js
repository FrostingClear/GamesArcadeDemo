// All References are in the Reference.txt file in the project folder

function changeImage(image, src){
    image.src = src;
}

function modalBoxSetup(){
    var modal = document.getElementById('modalBox');

    //hide the login pop-up display by default
    modal.style.display = "none";
    //Hide the pop-up display when clicked
    window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
    }
}