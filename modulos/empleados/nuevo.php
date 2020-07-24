<?php
require '../../php/conexion.php';


session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

$queryCargo = "SELECT * FROM cargos";
$resultado = mysqli_query($conexion,$queryCargo);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Empleado</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
	<h1>NUEVO EMPLEADO</h1>
	<p>
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
					<label>Cargo</label>
					<select name="cbocargo">
						<option value="0">Seleccionar</option>
						<?php while($datos=mysqli_fetch_array($resultado)) :?>
						<option value="<?php echo($datos['id_cargo']);?>">
							<?php echo($datos['cargo_descripcion']);?>
						</option>
					<?php endwhile ?>
					</select>
				</p>

				<p>
					<button>Guardar</button>
				</p>
			</form>
		</p>
	</div>
</body>
</html>