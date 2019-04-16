<?php

//Conexion base de datos

/*
include_once 'Conexion.php';

$sql = 'SELECT barco, zona_captura, producto, tamaño, peso, precio_salida, precio_minimo, imagen FROM lote';

$result = mysqli_query($con, $sql);

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $barco[] = $row["barco"];
        $zona_captura[] = $row["zona_captura"];
        $producto[] = $row["producto"];
        $tamaño[] = $row["tamaño"];
        $peso[] = $row["peso"];
        $precio_salida[] = $row["precio_salida"];
        $precio_minimo[] = $row["precio_minimo"];
        $imagen[] = $row["imagen"];
    }
} 
*/

$sin_subastas = '<p>No hay subastas disponibles en estos momentos.</p>';

//Codigo de prueba
$num_rows = 3;
$barco = array('barco1', 'barco2', 'barco3');
$zona_captura = array('zona_captura1', 'zona_captura2', 'zona_captura3');
$producto = array('producto1', 'producto2', 'producto3');
$tamaño = array('tamaño1', 'tamaño2', 'tamaño3');
$peso = array('peso1', 'peso2', 'peso3');
$precio_salida = array('precio_salida1', 'precio_salida2', 'precio_salida3');
$precio_minimo = 'precio_minimo';
$imagen = array('../images/captura.jpg', '../images/lonja.jpg', '../images/oceano.jpg');

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página principal de Aquabid">
    <meta name="author" content="Miguel Ángel Pérez, Eric Romero, Alberto Sastre, Alfonso Torres">

    <title>Subastas</title>

    <link rel="shortcut icon" href="../images/Aquabid.png">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- JavaScript -->
    <script language="javascript" type="text/javascript" src="../js/Captura.js"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">
    <link href="../css/lonja.css" rel="stylesheet">
    <link href="../css/RegistroCliente.css" rel="stylesheet">


</head>

<body>
    <!-- Navigation -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top nnavbar">
            <div class="container">
                <a class="navbar-brand" href="Principal.php"><img src="../images/Aquabid.png" width="55px"></a>
                <div class="collapse navbar-collapse" id="navbarResponsive">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Principal.php">Home</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Captura.php">Captura</a>
                        </li>
                        <li class="nav-item-principal active">
                            <a class="nav-link" href="Subastas.php">Subastas</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="#">Subastas Express</a>
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
        <h1 class="text-center">Subastas</h1>

        <?php

        //Falta poner el link personalizado que diriga a la pagina donde se realizará la subasta de cada lote
        if ($num_rows > 0) {
            for ($x = 0; $x < $num_rows; $x++) {
                echo '<div class="col-md-12 mb-5">
                <a href="ProcesoSubasta.php" class="shadow-lg card h-100">
                    <div class="d-flex flex-row">
                        <div style="width: 50%">
                            <img style="width: 100%; height: 100%" src=' . $imagen[$x] . ' alt="Foto del lote">
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <label for="barco">Barco:</label>
                                <p class="list-inline-item">' . $barco[$x] . '</p>
                            </div>
                            <div class="col-md-12">
                                <label for="producto">Producto:</label>
                                <p class="list-inline-item">' . $producto[$x] . '</p>
                            </div>
                            <div class="col-md-12">
                                <label for="tamaño">Tamaño:</label>
                                <p class="list-inline-item">' . $tamaño[$x] . '</p>
                            </div>
                            <div class="col-md-12">
                                <label for="peso">Peso:</label>
                                <p class="list-inline-item">' . $peso[$x] . '</p>
                            </div>
                            <div class="col-md-12">
                                <label for="precioSalida">Precio salida:</label>
                                <p class="list-inline-item">' . $precio_salida[$x] . '</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>';
            }
        } else {
            echo $sin_subastas;
        }
        ?>


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