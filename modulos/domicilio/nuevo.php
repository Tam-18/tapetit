<?php

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

// Id de la persona para el nuevo domicilio en la base de datos
$id = $_GET['id'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Domicilio</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
	<h1>Domicilio - Nuevo</h1>
	<p><?php require_once '../../php/menu.php' ?></p>
	<p>
		<a href="listado.php">Volver</a>
	</p>
	<div align="center">
		<p>
			<form class= 'form' action="alta.php" method="post">
				<input type="hidden" name="id_persona" value="<?php echo $id; ?>">
				<p>
					<label>Descripcion: </label>
					<input type="text" name="Descripcion">
				</p>
				<p>
					<label>Barrio: </label>
					<input type="text" name="Barrio">
				</p>
				<p>
					<label>Altura: </label>
					<input type="number" name="Altura" min="0">
				</p>
				<p>
					<label>Piso: </label>
					<input type="number" name="Piso" min="0">
				</p>
				<p>
					<label>Manzana: </label>
					<input type="text" name="Manzana">
	
				</p>
				<p>
					<label>Sector: </label>
					<input type="text" name="Sector">
	
				</p>
				<p>
					<label>Casa: </label>
					<input type="number" name="Casa" min="0">
	
				</p>
				<p>
					<label>Calle: </label>
					<input type="text" name="Calle">
	
				</p>
				<p>
					<label>Observaciones: </label>
					<input type="text" name="Observaciones">
	
				</p>
				<p>
					<button>Guardar</button>
				</p>
			</form>
		</p>
	</div>
</body>
</html>