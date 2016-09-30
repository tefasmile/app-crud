<?php
require "vistas.php";
require "modelo.php";

/*
Aplicación CreateReadUpdateDelete
PHP tiene 2 metodos de envio de datos: POST y GET
Recomendacion: enviar por metodo POST la información que afecte la Base de Datos;
las consultas que no van a afectar a la BD se utiliza via GET.

Create  Afecta BD     INSERT (SQL)  POST  MODELO
Read    No Afecta BD  SELECT (SQL)  GET   VISTA
Update  Afecta BD     UPDATE (SQL)  POST  MODELO
Delete  Afecta BD     DELETE (SQL)  POST  MODELO
*/

$transaccion = $_POST["transaccion"];

function ejecutarTransaccion($transaccion) {
	if($transaccion=="alta")
	{
		//Mostrar el formulario de alta
		altaHeroe();
	}
	else if($transaccion=="insertar")
	{
		//Procesar datos del formulario de alta e insertarlos en mysql
		//Esta funcion se ejecuta
		insertarHeroe($_POST['nombre_txt'],$_POST['imagen_txt'],$_POST['descripcion_txa'],$_POST['editorial_slc']);
		//echo "Obtener datos del form y agregarlos a la BD";
	}
	else if($transaccion=="eliminar")
	{
		//Eliminar de mysql el registro solicitado
	}
	else if($transaccion=="editar")
	{
		//Traer los datos del registro a modificar en un formulario
	}
	else if($transaccion=="actualizar")
	{
		//Modificar en MySQL los datos del registro modificado
	}
}

ejecutarTransaccion ($transaccion);
?>