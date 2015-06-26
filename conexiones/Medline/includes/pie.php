<script type="text/javascript" src="script/conexion.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

var $contenido = $('.ampliar');
// código para mostrar zonas ocultas
$contenido.on('click', function () {
	// se toma como referencia el elemento sobre el que se hace clic
	// con él, se identifican el resto de elementos siguientes HASTA QUE ENCUENTRA el siguiente enlace de título
	$(this).nextUntil('a').toggleClass('oculto');
});

</script>
</section>
</body>
</html>