<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

if (isset($_POST['nombre'],$_POST['apellido'],$_POST['dni'],$_POST['fecha_ingreso'],$_POST['dni'],$_POST['sexo']) and !empty($_POST['nombre']) and !empty($_POST['apellido']) and !empty(['dni']) and !empty($_POST['fecha_ingreso']) and !empty($_POST['sexo'])) {
	
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$dni = $_POST['dni'];
	$fecha_ingreso = $_POST['fecha_ingreso'];
	$sexo = $_POST['sexo'];

} else {
	header("Location: nuevo.php?error=faltan_datos");
}
//VALIDACION PARA QUE NO SE ENCUENTREN VACIOS LOS DATOS
//SI NO ESTAN VACIOS SE GUARDAN


$consultaPersona = "INSERT INTO personas values 
			(NULL,'$nombre','$apellido',$dni,1,'$sexo')";

if ($resultado = mysqli_query($conexion,$consultaPersona)) {
	$id_persona = mysqli_insert_id($conexion);
}else{
	die('Error al registrar persona');
}


$consulta = "INSERT INTO clientes values (NULL,$id_persona,'$fecha_ingreso')";

if ($resultado = mysqli_query($conexion,$consulta)) {
header("Location: listado.php");	
}else{
	die('Error al registrar cliente');
}
?>