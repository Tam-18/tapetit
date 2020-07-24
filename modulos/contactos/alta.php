<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

$id_persona = (int) $_POST['id_persona'];
$cboTipo = (int) $_POST['cboTipo'];

if (isset($_POST['descripcion']) and !empty($_POST['descripcion'])) {
	$descripcion = $_POST['descripcion'];

	$consulta = "INSERT INTO contactos VALUES (NULL,'$descripcion',$cboTipo)";

	if ($resultado = mysqli_query($conexion,$consulta)) {
		$id_contacto = mysqli_insert_id($conexion);
		$consulta2 = "INSERT INTO personas_contacto VALUES ($id_persona, $id_contacto)";
		if ($resultado = mysqli_query($conexion, $consulta2)) {
			$respuesta = ['codigo' => 200, 'mensaje' => 'El contacto se creo con exito'];
		} else{
			$respuesta = ['codigo' => 500, 'mensaje' => 'Hubo un error al asociar el contacto'];
		}
	} else{
		$respuesta = ['codigo' => 500, 'mensaje' => 'Hubo un error al crear el contacto'];
	}


} else {
	$respuesta = ['codigo' => 500, 'mensaje' => 'Falta completar el formulario'];
}

echo json_encode($respuesta, JSON_FORCE_OBJECT);


?>