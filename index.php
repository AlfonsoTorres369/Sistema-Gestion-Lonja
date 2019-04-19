<?php 
    session_start();
    if(isset($_SESSION['ID_Cliente'])!=""){
        header("Location:php/principal.php");
    }
    include_once 'php/Conexion.php';

//Comprobar de envio al formulario

    if(isset($_POST['login'])){
        
        $email=mysqli_real_escape_string($con, $_POST['email']);
        $contrasenia=mysqli_real_escape_string($con, $_POST['contrasenia']);
        $result=mysqli_query($con, "SELECT * FROM Cliente WHERE email= '" .$email."' AND contrasenia ='" .$contrasenia. "'");
		$result2=mysqli_query($con,"SELECT * FROM Administrador WHERE email='".$email."' AND contrasenia='".$contrasenia."'");
        if($row=mysqli_fetch_array($result)) {
            $_SESSION['ID_Cliente']=$row['ID_Cliente'];
            $_SESSION['usuario']=$row['usuario'];        
            header("Location:php/principal.php");
        }
        else if($row=mysqli_fetch_array($result2)){
				$_SESSION['ID_Admin']=$row['ID_Admin'];
				$_SESSION['nombre']=$row['nombre'];
				//header("Location:php/principal.php");
			}
			else {
				$errormsg="El email o contraseña no han sido introducidos correctamente";    
			}
    }
   
?>
<!DOCTYPE html>
<html lang="es">
  <head>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet"> 
	<link href="css/login.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="shortcut icon" type="image/png" href="images/Aquabid.png">
</head>

<body>
	<div id="formularioLogin" class="shadow-lg container">
		<img id="logoAquabid" class="img-fluid mx-auto d-block" src="images/Aquabid.png">
		<img id="subLogoAquabid" class="img-fluid mx-auto d-block" src="images/Aquabid sub.png">
	      <div class="login align-items-center py-1">
	        <div class="container">
	          <div class="row">
	            <div class="col-md-11 col-lg-11 mx-auto">
	              <form role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="loginform">
					<fieldset>
	              	<div class="row">
	              		<div class="form-group col-md-6">
	              			<div class="form-label-group">
	                  			<label for="inputPassword">Dirección de email:</label>
	                  			<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Dirección de email" required autofocus>
	                		</div>
	                	</div>
	                	<div class="col-md-6">
	              			<div class="form-label-group">
	                  			<label for="inputPassword">Contraseña:</label>
	                  			<input type="password" id="inputPassword" name="contrasenia" class="form-control" placeholder="Contraseña" required>
	                		</div>
	                	</div>
					</div>   
	                <div class="custom-control custom-checkbox mb-3">
	                  <input type="checkbox" class="custom-control-input" id="customCheck1">
	                  <label class="custom-control-label" for="customCheck1">Recordar contraseña</label>
	                </div>
	                <div class="row">
	                	<button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" input type="submit" name="login">Iniciar Sesión</button>
	                	<a href="php/RegistroCliente.php" class="btn btn-lg btn-outline-primary btn-block btn-login text-uppercase font-weight-bold mb-2"> Registro </a>
	                </div>
	                <div class="text-center">
	                  <a class="small" href="html/RecuperarContraseña-Email.html">¿Ha olvidado su contraseña?</a>
	              </div>
	              </fieldset>
	            </form>
	            <span class="text-danger"><?php if(isset($errormsg)){echo $errormsg;} ?></span>
	          </div>
	        </div>
	      </div>
	    </div>
	</div>

	<footer class="npadding bg-dark">
	        <div class="container">
	            <p class="m-0 text-center text-white">Copyright &copy; Aquabid 2019</p>
	        </div>
	        <a class="small text-center" href="html/principal.html">Enlace de prueba a principal (solo para github)</a>
	</footer>

</body>
