<?php
// comenzamos pasando como parámetro de la función llamada desde index el resultado del XML procesado
function salidaDatos($resultado) {
	// creamos una instancia de la clase DOM
	$dom = new DOMDocument();
	// cargamos en dicha instancia el DOM de documento, extraído gracias a la función file_get_content
	$dom->loadXML($resultado);
	// localizamos los elementos DOM que interesan de la estructura. En este caso <content />
	$contents = $dom->getElementsByTagName("content");
	// creamos un bucle que recorra el conjunto de resultados obtenidos
	foreach ($contents as $content) {
		// para el procesado, se debe tener en cuenta que todas las etiquetas tienen el mismo atributo "name"
		// la diferencia clave está EN EL VALOR DE DICHO ATRIBUTO
		// obtenemos dicho valor con el método de la clase DOMDocument getAttribute()
		$name = $content->getAttribute('name');
		// una vez obtenido, es preciso comprobar si el valor es el que interesa mostrar mediante un bucle
		// este bucle muestra sólo los datos interesantes
		switch ($name) {
			case 'title':
				echo "<h3>" . $content->nodeValue . '</h3>';
				;
			case 'FullSummary':
				echo "<p>" . $content->nodeValue . '</p>';
				;
				break;
			default:
				;
				break;
		}
	
	}
}


?>