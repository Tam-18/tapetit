<?php 

if (isset($_POST)) {
	include "conexion.php";
	if ($_POST['codigo']==0) {
		# code...
	$verficacion=$pdo->query("select count(*) as cantidad from ingredientes upper(nombre) like '%".$_POST['nombre']."%'");
		if ($verficacion->rowCount()>0) {
			$cantidad=$verificacion->fetch();
			if ($cantidad['cantidad']>0) {
				$insertIngredientes=$pdo->query("insert into ingredientes(nombre,id_stock,unidad_medida) values('".$_POST['nombre']."',".$_POST['stock'].",".$_POST['medida'].")");
				if ($insertIngredientes->rowCount()>0) {
					echo "Alta Correcta";
				}
			}
		}
	}else{
		$update=$pdo->query("update ingredientes set nombre=".$_POST['nombre'].",id_stock=".$_POST['stock'].",unidad_medida=".$_POST['medida']." where id_ingrediente=".$_POST['codigo']);
		if ($update->rowCount()>0) {
			echo "Acualizacion Correcta";
		}
	}
}


 ?>