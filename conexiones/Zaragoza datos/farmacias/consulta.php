<?php

// capturamos las variables enviadas. Falta por asegurar la petición
$farmacia = $_POST['palabra'];
$fecha = $_POST['datepicker'];

// función que evalúa si hay que mostrar farmacias de guardia o no
function procesadoFarmacia($farmacia,$fecha) {
	// si hay una fecha, se lanza el parámetro fecha. Si no, se muestran todas
	if ($fecha != "") {
		$url = "http://www.zaragoza.es/georref/json/hilo/farmacias_Equipamiento?georss_deguardia=s&georss_fecha=" . $fecha;
	} else {
		$url = "http://www.zaragoza.es/georref/json/hilo/farmacias_Equipamiento?";
	}
	return $url;
	
}

//Executes the URL and saves the content (json) in the variable.
$url = procesadoFarmacia($farmacia,$fecha);

$content = file_get_contents($url);
if($content) {
  $result = json_decode($content,true);

	//prints the content of array on the page. Instead perform the operation you ae interested.
	var_dump($result);
}
?>
