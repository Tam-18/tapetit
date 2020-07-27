<?php 
require '../../php/conexion.php';
session_start();

if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
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
        <form method="post" action="modificar_datos.php"> 
          <h1>Registrar Productos</h1> 
          
          <p> 
            <label for="nome_cad"> Nombre de Productos</label>
            <input id="nome_cad" name="nombre" required="required" type="text" placeholder="Hamburguesas" />
          </p>
          <p> 
            <label for="email_cad">Costo</label>
            <input id="email_cad" name="costo" required="required" type="text" placeholder="Ingrese su DNI"/> 
          </p>
          <p> 
            <label for="senha_cad">Iva</label>
            <select name="iva" id="senha_cad">
				<option value="2">10%</option>
			</select>
          </p>
          <p>
			<label for="senha_cad">Categoria</label>
			<select name="categoria" id="senha_cad">
				<option value="0">Seleccione Una Opcion</option>
				<?php while($datos=mysqli_fetch_array($resultado)) :?>
						<option value="<?php echo($datos['id_categoria']);?>">
							<?php echo($datos['descripcion']);?>
						</option>
					<?php endwhile ?>
			</select>
			</p>
          <p> 
            <input type="submit" value="Guardar Cliente"/> 
          </p>
        </form>
      </div>
    </div>
  </div> 
	<script src="../../vendor/jquery/jquery.min.js"></script>
  	<script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>