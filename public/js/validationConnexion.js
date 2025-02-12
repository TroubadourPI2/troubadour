var inputCourriel = document.getElementById('email');
var inputMDP = document.getElementById('mdp');
// var inputConfirmMDP = document.getElementById("cmdp");
var btnSuivant = document.getElementById('btn-suivant');

var crit1 = document.getElementById('signeCrit1');
var crit2 = document.getElementById('signeCrit2');
var crit3 = document.getElementById('signeCrit3');
var crit4 = document.getElementById('signeCrit4');
var crit5 = document.getElementById('signeCrit5');

var validation = {
    courriel: false,
    mdp: false
    // cmdp: false
};

function validateEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
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

    // /***************** INPUT => Confirm MDP *****************/
    //     inputConfirmMDP.addEventListener('input', function(){
    //         validerCMDP(inputConfirmMDP.value);
    //     });
});

function checkInfos() {
    console.log('checkInfos() is running');

    console.log('********************************************');
    console.log('********************************************');
    console.log('********************************************');

    console.log('courriel:', validation.courriel);
    console.log('mdp:', validation.mdp);
    // console.log('cmdp:', validation.cmdp);

    console.log('********************************************');
    console.log('********************************************');
    console.log('********************************************');

    if (validation.courriel && validation.mdp) {
        btnSuivant.disabled = false;
        console.log('Next button enabled');
    } else {
        btnSuivant.disabled = true;
        console.log('Next button disabled');
    }
}

function validerCourriel(inputValue) {
    var re = /\S+@\S+\.\S+/;
    $error = '';

    if (inputValue === '') {
        inputCourriel.style.borderColor = 'var(--accentRougeV3R)';
        validation.courriel = false;
        $error = 'Le courriel est requis.';
    } else if (inputValue !== '' && !re.test(inputValue)) {
        inputCourriel.style.borderColor = 'var(--accentRougeV3R)';
        validation.courriel = false;
        $error = "L'adresse courriel entrée n'est pas valide.";
    } else if (inputValue.length > 64) {
        inputCourriel.style.borderColor = 'var(--accentRougeV3R)';
        validation.courriel = false;
        $error = "L'adresse courriel doit contenir moins de 64 caractères.";
    } else {
        inputCourriel.style.borderColor = 'lightgray';
        validation.courriel = true;
        $error = '';
    }

    if (validation.courriel == false) {
        document.getElementById('sigleCouriel').classList.remove('d-none');
    } else {
        validation.courriel = true;

        document.getElementById('sigleCouriel').classList.add('d-none');
    }

    document.getElementById('errEmail').innerHTML = $error;
    document.getElementById('errEmail').style.color = 'var(--accentRougeV3R)';
    checkInfos();
}

function validerMDP(inputValue) {
    console.log(inputValue);
    $erreur = '';
    const regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\W).{8,}$/;
    const regMaj = /[A-Z]/;
    const regMin = /[a-z]/;
    const regSpec = /\W/;
    const regNum = /\d/;
    const regLong = /.{8,}/;

    var nbChar, asMaj, asMin, asSpec, asNum;

    if (inputValue === '') {
        inputMDP.style.borderColor = 'var(--accentRougeV3R)';
        validation.mdp = false;
        $erreur = 'Le mot de passe est requis.';

        document.getElementById('errCritMDP1').style.color =
            'var(--accentRougeV3R)';
        crit1.classList.remove('fa-check');
        crit1.classList.add('fa-x');

        document.getElementById('errCritMDP2').style.color =
            'var(--accentRougeV3R)';
        crit2.classList.remove('fa-check');
        crit2.classList.add('fa-x');

        document.getElementById('errCritMDP3').style.color =
            'var(--accentRougeV3R)';
        crit3.classList.remove('fa-check');
        crit3.classList.add('fa-x');

        document.getElementById('errCritMDP4').style.color =
            'var(--accentRougeV3R)';
        crit4.classList.remove('fa-check');
        crit4.classList.add('fa-x');

        document.getElementById('errCritMDP5').style.color =
            'var(--accentRougeV3R)';
        crit5.classList.remove('fa-check');
        crit5.classList.add('fa-x');
    } else {
        if (document.getElementById('criteres').style.display === 'none') {
            document.getElementById('criteres').style.display = 'flex';
        }

        if (!regMaj.test(inputValue)) {
            document.getElementById('errCritMDP2').style.color =
                'var(--accentRougeV3R)';
            crit2.classList.remove('fa-check');
            crit2.classList.add('fa-x');
            asMaj = false;
        } else if (regMaj.test(inputValue)) {
            document.getElementById('errCritMDP2').style.color =
                'var(--vertV3r)';
            crit2.classList.remove('fa-x');
            crit2.classList.add('fa-check');
            asMaj = true;
        }

        if (!regMin.test(inputValue)) {
            document.getElementById('errCritMDP3').style.color =
                'var(--accentRougeV3R)';
            crit3.classList.remove('fa-check');
            crit3.classList.add('fa-x');
            asMin = false;
        } else if (regMin.test(inputValue)) {
            document.getElementById('errCritMDP3').style.color =
                'var(--vertV3r)';
            crit3.classList.remove('fa-x');
            crit3.classList.add('fa-check');
            asMin = true;
        }

        if (!regSpec.test(inputValue)) {
            document.getElementById('errCritMDP4').style.color =
                'var(--accentRougeV3R)';
            crit4.classList.remove('fa-check');
            crit4.classList.add('fa-x');
            asSpec = false;
        } else if (regSpec.test(inputValue)) {
            document.getElementById('errCritMDP4').style.color =
                'var(--vertV3r)';
            crit4.classList.remove('fa-x');
            crit4.classList.add('fa-check');
            asSpec = true;
        }

        if (!regNum.test(inputValue)) {
            document.getElementById('errCritMDP5').style.color =
                'var(--accentRougeV3R)';
            crit5.classList.remove('fa-check');
            crit5.classList.add('fa-x');
            asNum = false;
        } else if (regNum.test(inputValue)) {
            document.getElementById('errCritMDP5').style.color =
                'var(--vertV3r)';
            crit5.classList.remove('fa-x');
            crit5.classList.add('fa-check');
            asNum = true;
        }

        if (!regLong.test(inputValue)) {
            document.getElementById('errCritMDP1').style.color =
                'var(--accentRougeV3R)';
            crit1.classList.remove('fa-check');
            crit1.classList.add('fa-x');
            nbChar = false;
        } else if (regLong.test(inputValue)) {
            document.getElementById('errCritMDP1').style.color =
                'var(--vertV3r)';
            crit1.classList.remove('fa-x');
            crit1.classList.add('fa-check');
            nbChar = true;
        } else {
            inputMDP.style.borderColor = 'lightgray';
            validation.mdp = true;
            $erreur = '';
        }
    }
    if (!nbChar || !asMaj || !asMin || !asSpec || !asNum) {
        inputMDP.style.borderColor = 'var(--accentRougeV3R)';
        validation.mdp = false;
        $erreur =
            'Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.';
    } else if (!nbChar && !asMaj && !asMin && !asSpec && !asNum) {
        inputMDP.style.borderColor = 'var(--accentRougeV3R)';
        validation.mdp = false;
        $erreur = 'Le mot de passe est requis';
    } else {
        inputMDP.style.borderColor = 'lightgray';
        validation.mdp = true;
        $erreur = '';
    }

    checkInfos();
}

// function validerCMDP(inputValue){
//     if (inputValue !== inputMDP.value) {
//         inputConfirmMDP.style.borderColor = "var(--accentRougeV3R)";
//         validation.cmdp = false;
//         document.getElementById('sigleCmdp').classList.remove('d-none');
//         document.getElementById("errCmdp").innerHTML = "Les mots de passe ne correspondent pas.";
//         document.getElementById("errCmdp").style.color = "var(--accentRougeV3R)";
//         document.getElementById('sigleCmdp').classList.remove('fa-check');
//         document.getElementById('sigleCmdp').classList.add('fa-x');
//     } else {
//         inputConfirmMDP.style.borderColor = "lightgray";
//         validation.cmdp = true;
//         document.getElementById("errCmdp").innerHTML = "";
//         document.getElementById('sigleCmdp').classList.add('d-none');
//     }
//     checkInfos();
// }

function finalCheck() {
    validerCourriel(inputCourriel.value);
    validerMDP(inputMDP.value);
    // validerCMDP(inputConfirmMDP.value);

    if (validation.courriel && validation.mdp) {
        return true;
    } else {
        return false;
    }
}
