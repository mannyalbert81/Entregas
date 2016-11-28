<?php

try {
	
	
	$cliente = new SoapClient("http://192.168.0.112:3015/servicioweb/ReporteContabilidad.asmx?wsdl", array( 'trace' => true ) );
	
	//$cliente = new SoapClient("http://192.168.0.112:3015/servicioweb/ReporteContabilidad.asmx/ReporteCuentas", array( 'trace' => true ) );
	
     //$respuesta  = $cliente->reporte(array());
    
      $cliente->__soapCall('ReporteCuentas', array() );
     
    // print_r($respuesta);
    // var_dump($respuesta);
     
} catch (Exception $e) {
	echo $e->getMessage();
}


//$respuesta = $cliente->ReporteCuentas(array(''=>''));

//var_dump($info_hash);

die();

?>