<?php 
include "conexion.php";
$sql="
SELECT r.nombre as receta, i.nombre as ingrediente, s.cantidad as stock, u.descripcion as unidad_medida from receta_por_ingrediente rpi 
	inner join receta r on r.id_receta=rpi.id_receta
	inner join ingredientes i on i.id_ingrediente=rpi.id_ingrediente
	inner join stock s on s.id_stock=i.id_stock
	inner join unidad_medida u on u.id_unidad_medida=i.id_unidad_medida 
";
$query=$pdo->query($sql);
echo json_encode($query->fetchAll());






?>	