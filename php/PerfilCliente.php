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
                <a class="navbar-brand" href="Principal.html"><img src="../images/Aquabid.png" width="55px"></a>
                <div class="collapse navbar-collapse" id="navbarResponsive">

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Principal.html">Home</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Captura.html">Captura</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="Subastas.html">Subastas</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="#">Subastas Express</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Informacion.html">Información</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="Perfil.html">Perfil</a>
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
        <h1 class="text-center">Perfil de usuario</h1>
        <form name="registrocliente" onsubmit="return Registro()" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreC">Nombre:</label>
                    <br>
                    <strong>
                    <?php echo $row['nombre']; ?>
                    </strong>
                </div>
                <div class="form-group col-md-6">
                    <label for="apellidos">Apellidos:</label>
                    <br>
                    <strong>
                    <?php echo $row['apellidos']; ?>
                    </strong>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="usuario">Usuario:</label>
                    <br>
                    <strong>
                    <?php echo $row['usuario']; ?>
                    </strong>
                </div>
                <div class="form-group col-md-6">
                    <label for="telefonoC">Teléfono:</label>
                    <br>
                    <strong>
                    <?php echo $row['telefono']; ?>
                    </strong>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="email">Dirección de email:</label>
                    <br>
                    <strong>
                    <?php echo $row['email']; ?>
                    </strong>
                </div>
            </div>
            <h1 class="text-center">Datos de la Empresa</h1>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreE">Nombre:</label>
                    <br>
                    <strong>
                    <?php echo $row['nombreE']; ?>
                    </strong>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreE">Dirección:</label>
                    <br>
                    <strong>
                    <?php echo $row['direccionE']; ?>
                    </strong>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nombreE">Telefono:</label>
                    <br>
                    <strong>
                    <?php echo $row['telefonoE']; ?>
                    </strong>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombreE">CIF:</label>
                    <br>
                    <strong>
                    <?php echo $row['cif']; ?>
                    </strong>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="nombreE">Cuenta Bancaria:</label>
                    <br>
                    <strong>
                    <?php echo $row['cuentaBancaria']; ?>
                    </strong>
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