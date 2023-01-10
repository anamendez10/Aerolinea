<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Rubic landing page.">
    <meta name="author" content="Devcrud">
    <title>Airline</title>
    <!-- font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Rubic main styles -->
	<link rel="stylesheet" href="assets/css/rubic.css">
</head>


<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <nav id="scrollspy" class="navbar page-navbar navbar-dark navbar-expand-md fixed-top" data-spy="affix" data-offset-top="20">
        <div class="container">
            <a class="navbar-brand" href="index.html"><strong class="text-primary">MI</strong><span class="text-light"> VUELO</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="index.php">Registrarse</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="header d-flex justify-content-center">
        <div class="container">
            <div class="row h-100 align-items-center">
            <div class="col-md-7">
                    <div class="header-content">
                        <h3 class="header-title"><strong class="text-primary">MI</strong><span style="color: white"> VUELO</span></h3>
                        <h4 class="header-subtitle">Para empezar a consultar, reservar y comprar vuelos inicia sesión!</h4>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi dolores voluptatem voluptatum adipisci vel, beatae unde! Mollitia voluptatum, ullam quisquam optio!</p>
                        <button class="btn btn-outline-light btn-flat">Download</button> -->
                    </div>  
                </div>
                <div class="col-md-5 d-none d-md-block">
                    <form class="header-form" name = "datosformulario" action="config/validar.php" method="post">
                        <div class="head">Inicia Sesión con <span class="text-primary"> Nosotros.</span></div>
                        <div class="body">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Correo*" name="correo">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Contraseña*" name="contrasena">
                            </div>
                        </div>
                        <div class="footer">
                            <button class="btn btn-primary btn-block" type="submit" name="iniciar">Iniciar Sesión</button>
                            <!-- <a class="link" href = "formulario_registrar.php" style="margin:15px">Registrarse</a> -->
                        </div>
                    </form> 
                </div>
            </div>  
        </div>
    </header>
    
    <footer class="footer py-4 bg-dark text-light"> 
        <div class="container text-center">
            <p class="mb-4 small">Copyright <script>document.write(new Date().getFullYear())</script> &copy; <a href="http://www.devcrud.com">DevCRUD</a></p>
            <div class="social-links">
                <a href="javascript:void(0)" class="link"><i class="ti-facebook"></i></a>
                <a href="javascript:void(0)" class="link"><i class="ti-twitter-alt"></i></a>
                <a href="javascript:void(0)" class="link"><i class="ti-google"></i></a>
                <a href="javascript:void(0)" class="link"><i class="ti-pinterest-alt"></i></a>
                <a href="javascript:void(0)" class="link"><i class="ti-instagram"></i></a>
                <a href="javascript:void(0)" class="link"><i class="ti-rss"></i></a>
            </div>
        </div>
    </footer>
	
	<!-- core  -->
    <script src="assets/vendors/jquery/jquery-3.4.1.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.js"></script>
    <!-- bootstrap 3 affix -->
	<script src="assets/vendors/bootstrap/bootstrap.affix.js"></script>

    <!-- Rubic js -->
    <script src="assets/js/rubic.js"></script>

</body>
</html>
