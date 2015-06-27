<?php
/* FUNCIONES GENERICAS PARA OBTENER LOS DATOS */

function obtenerContenidos($url) {
	$datos = file_get_contents($url);
	if ($datos) {
		return $datos;
	} else {
		include 'includes/encabezado.php';
		echo "<h2>No se han encontrado datos</h2>";
		include 'includes/pie.php';
	}
	
}

// creamos un método que, recibiendo el listado de resultados procesados, y el nombre del elemento a localizar
// devuelve el DOM estructurado
function obtenerDOM($resultado,$tagName) {
	// creamos una instancia de la clase DOM
	$dom = new DOMDocument();
	// cargamos en dicha instancia el DOM de documento, extraído gracias a la función file_get_content
	$dom->loadXML($resultado);
	// localizamos los elementos DOM que interesan de la estructura. En este caso <content />
	$contents = $dom->getElementsByTagName($tagName);
	// 	print "<pre>";
	// 	print_r($resultado);
	// 	print "</pre>"; 
	return $contents;
}

// método que genera la url completa con los criterios de búsqueda
function medline($palabra,$urlBase) {
	if ($palabra != "") {
		$url = $urlBase . "&term=title:" . $palabra . "&rettype=brief";
	} else {
		include 'includes/encabezado.php';
		echo "<h2>Inserta un término de búsqueda para continuar</h2>";
		include 'includes/pie.php';
		exit;
	}
	return $url;
}

/* FUNCION PARA OBTENER RESULTADOS POR PALABRA CLAVE */
// comenzamos pasando como parámetro de la función llamada desde index el resultado del XML procesado
function salidaDatos($resultado,$tagName) {
	// llamamos a la función que obtiene los resultados del DOM
	$contents = obtenerDOM($resultado,$tagName);
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
				echo "<h3 class='ampliar'>" . $content->nodeValue . '</h3>';
				;
			case 'FullSummary':
				echo "<div class='oculto'>" . $content->nodeValue . '</div>';
				;
				break;
				case 'groupName':
					echo "<p class='categoria'><b>Categoría: " . $content->nodeValue . '</b></p>';
					;
					break;
			default:
				;
				break;
		}
	
	}
}

/* FUNCION PARA OBTENER TODAS LAS CATEGORIAS */
function categorias($url) {
	// obtenemos TODOS los resultados de medline
	$datos = obtenerContenidos($url);
	$tagName = "content";
	salidaCategorias($datos,$tagName);
}

function salidaCategorias($resultado,$tagName) {
	
	$contents = obtenerDOM($resultado,$tagName);
	$categorias = array();
	foreach ($contents as $content) {
		$name = $content->getAttribute('name');

		if ($name == 'groupName') {
			$dato = $content->nodeValue;
			array_push($categorias, $dato);
		}
	}
	$categoriasUnicas = array_unique($categorias);
	print_r($categoriasUnicas);
}

?>