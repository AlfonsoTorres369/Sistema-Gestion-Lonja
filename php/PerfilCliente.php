<?php
include_once 'Conexion.php';
//if(isset($_SESSION['ID_Cliente']))
session_start();
$sql=mysqli_query($con, "SELECT * FROM Cliente WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'");
$row=mysqli_fetch_array($sql);




?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/RegistroCliente.css">
    <link rel="stylesheet" href="../css/lonja.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">
    <script src="../js/RegistroCliente.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Perfil</title>
    <link rel="shortcut icon" href="../images/Aquabid.png">
</head>

    
<body>
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
                        <li class="nav-item-principal active">
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
        <br>
        <br>
        <div id="formularioCliente" class="shadow-lg container">
        <br>
        <h1 class="text-center">Perfil de Usuario</h1>
        <form name="registrocliente" onsubmit="return Registro()" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreC">Nombre:</label>
                    <output type="text" class="form-control" name="nombre"><?php echo $row['nombre']; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="apellidos">Apellidos:</label>
                    <output type="text" class="form-control" name="apellidos"><?php echo $row['apellidos']; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="usuario">Usuario:</label>
                    <output type="text" class="form-control" name="usuario"><?php echo $row['usuario']; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefonoC">Teléfono:</label>
                    <output type="text" class="form-control" name="telefono"><?php echo $row['telefono']; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="email">Dirección de email:</label>
                    <output type="text" class="form-control" name="email"><?php echo $row['email']; ?></output>
                </div>
            </div>
            <br>
            <h1 class="text-center">Datos de la Empresa</h1>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreE">Nombre:</label>
                    <output type="text" class="form-control" name="nombreE"><?php echo $row['nombreE']; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreE">Dirección:</label>
                    <output type="text" class="form-control" name="direccionE"><?php echo $row['direccionE']; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreE">Telefono:</label>
                    <output type="text" class="form-control" name="telefonoE"><?php echo $row['telefonoE']; ?></output>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreE">CIF:</label>
                    <output type="text" class="form-control" name="cif"><?php echo $row['cif']; ?></output>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nombreE">Cuenta Bancaria:</label>
                    <output type="text" class="form-control" name="cuentaBancaria"><?php echo $row['cuentaBancaria']; ?></output>
                </div>
            </div>
    
            <br>
            
        </form>
    </div>
    <!-- Footer -->
    <footer class="npadding bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Aquabid 2019</p>
        </div>
        <!-- /.container -->
    </footer>

</body>

</html>