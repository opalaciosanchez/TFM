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
			<div id="contenido" class="row">
				<!-- aquí se carga el contenido Ajax -->
			</div>
		</div>
		<article id="servicios" class="main row">
		<div class="container">
			<h3 class="serviciosh3">Otros servicios en la provincia de Zaragoza</h3>
			<p>
				La plataforma de Open Data Sanidad le permite además de localizar asociaciones de enfermos, hacer uso de la información abierta proporcionada por el Ayuntamiento de Zaragoza para localizar otros tipos de servicios sanitarios.
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
				<label class="sr-only" for="fecha">Busca centro de salud por distrito, nombre...</label>
				<input class="form-control" type="text" id="palabraCentro" name="palabraCentro" placeholder="nombre, distrito ..." autofocus/>
				<button class="btn btn-default" id="buscarCentro" name="buscarCentro">Buscar Centro de salud</button>
			</div>
		</div>
		</article>
		<div class="container">
			<div id="contenidoCentro" class="row">
				<!-- aquí se carga el contenido Ajax -->
			</div>
		</div>
		<article id="medline" class="main row fondomedline">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-6">
						<h3 class="buscar">Información sobre enfermedades</h3>
						<h4 class="buscar">Esta búsqueda hace uso del completo catálogo de Medline para ...</h4>

					</div>
					<div class="col-xs-12 col-md-6">
						<label for="palabra">buscar por enfermedad</label>
						<p class="help-block">
							El sistema realizará una búsqueda en la base de datos de Medline
						</p>

					</div>
				</div>
			</div>
		</article>
	</section>
</div>

<?php include 'includes/footer.php'; ?>