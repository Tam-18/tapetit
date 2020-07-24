<?php

require('../../php/conexion.php');
//require('../../funciones/funciones.php');



$query_listadoUsuario ="SELECT * FROM personas P JOIN empleados E ON P.`ID_PERSONA` = E.`ID_PERSONA`
						JOIN usuario U ON U.`ID_EMPLEADO` = E.`ID_EMPLEADO`
						JOIN perfiles PF ON U.id_perfil = PF.id_perfil";

	if(!$resultado = consultar($conexion, $query_listadoUsuario)){

		echo "<p>No se ha encontrado un usuarios.</p>";
		echo "<a href='../../index.php'>Ir al login</a>";

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Listado</title>
	<link rel="stylesheet" href="../../css/style.css">
</head>
<body>

	<h1><b>Lista de Usuarios</b></h1>
	<table class="tabla">
		<thead>
			<tr>
				<th>#</th>
				<th>EMPLEADO</th>
				<th>USERNAME</th>
				<th>PASSWORD</th>
				<th>EMAIL</th>
				<th>PERFIL</th>
				<th>ACCION</th>
			</tr>
		</thead>
		<tbody>
			<!-- MIENTRAS $datos TENGA REGISTROS -->
			<?php while($datos = mysqli_fetch_array($resultado)):?>
			<tr>
				<td><?php echo $datos['id_usuario'] ?></td>
				<td><?php echo $datos['nombre'].' '.$datos['apellido'] ?></td>
				<td><?php echo $datos['usuario'] ?></td>
				<td><?php echo $datos['clave'] ?></td>
				<td><?php echo $datos['email'] ?></td>
				<td><?php echo $datos['descripcion'] ?></td>
				<td>
					<a onclick="return confirm('Esta seguro que desea borrar este usuario?')"
					href="borrar.php?id=<?php echo $datos['id_usuario'] ?>">Borrar</a>
				</td>
			</tr>
			<?php endwhile; ?>
		</tbody>
		

	</table>
	
</body>
</html>


<?php

// CERRAMOS LA CONEXION A LA DB
mysqli_close($conexion);

?>