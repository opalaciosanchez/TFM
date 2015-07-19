<?php require_once 'includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<!-- Importamos el viewport para trabajar con dispositivos móviles y el fichero mínimo de estilos Boostrap -->
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1"/>
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/start/jquery-ui.css">
	<title>Recursos de información sanitaria</title>
</head>
<body>
<!-- encabezado para título y menús de navegación -->
	<header>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
				<!-- esta configuración se refiere al botón de menú para móviles -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
						<!-- este span es por accesibilidad: para screen readers hace que el botón se interprete con el txt que pongamos  -->
						<span class="sr-only">Menu</span>
						<!-- esta clase añade una línea para el boton por cada span que pongamos -->
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- creamos el texto de encabezado que queremos que aparezca con una clase para que se integre en el menú-->
					<a href="index.php" class="navbar-brand">OpenData Salud</a>
				</div>
				<!-- creamos el menú al que apunta el data-target anterior -->
				<div class="collapse navbar-collapse" id="navbar-1">
				<!-- estas clases crean un menú como tal, y además sitúa los elementos a la derecha de la barra de forma responsive -->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php#asociaciones">Asociaciones</a></li>
						<li><a href="index.php#servicios">Servicios</a></li>
						<li><a href="index.php#medline">Enfermedades</a></li>
						<li><a href="index.php#healthfinder">Salud</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>