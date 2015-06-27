<?php
require_once 'includes/functions.php';
// comprobamos si se proviene del buscador por término, o desde una categoría concreta
if (isset($_REQUEST['buscarTermino'])) {
	// capturamos las variables enviadas. Falta por asegurar la petición
	$palabra = $_POST['palabra'];

	// Almacenamos la URL base para un mejor procesado
	$urlBase = 'http://healthfinder.gov/developer/Search.xml?api_key=jddtxibhqszsjiqq';
	$url = porTermino($palabra,$urlBase);
	$datos = obtenerContenidos($url);

	// definimos el elemento base del DOM que será pasado como argumento para el método que lo estructura "obtenerDOM"
	$tagName = "topic";
	// mostramos ya con formato la salida
	include 'includes/encabezado.php';
	$xml = simplexml_load_string($datos);
	// print_r($xml);
	salidaDatos($xml);
	include 'includes/pie.php';
} 



?>
