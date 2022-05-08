let utente = '';
let user_valIDo = false;
let pasw_valIDa = false;
let mail_valIDa = false;

const cred_err = document.getElementByID("cred_err"); // Credenziali non valIDe


function valIDazione(event){
    console.log("controllo validazione...");
    if(form.nome.value.length === 0 ||
        form.cognome.value.length === 0 ||
        form.email.value.length === 0 ||
        form.utente.value.length === 0 ||
        form.pasw.value.length === 0 ||
        form.confirm.value.length === 0){
            console.log("Ci sono campi non riempiti. Allora va e riempili.");
            event.preventDefault();
        }
    else if(user_valido == false || pasw_valida == false || mail_valida == false){
        cred_err.classList.remove("hidden");
        event.preventDefault();
    }    
    
}

function onResponse(response){
    return response.json();
}

function controllaUtente(json){
    for(event of json){
        if(event.Username == utente){
            document.getElementByID('user').style.color = 'red';
            document.getElementByID('user').innerHTML = 'Username non disponibile...';          
            return;
        }
    }
    console.log("user valIDo");
    document.getElementByID('user').style.color = 'green';
    document.getElementByID('user').innerHTML = 'Username disponibile!';  
    user_valido = true;
}

function onBlurUsr(json){
    console.log("blur utente");
    utente = form.utente.value;
    console.log(utente);
    if(utente.length != 0){
        fetch("http://localhost/Homework1/ajax_get_user.php").then(onResponse).then(controllaUtente);
    }
    else {
        document.getElementByID('user').style.color = 'red';
        document.getElementByID('user').innerHTML = 'Scegli un altro username.';
    }
}

function onBlurPsw(event){
    console.log("blur password");
    if(form.confirm.value == form.pasw.value){
        pasw_valIDa = true;
        document.getElementByID('pass').style.color = 'green';
        document.getElementByID('pass').innerHTML = 'Ok!'; 
    }
    else {
        document.getElementByID('pass').style.color = 'red';
        document.getElementByID('pass').innerHTML = 'Ritenta...';    
    }
}

function onBlurMail(event){
    console.log("blur mail");
    const email = form.email.value;
    console.log(email);
    if(email.indexOf("@") != (-1)){
        document.getElementByID('mail').style.color = 'green';
        document.getElementByID('mail').innerHTML = 'Ok!';
        mail_valIDa = true;
    }
    else{
        document.getElementByID('mail').style.color = 'red';
        document.getElementByID('mail').innerHTML = 'Ritenta...';
    }
}

const form = document.forms['signup'];
const user = document.querySelector('input[name="utente"]');
const conf_password = document.querySelector('input[name="confirm"]');
const mail = document.forms['signup']['email'];
user.addEventListener("blur",onBlurUsr);
conf_password.addEventListener("blur",onBlurPsw)
mail.addEventListener("blur",onBlurMail);
form.addEventListener('submit',valIDazione);
