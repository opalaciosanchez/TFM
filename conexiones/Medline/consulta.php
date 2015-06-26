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

$url = medline($palabra,$urlBase);

$datos = obtenerContenidos($url);

// definimos el elemento base del DOM que será pasado como argumento para el método que lo estructura "obtenerDOM"
$tagName = "health-topic";
// mostramos ya con formato la salida
include 'includes/encabezado.php';
salidaDatos($datos,$tagName);
include 'includes/pie.php';


?>
