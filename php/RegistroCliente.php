<?php 
session_start();

if(isset($_SESSION['ID_Cliente'])){
    header("Location:Principal.php");
}
include_once 'Conexion.php';

//Error validacion
$error=false;


//Variables
if(isset($_POST['signup'])){
    $nombre= mysqli_real_escape_string($con, $_POST['nombre']);
    $apellidos=mysqli_real_escape_string($con, $_POST['apellidos']);
    $telefonoc=mysqli_real_escape_string($con, $_POST['telefonoc']);
    $usuario=mysqli_real_escape_string($con, $_POST['usuario']);
    $email=mysqli_real_escape_string($con, $_POST['email']);
    $contrasenia=mysqli_real_escape_string($con, $_POST['contrasenia']);
    $nombreE=mysqli_real_escape_string($con, $_POST['nombreE']);
    $direccionE=mysqli_real_escape_string($con, $_POST['direccionE']);
    $telefonoE=mysqli_real_escape_string($con, $_POST['telefonoE']);
    $cif=mysqli_real_escape_string($con, $_POST['cif']);
    $conContrasenia=mysqli_real_escape_string($con, $_POST['conContrasenia']);
    $cuentaBancaria=mysqli_real_escape_string($con, $_POST['cuentaBancaria']);
    $lonja= mysqli_real_escape_string($con, $_POST['lonja']);
if($lonja=="Santander"){
	$id_lonja=1;
}else if($lonja=="Cádiz"){
		$id_lonja=2;
	}else if($lonja=="Cartagena"){
			$id_lonja=3;
		}

//Comprobaciones nombre, apellidos, nombreE, direccionE
if(!preg_match("/^[a-zA-Z ]+$/",$nombre)){
    $error=true;
    $nombre_error="El nombre debe contener solo caracteres del alfabeto y espacio";
}

if(!preg_match("/^[a-zA-Z ]+$/",$apellidos)){
    $error=true;
    $apellidos_error="El apellido debe contener solo caracteres del alfabeto y espacio";
}

//Comprobacion telefonos
if(!preg_match("/^[0-9]{9}$/",$telefonoc)){
    $error=true;
    $telefonoc_error="No es una cadena de 9 números";
}


if(!preg_match("/^[0-9]{9}$/",$telefonoE)){
    $error=true;
    $telefonoE_error="No es una cadena de 9 números";
    }
//Colocar comprobacion de email unico tras cambio en las tablas
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	$error=true;
	$email_error="Ingresa un correo electrónico válido";
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

//Comprobacion cif
if(!preg_match("/^[A-W]{1}[0-9]{8}$/",$cif)){
    $error=true;
    $cif_error="El CIF introducido es incorrecto";
}
//Comprobaciion cuenta bancaria
if(strlen($cuentaBancaria)!=20){
	$error=true;
	$cuentaBancaria_error="El numero de cuenta bancaria es erróneo";
}
if(!$error){
	$sql=mysqli_query($con, "INSERT INTO Cliente (ID_Cliente, nombre,apellidos,telefono,usuario,email,contrasenia, nombreE, direccionE,telefonoE,cif,cuentaBancaria, ID_Lonja) VALUES(NULL, '".$nombre."', '".$apellidos."', '".$telefonoc."', '".$usuario."', '".$email."', '".$contrasenia."', '".$nombreE."', '".$direccionE."', '".$telefonoE."', '".$cif."','".$cuentaBancaria."', '".$id_lonja."')");
    if(false==$sql){
		printf("error: %s\n", mysqli_error($con));
	}
    mail($email,"Registro","El registro a la lonja online Aquabid se ha realizado con éxito. Web: https://localhost/Sistema-Gestion-Lonja/index.php");
    $sql_ID="SELECT MAX(ID_Cliente) FROM Cliente";
	$res=mysqli_query($con,$sql_ID);
	if(false==$res){
		printf("errorB: %s\n", mysqli_error($con));	
	}
	
	$fecha=date("Y-m-d");
	$id_Cliente=mysqli_fetch_assoc($res);
	$sql2=mysqli_query($con, "INSERT INTO Descuentos (ID_Cliente, num_desc, fecha_ult_comp) VALUES ('".$id_Cliente["MAX(ID_Cliente)"]."',0 , '".$fecha."' )");
    if(false==$sql2){
		printf("errorB: %s\n", mysqli_error($con));	
	}
    $successmsg= '
             <div class="alert alert-success alert-dismissable fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>EXITO.!</strong> ¡Registrado exitosamente!
              </div>
              ';
         echo $successmsg;
         header("Location: ../index.php");

}else {
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
    <script src="../js/RegistroCliente.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Registro</title>
    <link rel="shortcut icon" href="../images/Aquabid.png">
</head>

    
    <body onload="BotonPulsable()" id="bprincipal">
        
        <div id="formularioCliente" class="shadow-lg container">
        <br>
        <h1 class="text-center">Registro de Cliente</h1>
        <p id="aviso">
            <font color="red"><strong>TODOS</strong></font> los campos son obligatorios
        </p>
        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="registrocliente" onsubmit="return Registro()" method="post">
            <fieldset>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreC">Nombre del cliente:</label>
                    <input type="text" class="form-control" placeholder="Nombre del cliente" name="nombre" required value="<?php if($error) echo $nombre;?>">
                    <span class="text-danger"><?php if (isset($nombre_error)) echo $nombre_error;?> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" placeholder="Apellidos" id="apellidos" name="apellidos" required value="<?php if($error) echo $apellidos;?>">
                    <span class="text-danger"> <?php if (isset($apellidos_error)) echo $apellidos_error;?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="usuario">Usuario:</label>
                    <input type="text" class="form-control" placeholder="Usuario" id="usuario" name="usuario">
                </div>
                <div class="form-group col-md-6">
                    <label for="telefonoC">Teléfono:</label>
                    <input type="text" class="form-control" placeholder="Teléfono del cliente"
                     id="telefonoC" name="telefonoc"required value="<?php if($error) echo $telefonoc?>" >
                    <span class="text-danger"> <?php if (isset($telefonoc_error)) echo $telefonoc_error;?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">Dirección de email:</label>
                    <input type="email" class="form-control" placeholder="Dirección de email" id="email" name="email" required value="<?php if ($error) echo $email ?>">
                    <span class="text-danger"> <?php if (isset($email_error)) echo $email_error;?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Zona captura">Lonja:</label>
                    <div class="input-group-prepend">
                        <select name="lonja" class="form-control rounded-right">
                            <option disabled selected value> Seleccione una opción </option>
                            <option>Santander</option>
                            <option>Cádiz</option>
                            <option>Cartagena</option>
                        </select>
                    </div>
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
            <h1 class="text-center">Datos de la Empresa</h1>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreE">Nombre:</label>
                    <input type="text" class="form-control" placeholder="Nombre de la empresa" id="nombreE" name="nombreE">
                </div>
                <div class="form-group col-md-6">
                    <label for="cip">CIF:</label>
                    <input type="text" max="9" class="form-control" placeholder="CIF" id="cip" name="cif" required value="<?php if($error) echo $cif ?>">
                    <span class="text-danger"> <?php if (isset($cif_error)) echo $cif_error;?></span>
                </div>
            </div>
            <div id="ultimoscampos" class="form-row">
                <div class="form-group col-md-6">
                    <label for="direccion">Dirección:</label>
                    <input type="adress" class="form-control" placeholder="Dirección" id="direccion" name="direccionE">
                </div>
                <div class="form-group col-md-6">
                    <label for="telefonoE">Teléfono:</label>
                    <input type="text" class="form-control" placeholder="Teléfono de la empresa"
                     id="telefonoE" name="telefonoE"required value="<?php if($error) echo $telefonoE ?>" >
                    <span class="text-danger"> <?php if (isset($telefonoE_error)) echo $telefonoE_error;?></span>
                </div>
                <div class="form-group col-md-12">
					<label for="cuentaB"> Cuenta Bancaria:</label>
					<input type="text" class="form-control" placeholder="Cuenta Bancaria" name="cuentaBancaria">
					<span class="text-danger"> <?php if (isset($cuentaBancaria_error)) echo $cuentaBancaria_error;?></span>
                </div>
            </div>
            <div class="form-boton">
                <button input type="submit"
                    class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2"
                    id="BotonRegistro" name="signup">Registrarse</button>
            </div>
            </fieldset>
        </form>
        <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
        <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
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
