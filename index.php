<?php require("vistas.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nuestra aplicación Crud SuperHeroes</title>
	<meta name="description" content="Aplicación CRUD (Create-Read-Update-Delete) con filosofia MVC desarrollada en PHP MySql y AJAX" />
	<link rel="stylesheet" href="css/super-heroes.css">
</head>
<body>
	<header class="cabecera">
		<h1>Super Heroes</h1>
		<div>
			<img src="img/super-heroes.png" alt="Super Héroes">
		</div>
		<a href="#" id="insertar">Insertar</a>
	</header>
	<section class="contenido">
		<!--<p>aqui va el contenido</p>-->
		<div id="respuesta"></div>
		<div id="precarga"></div>
		<?php mostrarHeroes(); ?>
	</section>
	<script src="js/despachador.js"></script>
</body>
</html>