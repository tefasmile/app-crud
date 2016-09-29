<?php 
require_once "conexion.php";//conexion a BD

//Esta funcion esta definida
function insertarHeroe ($nombre,$imagen,$descripcion,$editorial) 
{
	$sql = "INSERT INTO heroes (id_heroe,nombre,imagen,descripcion,editorial) VALUES (0,'$nombre','$imagen','$descripcion',$editorial)";

	$mysql = conexionMySQL();


	if($resultado = $mysql->query($sql))
	{
		$respuesta = "<div class='exito' data-recargar>Se insertó con exito el registro del SuperHeroe: <b>$nombre</b></div>";
	}
	else
	{
		$respuesta = "<div class='error'>Ocurrio un error, No se inserto el registro del SuperHeroe: <b>$nombre</b></div>";
	}

	$mysql->close();

	return printf($respuesta);

}
?>