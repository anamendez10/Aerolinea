<?php 
    require 'config/conexion.php';
    require 'registrarse.php';
    include('registrarse.php');
    include('config/conexion.php');

?>

<!DOCTYPE html>
<html lang="es">
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
                        
                    <li class="nav-item">
                    <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="vuelos.php">Ver Vuelos</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    
    <section class="section">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-lg-8">
                    <div class="tabs-container">
                        <ul class="nav tab-nav" id="pills-tab">
                            <li class="item">
                                <a class="link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"aria-selected="true">Info personal</a>
                            </li>
                            <li class="item">
                                <a class="link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"aria-selected="false">Compras</a>
                            </li>
                            <li class="item">
                                <a class="link" id="pills-contacet-tab" data-toggle="pill" href="#pills-contact"aria-selected="false">Reservas</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-home">
                                <h1 class="title" align="center">Información de pasajero!</h1>
                                <br>
                                <table class="table">
                                    <tbody>
                                    <?php 
                                        $correo = $_GET['correo'];
                                        $consulta = "SELECT * FROM PASAJERO WHERE EMAIL='$correo' LIMIT 1";
                                        $resultadoo = mysqli_query($conectar, $consulta);
                                        $registrosInfo = mysqli_num_rows($resultadoo);
                                        if($registrosInfo == 0){
                                            ?>
                                            <br>
                                            <br>
                                            <br>
                                            <h1 class="title" align="center">No has hecho ninguna compra ni reserva, por lo tanto no se han registrado tus datos de pasajero :(</h1><?php
                                        }
                                    ?>
                                        
                                        <tr>
                                        <?php foreach ($resultadoo as $row){
                                            $cedula = $row['ID']; ?>
                                        <th scope="row">Cédula</th>
                                        <td align="center"><?php echo $row['ID']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                        <th scope="row">Nombre</th>
                                        <td align="center"><?php echo $row['NOMBRE']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                        <th scope="row">País</th>
                                        <td align="center"><?php echo $row['PAIS']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Ciudad</th>
                                        <td align="center"><?php echo $row['CIUDAD']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Dirección</th>
                                        <td align="center"><?php echo $row['DIRECCION']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Código Postal</th>
                                        <td align="center"><?php echo $row['CODIGO_POSTAL']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Teléfono</th>
                                        <td align="center"><?php echo $row['TELEFONO']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Email</th>
                                        <td align="center"><?php echo $row['EMAIL']; ?></td>
                                        </tr>
                                        <?php }?>


                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="pills-profile">
                                <h1 class="title" align="center">Compras de billetes realizadas</h1>
                                <br>
                                <?php 
                                        include("config/conexion.php");
                                        $correo = $_GET['correo'];
                                        if($registrosInfo == 0)
                                        {
                                            ?>
                                                <br>
                                                <br>
                                                <br>
                                                <h1 class="title" align="center">Aun no has hecho compras :(</h1>
                                                <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="vuelos.php">Ver vuelos</a><?php
                                        }
                                        else
                                        {
                                            $contador = 1;
                                            $consulta = "SELECT * FROM FACTURA_COMPRA WHERE CEDULA='$cedula'";
                                            $resultadoo = mysqli_query($conectar, $consulta);
                                            $registros = mysqli_num_rows($resultadoo);
                                            
                                            if($registros == 0)
                                            {
                                                ?>
                                                <br>
                                                <br>
                                                <br>
                                                <h1 class="title" align="center">Aun no has hecho compras :(</h1>
                                                <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="vuelos.php">Ver vuelos</a><?php
                                            }
                                            foreach ($resultadoo as $row){
                                                
                                                $cod_compra = $row['COD_COMPRA'];
                                    ?>
                                <table class="table">
                                    <tbody>
                                    
                                        
                                        <tr>
                                        <th scope="row">Código de Compra</th>
                                        <h3 class="title" align="center">Compra <?php echo $contador.' de '.$registros;?></h3>
                                        <td align="center"><?php echo $cod_compra; ?></td>
                                        </tr>
                                        
                                        <tr>
                                        <th scope="row">Cédula</th>
                                        <td align="center"><?php echo $row['CEDULA']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                        <th scope="row">Número de Vuelo</th>
                                        <td align="center"><?php echo $row['NUM_VUELO']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Origen</th>
                                        <td align="center"><?php echo $row['ORIGEN']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Destino</th>
                                        <td align="center"><?php echo $row['DESTINO']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Hora y Fecha de Salida</th>
                                        <td align="center"><?php echo $row['FECHA_SALIDA'].' '.$row['HORA_SALIDA']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Hora y Fecha de Llegada</th>
                                        <td align="center"><?php echo $row['FECHA_LLEGADA'].' '.$row['HORA_LLEGADA']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Número de Pasajeros</th>
                                        <td align="center"><?php echo $row['NUM_PASAJEROS']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Clase de Asiento</th>
                                        <td align="center"><?php echo $row['CLASE_ASIENTOS']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Precio x Boleto</th>
                                        <td align="center"><?php echo '$'.number_format($row['PRECIO'],0,',','.'); ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Total Pagado</th>
                                        <td align="center"><?php echo '$'.number_format($row['TOTAL'],0,',','.'); ?></td>
                                        </tr>
                                        <?php $contador = $contador + 1;} }?>
                                    </tbody>
                                </table>
                                <br>
                            </div>

                            <div class="tab-pane fade" id="pills-contact">
                                <h1 class="title" align="center">Reservas realizadas</h1>
                                <br>
                                <?php 
                                        if($registrosInfo == 0)
                                        {
                                            ?>
                                                <br>
                                                <br>
                                                <br>
                                                <h1 class="title" align="center">Aun no has hecho reservas :(</h1>
                                                <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="vuelos.php">Ver vuelos</a><?php
                                        }
                                        else
                                        {
                                            $contador = 1;
                                            $consulta = "SELECT * FROM FACTURA_RESERVA WHERE CEDULA='$cedula'";
                                            $resultadoo = mysqli_query($conectar, $consulta);
                                            $registros = mysqli_num_rows($resultadoo);

                                            if($registros == 0)
                                            {
                                                ?>
                                                <br>
                                                <br>
                                                <br>
                                                <h1 class="title" align="center">Aun no has hecho reservas :(</h1>
                                                <a class="nav-link btn btn-primary text-dark shadow-none ml-md-4" href="vuelos.php">Ver vuelos</a><?php
                                            }
                                            foreach ($resultadoo as $row){
                                                $cod_reserva = $row['COD_RESERVA'];
                                        
                                    ?>
                                <table class="table">
                                    <tbody>
                                    
                                        
                                        <tr>
                                        <th scope="row">Código de Reserva</th>
                                        <h3 class="title" align="center">Compra <?php echo $contador.' de '.$registros;?></h3>
                                        <td align="center"><?php echo $row['COD_RESERVA']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                        <th scope="row">Cédula</th>
                                        <td align="center"><?php echo $row['CEDULA']; ?></td>
                                        </tr>
                                        
                                        <tr>
                                        <th scope="row">Número de Vuelo</th>
                                        <td align="center"><?php echo $row['NUM_VUELO']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Origen</th>
                                        <td align="center"><?php echo $row['ORIGEN']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Destino</th>
                                        <td align="center"><?php echo $row['DESTINO']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Hora y Fecha de Salida</th>
                                        <td align="center"><?php echo $row['FECHA_SALIDA'].' '.$row['HORA_SALIDA']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Hora y Fecha de Llegada</th>
                                        <td align="center"><?php echo $row['FECHA_LLEGADA'].' '.$row['HORA_LLEGADA']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Número de Pasajeros</th>
                                        <td align="center"><?php echo $row['NUM_PASAJEROS']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Clase de Asiento</th>
                                        <td align="center"><?php echo $row['CLASE_ASIENTOS']; ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Precio x Boleto</th>
                                        <td align="center"><?php echo '$'.number_format($row['PRECIO'],0,',','.'); ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Total a Pagar</th>
                                        <td align="center"><?php echo '$'.number_format($row['TOTAL'],0,',','.'); ?></td>
                                        </tr>

                                        <tr>
                                        <th scope="row">Recargo Pagado</th>
                                        <td align="center"><?php echo '$'.number_format($row['RECARGO'],0,',','.'); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php $contador += 1; } }?>
                                
                            </div>

                            <div class="tab-pane fade" id="pills-profile">
                                <h1 class="title" align="center">Compras de billetes realizadas</h1>
                                <br>
                                <table class="table">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                  
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
