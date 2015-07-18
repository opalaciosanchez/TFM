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
	</section>
</div>




<?php include 'includes/footer.php'; ?>