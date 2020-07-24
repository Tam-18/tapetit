<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

if (isset($_GET['id'])) {
	$id_persona = $_GET['id'];
} else {
	die('No se especifico el id de persona');
}

$consulta = "UPDATE personas set estado = 0 where id_persona = $id_persona";

if (!$resultado = mysqli_query($conexion,$consulta)) {
	die('Error al dar de baja a persona');
}

header("Location: listado.php");


?>