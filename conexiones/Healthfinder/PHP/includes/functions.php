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
	
	// print_r($xml);
	$baseTopic = $xml->Topics->Topic;
	$baseSection = $baseTopic->Sections->Section;
	$tamaño = count($baseTopic);

	// echo $tamaño . "<br>";

	for ($i=0; $i < $tamaño; $i++) { 
		echo "<h3 class='ampliar'>" . $baseTopic[$i]->Title . "</h3>";
		echo "<article class='oculto'>
			 <h4>" . $baseSection[$i]->Title . "</h4>";
		echo $baseSection[$i]->Content . 
			 "</article>";
	}

}

/* FUNCION PARA OBTENER TODAS LAS CATEGORIAS */
function categorias($url) {
	// obtenemos TODOS los resultados de medline
	$datos = obtenerContenidos($url);
	salidaCategorias($datos);
}

function salidaCategorias($xml) {
	
	// print_r($xml);
	$baseTopic = $xml->Topics->Topic;
	$tamaño = count($baseTopic);

	// echo $tamaño . "<br>";
	echo "<ul class='categorias'>";
	for ($i=0; $i < $tamaño; $i++) { 
		echo "<li>" . $baseTopic[$i]->categories . "</li>";
	}
	echo "</ul>";
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