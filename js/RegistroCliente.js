var proceso;

function BotonPulsable(){
    var boton = document.getElementById("BotonRegistro");
    var nombrec = document.forms["registrocliente"]["nombreC"].value;
    var apellidos = document.forms["registrocliente"]["apellidos"].value;
    var usuario = document.forms["registrocliente"]["usuario"].value;
    var telefonoc = document.forms["registrocliente"]["telefonoC"].value;
    var email = document.forms["registrocliente"]["email"].value;
    var password = document.forms["registrocliente"]["password"].value;
    var nombreE = document.forms["registrocliente"]["nombreE"].value;
    var cip = document.forms["registrocliente"]["cip"].value;
    var direccion = document.forms["registrocliente"]["direccion"].value;
    var telefonoE = document.forms["registrocliente"]["telefonoE"].value;
    
    if(nombrec == "" || apellidos == "" || usuario == "" || telefonoc == ""
      || email == "" || password == "" || nombreE == "" || cip == "" 
      || direccion == "" || telefonoE == ""){
        boton.disabled = true;
    }
    else{
        boton.disabled = false;
    }
    
    proceso=setInterval(BotonPulsable, 1000);
}

