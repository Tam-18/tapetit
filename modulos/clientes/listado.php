<?php

require '../../php/conexion.php';


session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

$consulta = "SELECT id_cliente, id_persona, nombre, apellido, dni, estado, sexo, fecha_ingreso
			FROM personas INNER JOIN clientes ON  id_persona=rela_persona
			WHERE estado = 1"; // TRAE LOS CLIENTES QUE ESTAN ACTIVOS

?>

<!DOCTYPE html>
<html>
<head>
	<title>CLIENTES</title>
	<link rel="stylesheet" type="text/css" href="../../css/estilo.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>	
	<h1>CLIENTES</h1>

	<p>
		<a href="nuevo.php" class="btn btn-light">Nuevo</a> | 
		<a href="../../index.php" class="btn btn-light">Volver</a>
	</p>
	<br>
	
	<div align="center">
		<div>
			<?php
			if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
					die("No se encontraron clientes");
			} 
			?>
			<div class="container">
			<table class='table table-striped'> 
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nombre</th>
						<th scope="col">Apellido</th>
						<th scope="col">DNI</th>
						<th scope="col">Fecha de Ingreso</th>
						<th scope="col">Sexo</th>
						<th scope="col">Contacto</th>
						<th scope="col">Domicilio</th>
						<th scope="col">Acciones</th>					
					</tr>
				</thead>
				<tbody>
					<?php while ($datos = mysqli_fetch_array($resultado)) { ?>
						<tr>
							<td><?php echo $datos['id_cliente'] ?></td>
							<td><?php echo $datos['nombre'] ?></td>
							<td><?php echo $datos['apellido'] ?></td>
							<td><?php echo $datos['dni'] ?></td>
							<td><?php echo $datos['fecha_ingreso'] ?></td>
							<td><?php echo $datos['sexo'] ?></td>
							<td> 
								<a href="../contactos/listado.php?id=<?php echo $datos['id_persona']?>"> Ver</a>
							</td>
							<td> 
								<a href="../domicilio/listado.php?id=<?php echo $datos['id_persona']?>"> Ver</a>
							</td>
							<td>
								<a href="modificar.php?id=<?php echo $datos['id_cliente']; ?>">Modificar</a>| 
								<a onclick="return confirm('Esta seguro que desea dar de baja a este cliente?')"
								href="borrar.php?id=<?php echo $datos['id_persona']; ?>">Baja</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
</body>
</html>