<?php

function salidaDatos($resultado) {
	// capturamos la longitud total de los resultados
	$longitud = count($resultado['features']);
	// creamos el encabezado de la tabla
	echo '
	<div id="contenido">
		<h3>Listado de farmacias</h3>
		<table id="farmacias">
		<tr>
			<th>Nombre</th>
			<th>Dirección</th>
			<th>Teléfono</th>
			<th>Consultar Ubicación</th>
		</tr>
	';

	for ($i=0; $i < $longitud; $i++) { 

		$base = $resultado['features'][$i]['properties'];
		$baseLocalizacion = $resultado['features'][$i]['geometry']['coordinates']; 
		$descripcion = $resultado['features'][$i]['properties']['description'];
		$separacion = explode('Teléfono: ', $descripcion);
		$otros = explode(' ', $separacion[1]);

		echo '<tr><td>' . $base['title'] . '</td><td>' . $separacion[0] . '</td><td>' . $otros[0] . '</td><td>
			<a href="http://maps.google.com/?q=' . $baseLocalizacion[0] . ',' . $baseLocalizacion[1] .'" target="_blank">
			<button name="envioCoord" id="envioCoord">Ubicación en mapa</button></a>
		';

	}
	// cerramos la tabla id="farmacias"
	echo '</table></div>';


}

?>