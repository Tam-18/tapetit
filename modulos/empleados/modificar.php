<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

if (isset($_GET['id'])) {
	$id_empleado = $_GET['id'];
	$consulta = "SELECT * FROM personas P JOIN empleados  ON rela_persona = P.ID_PERSONA 
	INNER JOIN cargos ON cargos.id_cargo=empleados.id_cargo
	WHERE id_empleado = $id_empleado";

	if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
		die("No se encontraron empleados");	
	}
	$datos_empleado = mysqli_fetch_array($resultado);
	$id_persona = $datos_empleado['id_persona'];
	$id_empleado = $datos_empleado['id_empleado'];
	$nombre = $datos_empleado['nombre'];
	$apellido = $datos_empleado['apellido'];
	$dni = $datos_empleado['dni'];
	$fecha_ingreso = $datos_empleado['fecha_ingreso'];
	$sexo = $datos_empleado['sexo'];
} else {
	die('No se especifico el id de empleado');
}

$queryCargo = "SELECT * from cargos";
$resultado_cargo = mysqli_query($conexion,$queryCargo);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Empleado</title>
</head>
<body>
	<h1>Empleados - Modificar</h1>
	<p>
		<a href="nuevo.php">Nuevo</a> |
		<a href="listado.php">Volver</a>
	</p>
	<div align="center">
		<p>
			<form action="procesar_modi.php" method="post">
				<input type="hidden" name="id_persona" value="<?php echo $id_persona ?>">
				<input type="hidden" name="id_empleado" value="<?php echo $id_empleado ?>">
				<p>
					<label>Nombre: </label>
					<input type="text" name="nombre" value="<?php echo $nombre ?>">
				</p>
				<p>
					<label>Apellido: </label>
					<input type="text" name="apellido" value="<?php echo $apellido ?>">
				</p>
				<p>
					<label>DNI: </label>
					<input type="text" name="dni" value="<?php echo $dni ?>">
				</p>
				<p>
					<label>Fecha de Ingreso: </label>
					<input type="date" value="<?php echo $fecha_ingreso; ?>" name="fecha_ingreso">
				</p>
				<p>
					<label>Sexo</label>
					<select name="sexo">
						<?php if ($sexo == 'Masculino') { ?>
							<option selected value="Masculino">Masculino</option>
						<?php } else { ?>
							<option value="Masculino">Masculino</option>
						<?php } ?>
						<?php if ($sexo == 'Femenino') { ?>
							<option selected value="Femenino">Femenino</option>
						<?php } else { ?>
							<option value="Femenino">Femenino</option>
						<?php } ?>
					</select>
				</p>
				<p>Cargo:
				<select name="cbocargo">
					<option value="0">--Seleccionar</option>
					<?php while($datos_cargo = mysqli_fetch_array($resultado_cargo)) :?>
						<?php if ($datos_cargo['id_cargo'] == $datos_empleado['id_cargo']){?>
							<option selected value="<?php echo $datos_empleado['id_cargo']; ?>"><?php echo utf8_encode ($datos_empleado['cargo_descripcion']);?></option>
						<?php } else{?>
						<option value="<?php echo $datos_cargo['id_cargo']?>"><?php echo utf8_encode($datos_cargo['cargo_descripcion'])?></option>
					<?php } ?>
				<?php endwhile; ?>
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