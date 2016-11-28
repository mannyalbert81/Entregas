<?php

//$WebService="";
//parametros de la llamada
//Invocación al web service
//$WS = new SoapClient($WebService, $parametros);
//$ws = new SoapClient($WebService);
//recibimos la respuesta dentro de un objeto

//http://localhost:53325/servicioweb/ReporteContabilidad.asmx?op=ReporteCuentas

//$cliente = new SoapClient("http://www.webservicex.net/globalweather.asmx?wsdl");
$cliente = new SoapClient("http://192.168.0.112:3015/servicioweb/ReporteContabilidad.asmx?wsdl");
//obtener las funciones a las que puedo llamar
$funciones = $cliente->__getFunctions();

echo "<h2>Funciones del servicio</h2>";
foreach ($funciones as $funcion) {
	echo $funcion . "<br />";
}

//obtener los tipos de datos involucrados
echo "<h2>Tipos en el servicio</h2>";
$tipos = $cliente->__getTypes();

foreach ($tipos as $tipo) {
	echo $tipo . "<br />";
}

?>

