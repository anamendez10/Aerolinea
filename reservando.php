<?php
    ob_start();
    require 'config/conexion.php';
    include("config/conexion.php");

    function random($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz()';
        $charactersLength = strlen($characters);
        $random_string = '';

        for($i = 0; $i < $length; $i++)
        {
            $random_string .= $characters[rand(0, $charactersLength - 1)];
        }
        return $random_string;
    }

    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $precio = isset($_GET['precio']) ? $_GET['precio'] : '';
    $correo = isset($_GET['correo']) ? $_GET['correo'] : '';

    if(isset($_POST['reserva']))
    {
        $cedula=trim($_POST['cedula']);
        $nombre=trim($_POST['nombre']);

        $pais=trim($_POST['pais']);
        $ciudad=trim($_POST['ciudad']);
        $direccion=trim($_POST['direccion']);
        $codigo_postal=trim($_POST['codigo_postal']);
        $telefono=trim($_POST['telefono']);
        $email=trim($_POST['email']);  

        $numero=trim($_POST['numero']);
        $fecha_vencimiento=trim($_POST['fecha_vencimiento']);

        $fecha_resultado=explode('-', $fecha_vencimiento);
        $dia=$fecha_resultado[2];
        $mes=$fecha_resultado[1];
        $año=$fecha_resultado[0];
        $fecha_final = $año.'-'.$mes.'-'.$dia;

        $banco=trim($_POST['banco']);

        $clase_asiento=$_REQUEST['clase_asiento'];

        $num_pasajeros=trim($_POST['num_pasajeros']);

        $consulta1 = "INSERT INTO `pasajero`(`ID`, `NOMBRE`, `PAIS`, `CIUDAD`, `DIRECCION`, `CODIGO_POSTAL`, `TELEFONO`, `EMAIL`) VALUES ('$cedula', '$nombre', '$pais', '$ciudad', '$direccion', '$codigo_postal', '$telefono', '$email')";
        $resultado1 = mysqli_query($conectar, $consulta1);  
        
        $cod_reserva = random(15);
        $total = $precio * $num_pasajeros;
        
        $consulta2 = "INSERT INTO `tarjeta`(NUMERO, ID, FECHA_VENCIMIENTO, NOMBRE_PROPIETARIO, NOMBRE_BANCO) VALUES ('$numero', '$cedula', '$fecha_final', '$nombre', '$banco')";
        $resultado2 = mysqli_query($conectar, $consulta2);

        $consulta3 = "INSERT INTO `reserva`(COD_RESERVA, NUM_TARJETA, NUM_VUELO, NUM_PASAJEROS, TOTAL) VALUES ('$cod_reserva', '$numero', '$id', '$num_pasajeros', '$total')";
        $resultado3 = mysqli_query($conectar, $consulta3);

        $consulta4 = "UPDATE VUELO SET PUESTOS_SOBRANTES=PUESTOS_SOBRANTES-'$num_pasajeros' WHERE NUMERO='$id'";
        $resultado4 = mysqli_query($conectar, $consulta4);

        $consulta7 = "UPDATE RESERVA SET TOTAL='$precio'*'$num_pasajeros' WHERE COD_RESERVA=''";
        $destino = mysqli_query($conectar, $consulta7);

        $consulta8 = "SELECT * FROM VUELO WHERE NUMERO='$id' LIMIT 1";
        $resultado8 = mysqli_query($conectar, $consulta8);
        $registros = mysqli_num_rows($resultado8);

        $consulta = "SELECT * FROM VUELO WHERE NUMERO='$id' LIMIT 1";
        $resultadoo = mysqli_query($conectar, $consulta);
        $registros = mysqli_num_rows($resultadoo);

        foreach ($resultadoo as $row)
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

        $consulta9 = "INSERT INTO `factura_reserva`(`COD_RESERVA`, `CEDULA`, `NUM_VUELO`, `ORIGEN`, `DESTINO`, `FECHA_SALIDA`, `HORA_SALIDA`, `FECHA_LLEGADA`, `HORA_LLEGADA`,`NUM_PASAJEROS`, `CLASE_ASIENTOS`, `PRECIO`, `RECARGO`, `TOTAL`) VALUES ('$cod_reserva', '$cedula', '$id', '$origen', '$destino', '$fecha_salida', '$hora_salida', '$fecha_llegada', '$hora_llegada', '$num_pasajeros', '$clase_asiento', '$precio', '500000', '$total')";
        $resultado9 = mysqli_query($conectar, $consulta9);
         

        if($consulta9 == false)
        {
            echo "<script>alert('Error al procesar la petición, intentelo más tarde.')</script>";
            echo "<script>setTimeout(\"location.href='vuelos.php'\")</script>";
        }
        else
        {
            echo "<script>alert('Has reservado tus boletos con éxito.')</script>";
            echo "<script>setTimeout(\"location.href='perfil.php?correo=$email'\")</script>";
        } 

        mysqli_close($conectar);
    }
    elseif(isset($_POST['compra']))
    {
        $cedula=trim($_POST['cedula']);
        $nombre=trim($_POST['nombre']);

        $pais=trim($_POST['pais']);
        $ciudad=trim($_POST['ciudad']);
        $direccion=trim($_POST['direccion']);
        $codigo_postal=trim($_POST['codigo_postal']);
        $telefono=trim($_POST['telefono']);
        $email=trim($_POST['email']);  

        $numero=trim($_POST['numero']);
        
        $fecha_vencimiento=trim($_POST['fecha_vencimiento']);
        $fecha_resultado=explode('-', $fecha_vencimiento);
        $dia=$fecha_resultado[2];
        $mes=$fecha_resultado[1];
        $año=$fecha_resultado[0];
        $fecha_final = $año.'-'.$mes.'-'.$dia;

        $banco=trim($_POST['banco']);

        $clase_asiento=$_REQUEST['clase_asiento'];

        $num_pasajeros=trim($_POST['num_pasajeros']);



        $consulta1 = "INSERT INTO `pasajero`(`ID`, `NOMBRE`, `PAIS`, `CIUDAD`, `DIRECCION`, `CODIGO_POSTAL`, `TELEFONO`, `EMAIL`) VALUES ('$cedula', '$nombre', '$pais', '$ciudad', '$direccion', '$codigo_postal', '$telefono', '$email')";
        $resultado1 = mysqli_query($conectar, $consulta1);  
        
        $cod_compra = random(15);
        $total = $precio * $num_pasajeros;
        
        $consulta2 = "INSERT INTO `tarjeta`(NUMERO, ID, FECHA_VENCIMIENTO, NOMBRE_PROPIETARIO, NOMBRE_BANCO) VALUES ('$numero', '$cedula', '$fecha_final', '$nombre', '$banco')";
        $resultado2 = mysqli_query($conectar, $consulta2);

        $consulta3 = "INSERT INTO `compra`(`COD_COMPRA`, `NUM_TARJETA`, `NUM_VUELO`, `NUM_PASAJEROS`, `TOTAL`) VALUES ('$cod_compra', '$numero', '$id', '$num_pasajeros', '$total')";
        $resultado3 = mysqli_query($conectar, $consulta3);

        $consulta4 = "UPDATE VUELO SET PUESTOS_SOBRANTES=PUESTOS_SOBRANTES-'$num_pasajeros' WHERE NUMERO='$id'";
        $resultado4 = mysqli_query($conectar, $consulta4);

        $consulta = "SELECT * FROM VUELO WHERE NUMERO='$id' LIMIT 1";
        $resultadoo = mysqli_query($conectar, $consulta);
        $registros = mysqli_num_rows($resultadoo);

        foreach ($resultadoo as $row)
        {
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


        $consulta9 = "INSERT INTO `factura_compra`(`COD_COMPRA`, `CEDULA`, `NUM_VUELO`, `ORIGEN`, `DESTINO`, `FECHA_SALIDA`, `HORA_SALIDA`, `FECHA_LLEGADA`, `HORA_LLEGADA`, `NUM_PASAJEROS`, `CLASE_ASIENTOS`, `PRECIO`, `TOTAL`) VALUES ('$cod_compra', '$cedula', '$id', '$origen', '$destino', '$fecha_salida', '$hora_salida', '$fecha_llegada', '$hora_llegada', '$num_pasajeros', '$clase_asiento', '$precio', '$total')";
        $resultado9 = mysqli_query($conectar, $consulta9);


        if($consulta9 == false)
        {
            echo "<script>alert('Error al procesar la petición, intentelo más tarde.')</script>";
            echo "<script>setTimeout(\"location.href='vuelos.php'\")</script>";
        }
        else
        {
            echo "<script>alert('Has comprado tus boletos con éxito.')</script>";
            echo "<script>setTimeout(\"location.href='perfil.php?correo=$email'\")</script>";
        } 

        mysqli_close($conectar);
    }
    elseif(isset($_POST['mas_reserva']))
    {
        $cod_reserva = random(15);

        $consulta1 = "SELECT ID FROM PASAJERO WHERE EMAIL='$correo'";
        $resultado1 = mysqli_query($conectar, $consulta1); 
        $registros1 = mysqli_num_rows($resultado1);

        foreach ($resultado1 as $row)
        {
            $cedula = $row['ID'];
        }

        $consulta2 = "SELECT * FROM TARJETA WHERE ID='$cedula'";
        $resultado2 = mysqli_query($conectar, $consulta2);
        $registros = mysqli_num_rows($resultado2);

        $num_pasajeros=trim($_POST['num_pasajeros']);
        $total = $precio * $num_pasajeros;
        $clase_asiento=$_REQUEST['clase_asiento'];

        foreach ($resultado2 as $row)
        {
            $numero = $row['NUMERO'];
            $cedula = $row['ID'];
        }

        $consulta3 = "INSERT INTO `reserva`(COD_RESERVA, NUM_TARJETA, NUM_VUELO, NUM_PASAJEROS, TOTAL) VALUES ('$cod_reserva', '$numero', '$id', '$num_pasajeros', '$total')";
        $resultado3 = mysqli_query($conectar, $consulta3);

        $consulta4 = "SELECT * FROM VUELO WHERE NUMERO='$id'";
        $resultado4 = mysqli_query($conectar, $consulta4);
        $registros = mysqli_num_rows($resultado4);
        foreach ($resultado4 as $row)
        {
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

        $consulta9 = "INSERT INTO `factura_reserva`(`COD_RESERVA`, `CEDULA`, `NUM_VUELO`, `ORIGEN`, `DESTINO`, `FECHA_SALIDA`, `HORA_SALIDA`, 
        `FECHA_LLEGADA`, `HORA_LLEGADA`,`NUM_PASAJEROS`, `CLASE_ASIENTOS`, `PRECIO`, `RECARGO`, `TOTAL`) VALUES ('$cod_reserva', '$cedula', 
        '$id', '$origen', '$destino', '$fecha_salida', '$hora_salida', '$fecha_llegada', '$hora_llegada', '$num_pasajeros', '$clase_asiento', 
        '$precio', '500000', '$total')";
        $resultado9 = mysqli_query($conectar, $consulta9);




        if($consulta9 == false)
        {
            echo "<script>alert('Error al procesar la petición, intentelo más tarde.')</script>";
            echo "<script>setTimeout(\"location.href='vuelos.php'\")</script>";
        }
        else
        {
            echo "<script>alert('Has reservado tus boletos con éxito.')</script>";
            echo "<script>setTimeout(\"location.href='perfil.php?correo=$correo'\")</script>";
        }

        mysqli_close($conectar);
    }
    elseif(isset($_POST['mas_compra']))
    {
        $cod_compra = random(15);

        $consulta1 = "SELECT ID FROM PASAJERO WHERE EMAIL='$correo'";
        $resultado1 = mysqli_query($conectar, $consulta1); 
        $registros1 = mysqli_num_rows($resultado1);

        foreach ($resultado1 as $row)
        {
            $cedula = $row['ID'];
        }

        $consulta2 = "SELECT * FROM TARJETA WHERE ID='$cedula'";
        $resultado2 = mysqli_query($conectar, $consulta2);
        $registros = mysqli_num_rows($resultado2);

        $num_pasajeros=trim($_POST['num_pasajeros']);
        $total = $precio * $num_pasajeros;
        $clase_asiento=$_REQUEST['clase_asiento'];

        foreach ($resultado2 as $row)
        {
            $numero = $row['NUMERO'];
            $cedula = $row['ID'];
        }

        $consulta3 = "INSERT INTO `compra`(`COD_COMPRA`, `NUM_TARJETA`, `NUM_VUELO`, `NUM_PASAJEROS`, `TOTAL`) VALUES ('$cod_compra', '$numero', '$id', '$num_pasajeros', '$total')";
        $resultado3 = mysqli_query($conectar, $consulta3);

        $consulta4 = "SELECT * FROM VUELO WHERE NUMERO='$id'";
        $resultado4 = mysqli_query($conectar, $consulta4);
        $registros = mysqli_num_rows($resultado4);
        foreach ($resultado4 as $row)
        {
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

        $consulta9 = "INSERT INTO `factura_compra`(`COD_COMPRA`, `CEDULA`, `NUM_VUELO`, `ORIGEN`, `DESTINO`, `FECHA_SALIDA`, `HORA_SALIDA`, `FECHA_LLEGADA`, `HORA_LLEGADA`, `NUM_PASAJEROS`, `CLASE_ASIENTOS`, `PRECIO`, `TOTAL`) VALUES ('$cod_compra', '$cedula', '$id', '$origen', '$destino', '$fecha_salida', '$hora_salida', '$fecha_llegada', '$hora_llegada', '$num_pasajeros', '$clase_asiento', '$precio', '$total')";
        $resultado9 = mysqli_query($conectar, $consulta9);




        if($consulta9 == false)
        {
            echo "<script>alert('Error al procesar la petición, intentelo más tarde.')</script>";
            echo "<script>setTimeout(\"location.href='vuelos.php'\")</script>";
        }
        else
        {
            echo "<script>alert('Has comprado tus boletos con éxito.')</script>";
            echo "<script>setTimeout(\"location.href='perfil.php?correo=$correo'\")</script>";
        }

        mysqli_close($conectar);
    }

?>