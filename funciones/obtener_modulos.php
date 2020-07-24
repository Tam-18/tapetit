<?php

require_once '../php/conexion.php';

function obtener_modulos($persona_id) {
	// Es necesario esto ya que sino no es posible acceder a la conexión.
	// En este caso se convierte la variable conexion a una variable global.
	global $conexion;

	// Array vacío. Aquí agregaremos los módulos obtenidos.
	$modulos = [];

	// Consulta sql para obtener id y descrición dé los módulos.
	$sql = "SELECT M.`id_modulo` AS ID, M.descripcion AS Modulos, M.directorio FROM modulos M 
	INNER JOIN Perfiles_Por_Modulo PM ON M.`id_modulo` = PM.`id_modulo`
	INNER JOIN perfiles P ON P.`id_perfil` = PM.`id_perfil`
	INNER JOIN usuarios U ON U.`id_perfil` = P.`id_perfil`
	INNER JOIN empleados E ON E.`id_empleado` = U.`id_usuario`
	WHERE E.id_persona = $persona_id;";

	$resultado = mysqli_query($conexion, $sql);

	// Reccorro los registros y asigno los módulos al array.
	while ($datos = mysqli_fetch_array($resultado)) {
		// $modulos[$datos["directorio"]] = $datos["Modulos"];
		$arreglo = ['id' => $datos["ID"], 'descripcion' => $datos['Modulos'], 'directorio' => $datos['directorio']];
		$modulos[] = $arreglo;
	}

	// retorno los módulos obtenidos.
	return $modulos;
}

?>