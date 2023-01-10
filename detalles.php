<?php
    ob_start();
    session_start();

    require'registrarse.php';
    require'config/conexion.php';
    require'config/config.php';

    $destino = '';

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

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $token = isset($_GET['token']) ? $_GET['token'] : '';
    $fecha_salida = isset($_GET['fecha_salida']) ? $_GET['fecha_salida'] : '';

    if($id == '' || $token == ''){

        echo 'Error al procesar la peticion';
        exit;
    }
    else 
    {
        $token_tmp = hash_hmac('sha1', $id, 'KEY_TOKEN');
        
        if ($token == $token_tmp) 
        {
            $consulta = "SELECT count(NUMERO) FROM VUELO WHERE NUMERO='$id'";
            $resultado = mysqli_query($conectar, $consulta);
            $registros = mysqli_num_rows($resultado);

                if ($registros > 0) 
                {
                    $consulta = "SELECT * FROM VUELO WHERE NUMERO='$id' LIMIT 1";
                    $resultado = mysqli_query($conectar, $consulta);
                    $registros = mysqli_num_rows($resultado);

                        foreach ($resultado as $row)
                        {
                            $numero = $row['NUMERO'];
                            $id_avion = $row['ID_AVION'];
                            $aerolinea = $row['AEROLINEA'];
                            $origen = $row['ORIGEN'];
                            $destino = $row['DESTINO'];
                            $fecha_llegada = $row['FECHA_LLEGADA'];
                            $hora_llegada = $row['HORA_LLEGADA'];
                            $fecha_salida = $row['FECHA_SALIDA'];
                            $hora_salida = $row['HORA_SALIDA'];
                            $puestos_sobrantes = $row['PUESTOS_SOBRANTES'];
                            $precio_min = $row['PRECIO_MIN'];
                        }
                }
                else
                {
                    echo 'Error al procesar la peticion';
                    exit;
                }
            }
        }
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
            <a class="navbar-brand" href="vuelos.php"><strong class="text-primary">MI</strong><span class="text-light"> VUELO</span></a>
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
    
    <div class="social-wrapper" id="features" style="margin-bottom: 0px"></div>
    
    
    <section class="section" id="about" style="background-image: url('assets/imgs/foto2.jpg');">
        <div class="container text-center">
            <br>
            <h6 class="display-4 has-line">MÁS DETALLES DE NUESTRO VUELO A <?php echo $destino; ?></h6>            
            <br>
            
            <a  class="details-card" style="heigth:180px">
                <div class="head">DESTINO</div>
                <div class="body">
                    <?php 
                        $tarifa = "SELECT MIN(PRECIO) FROM TARIFA WHERE DESTINO='$destino'"; 
                        $resultado1 = mysqli_query($conectar, $tarifa); 
                    ?> 
                    <h1><?php echo $destino ?></h1>
                    <p>Este viaje arranca en: <?php echo $origen?></p> 
                </div>
                
                <ul class="list-group">
                    <li class="list-group-item">AEROLINEA: <strong><?php echo $aerolinea; ?></strong></li>
                    <li class="list-group-item">AEROPUERTO: <strong><?php echo $origen; ?></strong></li>
                    <li class="list-group-item">FECHA Y HORA DE SALIDA: <strong><?php echo $fecha_llegada.' '.$hora_llegada; ?></strong></li>
                    <li class="list-group-item">FECHA Y HORA DE LLEGADA: <strong><?php echo $fecha_salida.' '.$hora_salida; ?></strong></li>
                    <li class="list-group-item">PUESTOS SOBRANTES: <strong><?php echo $puestos_sobrantes; ?></strong></li>
                </ul>
            </a>
        </div>

        <section class="section" id="pricing">
            <div class="container text-center">
                <h6 class="display-4 has-line">NUESTRAS TARIFAS</h6>
                <?php 
                    include("config/conexion.php");
                    $consulta = "SELECT * FROM TARIFA WHERE DESTINO = '$destino' AND FECHA_SALIDA='$fecha_salida'";
                    $resultado = mysqli_query($conectar, $consulta);
                ?>
                
                <div class="row pt-5">
                <?php foreach($resultado as $row){ 
                    global $clase_asiento;
                    $clase_asiento = $row['CLASE_ASIENTO'];?>
                    <div class="col-lg-4">
                        <a class="pricing-card" href="formulario.php?id=<?php echo $id;?>&precio=<?php echo $row['PRECIO'];?>&clase_asiento=<?php echo $row['CLASE_ASIENTO'];?>">   
                            <div class="head"><?php echo ($row['DESTINO']); ?></div>

                            <div class="body">
                                <h1><?php echo number_format($row['PRECIO'],0,',','.'); ?></h1>
                                <p><?php echo ($row['CLASE_ASIENTO']); ?></p>
                            </div>
                        </a>
                </div>
                <?php } ?>

            </div>


        </section>
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
    
    <script src="js/modal.js"></script>
</body>
</html>
