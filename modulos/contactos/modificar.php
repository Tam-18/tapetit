<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

$id = $_GET['id'];

$consulta = "SELECT * FROM tipo_contactos ORDER BY DESCRIPCION ASC";
$resultado = mysqli_query($conexion,$consulta);

$consulta = "SELECT * FROM contactos WHERE ID_CONTACTO = $id";
$resultado_contacto = mysqli_query($conexion,$consulta);
$datos_contacto = mysqli_fetch_array($resultado_contacto);

$descripcion = $datos_contacto['DESCRIPCION'];
$tipo = $datos_contacto['ID_TIPO_CONTACTO'];
$id_persona = $datos_contacto['ID_PERSONA'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Modificar Contacto</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
	<h1>Contacto - Modificar</h1>
	<p><?php require_once '../../php/menu.php' ?></p>
	<p>
		<a href="listado.php?id=<?php echo $id; ?>">Volver</a>
	</p>
	<div align="center">
		<p>
			<form class= 'form' action="modi_alta.php" method="post">
				<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
				<input type="hidden" name="id_contacto" value="<?php echo $id; ?>">
				<p>
					<label>Descripcion: </label>
					<input type="text" name="descripcion" value="<?php echo $descripcion ?>">
				</p>
				<p>
					<label>Tipo: </label>
					<select name="cboTipo">
						<?php while($datosTipo = mysqli_fetch_array($resultado)) { ?>
							<?php if ($datosTipo['ID_TIPO_CONTACTO'] == $tipo){ ?>
								<option selected value="<?php echo $datosTipo['ID_TIPO_CONTACTO']; ?>"><?php echo $datosTipo['DESCRIPCION']; ?></option>	
							<?php } else { ?>
							<option value="<?php echo $datosTipo['ID_TIPO_CONTACTO']; ?>"><?php echo $datosTipo['DESCRIPCION']; ?></option>
							<?php } ?>
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