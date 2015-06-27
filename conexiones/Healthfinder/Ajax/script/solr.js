/// <reference path="../typings/jquery/jquery.d.ts"/>
$(function() {

// creamos las variables que vayamos a ir necesitando
// comenzamos capturando el botón que lanza la búsqueda
var $buscar = $('#buscar');
// capturamos el dato del formulario
var $palabra = $('#palabra');
// enlaces de categorias
// var $categoria = $('.categoria');
// sección donde insertar el contenido
var $contenido = $('#contenido');
// URL base de la consulta
var $URL = 'http://healthfinder.gov/developer/MyHFSearch.json?api_key=demo_api_key&who=child&age=16&gender=male';

/* BUSQUEDA */ 
$buscar.on('click', function () {
  alert("funciona");
  // eliminamos el contenido anterior
  $contenido.text("");
  $.ajax({
    type: 'GET',
    // ifModified: true,
    url: $URL,
    // insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
    // data: {'api_key':'jddtxibhqszsjiqq', 'keyword': + $palabra.val(), 'callback':'cbFunction' ,'lang':'es'},
    success: resultados,
    dataType: 'json',
    // jsonp: 'json.wrf',
    error: function(jqXHR, textStatus, errorThrown) {
      alert(jqXHR.status)
      alert(textStatus);
      alert(jqXHR.responseText);
    } 
   });
});

/* CATEGORIAS */
// $categoria.on('click', function () {
//   // eliminamos el contenido anterior
//   $contenido.text("");
//   $.ajax({
//     type: 'GET',
//     ifModified: true,
//     url: $URL,
//     // insertamos las variables que realizan la consulta. ATENCIÓN A LOS ESPACIOS entre elementos
//     data: {'wt':'json', 'q':'title:' +  $(this).text() + ' text:' +  $(this).text() + ' AND category:Asociaciones'},
//     success: resultados,
//     dataType: 'jsonp',
//     jsonp: 'json.wrf',
//     error: function(xhr) {
//       alert(xhr.responseText);
//     } 
//    });
// });

// función que muestra los resultados
function resultados(data) { 
  alert("la peticion ha funcionado");
}

});