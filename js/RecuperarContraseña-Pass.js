var proceso;

function BotonPulsablePass(){
    var boton = document.getElementById("BotonRecuperar");
    var pass1 = document.forms["recuperarpass"]["pass"].value;
    var pass2 = document.forms["recuperarpass"]["pass2"].value;
    var message = document.getElementById("message");
    
    boton.disabled = true;
    
    if(pass1 == pass2 && pass1 != "" && pass2 != ""){
        boton.disabled = false;
        message.style.display = 'none';
    }
    else{
        boton.disabled = true;
        message.style.display = 'block';
    }
    
    proceso=setInterval(BotonPulsablePass, 1000);
}