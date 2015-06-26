<?php
require_once 'includes/functions.php';

// capturamos las variables enviadas. Falta por asegurar la petición
$busqueda = $_POST['palabra'];

// mejoramos los resultados asegurándonos de que hace las búsquedas más aproximadas posibles
$palabra = str_replace(" ", "+AND+", $busqueda);

// if (isset($_POST['exacta'])) {
// 	$palabra = str_replace(" ", "+AND+", $busqueda);
// } else {
// 	$palabra = $busqueda;
// }


// Almacenamos la URL base para un mejor procesado
$urlBase = 'http://wsearch.nlm.nih.gov/ws/query?db=healthTopicsSpanish';

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

$url = medline($palabra,$urlBase);

$datos = file_get_contents($url);

if($datos) {

	// una vez obtenido el contenido de la petición, damos salida por pantalla en formato legible
	// $resultado = simplexml_load_string($datos);

// 	print "<pre>";
// 	print_r($resultado);
// 	print "</pre>"; 

	// mostramos ya con formato la salida
	include 'includes/encabezado.php';
	salidaDatos($datos);
	include 'includes/pie.php';

}

?>
