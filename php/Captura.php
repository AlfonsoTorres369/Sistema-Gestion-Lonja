<?php

include_once 'Conexion.php';
if (isset($_POST['guardar'])) {
    $barco = mysqli_real_escape_string($con, $_POST['barco']);
    $zona_captura = mysqli_real_escape_string($con, $_POST['zona_captura']);
    $producto = mysqli_real_escape_string($con, $_POST['producto']);
    $peso = mysqli_real_escape_string($con, $_POST['peso']);
    $tamanio = mysqli_real_escape_string($con, $_POST['tamanio']);
    $archivo = $_FILES['file-input']['tmp_name'];
    $size = $_FILES['file-input']['size'];
    if ($archivo != "none") {
        $fp = fopen($archivo, "r");
        $contenido = fread($fp, $size);
        $contenido = addslashes($contenido);
        fclose($fp);
    }


    $sql = "INSERT INTO Lote (barco, zona_captura, producto, peso, tamanio, imagen, subastado) VALUES('" . $barco . "', '" . $zona_captura . "', '" . $producto . "', '" . $peso . "', '" . $tamanio . "', '" . $contenido . "', '0')";

    $sql = mysqli_query($con, $sql);
    if (false == $sql) {
        printf("error: %s\n", mysqli_error($con));
    }
    $successmsg = '
        <div class="alert alert-success alert-dismissable fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>EXITO.!</strong> Captura guardada exitosamente!
        </div>';
    echo $successmsg;
    header("Location: Principal.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página principal de Aquabid">
    <meta name="author" content="Miguel Ángel Pérez, Eric Romero, Alberto Sastre, Alfonso Torres">

    <title>Captura</title>

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
    <link rel="stylesheet" href="bootstrap.min.css">
    <link href="css/bootstrap-imgupload.css" rel="stylesheet">

</head>

<body id="bprincipal ">
    <!-- Navigation -->

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top nnavbar">
            <div class="container">
                <a class="navbar-brand" href="Principal.php"><img src="../images/Aquabid.png" width="55px"></a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Principal.php">Home</a>
                        </li>
                        <li class="nav-item-principal active">
                            <a class="nav-link" href="Captura.php">Captura</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Subastas.php">Subastas</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="SubastasExpress.php">Subastas Express</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Cesta.php">Cesta</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal">
                            <a class="nav-link" href="InformacionCliente.php">Info</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="PerfilCliente.php">Perfil</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="logout-cliente.php">Cerrar Sesión</a>
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
        <h1 class="text-center">Captura</h1>
        <p id="aviso">
            <font color="red"><strong>TODOS</strong></font> los campos son obligatorios
        </p>

        <form name="captura" enctype="multipart/form-data" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Barco">Barco:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/barco.png" class="img-input-decorator"></div>
                        <input name="barco" class="form-control input-decorator-radius-left" placeholder="Barco" type="text">
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="Zona captura">Zona captura:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/location.png" class="img-input-decorator"></div>
                        <select name="zona_captura" class="form-control rounded-right">
                            <option disabled selected value> Zona captura </option>
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
                        <input name="producto" class="form-control input-decorator-radius-left" placeholder="Producto" type="text">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Peso">Peso:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right">Kg</div>
                        <input name="peso" class="form-control input-decorator-radius-left" placeholder="Peso" type="number">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Tamaño">Tamaño:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right">cm</div>
                        <input name="tamanio" class="form-control input-decorator-radius-left" placeholder="Tamaño" type="number">
                    </div>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-12">
                    <label for="Tamaño">Imagen:</label>
                    <div class="input-group-prepend">
                        <div class="input-group-text input-decorator-radius-right"><img src="../images/carpeta.png" class="img-input-decorator"></div>
                        <div class="custom-file">
                            <input type="file" class="form-control input-decorator-radius-left" id="imagen" name="file-input">
                        </div>
                    </div>
                </div>
            </div>

            <!-- BOTONES -->
            <div class="form-row">
                <div id="guardar" class="center form-boton submit-boton al-right" style="display: block;">
                    <div class="form-group col-md-12">
                        <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
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