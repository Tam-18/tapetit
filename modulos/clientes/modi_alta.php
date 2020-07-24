<?php

require '../../php/conexion.php';
require '../../funciones/funciones.php';
session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../../login.php?error=iniciar_sesion");
	exit();
}

$id_persona = $_POST['id_persona'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$sexo = $_POST['sexo'];
$fecha_ingreso = $_POST['fecha_ingreso'];

$consulta = "UPDATE personas SET nombre = '$nombre',
					apellido = '$apellido', 
					dni = $dni,
					sexo = '$sexo'
					WHERE id_persona = $id_persona";
					
if ($resultado = mysqli_query($conexion,$consulta)) {
	echo "<p>Registro modificado con exito</p>";
}else{
	die('Error al actualizar persona');	
}

$queryId_persona = "select id_cliente from clientes where rela_persona = $id_persona";
$resultadoId = mysqli_query($conexion, $queryId_persona);
$data1 = $resultadoId->fetch_array(MYSQLI_BOTH);
$id_cliente = $data1['id_cliente'];

$consultaCliente = "update clientes set fecha_ingreso = '$fecha_ingreso' where id_cliente = $id_cliente";

if ($resultado = insertar($conexion, $consultaCliente)) {
	echo "Registro Moidificado con Exito";
	}




header("Location: listado.php");

?>