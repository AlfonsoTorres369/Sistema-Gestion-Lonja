<?php

//Conexion base de datos
session_start();

include_once 'Conexion.php';

$sql=mysqli_query($con, "SELECT * FROM Cliente WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'");
$row=mysqli_fetch_array($sql);

$lote = mysqli_query($con, "SELECT * FROM lote WHERE ID_Subasta=".$_SESSION['subasta']);
$loterow = mysqli_fetch_array($lote);
//hay que sacar el ID_Lote
$sql1 = "SELECT * FROM Lote WHERE ID_Lote =".$loterow['ID_Lote'];
$consulta1 = mysqli_query($con, $sql1);
$row = mysqli_fetch_array($consulta1);

$sql2 = "SELECT usuario, nombreE FROM Cliente c INNER JOIN Lote l ON  c.ID_Cliente = l.ID_Cliente AND ID_Lote =".$loterow['ID_Lote'];
$consulta2 = mysqli_query($con, $sql2);
$row2 = mysqli_fetch_array($consulta2);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página principal de Aquabid">
    <meta name="author" content="Miguel Ángel Pérez, Eric Romero, Alberto Sastre, Alfonso Torres">

    <title>Subasta finalizada</title>

    <link rel="shortcut icon" href="../images/Aquabid.png">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- JavaScript -->
    <script language="javascript" type="text/javascript" src="../js/ProcesoSubasta.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive">
                    <span class="navbar-toggler-icon"></span>
                </button>
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
                            <a class="nav-link" href="PerfilCliente.php">Perfil</a>
                        </li>
                        <li class="nav-item">
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
        <h1 class="text-center">Subasta finalizada</h1>
        <form name="procesoSubasta" method="post">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="text-right">
                        <?php echo ' <img class="rounded d-block" style="width: 100%; height: 100%" src="data:image/jpeg;base64,' . base64_encode($row["imagen"]) . '" alt="Foto del lote">' ?>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="barco">Barco:</label>
                    <output type="text" class="form-control" name="barco"><?php echo $row['barco']; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="zonaCaptura">Zona captura:</label>
                    <output type="text" class="form-control" id="zonaCaptura"><?php echo $row['zona_captura']; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="producto">Producto:</label>
                    <output type="text" class="form-control" id="producto"><?php echo $row['producto']; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="tamaño">Tamaño:</label>
                    <output type="number" class="form-control" id="tamaño"><?php echo $row['tamanio']; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="peso">Peso:</label>
                    <output type="text" class="form-control" id="peso"><?php echo $row['peso']; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="precioVenta">Precio venta:</label>
                    <output type="text" class="form-control" id="precioSalida"><?php echo $row['precio_venta'] . "€"; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="usuario">Usuario:</label>
                    <output type="text" class="form-control" id="peso"><?php echo $row2['usuario']; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="empresa">Empresa:</label>
                    <output type="text" class="form-control" id="precioSalida"><?php echo $row2['nombreE']; ?></output>
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

</body>

</html>