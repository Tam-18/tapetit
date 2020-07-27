<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

if (isset($_POST['categoria'],$_POST['iva'],$_POST['costo'],$_POST['nombre']) and !empty($_POST['categoria']) and !empty($_POST['iva']) and !empty(['costo']) and !empty($_POST["nombre"])) {
	
	$nombre = $_POST['nombre'];
	$categoria = $_POST['categoria'];
	$iva = $_POST['iva'];
	$costo = $_POST['costo'];
	$receta=$_POST['receta'];

} else {
	header("Location: nuevo.php?error=faltan_datos");
}
//VALIDACION PARA QUE NO SE ENCUENTREN VACIOS LOS DATOS
//SI NO ESTAN VACIOS SE GUARDAN


$consulta_receta = "UPDATE receta values  SET nombre='$nombre',costo='$costo',rela_iva=$iva, rela_categoria=$categoria,estado=1 where id_receta=$receta";

if ($resultado = mysqli_query($conexion,$consulta_receta)) {
	$id_persona = mysqli_insert_id($conexion);
}else{
	die('Error al registrar Producto');
}

if ($resultado = mysqli_query($conexion,$consulta_receta)) {
header("Location: listado.php");	
}
?>