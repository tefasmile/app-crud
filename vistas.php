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

function listaEditoriales()
{
	//esta funcion generara el select de las editoriales
	$mysql = conexionMySQL();
	$sql   = "SELECT * FROM editorial";

	$resultado = $mysql->query($sql);

	$lista = "<select id='editorial' name='editorial_slc' required>";
		$lista .= "<option value=''>- - -</option>";
		while($fila = $resultado->fetch_assoc())
		{
			//$lista .= "<option value='".$fila["id_editorial"]."'>".$fila["editorial"]."</option>"; (1forma)
			//2 forma
			$lista .= sprintf(
				"<option value='%d'>%s</option>",
				$fila["id_editorial"],
				$fila["editorial"]
			);
			//$lista .= $fila["id_editorial"]."-".$fila["editorial"]."<br/>";
		}

	$lista .= "</select>";

	$resultado->free();
	$mysql->close();
	return $lista;
}

function altaHeroe()
{
	$form = "";
	$form .= "<form id='alta-heroe' class='formulario' data-insertar>";
		$form .= "<fieldset>";
			$form .= "<legend>Alta de Super Heroe:</legend>";
			$form .= "<div>";
				$form .= "<label for='nombre'>Nombre:</label>";
				$form .= "<input type='text' id='nombre' name='nombre_txt' required>";
			$form .= "</div>";
			$form .= "<div>";
				$form .= "<label for='imagen'>Imagen:</label>";
				$form .= "<input type='text' id='imagen' name='imagen_txt' required />";
			$form .= "</div>";
			$form .= "<div>";
				$form .= "<label for='descripcion'>Descripción:</label>";
				$form .= "<textarea id='descripcion' name='descripcion_txa' required /></textarea>";
			$form .= "</div>";
			$form .= "<div>";
				$form .= "<label for='editorial'>Editorial:</label>";
				$form .= listaEditoriales();
			$form .= "</div>";
			$form .= "<div>";
				$form .= "<input type='submit' id='insertar-btn' name='insertar_btn' value='Insertar'/>";
				$form .= "<input type='hidden' id='transaccion' name='transaccion' value='Insertar'/>";
			$form .= "</div>";
		$form .= "</fieldset>";
	$form .= "</form>";
	return printf($form);
}

function catalogoEditoriales()
{
	//echo "funciona";
	$editoriales = Array();
	
	$mysql = conexionMySQL();
	$sql   = "SELECT * FROM editorial";

	if($resultado = $mysql->query($sql))
	{
		while($fila = $resultado->fetch_assoc())
		{
			$editoriales[$fila["id_editorial"]] = $fila["editorial"]."<br />";
		}
		$resultado->free();
	}
	$mysql->close();

	return $editoriales;
}

//catalogoEditoriales(); 

function mostrarHeroes()
{
	$editorial = catalogoEditoriales();
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
				    $tabla .= "<td><h3>".$editorial[$fila["editorial"]]."</h3></td>";
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