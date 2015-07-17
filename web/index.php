<?php include 'includes/header.php'; ?>
<!-- todo el contenido en un container responsive para Boorstrap -->
<div class="container">
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
					<a href="#" class="navbar-brand">OpenData Salud</a>
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

<?php include 'includes/footer.php'; ?>