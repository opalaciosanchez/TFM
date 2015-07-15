<?php
/* PENDIENTE CREAR UNA FUNCION CON TODO EL CONTENIDO REPETIDO */
require_once 'includes/functions.php';
// comprobamos si se proviene del buscador por término, o desde una categoría concreta
if (isset($_POST['buscarTermino'])) {
	// capturamos las variables enviadas. Falta por asegurar la petición
	$termino = $_POST['palabra'];
	$termino = "%22" . $termino . "%22";
	$palabra = str_replace(" ", "%20", $termino);
	// Almacenamos la URL base para un mejor procesado
	$urlBase = 'http://healthfinder.gov/developer/Search.xml?api_key=jddtxibhqszsjiqq';
	$url = porTermino($palabra,$urlBase);
	$datos = obtenerContenidos($url);
	// mostramos ya con formato la salida
	include 'includes/encabezado.php';
	$xml = simplexml_load_string($datos);
	// print_r($xml);
	salidaDatos($xml);
	include 'includes/pie.php';
} elseif (isset($_POST['oculto'])) {
	$termino = $_POST['oculto'];
	$termino = "%22" . $termino . "%22";
	$palabra = str_replace(" ", "%20", $termino);
	$urlBase = 'http://healthfinder.gov/developer/Search.xml?api_key=jddtxibhqszsjiqq';
	$url = porTermino($palabra,$urlBase);
	$datos = obtenerContenidos($url);
	// mostramos ya con formato la salida
	include 'includes/encabezado.php';
	$xml = simplexml_load_string($datos);
	// print_r($xml);
	salidaDatos($xml);
	include 'includes/pie.php';
} else {
	include 'includes/encabezado.php';
	echo "<h2>El acceso no está permitido desde la URL directamente</h2>";
	include 'includes/pie.php';
}

?>
