<?php

//Conexion base de datos
session_start();
include_once 'Conexion.php';

//Estructura subasta 0: barco, 1: zona_captura, 2: producto, 3:tamaño, 4: peso, 5: precio_salida, 6: fecha, 7:ID_Lote, 8:ID_Subasta, 9:precio_minimo
$subasta = $_GET['subasta'];

$sql = 'SELECT imagen FROM Lote WHERE ID_Lote=' . $subasta[7] . '';

$result = mysqli_query($con, $sql);

    if (false == $result) {
        printf("error: %s\n", mysqli_error($con));
	}

//Funcion e-mail
$consultaaux = mysqli_query($con, "SELECT * FROM Participa WHERE ID_Cliente='".$_SESSION['ID_Cliente']."' AND ID_Subasta='".$subasta[8]."'");
if(false==$consultaaux){
    printf("error: %s\n", mysqli_error($con));
}
$numrow = mysqli_num_rows($consultaaux);
if($numrow == 0){

    $mail = mysqli_query($con,"SELECT email FROM Cliente WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'");
    if(false==$mail){
        printf("error: %s\n",mysqli_error($con));
    }
    $maildef = mysqli_fetch_array($mail);
    mail($maildef['email'],"Apuntado en nueva Subasta","Te has apuntado en una nueva subasta!\nDatos de la subasta\nBarco: ".$subasta[0]."\nZona de Captura:".$subasta[1]."\nProducto:".$subasta[2]."\nTamaño:".$subasta[3]." cm\nPeso:".$subasta[4]." kg\nPrecio de Salida:".$subasta[5]."\nFecha:".$subasta[6]."\n\n¡Gracias por apuntarse!");
}


$row=mysqli_fetch_assoc($result);
$result3=mysqli_query($con,"INSERT INTO Participa(ID_Cliente, ID_Subasta)VALUES('".$_SESSION['ID_Cliente']."', '".$subasta[8]."')");
if(false==$result3){
	printf("\n error:. %s\n",mysqli_error($con));
}

//Proceso de compra y descuentos
if(isset($_POST['comprar'])){

}


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
        <h1 class="text-center">Proceso Subasta</h1>
        <form name="procesoSubasta">
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
                    <output type="text" class="form-control" name="barco"><?php echo $subasta[0]; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="zonaCaptura">Zona captura:</label>
                    <output type="text" class="form-control" id="zonaCaptura"><?php echo $subasta[1]; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="producto">Producto:</label>
                    <output type="text" class="form-control" id="producto"><?php echo $subasta[2]; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="tamaño">Tamaño:</label>
                    <output type="number" class="form-control" id="tamaño"><?php echo $subasta[3]; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="peso">Peso:</label>
                    <output type="text" class="form-control" id="peso"><?php echo $subasta[4]; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="precioSalida">Precio salida:</label>
                    <output type="text" class="form-control" id="precioSalida"><?php echo $subasta[5] . "€"; ?></output>
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="output">
                        <p id="precio" class="text-center size-counter"><?php echo $subasta[5] . "€"; ?></p>
                    </div>
                </div>
            </div>
        </form>
        <div class="form-boton">
            <button type="submit" name= "comprar" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" id="botonComprar">COMPRAR</button>
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
