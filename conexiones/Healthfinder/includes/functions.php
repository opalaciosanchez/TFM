<?php
/* FUNCIONES GENERICAS PARA OBTENER LOS DATOS */
// método que genera la url completa con los criterios de búsqueda
function porTermino($palabra,$urlBase) {
	if ($palabra != "") {
		$url = $urlBase . "&term=title:" . $palabra . "&rettype=topic";
	} else {
		include 'includes/encabezado.php';
		echo "<h2>Inserta un término de búsqueda para continuar</h2>";
		include 'includes/pie.php';
		exit;
	}
	return $url;
}

function porGrupo($palabra,$urlBase) {
	
	$url = $urlBase . "&term=group:" . $palabra . "&rettype=topic";
	return $url;
}

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


/* FUNCION PARA OBTENER RESULTADOS POR PALABRA CLAVE */
// comenzamos pasando como parámetro de la función llamada desde index el resultado del XML procesado
function salidaDatos($resultado,$tagName) {
	// llamamos a la función que obtiene los resultados del DOM
	$contents = obtenerDOM($resultado,$tagName);
	// creamos un bucle que recorra el conjunto de resultados obtenidos, es decir, de health-topic
	foreach ($contents as $content) {
		// cada health-topic tiene una estructura concreta (http://www.nlm.nih.gov/medlineplus/xmldescription.html)
		// mostramos sólo la parte que nos interesa de esa estructura
		$title = $content->getAttribute('title');
		$summary = $content->getElementsByTagName('full-summary');
		$groups = $content->getElementsByTagName('group');
		$called = $content->getElementsByTagName('also-called');
		$references = $content->getElementsByTagName('see-reference');
		$sites = $content->getElementsByTagName('site');

		// se muestra el título del tema
		echo "<h3 class='ampliar'>" . $title . '</h3>';
		// se crea la sección artículo que ocultara cada tópico
		echo "<article class='oculto'>";
		// insertamos los otros nombres del término buscado
		if ($called->item(0)) {
			echo "
			<h4>También llamado</b></h4>
			<ul>";
			// recorremos todas las coincidencias obtenidas
			foreach ($called as $called) {
				echo "<li>" . $called->nodeValue . '</li>';
			}

			echo "</ul>";
		}

		// se muestra el texto central
		echo "<p class='resumen'>" . $summary->item(0)->nodeValue . '</p>';

		// mostramos las categorías relacionadas con los tópicos, creando primero esa sección

		// sitios web de interés
		echo "
		<div class='sites'>
		<h4 class='ampliar'>Para ampliar</b></h4>
		<ul class='oculto'>";
		foreach ($sites as $site) {
			$titulo = $site->getAttribute('title');
			$url = $site->getAttribute('url');
			echo "<li><a href='" . $url . "' title='" . $url . "' target='_blank' >" . $titulo . '</a></li>';
		}
		echo "</ul></div>";

		echo "<div class='categorias'>
		<p><b>Categoría</b></p>
		";
		// para aquellos elementos de los que hay más de una coincidencia, es preciso recorrerlos con bucle
		// por ejemplo aquí sucede con el elemento group y also-called
		// primero han sido capturados como variable (arriba) y luego ésta usada para recorrerlos con foreach
		foreach ($groups as $group) {
			// queremos que cada categoría sirva como enlace a una nueva búsqueda
			// por ello hemos creado una función que llamamos desde aqui, y que inserta el código del formulario
			// necesitamos pasar como argumento el nombre del elemento con el que estamos trabajando
			// además es IMPORTANTE generar un id único para cada formulario que vamos a enviar. Ha de ser string
			// este id permite usar javascript para su envío. Lo pasamos en la llamada a la función
			$i  = rand(1, 1000);
			$id = "form" . $i;
			echo "<p>" . enlacesForm($group,$id) . '</p>';
		}

		// cerramos la sección
		echo "</div></article>";
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
// función que permite que las categorías del listado de resultados funcionen como enlaces
function enlacesForm($elemento,$id) {
	// insertamos en el elemento en el que se ha llamado la función el código del formulario
	// pasamos como valor del campo oculto, el valor del campo 
	$categoria = $elemento->nodeValue;
	echo "<form name='" . $id . "' id='" . $id . "' method='POST' action='consulta.php'>
	<input type='hidden' name='oculto' value='" . $categoria . "'>
	<a href='#' onclick='document.forms[\"" . $id . "\"].submit();'>" . $categoria . "</a>
	</form>";
	
}

?>