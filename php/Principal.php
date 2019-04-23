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
    <script language="javascript" type="text/javascript" src="../js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="../css/lonja.css" rel="stylesheet">

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
                        <li class="nav-item-principal active">
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
    <div class="ncontainer">

        <div class="ncontainer-interno">
            <!-- Content Row -->
            <div class="row">
                <div class="col-md-4 mb-5">
                    <a href="Captura.php" id="tarjetaPrincipal" class="shadow-lg card h-100">
                    	<img class="card-img-top" src="../images/captura.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Captura</h1>
                            <p class="card-text text-center">Registra los datos de una captura para su venta en la lonja</p>
                        </div>
                    </a>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4 mb-5">
                    <a href="Subastas.php" id="tarjetaPrincipal" class="shadow-lg card h-100">
                    	<img class="card-img-top" src="../images/lonja.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Subasta</h1>
                            <p class="card-text text-center">Accede a las subastas en curso en la lonja</p>
                        </div>
                    </a>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4 mb-5">
                    <a href="SubastasExpress.php" id="tarjetaPrincipal" class="shadow-lg card h-100 overlay">
						<img class="card-img-top" src="../images/subastaExpress.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Subasta Express</h1>
                            <p class="card-text text-center">Accede a las subastas express con precios mínimos</p>
                        </div>
                    </a>
                </div>
                <!-- /.col-md-4 -->

            </div>
            <!-- /.row -->
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 mb-5">
                    <a href="PerfilCliente.php" id="tarjetaPrincipal" class="shadow-lg card h-100">
                        <img class="card-img-top" src="../images/perfil.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Perfil</h1>
                            <p class="card-text text-center">Consulta tus datos de usuario</p>
                        </div>
                    </a>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4 mb-5">
                    <a href="InformacionCliente.php" id="tarjetaPrincipal" class="shadow-lg card h-100">
                        <img class="card-img-top" src="../images/informacion.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Información</h1>
                            <p class="card-text text-center">Acerca de nosotros y FAQs</p>
                        </div>
                    </a>
                </div>
                <!-- /.col-md-4 -->
            </div>
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

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
