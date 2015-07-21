$(function() {

// *********
// FUNCIÓN PARA LAS ASOCIACIONES DE ENFERMOS
//
// creamos las variables que vayamos a ir necesitando
// comenzamos capturando el botón que lanza la búsqueda
var $busquedaAsociacion = $('#busquedaAsociacion');
// capturamos el dato del formulario
var $palabra = $('#palabra');
// enlaces de categorias
var $categoria = $('.categoria');
// sección donde insertar el contenido
var $contenido = $('#contenidoAsoc');
// URL base de la consulta
var $URL = 'http://www.zaragoza.es/buscador/select?';

$busquedaAsociacion.on('click', function () {
  // eliminamos el contenido anterior
  $contenido.text("");
  $.ajax({
    type: 'GET',
    ifModified: true,
    url: $URL,
    // insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
    data: {'wt':'json', 'q':'title:' + $palabra.val() + ' text:' + $palabra.val() + ' AND category:Asociaciones'},
    success: resultados,
    dataType: 'jsonp',
    jsonp: 'json.wrf',
    error: function(xhr) {
      alert(xhr.responseText);
    } 
   });
});

/* CATEGORIAS */
$categoria.on('click', function () {
  // eliminamos el contenido anterior
  $contenido.text("");
  $.ajax({
    type: 'GET',
    ifModified: true,
    url: $URL,
    // insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
    data: {'wt':'json', 'q':'title:' +  $(this).text() + ' text:' +  $(this).text() + ' AND category:Asociaciones'},
    success: resultados,
    dataType: 'jsonp',
    jsonp: 'json.wrf',
    error: function(xhr) {
      alert(xhr.responseText);
    } 
   });
});

// función que muestra los resultados
function resultados(data) { 
  if (data.response.numFound !== 0) {

    $(".aviso").remove();
    $(".cerrar").remove();

    if ($contenido.css("display", "none")) {
      $contenido.toggle();
      $("#buscarAsoc").append('<strong class="aviso">Los resultados aparecen en la parte inferior</strong>');
      $("#buscarAsoc").append('<strong class="cerrar" tabindex="0">Cerrar resultados</strong>');
      $(".cerrar").on("click tab", function() {
          $(".aviso").remove();
          $(".cerrar").remove();
          $contenido.toggle();
      });
      $(".cerrar").on("keypress", function(e) {
        if(e.which == 13 || e.which == 32) {
          $(".aviso").remove();
          $(".cerrar").remove();
          $contenido.toggle();
        }
      });
    };
   
    $.each(data.response, function() {
      $.each(this, function () {
        $.each(this, function (k,v) {   
          switch (k) {
            case 'title':
              $contenido.append('<h4>' + v + '</h4>');
              break;
            case 'direccion_s':
              $contenido.append('<p><strong>Dirección </strong><a href="https://www.google.com/maps/place/' + v + '" target="_blank">' + v + '</a></p>');
              break;
            case 'telefono_s':
              $contenido.append('<p><strong>Teléfono </strong>' + v + '</p>');
              break;
            case 'mail_s':
              $contenido.append('<p><strong>Email </strong>' + v + '</p>');
              break;
            default:
              break;
          }       
        });
      });
    });

    $contenido.append("<p class='fuente'>Fuente: <a href='http://www.zaragoza.es/ciudad/risp/' target='_blank'>Ayuntamiento de Zaragoza</a></p>");
  } else {
    $contenido.append('<h4>No se han obtenido resultados en la búsqueda</h4>');
  }
  $palabra.val("");
}

// *********
// FUNCIONES PARA LOS CENTROS DE SALUD
//
// creamos las variables que vayamos a ir necesitando
// comenzamos capturando el botón que lanza la búsqueda
var $buscarCentro = $('#btnBuscarCentro');
// capturamos el dato del formulario
var $palabraCentro = $('#palabraCentro');
// enlaces de categorias
var $categoriaCentro = $('.categoriaCentro');
// sección donde insertar el contenido
var $contenidoCentro = $('#contenidoCentro');
// URL base de la consulta
var $URLCentro = 'http://www.zaragoza.es/buscador/select?';

$buscarCentro.on('click', function () {
  // alert($palabraCentro.val());
  // eliminamos el contenido anterior
  $contenidoCentro.text("");
  $.ajax({
    type: 'GET',
    ifModified: true,
    url: $URLCentro,
    // insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
    data: { 'wt':'json','q':'title:Salud AND (text:' + $palabraCentro.val() + ') AND category:Recursos' },
    success: resultadosCentro,
    dataType: 'jsonp',
    jsonp: 'json.wrf',
    error: function(xhr) {
      alert(xhr.responseText);
    } 
   });
});

// función que muestra los resultados
function resultadosCentro(data) { 
  if (data.response.numFound !== 0) {

   $(".aviso").remove();
   $(".cerrar").remove();

   if ($contenidoCentro.css("display", "none")) {
     $contenidoCentro.toggle();
     $("#buscarCentro").append('<strong class="aviso">Los resultados aparecen en la parte inferior</strong>');
     $("#buscarCentro").append('<strong class="cerrar" tabindex="0">Cerrar resultados</strong>');
     $(".cerrar").on("click tab", function(e) {
         $(".aviso").remove();
         $(".cerrar").remove();
         $contenidoCentro.toggle();
     });
     $(".cerrar").on("keypress", function(e) {
       if(e.which == 13 || e.which == 32) {
         $(".aviso").remove();
         $(".cerrar").remove();
         $contenidoCentro.toggle();
       }
     });
   };

    // creamos la URL base para permitir la ubicación del centro de salud en el mapa
    $urlMapa = "http://maps.google.com/?q=";
    $.each(data.response, function() {
      $.each(this, function () {
        $.each(this, function (k,v) { 
          // recorremos todos los elementos del interior de este objeto y comparamos su clave con la que nos interesa
          // en caso de coincidir, obtenemos su información para nuestro uso
          switch (k) {
            case 'title':
              $contenidoCentro.append('<h4>' + v + '</h4>');
              break;
            case 'calle_t':
              $contenidoCentro.append('<p><strong>Dirección: </strong>' + v + '</p>');
              break;
            case 'telefono_s':
              $contenidoCentro.append('<p><strong>Teléfono: </b>' + v + '</strong>');
              break;
            case 'coordenadas_p':
              $contenidoCentro.append('<p><a target="_blank" href="' + $urlMapa + v + '"><button class="btn btn-default">Ubicar en mapa</button></a></p>');
              break;
          } 
          
        });
      });
    });

    $contenidoCentro.append("<p class='fuente'>Fuente: <a href='http://www.zaragoza.es/ciudad/risp/' target='_blank'>Ayuntamiento de Zaragoza</a></p>");
  
  } else {
    $contenidoCentro.append('<h4>No se han obtenido resultados en la búsqueda</h4>');
  }
  $palabraCentro.val("");
}

// COMPORTAMIENTO PARA OCULTAR LAS SECCIONES DE MEDLINE Y HEALTHFINDER
// creamos las variables que vayamos a ir necesitando
// comenzamos capturando el botón que lanza la búsqueda
var $contenidoMostrar = $('.ampliar');
// código para mostrar zonas ocultas
$contenidoMostrar.on('click tab', function () {
  // se toma como referencia el elemento sobre el que se hace clic
  // con él, se identifican el resto de elementos siguientes HASTA QUE ENCUENTRA el siguiente enlace de título
    $(this).nextUntil('.ampliar').toggleClass('oculto');
});
// si la tecla pulsada es enter se actúa igual
$contenidoMostrar.on("keypress", function(e) {
  if(e.which == 13 || e.which == 32) {
    $(this).nextUntil('.ampliar').toggleClass('oculto');
  }
});

});