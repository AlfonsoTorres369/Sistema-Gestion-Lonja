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

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="../css/lonja.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

</head>

<body>

    <!-- Navigation -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top nnavbar">
            <div class="container">
                <a class="navbar-brand" href="principalAdmin.php"><img src="../images/Aquabid.png" width="55px"></a>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item-principal">
                            <a class="nav-link" href="ConfirmarCaptura.php">Revisión</a>
                        </li>
                        <li class="nav-item-principal">
                            <a class="nav-link" href="ConfirmarCaptura.php">Registrar admin.</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="InformacionAdmin.php">Información</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="PerfilAdmin.php" > Perfil</a>
                        </li>
                        <li class="nav-item">
							<a class="nav-link" href="logout-admin.php">Cerrar Sesión</a>
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
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 mb-5">
                    <a href="ConfirmarCaptura.php" id="tarjetaPrincipal" class="shadow-lg card h-100">
                    	<img class="card-img-top" src="../images/verificar.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Revisión</h1>
                            <p class="card-text text-center">Revisa las capturas para aprobar su venta en la lonja</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-5">
                    <a href="RegistroAdmin.php" id="tarjetaPrincipal" class="shadow-lg card h-100">
                        <img class="card-img-top" src="../images/admin.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Registrar admin.</h1>
                            <p class="card-text text-center">Registra a otro administrador en la plataforma</p>
                        </div>
                    </a>
                </div>
                <!-- /.col-md-4 -->
                <div class="col-md-4 mb-5">
                    <a href="PerfilAdmin.php" id="tarjetaPrincipal" class="shadow-lg card h-100">
                        <img class="card-img-top" src="../images/perfil.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Perfil</h1>
                            <p class="card-text text-center">Consulta tus datos de usuario</p>
                        </div>
                    </a>
                </div>
                <!-- /.col-md-4 -->

            </div>
            <div class="row d-flex justify-content-center">
                    <div class="col-md-4 mb-5">
                    <a href="InformacionAdmin.php" id="tarjetaPrincipal" class="shadow-lg card h-100">
                        <img class="card-img-top" src="../images/informacion.jpg" alt="Card image">
                        <div class="card-body">
                            <h1 class="card-title text-center">Información</h1>
                            <p class="card-text text-center">Acerca de nosotros y FAQs</p>
                        </div>
                    </a>
                    </div>
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
