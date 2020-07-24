<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

if (isset($_GET['id'])) {
	$id_proveedor = $_GET['id'];
	$consulta = "SELECT id_proveedor, id_persona_juridica, razon_social, fecha_inicio, cuil
				FROM proveedores INNER JOIN persona_juridica ON rela_persona_juridica = id_persona_juridica
					WHERE estado=1";

	if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
		die("No se encontraron proveedores");	
	}
	$datos_proveedor = mysqli_fetch_array($resultado);
	$id_persona_juridica = $datos_proveedor['id_persona_juridica'];
	$id_proveedor = $datos_proveedor['id_proveedor'];
	$razon_social = $datos_proveedor['razon_social'];
	$cuil = $datos_proveedor['cuil'];
	$fecha_inicio = $datos_proveedor['fecha_inicio'];
} else {
	die('No se especifico el id de proveedor');
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Proveedores</title>
</head>
<body>
	<h1>MODIFICAR PROVEEDORES</h1>
	<p>
		<a href="nuevo.php">Nuevo</a> |
		<a href="listado.php">Volver</a>
	</p>
	<div align="center">
		<p>
			<form action="modi_alta.php" method="post">
				<input type="hidden" name="id_proveedor" value="<?php echo $id_proveedor?>">
				<input type="hidden" name="id_persona_juridica" value="<?php echo 
				$id_persona_juridica ?>">
				<p>
					<label>Razon Social </label>
					<input type="text" name="razon_social" value="<?php echo $razon_social ?>">
				</p>
				<p>
					<label>Cuil/Cuit: </label>
					<input type="text" name="cuil" value="<?php echo $cuil ?>">
				</p>
				<p>
					<label>Fecha de Inicio: </label>
					<input type="date" value="<?php echo $fecha_inicio; ?>" name="fecha_inicio">
				</p>

				<p>
					<button>Guardar</button>
				</p>
			</form>
		</p>
	</div>
</body>
</html>