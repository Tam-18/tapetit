<?php
require '../../php/conexion.php';


session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

$queryPerju = "SELECT * FROM persona_juridica";
$resultado = mysqli_query($conexion,$queryPerju);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Proveedor</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">

</head>
<body>
	<h1>NUEVO PROVEEDOR</h1>
	<p>
		<a href="listado.php">Volver</a>
	</p>
	<div align="center">
		<table class='table table-striped'> 

		<p>
			<form class= 'form' action="alta.php" method="post">
				<p>
					<label>Razon Social: </label>
					<input type="text" name="razon_social">
				</p>
				<p>
					<label>Cuil/Ciut: </label>
					<input type="text" name="cuil">
				</p>
				<p>
					<label>Fecha de Inicio</label>
					<input type="date" name="fecha_inicio">
				</p>
				<p>
					<button>Guardar</button>
				</p>
			</form>
		</p>
	</table>
	</div>
</body>
</html>