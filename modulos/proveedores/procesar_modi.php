<?php

require '../../php/conexion.php';
require '../../funciones/funciones.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../../login.php?error=iniciar_sesion");
	exit();
}

$id_persona_juridica = $_POST['id_persona_juridica'];
	$id_proveedor = $_POST['id_proveedor'];
	$razon_social = $_POST['razon_social'];
	$cuil = $_POST['cuil'];
	$fecha_inicio = $_POST['fecha_inicio'];


$consulta = "UPDATE persona_juridica SET razon_social = '$razon_social',
					cuil = '$cuil', 
					fecha_inicio = '$fecha_inicio',
					estado = '$estado'
					WHERE estado=1";

if ($resultado = mysqli_query($conexion,$consulta)) {
	$id_persona = mysqli_insert_id($conexion);
}else {
	die('Error al actualizar proveedor');
}

$consultaCliente = "UPDATE proveedores SET id_proveedor = $id_proveedor 
WHERE rela_persona_juridica=$id_persona_juridica";

if ($resultado = mysqli_query($conexion, $consultaCliente)) {
	header("Location: listado.php");	
} else{
	die('Error al actualizar Proveedor');
}

?>