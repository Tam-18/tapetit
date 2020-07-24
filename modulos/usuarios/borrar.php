<?php

require '../../php/conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM usuario WHERE ID_USUARIO = $id";

if ($rs_delete = mysqli_query($conexion,$sql)) {
	header('location: listado.php?mensaje=USUARIO_DELETE');
	exit();
} else {
	header('location: listado.php?mensaje=USUARIO_ERROR_DELETE');
	exit;
}

?>