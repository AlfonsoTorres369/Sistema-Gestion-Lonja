<?php

//Conexion base de datos
session_start();
if (isset($_SESSION['ID_Admin']) == "") {
    header("Location: ../index.php");
}

include_once 'Conexion.php';
//Estrucutra captura 0 id lote, 1 barco, 2 zona, 3 producto, 4 peso, 5 tamaño 
$captura = $_GET['captura'];
//el ID_Lote tiene que ser el pasado desde la pagina Revision.php

if (isset($_POST['confirmar'])) {

    $barco = mysqli_real_escape_string($con, $_POST['barco']);
    $zona_captura = mysqli_real_escape_string($con, $_POST['zona_captura']);
    $producto = mysqli_real_escape_string($con, $_POST['producto']);
    $peso = mysqli_real_escape_string($con, $_POST['peso']);
    $tamanio = mysqli_real_escape_string($con, $_POST['tamanio']);
    $precio_salida = mysqli_real_escape_string($con, $_POST['precio_salida']);
    $precio_minimo = mysqli_real_escape_string($con, $_POST['precio_minimo']);
    $fecha = mysqli_real_escape_string($con, $_POST['fecha']);
    $id_lote=mysqli_real_escape_string($con, $_POST['id_lote']);
    $error=false;
    $lonja= mysqli_real_escape_string($con, $_POST['lonja']);
	if($lonja=="Santander"){
		$id_lonja=1;
	}else if($lonja=="Cádiz"){
		$id_lonja=2;
		}else if($lonja=="Cartagena"){
			$id_lonja=3;
			}
	if($precio_minimo>$precio_salida){
			$error=true;
			$precio_error="El precio minimo debe ser menor que el precio de salida";
		}
    //Insert en Subasta
	if(!$error){
		$sql_subasta = "INSERT INTO Subasta (fecha, actual, realizada,precio_actual, ID_Lonja, express_no) VALUES('" . $fecha . "', '0', '0', '".$precio_salida."', '".$id_lonja."', '0')";
		$result1 = mysqli_query($con, $sql_subasta);
		if (false == $result1) {
			printf("errorA: %s\n", mysqli_error($con));
		}
		
		$sql_ID="SELECT MAX(ID_Subasta) FROM Subasta";
		$res=mysqli_query($con,$sql_ID);
		if(false==$res){
			printf("errorB: %s\n", mysqli_error($con));
			
		}
		$id_Subasta=mysqli_fetch_assoc($res);
		//Update en Lote
		$sql_lote="UPDATE Lote SET peso = '" . $peso . "', tamanio = '" . $tamanio . "', precio_salida = '" . $precio_salida . "', precio_minimo = '" . $precio_minimo . "', ID_Admin = '" . $_SESSION['ID_Admin'] ."', ID_Subasta='".$id_Subasta["MAX(ID_Subasta)"]."' 
		WHERE ID_Lote = '".$id_lote."'";
		$result2 = mysqli_query($con,$sql_lote);
		if (false == $result2) {
			printf("errorC: %s\n", mysqli_error($con));
			
		}

		$successmsg = '
			<div class="alert alert-success alert-dismissable fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>EXITO.!</strong> Captura guardada exitosamente!
			</div>';
		echo $successmsg;

		header("Location: Revision.php");
	}else{
		header('Location:' . getenv('HTTP_REFERER'));
	}
}


?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página de confirmación de captura Aquabid">
    <meta name="author" content="Miguel Ángel Pérez, Eric Romero, Alberto Sastre, Alfonso Torres">

    <title>AQUABID</title>

    <link rel="shortcut icon" href="../images/Aquabid.png">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- JavaScript -->
    <script language="javascript" type="text/javascript" src="../js/Captura.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">
    <link href="../css/lonja.css" rel="stylesheet">
    <link href="../css/RegistroCliente.css" rel="stylesheet">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-imgupload.css" rel="stylesheet">

</head>

<body id="bprincipal ">
    <!-- Navigation -->
   <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top nnavbar">
            <div class="container">
                <a class="navbar-brand" href="principalAdmin.php"><img src="../images/Aquabid.png" width="55px"></a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal ">
                            <a class="nav-link" href="principalAdmin.php">Home</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Revision.php">Revisión</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="RegistroAdmin.php">Registrar admin.</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal">
                            <a class="nav-link" href="InformacionAdmin.php">Información</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="PerfilAdmin.php"> Perfil</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="logout-admin.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content -->
    <br>
    <br>
    <div id="formularioCliente" class="shadow-lg container">
        <br>
        <h1 class="text-center">Confirmación de captura</h1>
        <p id="aviso">
            <font color="red"><strong>TODOS</strong></font> los campos son obligatorios
        </p>

        <form name="captura" enctype="multipart/form-data" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Barco">Barco:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/barco.png" class="img-input-decorator"></div>
                        <output name="barco" class="form-control input-decorator-radius-left"><?php echo $captura[1] ?></output>
                    </div>
                </div>
            </div>
            <div class="form-row">
               <div class="form-group col-md-12">
                    <label for="Zona captura">Lonja:</label>
                    <div class="input-group-prepend">
					<div class="input-group-text input-decorator-radius-right"><img src="../images/Lonja.png" class="img-input-decorator"></div>
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
                <div class="form-group col-md-12">
                    <label for="Zona captura">Zona captura:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/location.png" class="img-input-decorator"></div>
                        <output name="zona_captura" class="form-control input-decorator-radius-left"><?php echo $captura[2] ?></output>
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Producto">Producto:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/pez.png" class="img-input-decorator"></div>
                        <output name="producto" class="form-control input-decorator-radius-left"><?php echo $captura[3] ?></output>
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Peso">Peso:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right">Kg</div>
                        <input name="peso" class="form-control input-decorator-radius-left" value="<?php echo $captura[4]; ?>" type="number">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Tamaño">Tamaño:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right">cm</div>
                        <input name="tamanio" class="form-control input-decorator-radius-left" value="<?php echo $captura[5] ?>" type="number">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="PrecioSalida">Precio salida:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/dolar.png" class="img-input-decorator"></div>
                        <input name="precio_salida" class="form-control input-decorator-radius-left" placeholder="Precio salida" type="number">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="PrecioMinimo">Precio minimo:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/dolar.png" class="img-input-decorator"></div>
                        <input name="precio_minimo" class="form-control input-decorator-radius-left" placeholder="Precio minimo" type="number">
                    </div>
						<span class="text-danger"> <?php if (isset($precio_error)) echo $precio_error;?></span>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Fecha">Fecha:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/calendario.png" class="img-input-decorator"></div>
                        <input name="fecha" class="form-control input-decorator-radius-left" type="datetime-local">
                    </div>
                </div>
            </div>

            <!-- BOTONES -->
            <div class="form-row">
                <div id="confirmar" class="center form-boton submit-boton al-right" style="display: block;">
                    <div class="form-group col-md-12">
                        <button type="submit" name="confirmar" class="btn btn-primary">Confirmar</button>
                    </div>
                </div>
            </div>
            <input type="number" value="<?php echo $captura[0]?>" name="id_lote" style="visibility:hidden">
            </fieldset>
        </form>
    </div>

    <!-- /.container -->

    <!-- Footer -->
    <footer class="npadding bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Aquabid 2019</p>
        </div>
        <!-- /.container -->
    </footer>

    <script src="//code.jquery.com/jquery-1.12.2.min.js"></script>
    <script src="js/bootstrap-imgupload.js"></script>
    <script $('.img-upload').imgupload();></script>
</body>

</html>
