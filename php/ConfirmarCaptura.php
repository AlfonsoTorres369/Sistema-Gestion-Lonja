<?php

$barco = 'barco_consulta';
$zona_captura = 'zona_captura_consulta';
$producto = 'producto_consulta';
$peso = 116;
$tamanio = 117;


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
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal">
                            <a class="nav-link" href="ConfirmarCaptura.php">Revisión</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="ConfirmarCaptura.php">Registrar admin.</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="InformacionAdmin.php">Información</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="PerfilAdmin.php" > Perfil</a>
                        </li>
                        <li class="nav-item">
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

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Barco">Barco:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/barco.png" class="img-input-decorator"></div>
                        <input name="barco" class="form-control input-decorator-radius-left" value="<?php echo $barco ?>" type="text">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Zona captura">Zona captura:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/location.png" class="img-input-decorator"></div>
                        <select name="zona_captura" class="form-control rounded-right">
                            <option disabled selected value> <?php echo $zona_captura ?> </option>
                            <option>Cantábrico</option>
                            <option>Atlántico</option>
                            <option>Mediterráneo</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Producto">Producto:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/pez.png" class="img-input-decorator"></div>
                        <input name="producto" class="form-control input-decorator-radius-left" value="<?php echo $producto ?>" type="text">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Peso">Peso:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right">Kg</div>
                        <input name="peso" class="form-control input-decorator-radius-left" value="<?php echo $peso ?>" type="number">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Tamaño">Tamaño:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right">cm</div>
                        <input name="tamanio" class="form-control input-decorator-radius-left" value="<?php echo $tamanio ?>" type="number">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Producto">Precio salida:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/dolar.png" class="img-input-decorator"></div>
                        <input name="precio_salida" class="form-control input-decorator-radius-left" placeholder="Precio salida" type="number">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Producto">Precio minimo:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/dolar.png" class="img-input-decorator"></div>
                        <input name="precio_minimo" class="form-control input-decorator-radius-left" placeholder="Precio minimo" type="number">
                    </div>
                </div>
            </div>

            <!-- BOTONES -->
            <div class="form-row">
                <div id="guardar" class="center form-boton submit-boton al-right" style="display: block;">
                    <div class="form-group col-md-12">
                        <button type="submit" name="confirmar" class="btn btn-primary">Confirmar</button>
                    </div>
                </div>
            </div>
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
