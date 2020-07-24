<?php

require '../../php/conexion.php';

session_start();

// Si no existe la variable de sesión logueado, entonces el usuario debe loguearse.
if (!isset($_SESSION["logueado"])) {
	header("location: login.php?error=debe_loguearse");
	exit;
}

if (isset($_GET['mensaje'])) {
	switch ($_GET['mensaje']) {
        case 'USUARIO_ERROR':
            $mensaje = 'Error al crear/modificar usuario.';
            break;
	}
}

$empleado_id = $_GET['id_empleado'];

$sql = "SELECT * FROM perfiles";
$rs_perfiles = mysqli_query($conexion, $sql);

$sql = "SELECT * FROM usuario WHERE id_empleado = $empleado_id";
$rs_usuarios = mysqli_query($conexion, $sql);
$usuario = $rs_usuarios->fetch_assoc();

if ($usuario == NULL) {
	$usuario_id = 0;
} else {
	$usuario_id = $usuario['id_usuario'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
	<h1>Usuario</h1>
	<br>
	<br>
	<p>
		<a href="listado.php">Volver</a>
	</p>
	<br>
	<div align='center'>
		<form method="POST" action="../usuarios/asignar_usuario.php">
			<input type="hidden" name="txtEmpleadoID" value="<?php echo $empleado_id; ?>">
			<input type="hidden" name="txtUsuarioID" value="<?php echo $usuario_id; ?>">
			<table class="tabla" style="width: 25%;">
				<tbody>
					<tr>
						<td>Usuario: </td>
						<td>
							<input type="text" name="txtUsername" value="<?php echo $usuario['usuario']; ?>">
						</td>
					</tr>
					<tr>
						<td>Clave: </td>
						<td>
							<input type="text" name="txtPassword" value="<?php echo $usuario['clave']; ?>">
						</td>
					</tr>
					<tr>
						<td>E-mail:	</td>
						<td>
							<input type="text" name="txtEmail" value="<?php echo $usuario['email']; ?>">
						</td>
					</tr>
					<tr>
						<td>Perfil: </td>
						<td>
							<select name="cboPerfil">
								<?php while ($row = $rs_perfiles->fetch_assoc()): ?>
									<?php if ($row['id_perfil'] == $usuario['ID_PERFIL']) { ?>
										<option selected value="<?php echo $row['id_perfil'] ?>"><?php echo $row['descripcion'] ?></option>
									<?php } else { ?>
										<option value="<?php echo $row['id_perfil'] ?>"><?php echo $row['descripcion'] ?></option>
									<?php } ?>
			    				<?php endwhile; ?>
							</select>
					    </td>
				    </tr>
				    <tr>
				    	<td colspan="2">
				    		<input type="submit" value="Guardar">
				    	</td>
				    </tr>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>