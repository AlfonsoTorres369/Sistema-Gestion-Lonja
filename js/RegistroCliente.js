var proceso;

function BotonPulsable(){
    var boton = document.getElementById("BotonRegistro");
    var nombrec = document.forms["registrocliente"]["nombreC"].value;
    var apellidos = document.forms["registrocliente"]["apellidos"].value;
    var usuario = document.forms["registrocliente"]["usuario"].value;
    var telefonoc = document.forms["registrocliente"]["telefonoC"].value;
    var email = document.forms["registrocliente"]["email"].value;
    var pass1 = document.forms["registrocliente"]["password"].value;
    var pass2 = document.forms["registrocliente"]["password2"].value;
    var nombreE = document.forms["registrocliente"]["nombreE"].value;
    var cip = document.forms["registrocliente"]["cip"].value;
    var direccion = document.forms["registrocliente"]["direccion"].value;
    var telefonoE = document.forms["registrocliente"]["telefonoE"].value;
    
    boton.disabled = true;
    
    if(pass1 == pass2 && pass1 != "" && pass2 != ""){
        message.style.display = 'none';
        passOK = true;
    }
    else{
        message.style.display = 'block';
        passOK = false;   
    }
    
    if((nombrec != "" && apellidos != "" && usuario !="" && telefonoc != "" && email != "" && nombreE != "" && cip != "" && direccion != "" && telefonoE != "") && passOK){
        boton.disabled = false;
    }
    else{
        boton.disabled = true;
    }
    proceso=setInterval(BotonPulsable, 1000);
}

