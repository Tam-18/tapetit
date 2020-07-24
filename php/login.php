<?php

require 'conexion.php';
require '../funciones/obtener_modulos.php';


if(isset($_POST['user'],$_POST['password']) and !empty($_POST['user']) and !empty($_POST['password'])){
	$user = trim($_POST['user']);
	$password = trim($_POST['password']);
} else {
	header("Location: ../login.html?error=campos_vacios");
	exit();
}

$query = "SELECT rela_persona FROM empleados E
INNER JOIN usuarios U on E.id_empleado = U.rela_empleado
WHERE usuario = '$user' AND pass = '$password' ";


if (!$resultado = mysqli_query($conexion,$query) or mysqli_num_rows($resultado)<1) {
	header("Location: ../login.html?error=login_error");
	exit();
}

$datos_rs = mysqli_fetch_array($resultado);
$id_persona = $datos_rs['rela_persona'];

$query = "SELECT nombre, apellido FROM personas
WHERE id_persona = $id_persona
AND estado = 1";



if (!$resultado = mysqli_query($conexion,$query) or mysqli_num_rows($resultado)<1) {
	header("Location: ../login.html?error=usuario_inactivo");
	exit();
}

$datos_U = mysqli_fetch_array($resultado);

session_start();
$_SESSION['logueado'] = true;
$_SESSION['usuario'] = $datos_U['nombre']." ".$datos_U['apellido'];
$_SESSION['id_persona'] = $id_persona;
$modulos = obtener_modulos($id_persona);
$_SESSION['modulos'] = $modulos;

header("Location: ../index.php");

?>s