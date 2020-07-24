<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

$id_persona = $_POST['id_persona'];

$descripcion = NULL;
$piso = 'NULL';
$manzana = NULL;
$sector = NULL;
$casa = 'NULL';
$observaciones = NULL;

if (isset($_POST['Barrio'],$_POST['Altura'],$_POST['Calle']) and !empty($_POST['Barrio']) and !empty($_POST['Altura']) and !empty(['Calle'])) {
	
	$barrio = $_POST['Barrio'];
	$altura = $_POST['Altura'];
	$calle = $_POST['Calle'];
} else {
	header("Location: nuevo.php?id=$id_persona&error=faltan_datos");
	exit();
}

if (isset($_POST['Descripcion']) and !empty($_POST['Descripcion'])) {
	$descripcion = $_POST['Descripcion'];
}

if (isset($_POST['Piso']) and !empty($_POST['Piso'])) {
	$piso = $_POST['Piso'];
}

if (isset($_POST['Manzana']) and !empty($_POST['Manzana'])) {
	$manzana = $_POST['Manzana'];
}

if (isset($_POST['Sector']) and !empty($_POST['Sector'])) {
	$sector = $_POST['Sector'];
}

if (isset($_POST['Casa']) and !empty($_POST['Casa'])) {
	$casa = $_POST['Casa'];
}

if (isset($_POST['Observaciones']) and !empty($_POST['Observaciones'])) {
	$observaciones = $_POST['Observaciones'];
}

$consulta = "INSERT INTO domicilio values 
			(NULL,'$descripcion',$id_persona,'$barrio',$altura,$piso,'$manzana','$sector
			',$casa,'$calle','$observaciones')";

if (!$resultado = mysqli_query($conexion,$consulta)) {
	die('Error al registrar domicilio');
}

header("Location: listado.php?id=$id_persona");

?>