var proceso;

function BotonPulsablePass(){
    var boton = document.getElementById("BotonRegistro");
    var nombrec = document.forms["registrocliente"]["nombreC"].value;
    var apellidos = document.forms["registrocliente"]["apellidos"].value;
    var usuario = document.forms["registrocliente"]["usuario"].value;
    var telefonoc = document.forms["registrocliente"]["telefonoC"].value;
    var email = document.forms["registrocliente"]["email"].value;
    var pass1 = document.forms["registrocliente"]["password"].value;
    var pass2 = document.forms["registrocliente"]["password2"].value;
    var message = document.getElementById("message");
    var passOK = false;
    
    boton.disabled = true;
    
    if(pass1 == pass2 && pass1 != "" && pass2 != ""){
        message.style.display = 'none';
        passOK = true;
    }
    else{
        message.style.display = 'block';
        passOK = false;   
    }
    
    if((nombrec != "" && apellidos != "" && usuario !="" && telefonoc != "" && email != "") && passOK){
        boton.disabled = false;
    }
    else{
        boton.disabled = true;
    }
    
    
    proceso=setInterval(BotonPulsablePass, 1000);
}