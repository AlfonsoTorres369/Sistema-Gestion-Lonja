<?php

//Conexion base de datos
    session_start();
    if(isset($_SESSION['ID_Cliente'])==""){
        header("Location:../index.php");
    }

include_once 'Conexion.php';

$sql = 'SELECT L. ID_Lote, L.barco, L.zona_captura, L.producto, L.tamanio, L.peso, L.precio_salida, L.precio_minimo, L.imagen, S.fecha, L.ID_Subasta
		FROM Lote L INNER JOIN Subasta S ON L.ID_Subasta=S.ID_Subasta INNER JOIN Cliente C ON C.ID_Lonja = S.ID_Lonja
		WHERE L.ID_Admin IS NOT NULL AND L.ID_Subasta IS NOT NULL AND S.realizada=1 AND S.actual=0 AND S.express_no=false AND L.ID_Cliente IS NULL AND C.ID_Cliente = ' . $_SESSION['ID_Cliente'] . '';

$result = mysqli_query($con, $sql);
    if (false == $result) {
        printf("error: %s\n", mysqli_error($con));
    }

$num_rows = mysqli_num_rows($result);

if ($num_rows > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        $barco[] = $row["barco"];
        $zona_captura[] = $row["zona_captura"];
        $producto[] = $row["producto"];
        $tamaño[] = $row["tamanio"];
        $peso[] = $row["peso"];
        $precio_salida[] = $row["precio_salida"];
        $precio_minimo[] = $row["precio_minimo"];
        $imagen[] = $row["imagen"];
        $lote[]=$row["ID_Lote"];
        $fecha[]=$row["fecha"];
        $ID_Subasta[]=$row["ID_Subasta"];
    }
} 


$sin_subastas = '<p>No hay subastas disponibles en estos momentos.</p>';

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página principal de Aquabid">
    <meta name="author" content="Miguel Ángel Pérez, Eric Romero, Alberto Sastre, Alfonso Torres">

    <title>Subastas Express</title>

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


</head>

<body>
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
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Captura.php">Captura</a>
                        </li>
                        <li class="nav-item-principal active">
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
        <h1 class="text-center">Subastas Express</h1>

        <?php
        //Falta poner el link personalizado que diriga a la pagina donde se realizará la subasta de cada lote
        if ($num_rows > 0) {
            for ($x = 0; $x < $num_rows; $x++) {
                
				//Estructura subasta 0: barco, 1: zona_captura, 2: producto, 3:tamaño, 4: peso, 5: precio_salida, 6: fecha, 7:ID_Lote, 8: ID_Subasta, 9:precio_minimo
                $subasta= array($barco[$x], $zona_captura[$x], $producto[$x], $tamaño[$x], $peso[$x], $precio_salida[$x], $fecha[$x], $lote[$x], $ID_Subasta[$x], $precio_minimo[$x]);
                
                echo '<div class="col-md-12 mb-5">
                <a href="ProcesoSubastaExpres.php?'. http_build_query(array('subasta' => $subasta)) .'" class="shadow-lg card h-100" id="tarjetaPrincipal">
                    <div class="d-flex flex-row">
                        <div style="width: 50%">
                            <img style="width: 100%; height: 100%" src="data:image/jpeg;base64,' .base64_encode( $imagen[$x]) . '" alt="Foto del lote">
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
                                <p class="list-inline-item">' . $tamaño[$x] . ' cm</p>
                            </div>
                            <div class="col-md-12">
                                <label for="peso">Peso:</label>
                                <p class="list-inline-item">' . $peso[$x] . ' Kg</p>
                            </div>
                            <div class="col-md-12">
                                <label for="precioSalida">Precio salida:</label>
                                <p class="list-inline-item">' . $precio_salida[$x] . '€</p>
                            </div>
                            <div class="col-md-12">
                                <label for="precioSalida">Fecha:</label>
                                <p class="list-inline-item">' . $fecha[$x] . '</p>
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