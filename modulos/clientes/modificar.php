<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

if (isset($_GET['id'])) {
	$id_cliente = $_GET['id'];
	$consulta = "SELECT * FROM personas P JOIN Clientes C ON C.rela_persona = P.id_persona WHERE C.id_cliente = $id_cliente";

	if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
		die("No se encontraron cliente");	
	}
	$datos_cliente = mysqli_fetch_array($resultado);
	$id_persona = $datos_cliente['id_persona'];
	$nombre = $datos_cliente['nombre'];
	$apellido = $datos_cliente['apellido'];
	$dni = $datos_cliente['dni'];
	$fecha_ingreso = $datos_cliente['fecha_ingreso'];
	$sexo = $datos_cliente['sexo'];
} else {
	die('No se especifico el id de cliente');
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Cliente</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
	<h1>Clientes - Modificar</h1>
	<p>
		<a href="nuevo.php">Nuevo</a> |
		<a href="listado.php">Volver</a>
	</p>
	<div align="center">
		<p>
			<form action="modi_alta.php" method="post">
				<input type="hidden" name="id_persona" value="<?php echo $id_persona ?>">
				<input type="hidden" name="id_cliente" value="<?php echo $id_cliente ?>">
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
				<p>
					<button>Guardar</button>
				</p>
			</form>
		</p>
	</div>
</body>
</html>