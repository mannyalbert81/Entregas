<?php

//$cliente = new SoapClient("http://localhost:53325/servicioweb/ReporteContabilidad.asmx?wsdl", array( 'trace' => true ) );
$cliente = new SoapClient("http://192.168.0.112:3015/servicioweb/ReporteContabilidad.asmx?wsdl", array( 'trace' => true ) );

$respuesta = $cliente->busca_Cuentas(array('str_cuenta'=>'PASIVO'));

$xml = $respuesta->busca_CuentasResult;

//$xml2 = $xml->Cuentas_Entidad;
$output='';

foreach($xml as $columnas)
{
	$output .= "<p>$columnas->nombre_entidades</p>";
	
}
print_r($output);

die();

// procesar xml
$xml2 = simplexml_load_string($xml2);



foreach($xml->Cuentas_Entidad as $table)
{
	$output .= "<p>$table->Name</p>";
}
print_r($output);

die();

print_r($respuesta);

echo $respuesta['busca_CuentasResult']['Cuentas_Entidad'];

/*foreach ($respuesta as $res)
{
	echo $res.'<br>';
}
*/
die();

//inicio cliente SOAP
$cliente = new SoapClient("http://localhost:53325/servicioweb/ReporteContabilidad.asmx?wsdl");

//hago la llamada pasando por parámetro un objeto como el que se define arriba
$respuesta = $cliente->ReporteCuentas(array());

var_dump( $cliente->__getLastRequest() );
#para ver el response del servidor SOAP
var_dump( $cliente->__getLastResponse()); // se imprime por pantalla la respuesta que será un Array asociativo con la estructura definida como GetWeatherResponse

?>