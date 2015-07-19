<?php

//***** FUNCIÓN PARA EL LISTADO DE FARMACIAS *****

function salidaFarmacia($resultado) {
	// capturamos la longitud total de los resultados
	$longitud = count($resultado['features']);
	// creamos el encabezado de la tabla
	echo '
	<div id="farmacias" class="container">
		<h3>Listado de farmacias</h3>
		<table class="table table-striped">
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
			<button class="farmacia btn btn-default" name="envioCoord" id="envioCoord">Ubicación en mapa</button></a>
		';

	}
	// cerramos la tabla id="farmacias"
	echo '</table></div>';
}

?>

<?php

// función GENÉRICA para medline y healthfinder para recuperar el XML

function obtenerContenidos($url) {
	$datos = file_get_contents($url);
	if ($datos) {
		return $datos;
	} else {
		include 'includes/header.php';
		echo "<div class='container-fluid busqueda'>
			  <h3>No se han encontrado datos</h3>
			  <span class='glyphicon glyphicon glyphicon glyphicon-eye-close' aria-hidden='true'></span>
			  <h2>INSERTA UN TÉRMINO DIFERENTE</h2>
			  </div>";
		include 'includes/footer.php';
	}
	
}

?>

<?php 

//***** FUNCIONES PARA OBTENER LOS DATOS MEDLINE *****

// método que genera la url completa con los criterios de búsqueda
function porTermino($palabra,$urlBase) {
	if ($palabra != "") {
		$url = $urlBase . "&term=title:" . $palabra . "&rettype=topic";
	} else {
		include 'includes/header.php';
		echo "<div class='container-fluid busqueda'>
			  <h3>UPS!! Ha habido un error</h3>
			  <span class='glyphicon glyphicon glyphicon-thumbs-down' aria-hidden='true'></span>
			  <h2>INSERTA UN TÉRMINO DE BÚSQUEDA</h2>
			  <h3>Debes especificar una palabra o frase para realizar la búsqueda</h3>
			  </div>";
		include 'includes/footer.php';
		exit;
	}
	return $url;
}

function porGrupo($palabra,$urlBase) {
	
	$url = $urlBase . "&term=group:" . $palabra . "&rettype=topic";
	return $url;
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

/* obtener resultados por palabra clave */

// comenzamos pasando como parámetro de la función llamada desde index el resultado del XML procesado
function salidaDatos($resultado,$tagName) {
	// llamamos a la función que obtiene los resultados del DOM
	$contents = obtenerDOM($resultado,$tagName);
	// preparamos el formato de los resultados
	echo "<div class='container-fluid resultados'>
		  <h1>RESULTADOS DE LA BÚSQUEDA</h1>
		  <p><strong>Pulsa sobre el encabezado de cada resultado para mostrar y ocultar su contenido</strong></p>
		  </div>";
	echo "<div id='resultadosMedline' class='main row'>";
	echo "<div class='container'>";
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
				echo "<li class='llamado'>" . $called->nodeValue . '</li>';
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

		echo "<div class='categorias'>";
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
	echo "</div></div>";
}

/* obtener todas las categorías */

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

<?php 

//***** FUNCIONES PARA OBTENER LOS DATOS HEALTHFINDER *****
// método que genera la url completa con los criterios de búsqueda
function porConsejos($palabra,$urlBase) {
	if ($palabra != "") {
		$url = $urlBase . "&keyword=" . $palabra . "&lang=es";
	} else {
		include 'includes/header.php';
		echo "<div class='container-fluid busqueda'>
			  <h3>UPS!! Ha habido un error</h3>
			  <span class='glyphicon glyphicon glyphicon-thumbs-down' aria-hidden='true'></span>
			  <h2>INSERTA UN TÉRMINO DE BÚSQUEDA</h2>
			  <h3>Debes especificar una palabra o frase para realizar la búsqueda</h3>
			  </div>";
		include 'includes/footer.php';
		exit;
	}
	return $url;
}

// comenzamos pasando como parámetro de la función llamada desde index el resultado del XML procesado
function salidaConsejos($xml) {
	/* para obtener la estructura, DESCOMENTA la siguiente Y COMENTA LAS DEMAS: */
	// print_r($xml);

	// dada la complejidad de la estructura (no podemos trabajar con DOM), reducimos la longitud de cada elemento
	// para ello una vez identificados, los insertamos en variables
	// primero insertamos la ruta base que servirá para llegar a cada tópico.
	$baseTopic = $xml->Topics->Topic;
	echo "<div class='container-fluid resultados'>
		  <h1>RESULTADOS DE LA BÚSQUEDA</h1>
		  <p><strong>Pulsa sobre el encabezado de cada resultado para mostrar y ocultar su contenido</strong></p>
		  </div>";
	echo "<div id='resultadosHealthfinder' class='main row'>";
	echo "<div class='container'>";
	echo "<h2 class='herramientas'>Resultados principales</h2>";
	foreach ($baseTopic as $topic) {
		echo "<h3 class='ampliar'>" . $topic->Title . "</h3>";
		echo "<article class='oculto'>";
		// a su vez, cada tópico TIENE UN ELEMENTO <sections> que contiene <section> QUE SON OTRA MATRIZ
		// esto es porque cada sección tiene su propio título y contenido
		// contamos el número de secciones (section) de cada tópico
		// para hacerlo más sencillo, lo convertimos en una variable
		$baseTopicCount = $topic->Sections->Section;

		// para cada tópico recorremos a su vez el número de secciones
		foreach ($baseTopicCount as $section) {
			echo "<h4>" . $section->Title . "</h4>" . 
				 $section->Content;
		}

		// al igual que el tópico tiene matriz de secciones, también la tiene la de términos relacionados
		// por ello se inserta EN EL INTERIOR DEL BUCLE QUE RECORRE CADA TOPICO
		$baseRelatedCount = $topic->RelatedItems->Item;
		$numItems = count($baseRelatedCount);
		// echo $numItems;
		if ($numItems > 0) {
			echo "<p><b>TEMAS RELACIONADOS</b></p>
				 <ul class='related'>";
			for ($r=0; $r < $numItems; $r++) { 
				$title = $baseRelatedCount[$r]->Title;
				consejosForm($title,$r);
			}
			echo '</ul>';
		}
		// cierre del tópico concreto
		echo "</article>";
	}

	/* LISTADO DE RECURSOS RELACIONADAS CON EL TÉRMINO BUSCADO*/
	// las herramientas son independientes de los tópicos, luego hay que procesarlas aparte
	// primero necesitamos saber cuántas tool individuales hay. Resulta que Tool es una matriz en sí
	$baseTool = $xml->Tools->Tool;
	$numTools = count($baseTool);
	// print_r($baseTool);
	echo "<br>";
	echo "<h3 class='herramientas'>Recursos relacionados</h3>";
	// recorremos el total de Tools ofrecidas
	for ($i=0; $i < $numTools; $i++) { 
		echo "<h4 class='ampliar'>" . $baseTool[$i]->Title . "</h4>";
		echo "<article class='oculto'>";
		echo $baseTool[$i]->Content;
		echo "</article>";
	}
	echo "</div></div>";

}

// // función que permite que los temas relacionados del listado de resultados funcionen como enlaces
function consejosForm($elemento,$id) {
	// insertamos en el elemento en el que se ha llamado la función el código del formulario
	// pasamos como valor del campo oculto, el valor del campo 
	echo "<form name='" . $id . "' id='" . $id . "' method='POST' action='consulta.php'>
	<input type='hidden' name='ocultoHealth' value='" . $elemento . "'>
	<a href='#' onclick='document.forms[\"" . $id . "\"].submit();'>" . $elemento . "</a>
	</form>";
	
}

?>