$(document).ready(function() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "http://www.zaragoza.es/buscador/select?wt=json&q=title:esclerosis%20text:esclerosis%20AND%20-tipocontenido_s:estatico%20AND%20category:Asociaciones",
        success: function(data) {
            $.each(data, function(k,v) {
                $("#lista").append("<li>Campo: " + k + " Valor: " + v + "</li>");
            });
        },
        error: function (xhr) {
             alert(xhr.responseText);
        }
    });
});