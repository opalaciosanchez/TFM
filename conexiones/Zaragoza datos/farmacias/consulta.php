<?php
require_once 'includes/functions.php';
// capturamos las variables enviadas. Falta por asegurar la petición
// $farmacia = $_POST['palabra'];
$fecha = $_POST['datepicker'];

// función que evalúa si hay que mostrar farmacias de guardia o no
function procesadoFarmacia($fecha) {
	// si hay una fecha, se lanza el parámetro fecha. Si no, se muestran todas
	if ($fecha != "") {
		$url = "http://www.zaragoza.es/georref/json/hilo/farmacias_Equipamiento?georss_deguardia=s&georss_fecha=" . $fecha;
	} else {
		$url = "http://www.zaragoza.es/georref/json/hilo/farmacias_Equipamiento?";
	}
	return $url;
	
}

// Ejacutamos la función de comprobación de fecha en la URL y guardamos la salida (json) en $datos.
$url = procesadoFarmacia($fecha);

$datos = file_get_contents($url);
if($datos) {

// una vez obtenido el contenido de la petición, damos salida por pantalla en formato legible
  $resultado = json_decode($datos,true);

/*	print "<pre>";
	print_r($resultado);
	print "</pre>";*/

	// mostramos ya con formato la salida
	include 'includes/encabezado.php';
	salidaDatos($resultado);
	include 'includes/pie.php';

}

?>
