<?php
require_once 'includes/functions.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Buscador de farmacias</title>
</head>
<body>
 	<section id="solr">
		<h2>Buscador de farmacias</h2>
		<form name="php" id="php" action="consulta.php" method="POST">
			<!-- <p>
				<label for="palabra">Farmacia</label>
				<input type="text" id="palabra" name="palabra" placeholder="nombre o direccion" autofocus/>
			</p> -->
			<p>
				<label for="fecha">Farmacias de guardia por fecha</label>
				<input type="text" id="datepicker" name="datepicker" size="30">
			</p>
		<input type="submit" id="buscar" name="buscar" value="Buscar Farmacia"/>
		</form>
		<h2>SPARQL</h2>
		<form name="SPARQL" id="SPARQL" action="SPARQL/consultaSPARQL.php" method="POST">
			<p>
				<input type="submit" id="buscarSPARQL" name="buscarSPARQL" value="Buscar Farmacia"/>
			</p>
		</form>
		<p><b>Si no se desea indicar datos, simplemente pulse en Buscar Farmacia</b></p>

		</section>
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/start/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
		<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="script/fecha.js"></script>
</body>
</html>