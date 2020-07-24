<?php

require '../../php/conexion.php';
require '../../funciones/funciones.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

if (isset($_POST['razon_social'],$_POST['cuil'],$_POST['fecha_inicio']) and !empty($_POST['razon_social']) and !empty($_POST['cuil']) and !empty(['fecha_inicio'])) {
	
	$razon_social = $_POST['razon_social'];
	$cuil = $_POST['cuil'];
	$fecha_inicio = $_POST['fecha_inicio'];

} else {
	header("Location: nuevo.php?error=faltan_datos");
}

$consultaPerju = "INSERT INTO persona_juridica values 
			(NULL,'$razon_social','$cuil',$fecha_inicio,1)";

if ($resultado = mysqli_query($conexion,$consultaPerju)) {
	$id_persona_juridica = mysqli_insert_id($conexion);
}else{
	die('Error al registrar persona');
}


$consulta = "INSERT INTO proveedores values (NULL,$id_persona_juridica)";

if ($resultado = mysqli_query($conexion,$consulta)) {
header("Location: listado.php");	
}else{
	die('Error al registrar empleado');
}
echo $consulta;
exit;
?>