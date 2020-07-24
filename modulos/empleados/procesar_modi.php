<?php

require '../../php/conexion.php';
require '../../funciones/funciones.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../../login.php?error=iniciar_sesion");
	exit();
}

$id_persona = $_POST['id_persona'];
$id_empleado = $_POST['id_empleado'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$sexo = $_POST['sexo'];
$cbocargo = $_POST['cbocargo'];


$consulta = "UPDATE personas SET nombre = '$nombre',
					apellido = '$apellido', 
					dni = $dni, 
					sexo = '$sexo'
					WHERE id_persona = $id_persona";

if ($resultado = mysqli_query($conexion,$consulta)) {
	$id_persona = mysqli_insert_id($conexion);
}else {
	die('Error al actualizar persona');
}

$consultaCliente = "UPDATE empleados SET id_cargo = $cbocargo,
					fecha_ingreso = '$fecha_ingreso'
WHERE rela_persona=$id_persona";

if ($resultado = mysqli_query($conexion, $consultaCliente)) {
	header("Location: listado.php");	
} else{
	die('Error al actualizar cliente');
}

?>