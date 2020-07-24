<?php

session_start();


if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
	<h1>Nuevo Cliente</h1>

		<a href="listado.php">Volver</a>
	</p>
	<div align="center">
		<p>
			<form class= 'form' action="alta.php" method="post">
				<p>
					<label>Nombre: </label>
					<input type="text" name="nombre">
				</p>
				<p>
					<label>Apellido: </label>
					<input type="text" name="apellido">
				</p>
				<p>
					<label>DNI: </label>
					<input type="text" name="dni">
				</p>
				<p>
					<label>Fecha de Ingreso</label>
					<input type="date" name="fecha_ingreso">
				</p>
				<p>
					<label>Sexo</label>
					<select name="sexo">
						<option value="Masculino">Masculino</option>
						<option value="Femenino">Femenino</option>
					</select>
				</p>
				<p>
					<button type="submit">Guardar</button>
				</p>
			</form>
		</p>
	</div>
</body>
</html>