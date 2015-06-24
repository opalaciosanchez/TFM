<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Directorio de desarrollo</title>
</head>
<body>
<h1>DIRECTORIO TFM</h1>
<h2>Comprueba los proyectos disponibles</h2>
<?php
$directorio = '.';
$ficheros1  = scandir($directorio);
 
print_r($ficheros1);
?>
</body>
</html>