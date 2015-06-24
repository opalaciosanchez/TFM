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
		</tr>
	';

	for ($i=0; $i < $longitud; $i++) { 

		$descripcion = $resultado['features'][$i]['properties']['description'];
		$separacion = explode('Teléfono: ', $descripcion);
		$eliminacion = explode(' ', $separacion[1]);

		echo '<tr><td>' . $resultado['features'][$i]['properties']['title'] . '</td><td>' . $separacion[0] . '</td><td>' . $eliminacion[0] . '</td></tr>';
	
	}
	// cerramos la tabla id="farmacias"
	echo '</table></div>';


}

?>