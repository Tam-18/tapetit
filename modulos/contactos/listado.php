<?php

require '../../php/conexion.php';

session_start();



if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}
$id= $_GET['id'];

$consulta ="SELECT contactos.id_contacto, contactos.`valor_contacto`, tipo_contacto.`descripcion` FROM contactos JOIN tipo_contacto ON contactos.id_tipo_contacto = tipo_contacto.id_tipo_contacto
JOIN personas_contacto ON personas_contacto.`id_contacto` = contactos.`id_contacto`
WHERE personas_contacto.`id_persona` =$id ORDER BY tipo_contacto.descripcion ASC";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Contacto</title>
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../css/business-casual.min.css" rel="stylesheet">
</head>
<body>	
	<h1>Contacto</h1>
	<br>
	<br>
	<p>
		<a href="nuevo.php?id=<?php echo $id; ?>">Nuevo</a>
	</p>
	<br>
	<div class='container'>
		<div>
			<?php
			if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
					die("No se encontraron contactos");
			} 
			?>
			<table class='table table-light'> 

				<thead class="thead-dark">
					<tr>
					
						<th>Contacto</th>
						<th>Tipo</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody >
					<?php while ($datos = mysqli_fetch_array($resultado)) { ?>
						<tr>
						
							<td><?php echo $datos['valor_contacto'] ?></td>
							<td><?php echo $datos['descripcion'] ?></td>
							<td>

								<a href="modificar.php?id=<?php echo $datos['id_contacto']; ?>">Modificar</a>| 
								<a onclick="return confirm('Esta seguro que desea borrar este contacto?')"
								href="borrar.php?id=<?php echo $datos['id_contacto']; ?>">Baja</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

  <footer class="footer text-faded text-center py-5">
    <div class="container">
      <p class="m-0 small">Copyright &copy; Petkevich Tamara 2019</p>
    </div>
  </footer>
</body>
</html>