<?php

//Conexion base de datos
session_start();
if (isset($_SESSION['ID_Admin']) == "") {
    header("Location:../index.php");
}

include_once 'Conexion.php';

$sql = 'SELECT ID_Lote, barco, zona_captura, producto, tamanio, peso, imagen FROM Lote WHERE ID_Admin IS NULL';

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
        $imagen[] = $row["imagen"];
        $id_lote[]=$row["ID_Lote"];
    }
}
$sin_subastas = '<p>No hay lotes disponibles para revisar en estos momentos.</p>';

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
                            <a class="nav-link active" href="Revision.php">Revisión</a>
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
        <h1 class="text-center">Revisión de lotes</h1>

        <?php
        //Falta poner el link personalizado que diriga a la pagina donde se realizará la subasta de cada lote
        if ($num_rows > 0) {
            for ($x = 0; $x < $num_rows; $x++) {
				//Estrucutra captura 0 id lote, 1 barco, 2 zona, 3 producto, 4 peso, 5 tamaño 
				$captura=array($id_lote[$x], $barco[$x], $zona_captura[$x], $producto[$x], $peso[$x], $tamaño[$x]);
                echo '<div class="col-md-12 mb-5">
                <a href="ConfirmarCaptura.php?'. http_build_query(array('captura' => $captura)) .'" class="shadow-lg card h-100" id="tarjetaPrincipal">
                    <div class="d-flex flex-row">
                        <div style="width: 50%">
                            <img style="width: 100%; height: 100%" src="data:image/jpeg;base64,' . base64_encode($imagen[$x]) . '" alt="Foto del lote">
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
