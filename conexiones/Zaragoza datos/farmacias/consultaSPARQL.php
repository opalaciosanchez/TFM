<?php
require_once( "sparqllib.php" );
 
$db = sparql_connect( "http://datos.zaragoza.es/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
 
/*$sparql = "SELECT distinct ?uri WHERE { ?uriCont a <http://www.zaragoza.es/api/kos/cultura-ocio/museos>;
    ?uri ?obj. } LIMIT 5";*/


$sparql = "
SELECT ?uriCont ?nombre ?description ?direccion ?tel ?tipo ?horario 
WHERE {
    ?uriCont a <http://www.zaragoza.es/api/kos/salud/farmacias>.
    OPTIONAL{?uriCont rdfs:label ?nombre.}
    OPTIONAL{?uriCont rdfs:comment ?description.}
    OPTIONAL{?uriCont <http://www.w3.org/2006/vcard/ns#/street-adr> ?direccion.}
    OPTIONAL{?uriCont <http://www.w3.org/2006/vcard/ns#/tel> ?tel.}
    OPTIONAL{?uriCont <http://www.w3.org/2006/vcard/ns#/category> ?tipo.}
    OPTIONAL{?uriCont <http://purl.org/goodrelations/v1#/hasOpeningHoursSpecification> ?horario.}
}
";

$result = sparql_query( $sparql ); 
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
 
$fields = sparql_field_array( $result );
 
print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
print "<table class='example_table'>";
print "<tr>";
foreach( $fields as $field )
{
	print "<th>$field</th>";
}
print "</tr>";
while( $row = sparql_fetch_array( $result ) )
{
	print "<tr>";
	foreach( $fields as $field )
	{
		print "<td>$row[$field]</td>";
	}
	print "</tr>";
}
print "</table>";