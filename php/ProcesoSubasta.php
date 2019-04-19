<?php

//Conexion base de datos

/*
include_once 'Conexion.php';

*/

//Codigo de prueba, hay que igualar las variables al resultado de la consulta sql
$barco = 'barco';
$zona_captura = 'zona_captura';
$producto = 'producto';
$tamaño = 'tamaño';
$peso = 'peso';
$precio_salida = 99.9;
$precio_minimo = 'precio_minimo';
$imagen = '../images/captura.jpg';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página principal de Aquabid">
    <meta name="author" content="Miguel Ángel Pérez, Eric Romero, Alberto Sastre, Alfonso Torres">

    <title>AQUABID</title>

    <link rel="shortcut icon" href="../images/Aquabid.png">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- JavaScript -->
    <script language="javascript" type="text/javascript" src="../js/ProcesoSubasta.js"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">
    <link href="../css/lonja.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/RegistroCliente.css">

</head>

<body id="bprincipal ">
    <!-- Navigation -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top nnavbar">
            <div class="container">
                <a class="navbar-brand" href="Principal.php"><img src="../images/Aquabid.png" width="55px"></a>
                <div class="collapse navbar-collapse" id="navbarResponsive">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal ">
                            <a class="nav-link" href="Principal.php">Home</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Captura.php">Captura</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Subastas.php">Subastas</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="SubastasExpress.php">Subastas Express</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Informacion.php">Información</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Perfil.php">Perfil</a>
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
        <h1 class="text-center">Proceso Subasta</h1>
        <form name="procesoSubasta">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="text-right" >
                        <img class="rounded d-block" style="width: 100%; height: 100%" src="<?php echo $imagen ?>" alt="Foto del lote">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="barco">Barco:</label>
                    <output type="text" class="form-control" name="barco"><?php echo $barco; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="zonaCaptura">Zona captura:</label>
                    <output type="text" class="form-control" id="zonaCaptura"><?php echo $zona_captura; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="producto">Producto:</label>
                    <output type="text" class="form-control" id="producto"><?php echo $producto; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="tamaño">Tamaño:</label>
                    <output type="number" class="form-control" id="tamaño"><?php echo $tamaño; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="peso">Peso:</label>
                    <output type="text" class="form-control" id="peso"><?php echo $peso; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="precioSalida">Precio salida:</label>
                    <output type="text" class="form-control" id="precioSalida"><?php echo $precio_salida . "€"; ?></output>
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="output">
                        <p id="precio" class="text-center size-counter"><?php echo $precio_salida . "€"; ?></p>
                    </div>
                </div>
            </div>
        </form>
        <div class="form-boton">
            <button type="submit" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" id="botonComprar">COMPRAR</button>
        </div>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="npadding bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Aquabid 2019</p>
        </div>
        <!-- /.container -->
    </footer>

</body>

</html>