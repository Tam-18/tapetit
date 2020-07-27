<?php

session_start();


if (!isset($_SESSION['logueado'])) {
	header("Location: ../login.php?error=iniciar_sesion");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" type="text/css" href="../../css/css_alta.css">
	<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
	/* CSS reset */

	</style>
</head>
<body>
	
<!-- .h3 Comienza tu prueba gratuita de 30 días ya mismo-->
<!-- p o puedes comprar tu plan en Softlife ahora mismo-->
<div class="container" >
    <a class="links" id="paracadastro"></a>
    
    <div class="content">

      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form method="post" action="alta.php"> 
          <h1>Registrar Clientes</h1> 
          
          <p> 
            <label for="nome_cad"> Nombre</label>
            <input id="nome_cad" name="nombre" required="required" type="text" placeholder="Luiz Augusto" />
          </p>
          
          <p> 
            <label for="email_cad">Apellido</label>
            <input id="email_cad" name="apellido" required="required" type="text" placeholder="Ingrese su Apellido"/> 
          </p>
          <p> 
            <label for="email_cad">DNI</label>
            <input id="email_cad" name="dni" required="required" type="text" placeholder="Ingrese su DNI"/> 
          </p>
          <p> 
            <label for="senha_cad">Fecha de Ingreso</label>
            <input id="senha_cad" name="fecha_ingreso" required="required" type="date"/>
          </p>
          <p>
			<label for="senha_cad">Sexo</label>
			<select name="sexo" id="senha_cad">
				<option value="Masculino">Masculino</option>
				<option value="Femenino">Femenino</option>
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