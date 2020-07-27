<?php 
include "conexion.php";
$query=$pdo->query("select i.nombre as nombre_ingrediente,s.cantidad as cantidad,u.descripcion as unidad_medida from ingredientes i inner join stock s on s.id_stock=i.id_stock inner join unidad_medida u on u.id_unidad_medida=i.id_unidad_medida");
echo json_encode($query->fetchAll());


 ?>