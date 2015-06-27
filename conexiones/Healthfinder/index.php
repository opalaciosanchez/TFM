<?php //API: jddtxibhqszsjiqq ?>
<?php include 'includes/encabezado.php';?>
<?php include 'includes/functions.php';?>

		<h3>Inserta un término de búsqueda</h3>
		<form id="medline" name="medline" action="consulta.php" method="POST">
			<label for="palabra">Palabra clave</label>
			<input type="text" id="palabra" name="palabra" placeholder="enfermedad, cuidados..." autofocus/>
			<input type="hidden" name="buscarTermino" id="buscarTermino" value="buscarTermino" />
			<!-- Exacta: <input type="checkbox" id="exacta" name="exacta"/> -->
		<input type="submit" id="buscar" name="buscar" value="buscar"/>
		</form>
		<!-- <div id="categorias">
			<h3>Búsqueda por categoría de información</h3>
			<?php 
				$urlBase = 'http://wsearch.nlm.nih.gov/ws/query?db=healthTopicsSpanish';
				$palabras = "enfermedades";
				$url = $urlBase . "&term=" . $palabras;
				categorias($url);
			?>
		</div> -->
		<div id="contenido">
			
<?php include 'includes/pie.php';?>