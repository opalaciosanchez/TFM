<!-- en este documento vamos a trabajar con la barra de menús responsive -->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Crear un navbar</title>
	<!-- Importamos el viewport para trabajar con dispositivos móviles y el fichero mínimo de estilos Boostrap -->
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<style>
	/* esta modificación es necesaria ciuando trabajamos con un header navbar-fixed-top
	para evitar que cuando se inserte texto éste se meta debajo del menú */
		body {
			padding-top: 100px;
		}
	</style>
</head>
<body>
<!-- como siempre comenzamos con un contenedor donde almacenamos todo el diseño fluido -->
	<div class="container">
		<header>
		<!-- dentro del header, como es normal, metemos el elemento nav, con clases de Bootstrap -->
		<!-- estas clases permiten dar formato, y sobre todo "navbar-fixed-top" hace que la barra se quede fija y ocupe el 100% -->
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
						<a href="#" class="navbar-brand">Open data</a>
					</div>
					<!-- creamos el menú al que apunta el data-target anterior -->
					<div class="collapse navbar-collapse" id="navbar-1">
					<!-- estas clases crean un menú como tal, y además sitúa los elementos a la derecha de la barra de forma responsive -->
						<ul class="nav navbar-nav navbar-right">
							<li><a href="#">Servicios</a></li>
							<li><a href="#">Enfermedades</a></li>
							<li><a href="#">Consejos de salud</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
	</div>
	<!-- Incluimos jQuery y bootstrap.js, que precisa del anterior -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>