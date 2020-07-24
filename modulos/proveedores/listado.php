<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

$consulta = "SELECT id_proveedor, id_persona_juridica, razon_social, fecha_inicio
				FROM proveedores INNER JOIN persona_juridica ON rela_persona_juridica = id_persona_juridica
					WHERE estado=1;";
?>

<!DOCTYPE html>
<html>
<head>
	<title>PROVEEDORES</title>
	<link rel="stylesheet" type="text/css" href="../../css/estilo.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>	
	<h1>PROVEEDORES</h1>
	<p>
		<a href="nuevo.php" class="btn btn-light">Nuevo</a> | 
		<a href="../../index.php" class="btn btn-light">Volver</a>
	</p>
	<br>
	<div align="center">
		<div>
			<?php
			if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
					die("No se encontraron proveedores");
			} 
			?>
			<div class="container">
			<table class='table table-striped'> 
				<thead>
					<tr>
						<th scope="col">Razon Social</th>
						<th scope="col">Fecha de Inicio</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($datos = mysqli_fetch_array($resultado)) { ?>
						<tr>
							<td><?php echo $datos['razon_social'] ?></td>
							<td><?php echo $datos['fecha_inicio'] ?></td>
							<td>
								<a href="modificar.php?id=<?php echo $datos['id_proveedor']; ?>">Modificar</a> | 
								<a onclick="return confirm('Esta seguro que desea dar de baja a este proveedor?')"
								href="borrar.php?id=<?php echo $datos['id_proveedor']; ?>">Baja</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</body>
</html>