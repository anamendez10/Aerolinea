<?php
    ob_start();
    session_start();

    require'registrarse.php';
    require'config/conexion.php';
    $correo = NULL;
    $contrasena = NULL;


    if(isset($_SESSION['CORREO'])){
        $consulta = "SELECT * FROM USUARIO WHERE CORREO='$_SESSION[CORREO]'";
        $resultado = mysqli_query($conectar, $consulta); 

        if($resultado){
            $user = $resultado->fetch_array();
            $correo = $user['CORREO'];
            $password = $user['CONTRASENA'];
        }
    }
    else
    {
        header("location:login.php");
    }

    
    require 'config/validar.php';
?>  

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
            <a class="navbar-brand" href="vuelos.php"><strong class="text-primary">MI</strong><span style="color: black"> VUELO</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    
                    <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="config/cerrar.php">Cerrar sesión</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="perfil.php?correo=<?php echo $correo;?>">Perfil</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="social-wrapper" id="features" style="margin-bottom: 90px"></div>
    
    
    
    <section class="section" id="pricing">
        <div class="container text-center">
            <h6 class="display-4 has-line">VUELOS DISPONIBLES</h6>
            <div class="form-group pb-1">
                <input type="text" name="buscador" id="buscador" class="form-control-input" placeholder="¿A donde quieres ir?" > 

            </div>
            <br><br>
            <?php 
                include("config/conexion.php");
                $consulta = "SELECT * FROM VUELO WHERE PUESTOS_SOBRANTES>0";
                $resultado = mysqli_query($conectar, $consulta);
            ?>
            
            <div class="row pt-5">
            <?php foreach($resultado as $row){ ?>
                <div class="col-lg-4">
                    <a href="detalles.php?id=<?php echo $row['NUMERO'];?>&token=<?php echo hash_hmac('sha1', $row['NUMERO'], 'KEY_TOKEN');?>" class="pricing-card">
                        <div class="head"><?php echo 'Destino: '.$row['DESTINO']; ?></div>

                        <div class="body">
                            <h1><small>DESDE $</small><?php echo ($row['PRECIO_MIN']); ?></h1>
                            <p>Origen: <?php echo ($row['ORIGEN']); ?></p>
                        </div>

                        <div class="body">
                            <img src="data:image/jpg;base64,<?php echo base64_encode($row['IMAGEN']); ?>"/> 
                        </div>
                    </a>
                </div>
                <?php } ?>
    </section>


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

    <script src="js_me/filter.js"></script>

</body>
</html>