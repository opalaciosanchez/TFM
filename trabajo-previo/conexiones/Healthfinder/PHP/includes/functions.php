<?php
/* FUNCIONES GENERICAS PARA OBTENER LOS DATOS */
// método que genera la url completa con los criterios de búsqueda
function porTermino($palabra,$urlBase) {
	if ($palabra != "") {
		$url = $urlBase . "&keyword=" . $palabra . "&lang=es";
	} else {
		include 'includes/encabezado.php';
		echo "<h2>Inserta un término de búsqueda para continuar</h2>";
		include 'includes/pie.php';
		exit;
	}
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

/* FUNCION PARA OBTENER RESULTADOS POR PALABRA CLAVE */
// comenzamos pasando como parámetro de la función llamada desde index el resultado del XML procesado
function salidaDatos($xml) {
	/* para obtener la estructura, DESCOMENTA la siguiente Y COMENTA LAS DEMAS: */
	// print_r($xml);

	// dada la complejidad de la estructura (no podemos trabajar con DOM), reducimos la longitud de cada elemento
	// para ello una vez identificados, los insertamos en variables
	// primero insertamos la ruta base que servirá para llegar a cada tópico.
	$baseTopic = $xml->Topics->Topic;
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
				enlacesForm($title,$r);
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
	echo "<h2 class='herramientas'>Recursos</h2>";
	// recorremos el total de Tools ofrecidas
	for ($i=0; $i < $numTools; $i++) { 
		echo "<h3 class='ampliar'>" . $baseTool[$i]->Title . "</h3>";
		echo "<article class='oculto'>";
		echo $baseTool[$i]->Content;
		echo "</article>";
	}

}

// función que permite que los temas relacionados del listado de resultados funcionen como enlaces
function enlacesForm($elemento,$id) {
	// insertamos en el elemento en el que se ha llamado la función el código del formulario
	// pasamos como valor del campo oculto, el valor del campo 
	echo "<form name='" . $id . "' id='" . $id . "' method='POST' action='consulta.php'>
	<input type='hidden' name='oculto' value='" . $elemento . "'>
	<a href='#' onclick='document.forms[\"" . $id . "\"].submit();'>" . $elemento . "</a>
	</form>";
	
}

// /* FUNCION PARA OBTENER TODAS LAS CATEGORIAS */
// function categorias($url) {
// 	// obtenemos TODOS los resultados de medline
// 	$datos = obtenerContenidos($url);
// 	salidaCategorias($datos);
// }

// function salidaCategorias($xml) {
	
// 	// print_r($xml);
// 	$baseTopic = $xml->Topics->Topic;
// 	$tamaño = count($baseTopic);

// 	// echo $tamaño . "<br>";
// 	echo "<ul class='categorias'>";
// 	for ($i=0; $i < $tamaño; $i++) { 
// 		echo "<li>" . $baseTopic[$i]->categories . "</li>";
// 	}
// 	echo "</ul>";
// }

?>