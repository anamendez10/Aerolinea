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
    
    <section class="section" id="contact">
        <div class="container text-center">
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
         Este formulario es para RESERVAR o COMPRAR billetes de vuelo
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
      </div>
            <br>
            <h6 class="display-4 has-line">DATOS PERSONALES</h6>
            <p class="mb-5 pb-2">IMPORTANTE: Recuerde poner el email con el que INICIA SESION en nuestra página.</p>
            <?php
                $consulta = "SELECT * FROM TARIFA WHERE DESTINO = '$destino'";
                $resultado = mysqli_query($conectar, $consulta);
                $precio = 0;
                $id = $_GET['id'];
                $precio2 = $_GET['precio'];
                $tipo_asiento = $_GET['clase_asiento'];
                foreach($resultado as $row){
                    $precio = $row['PRECIO'];
                }
            ?>
        
            <form name="reservas" method="post" action="reservando.php?precio=<?php echo $precio2;?>&id=<?php echo $id;?>&correo=<?php echo $correo;?>"> 
                <?php 
                $consulta2 = "SELECT * FROM PASAJERO WHERE EMAIL='$correo'";
                $resultado2 = mysqli_query($conectar, $consulta2);
                $registros = mysqli_num_rows($resultado2);
            
                if($registros)
                {
                    ?>
                    <center>
                    <h6 class="display-4 has-line">TARIFAS</h6>
                    
                    <div class="col-md-6">

                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="Clase de Asiento*" value="<?php echo $tipo_asiento ?>" name="clase_asiento" readonly>   
                        </div>
                        <div class="form-group pb-1">
                            <input type="number" class="form-control" placeholder="Cantidad de Pasajeros*" name="num_pasajeros" required>          
                        </div>
                    </div>
                    <div>
                    <input type="submit" class="btn btn-primary btn-block" style="width:50%" value="Reservar boletos" name="mas_reserva">
                    </div>
                    <br>
                    <div>
                    <input type="submit" class="btn btn-primary btn-block" style="width:50%" value="Comprar boletos" name="mas_compra">
                    </div>
        
                </center>
                <?php
                }else{?>
                <center>
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <input type="number" class="form-control" placeholder="Cédula de ciudadanía*" name="cedula" required>          
                        </div>
                        <div class="form-group pb-1">
                            <input type="text" class="form-control" placeholder="Nombre*" name="nombre" required>          
                        </div>
                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="País*" name="pais" required>   
                        </div>
                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="Ciudad*" name="ciudad" required>   
                        </div>
                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="Dirección*" name="direccion" required>   
                        </div>
                        <div class="form-group ">
                            <input type="number" class="form-control" placeholder="Código Postal*" name="codigo_postal" required>   
                        </div>
                        <div class="form-group ">
                            <input type="number" class="form-control" placeholder="Celular*" name="telefono" required>   
                        </div>
                        <div class="form-group ">
                            <input type="email" class="form-control" placeholder="Email*" name="email" value="<?php echo $correo ?>" readonly>   
                        </div>
                    </div>

                    <br>
                    <h6 class="display-4 has-line">INFORMACIÓN PARA EL PAGO</h6>
                    
                    <div class="col-md-6">
                        <div class="form-group pb-1">
                            <input type="text" class="form-control" placeholder="Número de Tarjeta*" name="numero" required>          
                        </div>
                        <div class="form-group pb-1">
                            <input type="date" class="form-control" placeholder="Fecha de Vencimiento*" name="fecha_vencimiento" required>          
                        </div>
                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="Nombre del Banco*" name="banco" required>   
                        </div>
                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="CVC*" name="cvc" required>   
                        </div>
                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="País donde es la tarjeta*" name="pais_tarjeta" required>   
                        </div>
                    </div>
                    
                    <br>
                    <h6 class="display-4 has-line">TARIFAS</h6>
                    
                    <div class="col-md-6">

                        <div class="form-group ">
                            <input type="text" class="form-control" placeholder="Clase de Asiento*" value="<?php echo $tipo_asiento ?>" name="clase_asiento" readonly>   
                        </div>
                        <div class="form-group pb-1">
                            <input type="number" class="form-control" placeholder="Cantidad de Pasajeros*" name="num_pasajeros" required>          
                        </div>
                    </div>
                    <div>
                    <input type="submit" class="btn btn-primary btn-block" style="width:50%" value="Reservar boletos" name="reserva">
                    </div>
                    <br>
                    <div>
                    <input type="submit" class="btn btn-primary btn-block" style="width:50%" value="Comprar boletos" name="compra">
                    </div>
        
                </center>
                <?php
                }?>
            </form>
        </div>
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
    
</body>
</html>
