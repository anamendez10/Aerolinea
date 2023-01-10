<?php
    ob_start();
    require 'config/conexion.php';
    include("config/conexion.php");

    $confirmacion = NULL;

    if(isset($_POST['subir']))
    {
        $email=trim($_POST['correo']);
        $password=trim($_POST['contrasena']);
        $confirm_password=trim($_POST['confirmar_contrasena']);

        #$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT); #<==    encrypto

        $validacion = "SELECT * FROM USUARIO WHERE CORREO = '$email'";
        $resultado1 = mysqli_query($conectar, $validacion);
        $registros = mysqli_num_rows($resultado1);


        if($registros > 0)
        {
            echo "<script>alert('Ya tienes una cuenta, inicia sesión!')</script>";
            echo "<script>setTimeout(\"location.href='login.php'\")</script>";
        }
        else if($password == $confirm_password)
        {
            $consulta = "INSERT INTO `usuario`(CORREO, CONTRASENA) VALUES ('$email', '$password')";
            $resultado = mysqli_query($conectar, $consulta);

            if($resultado)
            {
                echo "<script>alert('Te has registrado exitosamente')</script>";
                echo "<script>setTimeout(\"location.href='vuelos.php'\")</script>";
            }
            else
            {
                echo "<script>alert(Error al procesar la petición, intenta más tarde')</script>";
                echo "<script>setTimeout(\"location.href='login.php'\")</script>";
            }
            
        }
        else
        {
            echo "<script>alert('Las contraseñas no coinciden, intentalo de nuevo')</script>";
            echo "<script>setTimeout(\"location.href='index.php'\")</script>";
        }
        mysqli_close($conectar);
    }
?>