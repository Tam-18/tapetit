<?php

require '../../php/conexion.php';

session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

if (isset($_GET['id'])) {
	$receta = $_GET['id'];
	$consulta = "SELECT * FROM receta r inner join categoria c on c.id_categoria=r.rela_categoria inner join iva i on i.id_iva=r.rela_iva where id_receta=$receta";

	if (!$resultado = mysqli_query($conexion,$consulta) or mysqli_num_rows($resultado) < 1) {
		die("No se encontraron receta");	
	}
	$datos_receta = mysqli_fetch_array($resultado);
	$id_receta = $datos_receta['id_receta'];
	$nombre = $datos_receta['nombre'];
	$iva = $datos_receta['rela_iva'];
	$costo = $datos_receta['costo'];
	$categoria = $datos_receta['rela_categoria'];
} else {
	die('No se especifico el id de cliente');
}
$queryCargo = "SELECT * FROM categoria";
$resultado = mysqli_query($conexion,$queryCargo);

?>

 <!DOCTYPE html>
 <html>
 <head>
 		<title>Nuevo Producto</title>
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="../../css/css_alta.css">
 </head>
 <body>
 <div class="container" >
    <a class="links" id="paracadastro"></a>
    
    <div class="content">

      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form method="post" action="alta.php"> 
          <h1>Registrar Productos</h1> 
				<input type="hidden" name="receta" value="<?php echo $id_receta ?>">
          <p> 
            <label for="nome_cad"> Nombre de Productos</label>
            <input id="nome_cad" name="nombre" required="required" value="<?php echo $nombre;?>" type="text" placeholder="Hamburguesas" />
          </p>
          <p> 
            <label for="email_cad">Costo</label>
            <input id="email_cad" name="costo" required="required" value="<?php echo $costo; ?>" type="text" placeholder="Ingrese su Costo"/> 
          </p>
          <p> 
            <label for="senha_cad">Iva</label>
            <select name="iva" id="senha_cad">
				<option value="2">10%</option>
			</select>
          </p>
          <p>
			<label for="senha_cad">Categoria</label>
			<select name="categoria" id="categoria">
				<option value="0">Seleccione Una Opcion</option>
				<?php while($datos=mysqli_fetch_array($resultado)) :?>
						<option value="<?php echo($datos['id_categoria']);?>" <?php if ($datos['id_categoria']==$categoria) {
						echo "selected";
						}  ?>>
							<?php echo($datos['descripcion']);?>
						</option>
					<?php endwhile ?>
			</select>
			</p>
          <p> 
            <input type="submit" value="Actualizacion Datos"/> 
          </p>
        </form>
      </div>
    </div>
  </div> 
	<script src="../../vendor/jquery/jquery.min.js"></script>
  	<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   </body>
 </html>