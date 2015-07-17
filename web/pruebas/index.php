<!-- en este documento se muestra por zonas el funcionamiento más importante de Bootstrap -->
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<!-- Importamos el viewport para trabajar con dispositivos móviles y el fichero mínimo de estilos Boostrap -->
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<title>Recursos de información sanitaria</title>
</head>
<body>
<!-- para poder trabajar en columnas, es preciso insertar los contenidos dentro de div con la clase container -->
<!-- la clase "container-fluid" dispone todo el contenido cubriendo el 100% del ancho de la página -->
<!-- además, Bootstrap separa el diseño en FILAS en las que están insertas las columnas. Es una forma de distribuir el contenido -->
<!-- estas filas se controlan con la clase "row" y todos los elementos dentro de un contenedor con esta clase están en la misma fila -->
	<div class="container-fluid">
		<header class="main row">
	<!-- para controlar las columnas, es preciso usar la clase col-md-n, donde n es el número de columnas de la seccion -->
	<!-- realmente tenemos varias clases, en funciónd el tamaño de dispositivo que detecta automáticamente Bootstrap -->
	<!-- col-xs- para dispositivos muy pequeños (smartphones) -->
	<!-- col-sm- para dispositivos pequeños (tablets de pocas pulgadas) -->
	<!-- col-md- para dispositivos medianos (tablets o equipos de poca resolución) -->
	<!-- col-lg- para dispositivos grandes -->
	<!-- siempre el contenido se divide en 12 COLUMNAS EN TOTAL -->
	<!-- en este caso y en posteriores, añadimos el número de columnas PARA CADA ELEMENTO de la FILA -->
	<!-- la suma siempre ha de ser 12 como vemos en estos dos elementos (el disp. pequeños, cada elemento ocupa la totalidad) -->
		<h1 class="col-xs-12 col-s-12 col-md-5 col-lg-5">recursos sanitarios</h1>
		<!-- si no añadimos alguno de los valores, se toma EL DEL TAMAÑO INFERIOR. Por ejemplo aquí obviamos el col-lg-7 -->
		<!-- podríamos hacerlo también en los tamaños del h1 -->
		<nav class="col-xs-12 col-s-12 col-md-7">
			<ul class="nav navegacion">
				<li><a href="#">Asociaciones</a></li>
				<li><a href="#">Farmacias</a></li>
				<li><a href="#">Consejos</a></li>
				<li><a href="#">Enfermedades</a></li>
			</ul>
		</nav>
	</div>
	</header>
	<!-- la clase "container" dispone el contenido centrado en la página (los div, secciones, etc.) -->
	<div class="container">
		<section class="main">
		<!-- la clase row especifica que el contenido en el interior de ese contenedor va a ser una fila, dividida en columnas -->
		<!-- en el caso de que las columnas tengan diferente ancho y se monten una encima de otra, se puede usar la clase clearfix -->
			<article class="main row">			
				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
				<!-- aquí tenemos dos clases especiales: small inserta una versión más pequeña de un encabezado. Este elemento sólo funciona en encabezados -->
				<!-- la segunda es "lead", que añade textos más destacados y grandes -->
					<h2>Busca informacion de interés<br> 
					<small>Rellena la caja de búsqueda</small>
					</h2>
					<p class="lead">Puedes buscar palabras o frases completas</p>
				</div>
				<aside class="col-xs-12 col-sm-12 col-md-7 col-lg-6 busqueda">
					<h3>Búsqueda</h3>
					<input type="search" >
					<button class="btn btn-primary visible-xs-block visible-sm-block visible-md-inline visible-lg-inline">Buscar</button>
				</aside>
				<!-- esta clase permite corregir errores cuando por un float o uso de columnas, tenemos varias con diferentes anchos:
				<div class="clearfix visible-sm-block"></div>
				-->
			</article>
			<article class="row">
				<div class="col-xs-12 col-md-4">Una información</div>
				<div class="col-xs-12 col-md-4">Otra información</div>
				<div class="col-xs-12 col-md-4">Otra información más</div>
			</article>
			<article >
				<div class="container">
				<!-- podemos hacer a la tabla responsive si la metemos en un div con la clase table-responsive -->
				<!-- tenemos la opción también de hacer que este elemento aparezca sólo en dispositivos de cierto tamaño -->
				<!-- para ello usamos las clases visible-xs visible-sm visible-md visible-lg para indicar en cuál aparecera -->
				<!-- en este caso se verá sólo en dispositivos medianos y grandes -->
				<!-- también tenemos el contrario "hidden-xs" por ejemplo, para ocultar SOLO en los tamaños indicados -->
					<div class="table-responsive visible-md visible-lg">
					<!-- las tablas también tienen clases, como la clase "table" o "table-striped" -->
						<table class="table table-striped table-hover">
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Usuario</th>
							</tr>
							<tr>
								<td>Contenido</td>
								<td>Contenido</td>
								<td>Contenido</td>
							</tr>
							<tr>
								<td>Contenido</td>
								<td>Contenido</td>
								<td>Contenido</td>
							</tr>
						</table>
					</div>
				</div>
			</article>
			<article class="container-fluid">
			<div class="row">
				<h3>Imagenes</h3>
				<!-- trabajo con imágenes -->
				<!-- las imagenes tienen una clase denominada "img-responsive" que hace que las imágenes sean adaptables -->
				<div class="col-md-3"><img src="http://lorempixel.com/600/500" alt="imagenes de prueba" class="img-responsive"></div>
				<div class="col-md-3"><img src="http://lorempixel.com/600/500" alt="imagenes de prueba" class="img-responsive"></div>
				<div class="col-md-3"><img src="http://lorempixel.com/600/500" alt="imagenes de prueba" class="img-responsive"></div>
			</div>
			</article>
		</section>
	</div>
	<footer class="container-fluid">
		<h3>Pie de página</h3>
	</footer>
	<!-- Incluimos jQuery y bootstrap.js, que precisa del anterior -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>