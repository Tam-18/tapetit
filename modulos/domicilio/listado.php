<?php

require '../../php/conexion.php';

session_start();



if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}
$id= $_GET['id'];

$consulta = "SELECT * FROM domicilio D WHERE id_persona=$id";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Clientes</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>	
	<h1>Cliente</h1>
	<p>
		<a href="nuevo.php?id=<?php echo $id; ?>">Nuevo</a> | 
		<a href="../../dashboard.php">Volver</a>
	</p>
	<br>
	<div align="center">
		<div>
			<?php
			if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
					die("No se encontraron Domicilio");
			} 
			?>
			<table class='tabla'> 
				<thead>
					<tr>
						
						<th>ID</th>
						<th>Descripcion</th>
						<th>Barrio</th>
						<th>Altura</th>
						<th>Piso</th>
						<th>Manzana</th>
						<th>Sector</th>
						<th>Casa</th>
						<th>Calle</th>					
						<th>Observaciones</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($datos = mysqli_fetch_array($resultado)) { ?>
						<tr>
						
							<td><?php echo $datos['ID_DOMICILIO'] ?></td>
							<td><?php echo $datos['DESCRIPCION'] ?></td>
							<td><?php echo $datos['BARRIO'] ?></td>
							<td><?php echo $datos['ALTURA'] ?></td>
							<td><?php echo $datos['PISO'] ?></td>
							<td><?php echo $datos['MANZANA'] ?></td>
							<td><?php echo $datos['SECTOR'] ?></td>
							<td><?php echo $datos['CASA'] ?></td>
							<td><?php echo $datos['CALLE'] ?></td>
							<td><?php echo $datos['OBSERVACIONES'] ?></td>
							<td>

								<a href="modificar.php?id=<?php echo $datos['ID_DOMICILIO']; ?>">Modificar</a>| 
								<a onclick="return confirm('Esta seguro que desea dar de baja a este Domicilio?')"
								href="borrar.php?id=<?php echo $datos['ID_DOMICILIO']; ?>">Baja</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>