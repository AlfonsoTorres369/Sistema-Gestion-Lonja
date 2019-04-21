<?php 
session_start();

if(isset($_SESSION['ID_Cliente'])){
    header("Location:principal.php");
}
include_once 'Conexion.php';

//Error validacion
$error=false;


//Variables
if(isset($_POST['signup'])){
    $contrasenia=mysqli_real_escape_string($con, $_POST['contrasenia']);
    $conContrasenia=mysqli_real_escape_string($con, $_POST['conContrasenia']);
    $email=mysqli_real_escape_string($con, $_POST['email']);
    
    $confemail=mysqli_query($con, "SELECT email FROM Cliente WHERE email='".$email."'");
    if($confemail==true){
        $row=mysqli_fetch_array($confemail);
        if($row['email']!=$email){
            $error=true;
            $confemail_error="No se encuentra el email introducido.";
        }
    }
    else{
        printf("error: %s\n", mysqli_error($con));
    }


//Comprobacion contraseña
if(strlen($contrasenia)< 6){
    $error=true;
    $contrasenia_error="La contraseña debe comprender entre 6 y 30 caracteres";
}
else if(strlen($contrasenia)>30){
    $error=true;
    $contrasenia_error2="La contraseña supera los 30 caracteres";

}
//Comprobacion coincidencia de contraseñas
if($contrasenia!=$conContrasenia){
	$error=true;
	$conContrasenia_error="Las contraseñas deben de coincidir";
}

if(!$error){
	$sql=mysqli_query($con, "UPDATE Cliente SET contrasenia='".$contrasenia."' WHERE email='".$email."'");
    if(false==$sql){
		printf("error: %s\n", mysqli_error($con));
	}    
        
    $successmsg= '
             <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>EXITO.!</strong> ¡Contaseña cambiada con éxtio!
              </div>
              ';
         echo $successmsg;
        header("Location:../index.php");
}else {
            $errormsg = '
            <div class="alert alert-danger alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error de cambio de contraseña!</strong> Verifica tus datos.
            </div>
            ';
            echo $errormsg;
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/RegistroCliente.css">
    <link rel="stylesheet" href="../css/lonja.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">
    <script src="../js/RegistroCliente.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Registro</title>
    <link rel="shortcut icon" href="../images/Aquabid.png">
</head>

    
    <body onload="BotonPulsable()" id="bprincipal">
        
        <div id="formularioCliente" class="shadow-lg container">
        <br>
        <h1 class="text-center">Recuperar Contraseña</h1>
        <p id="aviso">
            <font color="red"><strong>TODOS</strong></font> los campos son obligatorios.<br>
            Por favor, introduzca el correo electrónico de la cuenta a la que quiere cambiar la contraseña e introduzca la nueva contraseña.
        </p>
        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="registrocliente" onsubmit="return Registro()" method="post">
            <fieldset>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nombreC">Dirección de email:</label>
                    <input type="text" class="form-control" placeholder="Email" name="email" required value="<?php if($error) echo $email;?>">
                    <span class="text-danger"><?php if (isset($confemail_error)) echo $confemail_error;?> </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" placeholder="Contraseña" name="contrasenia"required value="<?php if ($error) echo $contrasenia ?>">
                    <span class="text-danger"> <?php if (isset($contrasenia_error)){ echo $contrasenia_error;} else if(isset($contrasenia_error2)){echo $contrasenia_error2;}?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password2">Contraseña:</label>
                    <input type="password" class="form-control" id="password2" placeholder="Repite la contraseña" name="conContrasenia" required value="<?php if($error) echo $conContrasenia ?>">
                    <span class="text-danger"><?php if (isset($conContrasenia_error)) echo $conContrasenia_error; ?></span>
                </div>
            </div>
            <br>
            <div class="form-boton">
                <button input type="submit"
                    class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
                    id="BotonRegistro" name="signup">Cambiar</button>
            </div>
            </fieldset>
        </form>
    </div>
    <!-- Footer -->
    <footer class="npadding bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Aquabid 2019</p>
        </div>
        <!-- /.container -->
    </footer>

</body>

</html>