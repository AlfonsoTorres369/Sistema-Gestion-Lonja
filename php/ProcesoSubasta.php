<?php

//Conexion base de datos
session_start();
include_once 'Conexion.php';


//Estructura subasta 0: barco, 1: zona_captura, 2: producto, 3:tamaño, 4: peso, 5: precio_salida, 6: fecha, 7:ID_Lote, 8:ID_Subasta, 9:precio_minimo

if(isset($_GET['subasta'])){
$subasta = $_GET['subasta'];
$sql = "SELECT imagen FROM Lote WHERE ID_Lote=".$subasta[7];

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
    $result3=mysqli_query($con,"INSERT INTO Participa(ID_Cliente, ID_Subasta)VALUES('".$_SESSION['ID_Cliente']."', '".$subasta[8]."')");
    if(false==$result3){
	   printf("\n error:. %s\n",mysqli_error($con));
    }
}


$row=mysqli_fetch_assoc($result);
}
//Funcion Comprar
if(isset($_POST['botonComprar'])){
    
    $fix=mysqli_real_escape_string($con, $_POST['fix']);
    
    $precio_actual = mysqli_query($con, "SELECT precio_actual FROM Subasta WHERE ID_Subasta=".$subasta[8]);
    $precio = mysqli_fetch_array($precio_actual);
    $actu = "UPDATE lote SET precio_venta=".$precio['precio_actual'].", ID_Cliente=".$_SESSION['ID_Cliente'].", subastado=true WHERE ID_Lote=".$subasta[7];
    $actu2 = "UPDATE Subasta SET actual=false, realizada=true WHERE ID_Subasta=".$subasta[8];
    $ejec2 = mysqli_query($con, $actu2);
    $ejec=mysqli_query($con, $actu);
    if(false == $ejec){
        printf("error: %s\n", mysqli_error($con));
    }
    $mail2 = mysqli_query($con,"SELECT email FROM Cliente WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'");
    $mailrow = mysqli_fetch_array($mail2);
    mail($mailrow['email'],"Compra pendiente","Hola.\nLe informamos que tiene pendiente por pagar una compra de ".$subasta[2]." a un precio de ".$precio['precio_actual']."\nPor favor, pasese por nuestra web para ingresar el importe.");
    header("Location:Principal.php");
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
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    
    <!-- Script de Contador de Precio -->
    
    <script type="text/javascript">
$(document).ready(function() {
    function changeNumber() {
        value = $('#precio').text();
        $.ajax({
            type: "POST",
            url: "Contador.php",
            success: function(data) {
                $('#precio').text(data);
            }
        });
    }
    setInterval(changeNumber, 3000);
});
function Detener(){
    clearInterval(changeNumber);
}
</script> 

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
        <h1 class="text-center">Proceso Subasta</h1>
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
            
            <div class="form-boton">
            <button type="submit" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" id="botonComprar" name="botonComprar">COMPRAR</button>
        </div>
            
            <input type="number" value="<?php echo $subasta[8]?>" name="fix" style="visibility:hidden">
            
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