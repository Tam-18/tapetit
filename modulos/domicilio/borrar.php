<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

if (isset($_GET['id'])) {
	$id_domicilio = $_GET['id'];
} else {
	die('No se especifico el id de domicilio');
}

$consulta = "SELECT ID_PERSONA FROM domicilio WHERE ID_DOMICILIO = $id_domicilio";
$resultado_persona = mysqli_query($conexion,$consulta);
$datos_persona = mysqli_fetch_array($resultado_persona);
$id_persona = $datos_persona['ID_PERSONA'];

$consulta = "DELETE FROM domicilio WHERE ID_DOMICILIO = $id_domicilio";

if (!$resultado = mysqli_query($conexion,$consulta)) {
	die('Error al dar de baja a persona');
}

header("Location: listado.php?id=$id_persona");


?>