
<?php include 'includes/encabezado.php';?>

		<h3>Inserta un término de búsqueda</h3>
		<form id="medline" name="medline" action="consulta.php" method="POST">
			<label for="palabra">Palabra clave</label>
			<input type="text" id="palabra" name="palabra" placeholder="enfermedad, cuidados..." autofocus/>
		<input type="submit" id="buscar" name="buscar" value="buscar"/>
		</form>
		<div id="categorias">
			<h3>Búsqueda por categoría de información</h3>
			<p class="categoria"><a href=#>Esclerosis</a></p>
			<p class="categoria"><a href=#>Cancer</a></p>
			<p class="categoria"><a href=#>Asociaciones de enfermos</a></p>
		</div>
		<div id="contenido">
			
<?php include 'includes/pie.php';?>