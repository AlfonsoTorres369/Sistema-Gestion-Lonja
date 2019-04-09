function ReestablecerPass(){
    
    var boton = document.getElementById("BotonReestablecer");
    var nombrec = document.forms["recuperarpass"]["email"].value;
    
    if(email == "")
    {
       window.alert("Por favor, introduzca un email.")
    }
    else
        {
            location.href="../html/RecuperarContraseña-Pass.html";
        }
}