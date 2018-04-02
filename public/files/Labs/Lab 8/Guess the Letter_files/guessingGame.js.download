// Global variable letter, which will contain the randomly generated letter
var letter;

// This function will be used by the letterButtons created inside guessGame function
function clicked(elemt) {
	// guess contains the id of the chosen button, in this case it is also the letter
	var guess = elemt.id
	
	// If the random letter precedes the guess, sets the button and text color to blue
	if (letter < guess) {
		elemt.style.color = "blue";
		elemt.style.background = "blue";
    } else if (letter > guess) {
		// Complete the code such that if the random letter comes after the guess in the alphabet ***
		// then the button's text and background colour is changed to red. ***

	// if letter the guess is correct, set the button colour to green ***
    } else if (guess == letter){

		// The code below, adds the disabledbutton CSS class to be added to the letterButtons div
		document.getElementById("letterButtons").classList.add('disabledbutton');
		// This code, changes the text value of the newGame button
		document.getElementById("newGame").innerText="Reset!";
		// The folowing code set't the onClick attribute of newGame to reload the game page for another game.
		document.getElementById('newGame').setAttribute( "onClick", "location.reload()");
	}
}

function guessGame() { 
	// innitialized array alphabet that contains all the letters in the alphaber a-z
	var alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l',
    'm','n','o','p','q','r','s','t','u','v','w','x','y','z'];

	// Use Math object to generate a random number between 0-25 and set that to randomNum ***
	var randomNum;
	letter = alphabet[randomNum];
	
	// Initialized empty string variable
	var output = "";
	// Complete the missing portions of the loop such that the loop generates an individual button for all the letters ***
	for () { 
		output += "<button id="+alphabet[i]+ " onclick='clicked(this)'> "+ alphabet[i] + "</button>";
	}
	// sets the HTML code generated in the loop about such the buttons are created
	document.getElementById("letterButtons").innerHTML = output;	
}