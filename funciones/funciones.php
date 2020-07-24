<?php



function conectar($SERVIDOR, $USUARIO, $PASSWORD, $DATABASE){
	if (!$conexion = mysqli_connect($server, $userdb, $passwdb, $db)){
		// SI NO SE ESTABLECIO LA CONEXION CON EL SERVIDOR DE LA DB
		return false;
	} else {
		// SELECCIONAMOS LA DB
		mysqli_select_db($conexion, $db);
		// RETORNAMOS LA CONEXION
		return $conexion;
	}
}// end function conectarBase

function consultar($conexion, $consulta){
	if (!$datos = mysqli_query($conexion, $consulta) or mysqli_num_rows($datos) < 1){
		// si fue rechazada la consulta por errores de sintaxis, o ningún registro coincide con lo buscado, devolvemos false
		return false; 
	} else {
		// si se obtuvieron datos, los devolvemos al punto en que fue llamada la función
		return $datos; 
	}
}// end function consultar


function insertar($conexion, $query){
	if (!$datos = mysqli_query($conexion, $query)){
		// si fue rechazada la consulta por errores de sintaxis, o ningún registro coincide con lo buscado, devolvemos false
		return false; 
	} else {
		// si se obtuvieron datos, los devolvemos al punto en que fue llamada la función
		return true; 
	}
}// end function consultar


?>