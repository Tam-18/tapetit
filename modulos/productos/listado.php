<?php

require '../../php/conexion.php';


session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

$consulta = "SELECT id_receta, id_categoria, nombre, costo, estado
				FROM receta INNER JOIN categoria ON rela_categoria = id_categoria
					WHERE estado =1;"; // TRAE LOS CLIENTES QUE ESTAN ACTIVOS

?>

<!DOCTYPE html>
<html>
<head>
	<title>PRODUCTOS</title>
	<link rel="stylesheet" type="text/css" href="../../css/estilo.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
</head>
<body>	
	
			<?php
			if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
					die("No se encontraron productos");
			} 
			?>
			<div class="container">
				<h1 class="text-center">PRODUCTOS</h1>

	<p>
		<a href="nuevo.php" class="btn btn-light">Nuevo</a> | 
		<a href="../../index.php" class="btn btn-light">Volver</a>
	</p>
	<br>
			<div class="card">
				<div class="card-header">
					<h5 class="text-center">Listado Productos</h5>
				</div>
				<div class="card-body">
							<table class='table table-striped'> 
										<thead>
											<tr>
												<th scope="col">Nombre</th>
												<th scope="col">Costo en Pesos</th>
												<th scope="col">Acciones</th>					

											</tr>
										</thead>
										<tbody>
											<?php while ($datos = mysqli_fetch_array($resultado)) { ?>
												<tr>
													<td><?php echo $datos['nombre'] ?></td>
													<td><?php echo $datos['costo'] ?></td>
						
													<td>
														<a href="modificar.php?id=<?php echo $datos['id_receta']; ?>">Actualizar</a>| 
														<a onclick="return confirm('Esta seguro que desea dar de baja a este cliente?')"
														href="borrar.php?id=<?php echo $datos['id_receta']; ?>">Baja</a>
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