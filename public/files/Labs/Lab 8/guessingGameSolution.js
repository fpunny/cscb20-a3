// JavaScript Solution Code for guessingGame (CSCSB20 - Lab 8)

var letter;

// This function will be used by the letter buttons created inside guessGame function 
function clicked(elemt) {
	// guess contains the id of the chosen button
	var guess = elemt.id
	
	if (letter < guess) {
		elemt.style.color = "blue";
		elemt.style.background = "blue";
    } else if (letter > guess) {
        elemt.style.color = "red";
		elemt.style.background = "red";
    } else if (guess == letter){
		elemt.style.color = "green";
		elemt.style.background = "green";
		document.getElementById("letterButtons").classList.add('disabledbutton');
		document.getElementById("newGame").innerText="Reset!";
		document.getElementById('newGame').setAttribute( "onClick", "location.reload()");
		document.getElementById('meme').style.display = "inline-block";
	}
}

function guessGame() { 

	var alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l',
    'm','n','o','p','q','r','s','t','u','v','w','x','y','z'];

	var randomNum = Math.floor(Math.random() * 26);
	letter = alphabet[randomNum];

	var output = "";

	for (i = 0; i < alphabet.length; i++) { 
		output += "<button id="+alphabet[i]+ " onclick='clicked(this)'> "+ alphabet[i] + "</button>";
	}

	document.getElementById("letterButtons").innerHTML = output;	
}