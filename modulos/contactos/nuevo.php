<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../iniciar_sesion.php?error=iniciar_sesion");
	exit();
}

// Id de la persona para el nuevo contacto en la base de datos
$id = $_GET['id'];

$consulta = "SELECT * FROM tipo_contacto ORDER BY descripcion ASC";
$resultado = mysqli_query($conexion,$consulta);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Contacto</title>
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../../css/business-casual.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../css/sweetalert2.css">
</head>
<body>
	<h1>Contacto - Nuevo</h1>
	<p>
		<a href="listado.php?id=<?php echo $id; ?>" class="btn btn-primary">Volver</a>
	</p>
	<div class="container">
		<form action="alta.php" method="POST" class="bg-light rounded-lg p-4">
			<input type="hidden" id='id_persona' name="id_persona" value="<?php echo $id; ?>">
				<div class="form-group">
					<label> Descripcion: </label>
					<input class="form-control" type="text" id='descripcion' name="descripcion">
				</div>
				<div class="form-group">
					<label>Tipo: </label>
					<select class="form-control" name="cboTipo" id='cboTipo'>
						<?php while($datosTipo = mysqli_fetch_array($resultado)) { ?>
							<option value="<?php echo $datosTipo['id_tipo_contacto']; ?>"><?php echo $datosTipo['descripcion']; ?></option>
						<?php } ?>
					</select>
				</div>
				<p>
					<button type="button" onclick='guardar()' class="btn btn-success">Guardar</button>
				</p>
		</form>
	</div>
	
</body>
<script src="../../vendor/jquery/jquery.js" type="text/javascript"></script>
<script src="../../vendor/bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>
<script src="../../js/sweetalert2.min.js"></script>
<script type="text/javascript">
	function guardar(){
		var datos = {
			'id_persona' :  $('#id_persona').val(),
			'descripcion' :  $('#descripcion').val(),
			'cboTipo' :  $('#cboTipo').val(),
		}
		if(datos.descripcion != ''){
			$.ajax({
				url:'alta.php',
				type: 'POST',
				data: datos,
				success: function(respuesta){
					var respuestaJSON = $.parseJSON(respuesta)
					if(respuestaJSON.codigo == '200'){
						Swal.fire({
							icon: 'success',
							text: respuestaJSON.mensaje,
						}).then(function(){
							window.location.href='listado.php?id='+datos.id_persona
						})
					} else {
						Swal.fire({
							icon: 'error',
							text: respuestaJSON.mensaje,
						})
					}
				}
			})
		} else {
			Swal.fire({
				icon: 'error',
				text: respuestaJSON.mensaje,
			})
		}
	}
</script>
</html>