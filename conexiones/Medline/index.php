<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8"/>
		<title>Medline Plus</title>
	</head>
	<body>
		<section id="solr">
		<h2>Conectando con Medline Plus</h2>
		<label for="palabra">Palabra clave</label>
		<input type="text" id="palabra" name="palabra" placeholder="enfermedad, cuidados..." autofocus/>
		<button id="buscar" name="buscar">Buscar</button>
		<div id="categorias">
			<h3>Búsqueda por categoría de información</h3>
			<p class="categoria"><a href=#>Esclerosis</a></p>
			<p class="categoria"><a href=#>Cancer</a></p>
			<p class="categoria"><a href=#>Asociaciones de enfermos</a></p>
		</div>
		<div id="contenido">
			
		</div>
		</section>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="script/conexion.js"></script>
	</body>
</html>