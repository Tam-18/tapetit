<?php
//const= se define como contaste en ves de variable.
const SERVIDOR = 'localhost'; 
const USUARIO = 'root';
const PASSWORD = '';
const DATABASE = 'abm';

if(!$conexion = mysqli_connect(SERVIDOR,USUARIO,PASSWORD,DATABASE)){
	die("Error en la conexión con el servidor de Base de Datos");
}

?>