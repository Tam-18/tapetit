<?php 
if (isset($_POST)) {
	include "conexion.php";

	if ($_POST['codigo']==0) {
		$query=$pdo->query("insert into promociones(descuento,fecha_desde,fecha_hasta) values('".$_POST['descuento']."','".$_POST['desde']."','".$_POST['hasta']."')");
		if ($query->rowCount()>0) {
			$idInsertado=$pdo->lastInsertId();
			$queryInsert=$pdo->query("insert into promocion_por_receta(id_receta,id_promocion) values(".$_POST['receta'].",".$idInsertado.")");
			if ($queryInsert->rowCount()>0) {
				echo "Alta Correcta";
			}
		}
	}else{
		$queryUpdate=$pdo->query("UPDATE promociones SET descuento='".$_POST['descuento']."',fecha_desde='".$_POST['desde']."',fecha_hasta='".$_POST['hasta']."' where id_promocion=".$_POST['codigo']);
		if ($queryUpdate->rowCount()>0) {
			echo "Actualizacion Correcta";
		}
	}
}



 ?>