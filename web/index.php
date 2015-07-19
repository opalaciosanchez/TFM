<?php include 'includes/header.php'; ?>
<!-- contenedor de la sección de contenido de la página -->
<div id="seccion" class="container-fluid">
	<section class="main">

	<!-- articulo con las búsquedas para Zaragoza Datos abiertos -->
		<article id="asociaciones" class="main row fondozgz">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<h3 class="buscar">Localizador de asociaciones</h3>
						<h4 class="buscar">Búsqueda por categoría de asociación</h4>
						<p class="categoria"><a href=#>Esclerosis</a></p>
						<p class="categoria"><a href=#>Cancer</a></p>
						<p class="categoria"><a href=#>Otras asociaciones de enfermos</a></p>
					</div>
					<div class="col-xs-12 col-md-6">
						<label for="palabra">buscar por palabra clave</label>
						<p class="help-block">
							El sistema realizará una búsqueda entre todas las asociaciones de la provincia de Zaragoza
						</p>
						<input type="text" class="form-control" id="palabra" name="palabra" placeholder="e.g. alzheimer" autofocus/>
						<button id="buscar" class="btn btn-default" name="buscar">Buscar</button>
					</div>
				</div>
			</div>
		</article>
		<div class="container">
			<div id="contenidoAsoc" class="row">
				<!-- aquí se carga el contenido Ajax de las asociaciones -->
			</div>
		</div>

		<!-- artículo donde se ofrece la información de servicio de Zaragoza -->
		<article id="servicios" class="main row">
		<div class="container">
			<h3 class="serviciosh3">Otros servicios en la provincia de Zaragoza</h3>
			<p>
				La plataforma de Open Data Salud le permite además de localizar asociaciones de enfermos, hacer uso de la información abierta proporcionada por el Ayuntamiento de Zaragoza para localizar otros tipos de servicios sanitarios.
				En concreto, la siguiente sección le permite localizar farmacias de guardia, simplemente insertando una fecha, o ubicar de forma sencilla en el mapa los centros de salud de la zona de Zaragoza que indique.
			</p>
			<div class="col-xs-12 col-sm-6 servicios">
				<h4>Farmacias de guardia</h4>
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				<!-- codigo para la búsqueda de farmacias de guardia -->
				<form name="php" id="php" action="consulta.php" method="POST" >
					<label class="sr-only" for="fecha">Introduce una fecha para buscar farmacia de guardia</label>
					<input class="form-control" type="text" id="datepicker" name="datepicker" placeholder="escoge una fecha ...">
					<input class="btn btn-default" type="submit" id="buscar" name="buscar" value="Buscar Farmacia"/>
				</form>
			</div>
			<div class="col-xs-12 col-sm-6 servicios">
				<h4>Centros de salud</h4>
				<span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
				<!-- búsqueda de centros de salud  -->
				<label class="sr-only" for="fecha">Busca centro de salud por distrito, nombre...</label>
				<input class="form-control" type="text" id="palabraCentro" name="palabraCentro" placeholder="nombre, distrito ..." autofocus/>
				<button class="btn btn-default" id="buscarCentro" name="buscarCentro">Buscar Centro de salud</button>
			</div>
		</div>
		</article>
		<div class="container">
			<div id="contenidoCentro" class="row">
				<!-- aquí se carga el contenido Ajax de los servicios de Zaragoza -->
			</div>
		</div>

		<!-- aquí comienza el artículo de las búsquedas de Medline (PHP) -->
		<article id="medline" class="main row fondomedline">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<h3 class="buscar">Información sobre enfermedades</h3>
						<h4 class="buscar">Esta búsqueda usa el catálogo de Medline</h4>
						<p>
							Medline es una base de datos perteneciente a la Biblioteca Nacional de Medicina de los Estados Unidos.
							Toda la información ofrecida en esta web está contrastada y proporcionada por profesionales médicos.
						</p>
					</div>
					<div class="col-xs-12 col-md-6">
						<label for="palabraEnfermedad">buscar por enfermedad</label>
						<p class="help-block">
							El sistema realizará una búsqueda en la completa base de datos de enfermedades Medline en castellano
						</p>
						<form id="medline" name="medline" action="consulta.php" method="POST">
							<input class="form-control" type="text" id="palabraEnfermedad" name="palabraEnfermedad" placeholder="tipo de enfermedad ..." autofocus/>
							<input type="hidden" name="buscarTermino" id="buscarTermino" value="buscarTermino" />
							<input class="btn btn-default" type="submit" id="buscar" name="buscar" value="Buscar"/>
						</form>
					</div>
				</div>
			</div>
		</article>

		<article id="separador" class="main row">
		<div class="container">
			<h3 class="serviciosh3">Aprovecha los sistemas de búsqueda de la plataforma</h3>
			<p>
				La plataforma de Open Data Salud ofrece información de interés general sobre enfermedades, cuidados y consejos para enfermos o familiares de enfermos. Qué saber sobre una patología, cómo enfrentarse a ella ... Toda la información obtenida en este proyecto pertenece a iniciativas de información abierta tanto a nivel nacional como internacional.
			</p>
			<div class="col-xs-12 col-sm-6 servicios">
				<h4>Información sanitaria</h4>
				<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
				<p>
					Realiza búsquedas relacionadas con el ámbito sanitario, tanto cercano como global, desde servicios locales de la provincia de Zaragoza, como información global sobre salud. Un proyecto en crecimiento.
				</p>
			</div>
			<div class="col-xs-12 col-sm-6 servicios">
				<h4>Información contrastada</h4>
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<p>
					Hazlo siempre con la confianza de saber que la información procede de fuentes oficiales y profesionales sanitarios. Ninguna de las informaciones aquí ofrecidas se ha buscado al azar. Todas han seguido un proceso de selección y análisis exhaustivo, respetando la libertad de información: información libre y de calidad.
				</p>
			</div>
		</div>
		</article>


		<!-- artículo de las búsquedas de Healthfinder (PHP) -->
		<article id="healthfinder" class="main row fondohealthfinder">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<h3 class="buscar">Vive bien, aprende cómo</h3>
						<h4 class="buscar">Oficina de prevención de enfermedades y promoción de la salud del Gobierno de EEUU</h4>
						<p>
							Healthfinder ofrece consejos, información y guías de salud en castellano.
							Toda la información ofrecida en esta web está contrastada y proporcionada por profesionales médicos.
						</p>
					</div>
					<div class="col-xs-12 col-md-6">
						<label for="palabraConsejo">buscar por enfermedad</label>
						<p class="help-block">
							El sistema realizará una búsqueda en la base de datos de cuidados de Healthfinder en castellano
						</p>
						<form id="healthfinderForm" name="healthfinderForm" action="consulta.php" method="POST">
							<input class="form-control" type="text" id="palabraConsejo" name="palabraConsejo" placeholder="duda sobre salud, consejo ..." autofocus/>
							<input type="hidden" name="buscarConsejo" id="buscarConsejo" value="buscarConsejo" />
							<input class="btn btn-default" type="submit" id="consejo" name="consejo" value="Buscar"/>
						</form>
					</div>
				</div>
			</div>
		</article>
	</section>
</div>

<?php include 'includes/footer.php'; ?>