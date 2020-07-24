<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

$id_persona = $_POST['id_persona'];
$id_contacto = $_POST['id_contacto'];

if (isset($_POST['descripcion']) and !empty($_POST['descripcion'])) {
	$descripcion = $_POST['descripcion'];
} else {
	header("Location: modificar.php?id=$id_domicilio&error=faltan_datos");
}

$cboTipo = $_POST['cboTipo'];

$consulta = "UPDATE contactos SET DESCRIPCION = '$descripcion', ID_TIPO_CONTACTO = $cboTipo WHERE ID_CONTACTO = $id_contacto ";

if (!$resultado = mysqli_query($conexion,$consulta)) {
	die('Error al actualizar contacto');
}

header("Location: listado.php?id=$id_persona");

?>