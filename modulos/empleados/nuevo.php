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
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="../../css/css_alta.css">



</head>
<body>
	<!--
	<p>
		<a href="listado.php">Volver</a>
	</p>-->
	<div class="container">
		<div class="content">
			<div class="cadastro">
			<form action="alta.php" method="post">
				<h1>NUEVO EMPLEADO</h1>

				<div class="row">
					<div class="col-md-6">
						<p>
					<label>Nombre: </label>
					<input type="text" name="nombre">
				</p>
					</div>
					<div class="col-md-6">
						<p>
					<label>Apellido: </label>
					<input type="text" name="apellido">
				</p>
					</div>
				</div>
				<p></p>
				<div class="row">
					<div class="col-md-6">
						<p>
					<label>DNI: </label>
					<input type="text" name="dni">
				</p>
					</div>
					<div class="col-md-6">
						
				<p>
					<label>Fecha de Ingreso</label>
					<input type="date" name="fecha_ingreso">
				</p>
					</div>

				</div>
				<p></p>
				<div class="row">
					<div class="col-md-6">
						<p>
					<label>Sexo</label>
					<select name="sexo">
						<option value="Masculino">Masculino</option>
						<option value="Femenino">Femenino</option>
					</select>
				</p>
					</div>
					<div class="col-md-6">
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
					</div>

				</div>
				<p></p>
				<p>
					<input type="submit" value="Guardar Datos" name="guardar">
				</p>
				
			</form>
			</div>
			
		</div>
	</div>
</body>
</html>