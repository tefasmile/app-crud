<?php
//logica de las interfaces de usuario
/*
Pasos para conectarme a MySQL con PHP
1)Objeto de conexion: $mysql = conexionMySQL();
2)Consulta SQL: $sql   = "SELECT * FROM heroes ORDER BY id_heroe DESC";
3)Ejecutar la consulta: $resultado = $mysql->query($sql)
4)Mostar resultados: $fila = $resultado->fetch_assoc()
*/

//requiere conexion con el archivo conexion.php
require_once "conexion.php"; 

function mostrarHeroes()
{
	//conection bd
	$mysql = conexionMySQL();
	$sql   = "SELECT * FROM heroes ORDER BY id_heroe DESC";

	if($resultado = $mysql->query($sql))
	{
		//echo "wiiii";
		//Si no hay registros(compruebo que el query me regrese registros)
		if(mysqli_num_rows($resultado) == 0)
		{
			$respuesta = "<div class='error'>No existe registro de SuperHeroes, la base de datos esta vacia</div>";
		}
		else
		{
			$tabla = "<table id='tabla-heroes' class='tabla'";
			$tabla .= "<thead>";
			    $tabla .= "<tr>";
			        $tabla .= "<th>Id Heroe</th>";
			        $tabla .= "<th>Nombre</th>";
			        $tabla .= "<th>Imagen</th>";
			        $tabla .= "<th>Description</th>";
			        $tabla .= "<th>Editorial</th>";
			    $tabla .= "</tr>";
			$tabla .= "</thead>";
			$tabla .= "<tbody>";
			while($fila = $resultado->fetch_assoc())
			{
				$tabla .= "<tr>";
				    $tabla .= "<td>".$fila["id_heroe"]."</td>";
				    $tabla .= "<td><h2>".$fila["nombre"]."</h2></td>";
				    $tabla .= "<td><img src='img/".$fila["imagen"]."'/></td>";
				    $tabla .= "<td>".$fila["descripcion"]."</td>";
				    $tabla .= "<td><h3>".$fila["editorial"]."</h3></td>";
				    $tabla .= "<td>Botón Editar</td>";
				    $tabla .= "<td>Botón Eliminar</td>";
				$tabla .= "</tr>";
			}
			$resultado->free();//libero memoria de var que guarda datos
			$tabla .= "</tbody>";
			$tabla .= "</table>";

			$respuesta = $tabla;
		}
	}
	else
	{
		$respuesta = "<div class='exito'>No se ejecuto la consulta a la BD</div>";
	}

	$mysql->close();//cierro consulta

	printf($respuesta); 
}
?>