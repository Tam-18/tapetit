<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

if (isset($_GET['id'])) {
	$id_contacto = $_GET['id'];
} else {
	die('No se especifico el id de contacto');
}

$consulta = "SELECT ID_PERSONA FROM contactos WHERE ID_CONTACTO = $id_contacto";
$resultado_persona = mysqli_query($conexion,$consulta);
$datos_persona = mysqli_fetch_array($resultado_persona);
$id_persona = $datos_persona['ID_PERSONA'];

$consulta = "DELETE FROM contactos WHERE ID_CONTACTO = $id_contacto";

if (!$resultado = mysqli_query($conexion,$consulta)) {
	die('Error al borrar contacto');
}

header("Location: listado.php?id=$id_persona");


?>