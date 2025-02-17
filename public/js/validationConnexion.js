var inputCourriel = document.getElementById('courriel');
var inputMDP = document.getElementById('password');


var crit1 = document.getElementById('signeCrit1');
var crit2 = document.getElementById('signeCrit2');
var crit3 = document.getElemEntById('signeCrit3');
var crit4 = document.getElementById('signeCrit4');
var crit5 = document.getElementById('signeCrit5');

var validation = {
    courriel: false,
    mdp: false
    
};

function validateEmail(courriel) {
    var re = /\S+@\S+\.\S+/;
    return re.test(courriel);
}

document.addEventListener('DOMContentLoaded', function () {
    // const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    // const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

    checkInfos();

    /***************** INPUT => Courriel *****************/
    inputCourriel.addEventListener('input', function () {
        console.log(inputCourriel.value);
        validerCourriel(inputCourriel.value);
    });

    /********************* INPUT => MDP ********************/
    inputMDP.addEventListener('input', function () {
        validerMDP(inputMDP.value);
    });
});

function checkInfos() {
    console.log('checkInfos() is running');

    console.log('********************************************');

    console.log('courriel:', validation.courriel);
    console.log('password:', validation.password);

    console.log('********************************************');


    if (validation.courriel && validation.password) {
        btnSuivant.disabled = false;
        console.log('Next button enabled');
    } else {
        btnSuivant.disabled = true;
        console.log('Next button disabled');
    }
}
console.log("Validation object at startup:", validation);
function validerCourriel(inputValue) {
    let emailInput = document.getElementById('courriel');
    let errorSpan = document.getElementById('errEmail');

    let regex = /\S+@\S+\.\S+/;
    let errorMessage = "";

    if (!inputValue) {
        errorMessage = "Le courriel est requis.";
    } else if (!regex.test(inputValue)) {
        errorMessage = "L'adresse courriel n'est pas valide.";
    }

    if (errorMessage) {
        emailInput.style.borderColor = "red";
        errorSpan.textContent = errorMessage;
        if (typeof validation !== "undefined") validation.courriel = false;
        return;
    }

    // Check if `validation` exists before modifying it
    if (typeof validation === "undefined") {
        console.error("Erreur: `validation` n'est pas défini.");
        return;
    }

    // Send AJAX request to check if email exists
    fetch('/check-email', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ courriel: inputValue })
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            emailInput.style.borderColor = "lightgray";
            errorSpan.textContent = "";
            validation.courriel = true;
        } else {
            emailInput.style.borderColor = "red";
            errorSpan.textContent = "Ce compte n'existe pas.";
            validation.courriel = false;
        }
    })
    .catch(error => console.error('Error:', error));
}



function validerMDP(inputValue) {
    let mdpInput = document.getElementById('password');
    let errorSpan = document.getElementById('errMdp');
    let errorIcon = document.getElementById('sigleMdp');

    let regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\W).{8,}$/;
    let errorMessage = "";

    if (!inputValue) {
        errorMessage = "Le mot de passe est requis.";
    } else if (!regex.test(inputValue)) {
        errorMessage = "Le mot de passe doit contenir au moins 8 caractères, une majuscule et un caractère spécial.";
    }

    if (errorMessage) {
        mdpInput.style.borderColor = 'c4';
        errorSpan.textContent = errorMessage;
        errorIcon.classList.remove("d-none");
        validation.password = false;
    } else {
        mdpInput.style.borderColor = "lightgray";
        errorSpan.textContent = "";
        errorIcon.classList.add("d-none");
        validation.password = true;
    }
}




function finalCheck() {
    validerCourriel(inputCourriel.value);
    validerMDP(inputMDP.value);

    if (validation.courriel && validation.password) {
        return true;
    } else {
        return false;
    }
}
