<?php
require_once 'includes/functions.php';

if (isset($_POST['datepicker'])) {

	$fecha = $_POST['datepicker'];

	// función que evalúa si hay que mostrar farmacias de guardia o no
	function procesadoFarmacia($fecha) {
		// si hay una fecha, se lanza el parámetro fecha. Si no, se muestran todas
		if ($fecha != "") {
			$url = "http://www.zaragoza.es/georref/json/hilo/farmacias_Equipamiento?srsname=wgs84&georss_deguardia=s&georss_fecha=" . $fecha;
		} else {
			$url = "http://www.zaragoza.es/georref/json/hilo/farmacias_Equipamiento?srsname=wgs84";
		}
		return $url;		
	}

	// Ejacutamos la función de comprobación de fecha en la URL y guardamos la salida (json) en $datos.
	$url = procesadoFarmacia($fecha);

	$datos = file_get_contents($url);
	if($datos) {
		// una vez obtenido el contenido de la petición, damos salida por pantalla en formato legible
		  $resultado = json_decode($datos,true);
		// mostramos ya con formato la salida
		include 'includes/header.php';
		salidaFarmacia($resultado);
		include 'includes/footer.php';
	}
} 

elseif (isset($_REQUEST['buscarTermino'])) {
	// capturamos las variables enviadas. Falta por asegurar la petición
	$busqueda = $_POST['palabraEnfermedad'];

	// mejoramos los resultados asegurándonos de que hace las búsquedas más aproximadas posibles
	$palabra = str_replace(" ", "+AND+", $busqueda);

	// Almacenamos la URL base para un mejor procesado
	$urlBase = 'http://wsearch.nlm.nih.gov/ws/query?db=healthTopicsSpanish';
	$url = porTermino($palabra,$urlBase);
	$datos = obtenerContenidos($url);

	// definimos el elemento base del DOM que será pasado como argumento para el método que lo estructura "obtenerDOM"
	$tagName = "health-topic";
	// mostramos ya con formato la salida
	include 'includes/header.php';
	salidaDatos($datos,$tagName);
	include 'includes/footer.php';
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
	include 'includes/header.php';
	salidaDatos($datos,$tagName);
	include 'includes/footer.php';

} 

else {
	include 'includes/encabezado.php';
	echo "<h2>El acceso no está permitido desde la URL directamente</h2>";
	include 'includes/pie.php';
}

?>
