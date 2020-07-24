<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

if (isset($_GET['id'])) {
	$id_domicilio = $_GET['id'];
	$consulta = "SELECT * FROM domicilio WHERE ID_DOMICILIO = $id_domicilio";

	if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
		die("No se encontraron domicilio");	
	}
	$datos_domicilio = mysqli_fetch_array($resultado);
	$id_persona = $datos_domicilio['ID_PERSONA'];
	$descripcion = $datos_domicilio['DESCRIPCION'];
	$barrio = $datos_domicilio['BARRIO'];
	$altura = $datos_domicilio['ALTURA'];
	$piso = $datos_domicilio['PISO'];
	$manzana = $datos_domicilio['MANZANA'];
	$sector = $datos_domicilio['SECTOR'];
	$casa = $datos_domicilio['CASA'];
	$calle = $datos_domicilio['CALLE'];
	$obsevaciones = $datos_domicilio['OBSERVACIONES'];
} else {
	die('No se especifico el id de cliente');
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Domicilio</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
	<h1>Domicilio - Modificar</h1>
	<p>
		<a href="listado.php">Volver</a>
	</p>
	<div align="center">
		<p>
			<form action="modi_alta.php" method="post">
				<input type="hidden" name="id_persona" value="<?php echo $id_persona ?>">
				<input type="hidden" name="id_domicilio" value="<?php echo $id_domicilio ?>">
				<p>
					<label>Descripcion: </label>
					<input type="text" name="Descripcion" value="<?php echo $descripcion ?>">
				</p>
				<p>
					<label>Barrio: </label>
					<input type="text" name="Barrio" value="<?php echo $barrio ?>">
				</p>
				<p>
					<label>Altura: </label>
					<input type="number" name="Altura" min="0" value="<?php echo $altura ?>">
				</p>
				<p>
					<label>Piso: </label>
					<input type="number" name="Piso" min="0" value="<?php echo $piso ?>">
				</p>
				<p>
					<label>Manzana: </label>
					<input type="text" name="Manzana" value="<?php echo $manzana ?>">
	
				</p>
				<p>
					<label>Sector: </label>
					<input type="text" name="Sector" value="<?php echo $sector ?>">
	
				</p>
				<p>
					<label>Casa: </label>
					<input type="number" name="Casa" min="0" value="<?php echo $casa ?>">
	
				</p>
				<p>
					<label>Calle: </label>
					<input type="text" name="Calle" value="<?php echo $calle ?>">
	
				</p>
				<p>
					<label>Observaciones: </label>
					<input type="text" name="Observaciones" value="<?php echo $obsevaciones ?>">
	
				</p>
				<p>
					<button>Guardar</button>
				</p>
			</form>
		</p>
	</div>
</body>
</html>