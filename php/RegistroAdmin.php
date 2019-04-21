<?php

session_start();

include_once 'Conexion.php';

//Error validacion
$error = false;

//Variables
if (isset($_POST['signup'])) {
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($con, $_POST['apellidos']);
    $telefonoc = mysqli_real_escape_string($con, $_POST['telefonoc']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $contrasenia = mysqli_real_escape_string($con, $_POST['contrasenia']);
    $conContrasenia = mysqli_real_escape_string($con, $_POST['conContrasenia']);

    //Comprobaciones
    if (!preg_match("/^[a-zA-z ]+$/", $nombre)) {
        $error = true;
        $nombre_error = "El nombre debe contener solo caracteres del alfabeto y espacio";
    }

    if (!preg_match("/^[a-zA-z ]+$/", $apellidos)) {
        $error = true;
        $apellidos_error = "El apellido debe contener solo caracteres del alfabeto y espacio";
    }

    if (!preg_match("/^[0-9]{9}$/", $telefonoc)) {
        $error = true;
        $telefonoc_error = "No es una cadena de 9 números";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Ingresa un correo electrónico válido";
    }

if(strlen($contrasenia)< 6){
    $error=true;
    $contrasenia_error="La contraseña debe comprender entre 6 y 30 caracteres";
}
else if(strlen($contrasenia)>30){
    $error=true;
    $contrasenia_error2="La contraseña supera los 30 caracteres";
}

    //Comprobacion coincidencia de contraseñas
    if ($contrasenia != $conContrasenia) {
        $error = true;
        $error_conContrasenia = "Las contraseñas deben de coincidir";
    }

//Comprobacion coincidencia de contraseñas
if($contrasenia!=$conContrasenia){
	$error=true;
	$conContrasenia_error="Las contraseñas deben de coincidir";
}
    
if(!$error){
	$sql=mysqli_query($con, "INSERT INTO Administrador (ID_Admin, nombre,apellidos,telefono,email,contrasenia) VALUES(NULL, '".$nombre."', '".$apellidos."', '".$telefonoc."', '".$email."', '".$contrasenia."')");
    if(false==$sql){
		printf("error: %s\n", mysqli_error($con));
	}
    mail($email,"Registro","El registro a la lonja online Aquabid se ha realizado con éxito. Usted es un nuevo administrador. Aquí tiene los datos de su cuenta:
    Usuario:".$nombre."
    Contraseña:".$contrasenia."
    Web: localhost/Sistema-Gestion-Lonja/index.php");

        $successmsg = '
             <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>EXITO.!</strong> ¡Registrado exitosamente!
              </div>
              ';
        echo $successmsg;
        header("Location: principalAdmin.php");
    } else {
        $errormsg = '
            <div class="alert alert-danger alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error de registro.!</strong> Verifica tus datos.
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
    <script src="../js/RegistroAdmin.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Registro</title>
    <link rel="shortcut icon" href="../images/Aquabid.png">
</head>


<body onload="BotonPulsablePass()" id="bprincipal">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top nnavbar">
            <div class="container">
                <a class="navbar-brand" href="principalAdmin.php"><img src="../images/Aquabid.png" width="55px"></a>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Revision.php">Revisión</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link active" href="RegistroAdmin.php">Registrar admin.</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="InformacionAdmin.php">Información</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="PerfilAdmin.php"> Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout-admin.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <br>
    <br>
    <div id="formularioCliente" class="shadow-lg container">
        <br>
        <h1 class="text-center">Registro de Supervisor</h1>
        <p id="aviso">
            <font color="red"><strong>TODOS</strong></font> los campos son obligatorios
        </p>
        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="registrocliente" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreC">Nombre del supervisor:</label>
                    <input type="text" class="form-control" placeholder="Nombre del supervisor" name="nombre" required value="<?php if ($error) echo $nombre; ?>">
                    <span class="text-danger"><?php if (isset($nombre_error)) echo $nombre_error; ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" placeholder="Apellidos" id="apellidos" name="apellidos" required value="<?php if ($error) echo $apellidos ?>">
                    <span class="text-danger"><?php if (isset($apellidos_error)) echo $apellidos_error; ?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="telefonoC">Teléfono:</label>
                    <input type="number" maxlength="9" class="form-control" placeholder="Teléfono del cliente" id="telefonoC" name="telefonoc" required value="<?php if ($error) echo $telefonoc ?>">
                    <span class="text-danger"><?php if (isset($telefonoc_error)) echo $telefonoc_error; ?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="email">Dirección de email:</label>
                    <input type="email" class="form-control" placeholder="Dirección de email" id="email" name="email" required value="<?php if ($error) echo $email ?>">
                    <span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" id="password" placeholder="Contraseña" name="contrasenia" required value="<?php if ($error) echo $contrasenia ?>">
                    <span class="text-danger"><?php if (isset($contrasenia_error)) {
                                                    echo $contrasenia_error;
                                                } else if (isset($contrasenia_error2)) {
                                                    echo $contrasenia_error2;
                                                } ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="password2">Contraseña:</label>
                    <input type="password" class="form-control" id="password2" placeholder="Repite la contraseña" name="conContrasenia">
                    <span class="text-danger"><?php if (isset($conContrasenia_error)) echo $conContrasenia_error; ?></span>
                </div>
            </div>
            <br>

            <div class="form-boton">
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" id="BotonRegistro" name="signup">Registrarse</button>
            </div>
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