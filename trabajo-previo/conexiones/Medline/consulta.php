<?php
require_once 'includes/functions.php';
// comprobamos si se proviene del buscador por término, o desde una categoría concreta
if (isset($_REQUEST['buscarTermino'])) {
	// capturamos las variables enviadas. Falta por asegurar la petición
	$busqueda = $_POST['palabra'];

	// mejoramos los resultados asegurándonos de que hace las búsquedas más aproximadas posibles
	$palabra = str_replace(" ", "+AND+", $busqueda);

	// Almacenamos la URL base para un mejor procesado
	$urlBase = 'http://wsearch.nlm.nih.gov/ws/query?db=healthTopicsSpanish';
	$url = porTermino($palabra,$urlBase);
	$datos = obtenerContenidos($url);

	// definimos el elemento base del DOM que será pasado como argumento para el método que lo estructura "obtenerDOM"
	$tagName = "health-topic";
	// mostramos ya con formato la salida
	include 'includes/encabezado.php';
	salidaDatos($datos,$tagName);
	include 'includes/pie.php';
}
elseif (isset($_REQUEST['oculto'])) {
	$categoria = $_POST['oculto'];
	// echo $categoria;
	// mejoramos los resultados asegurándonos de que hace las búsquedas más aproximadas posibles
	$palabra = str_replace(" ", "+AND+", $categoria);

	// Almacenamos la URL base para un mejor procesado
	$urlBase = 'http://wsearch.nlm.nih.gov/ws/query?db=healthTopicsSpanish';
	$url = porGrupo($palabra,$urlBase);
	$datos = obtenerContenidos($url);

	// definimos el elemento base del DOM que será pasado como argumento para el método que lo estructura "obtenerDOM"
	$tagName = "health-topic";
	// mostramos ya con formato la salida
	include 'includes/encabezado.php';
	salidaDatos($datos,$tagName);
	include 'includes/pie.php';

} else {
	include 'includes/encabezado.php';
	echo "<h2>El acceso no está permitido desde la URL directamente</h2>";
	include 'includes/pie.php';
}




// if (isset($_POST['exacta'])) {
// 	$palabra = str_replace(" ", "+AND+", $busqueda);
// } else {
// 	$palabra = $busqueda;
// }


?>
