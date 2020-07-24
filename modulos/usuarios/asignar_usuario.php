<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION["logueado"])) {
	header("location: iniciar_sesion.php?error=debe_loguearse");
	exit;
}

$empleado_id = $_POST['txtEmpleadoID'];
$usuario_id = $_POST['txtUsuarioID'];
$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];
$email = $_POST['txtEmail'];
$perfil_id = $_POST['cboPerfil'];


if ((int)$usuario_id == 0) {
	// CREAR NUEVO USUARIO
	$sql = "INSERT INTO usuario VALUES
			(NULL,'$username','$password','$email',$empleado_id,$perfil_id)";
} else {
	// MODIFICAR USUARIO EXISTENTE
	$sql = "UPDATE usuario SET usuario = '$username', clave = '$password',
			email = '$email', id_perfil = $perfil_id
	     	WHERE id_usuario = " . $usuario_id;
}

// si no puedo crear/modificar, redirecciono al formulario con mensaje de error
if (!mysqli_query($conexion, $sql)) {
	$mensaje = 'USUARIO_ERROR';
	header("location: ../empleados/usuario.php?id_empleado=$empleado_id&mensaje=$mensaje");
	exit;
}


$mensaje = 'USUARIO_OK';
header("location: ../empleados/listado.php?mensaje=$mensaje");

?>