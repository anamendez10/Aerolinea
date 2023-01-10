<?php
ob_start();
if(isset($_POST['iniciar']))
{
    session_start();
    
	require '../config/conexion.php'; // Para llamar otro archivo php de la misma carpeta

    global $correo;
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

	/* $correo = $_POST['correo']; // Captura los datos de las variables en el formulario para usarlos en la validación
	$contrasena = $_POST['contrasena']; 
 */

	// CONSULTA
	$consulta = "SELECT * FROM USUARIO WHERE CORREO = '$correo' AND CONTRASENA = '$contrasena'";

    $resultado = mysqli_query($conectar, $consulta);

    $registros = mysqli_num_rows($resultado);

    if($registros)
    {
        $_SESSION["CORREO"] = $correo; // Se crea la sesión del usuario 

        echo "<script>alert('Has iniciado sesión exitosamente.')</script>";
        echo "<script>setTimeout(\"location.href='../vuelos.php'\")</script>";
    }
    else
    {
        echo "<script>alert('El usuario o la contraseña no coinciden')</script>";
        echo "<script>setTimeout(\"location.href='login.php'\")</script>";
    }
}
mysqli_free_result($resultado);
mysqli_close($conectar);
?>