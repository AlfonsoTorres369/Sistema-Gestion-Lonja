<?php

include_once "Conexion.php";
session_start();
$compra=$_GET['compra'];
    //Funcion aplicar descuentos
$sql_desc='SELECT num_desc, fecha_ult_comp FROM Descuentos WHERE ID_Cliente='.$_SESSION['ID_Cliente'].'';
$result_desc=mysqli_query($con, $sql_desc);
$precio_actual=$compra[5];
	if(false==$result_desc){
		printf("\n error: %s\n", mysqli_error($con));
	}
	$row_desc=mysqli_fetch_assoc($result_desc);
	$fecha_act=date("Y-m-d");
    $fecha = getdate();
	$fecha_comp=$row_desc["fecha_ult_comp"];
	$num_desc=$row_desc["num_desc"];
	if((strtotime($fecha_act)>=strtotime($fecha_comp))&&(strtotime($fecha_act)<=strtotime($fecha_comp."+ 1 month"))){
		if($num_desc==3){
			$precio_actual=$precio_actual-($precio_actual*0.15);
			$text_desc="Aplicado descuento del 15%";
			$sql_act="UPDATE Descuentos SET num_desc=2, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error1: $s", mysqli_error($con));
			}
		}
		if($num_desc==2){
			$precio_actual=$precio_actual-($precio_actual*0.10);
			$text_desc="Aplicado descuento del 10%";
			$sql_act="UPDATE Descuentos SET num_desc=1, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error2: $s", mysqli_error($con));
			}
		}
		if($num_desc==1){
			$precio_actual=$precio_actual-($precio_actual*0.05);
			$text_desc="Aplicado descuento del 5%";
			$sql_act="UPDATE Descuentos SET num_desc=0, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error3: $s", mysqli_error($con));
			}
		}
	}
	else if(strtotime($fecha_act)>strtotime($fecha_comp."+ 1 month")){
		$mes_anterior=date("Y-m-d",strtotime($fecha_act."- 1 month"));
		$sql_comp="SELECT COUNT(*) FROM Participa P INNER JOIN Subasta S ON P.ID_Subasta=S.ID_Subasta INNER JOIN Lote L ON P.ID_Subasta=L.ID_Subasta WHERE P.ID_Cliente='".$_SESSION['ID_Cliente']."' 
		AND S.fecha BETWEEN '".$mes_anterior."' AND '".$fecha_act."'";
		$res_comp=mysqli_query($con,$sql_comp);
		if($res_comp==false){
			printf("error4: %s", mysqli_error($con));
		}
		$row_comp=mysqli_fetch_assoc($res_comp);
		if($row_comp["COUNT(*)"]>1){
			$sql_act="UPDATE Descuentos SET num_desc=2, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error5: $s", mysqli_error($con));
			}
			$precio_actual=$precio_actual-($precio_actual*0.15);
		}else{
			$sql_act="UPDATE Descuentos SET num_desc=0, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error6: $s", mysqli_error($con));
			}
		}
	}
	$sql_buy="SELECT COUNT(*) FROM   Subasta S  INNER JOIN Lote L ON S.ID_Subasta=L.ID_Subasta WHERE L.ID_Cliente='".$_SESSION['ID_Cliente']."' 
		AND YEAR(S.fecha)=".$fecha['year']." AND MONTH(S.fecha)=".$fecha['mon']." AND DAY(S.fecha)=".$fecha['mday'];
	$res_buy=mysqli_query($con,$sql_buy);
	if($res_buy==false){
		printf("error7: %s", mysqli_error($con));
	}
	$row_buy=mysqli_fetch_assoc($res_buy);
	if($row_buy["COUNT(*)"]>=5){
		$precio_actual=$precio_actual-($precio_actual*0.05);
		$text_desc2="Aplicado descuento del 5%";
	}
if(isset($_POST['botonComprar'])){
    
    $c_email=mysqli_query($con, "SELECT email, cuentaBancaria FROM Cliente WHERE ID_Cliente=".$_SESSION['ID_Cliente']);
    $email=mysqli_fetch_array($c_email);
    mail($email['email'],"Factura de tu Compra","Buenos días.\n\nLe informamos que acaba de realizar el pago de su compra.\n\nHa comprado: ".$compra[2]."\nCuenta dónde se realizará la extracción:  ".$email['cuentaBancaria']."\nImporte: ".$precio_actual." €\n\n¡Gracias por su compra!");
    $pagadito=mysqli_query($con, "UPDATE Lote SET pagado=true, precio_venta=".$precio_actual." WHERE ID_Lote=".$compra[7]);
    
    header("Location: Cesta.php");
}

?>




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página principal de Aquabid">
    <meta name="author" content="Miguel Ángel Pérez, Eric Romero, Alberto Sastre, Alfonso Torres">

    <title>Pasarela de pago</title>

    <link rel="shortcut icon" href="../images/Aquabid.png">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- JavaScript -->
    <script language="javascript" type="text/javascript" src="../js/Captura.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
                        <li class="nav-item-principal">
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
        <form method="post">
        <br>
        <h1 class="text-center">Factura</h1>
        <h3>Precio de adquisición: <?php echo $compra[5]."€"; ?></h3>
        <br>
        <span class="text-success"><?php if (isset($text_desc)) echo $text_desc; ?></span>
        <br>
        <span class="text-success"><?php if (isset($text_desc2)) echo $text_desc2; ?></span>
        <br>
        <h3>Precio de compra final: <?php echo $precio_actual."€"; ?></h3>
        <button type="submit" class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" id="botonComprar" name="botonComprar">Pagar</button>
        </form>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="npadding bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Aquabid 2019</p>
        </div>
    </footer>
</body>

</html>
