<?php
/*Documentación php: http://php.net/manual/es/function.sprintf.php*/
/*Documentación php: http://php.net/manual/es/function.printf.php*/  
/*Conectando nuestra Base de Datos*/
/*require "config.php";*/
require_once "config.php";

function conexionMySQL()
{
	//echo "Hola mundo";
	/*conexion con base de datos*/
	$conexion = new mysqli(SERVER,USER,PASS,DB);

	if($conexion->connect_error)/*-> manera de ejecutar un metodo o atributo en php*/
	{
		/*$error = "<div class='error'>";
			$error .= "Error de conexion N° <b>".$conexion->connect_errno."</b> Mensaje del error: <mark>".$conexion->connect_error."</mark>";
		$error .= "</div>";//cierre div

		die($error);//hasta aqui termina de ejecutar el archivo*/

		//Buena practica
		$error .= "Error de conexion N° <b>%d</b> Mensaje del error: <mark>%s</mark>";
		printf($error,$conexion->connect_errno,$conexion->connect_error);
	}
	else
	{
		/*$formato = "<div class='mensaje'>Conexión exitosa: <b>".$conexion->host_info."</b></div>";
		echo $formato;*/
		//$formato = "<div class='mensaje'>Conexión exitosa: <b>%s</b></div>";
		//printf($formato,$conexion->host_info);
	}

	$conexion->query("SET CHARACTER SET UTF8");

	return $conexion;
}

//conexionMySQL();
?>