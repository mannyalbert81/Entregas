<?php
$base_url = "http://186.71.172.100:4000/Entregas/";

$id_clientes                             	= "";
$id_pedidos_cab						   		= "";	  
$ruc_clientes			   					= "";	
$razon_social_clientes			   			= ""; 
$direccion_clientes    						= ""; 
$telefono_clientes			   				= "";	 
$numero_pedidos_cab			   				= "";	 
$fcha_pedidos_cab			   				= "";	 
$usuario_usuarios				   			= "";	 



$id_pedidos_det    							= "";
$id_pedidos_cab			   					= "";
$codigo_productos			   				= "";
$nombre_productos 							= "";
$iva_productos 								= "";
$id_unidades_medida 						= "";
$cantidad_pedidos_det 						= "";
$precio_uno_productos 						= "";


$tabla_cabeza = "";
$texto_inicio = "";
if ($dt_cabpedido !="")
{
	


	foreach($dt_cabpedido as $res)
	{
		
		$id_clientes                          	 	= $res->id_clientes;
		$id_pedidos_cab						     	= $res->id_pedidos_cab;
		$ruc_clientes			   				 	= $res->ruc_clientes;
		$razon_social_clientes			  		 	= $res->razon_social_clientes;
		$direccion_clientes   						= $res->direccion_clientes;
		$telefono_clientes			 				= $res->telefono_clientes;
		$numero_pedidos_cab							= $res->numero_pedidos_cab;
		$fcha_pedidos_cab		 					= $res->fcha_pedidos_cab;
		$usuario_usuarios			 				= $res->usuario_usuarios;
		
		
		
		$texto_inicio = "<table border='1' style='width:100%;'  >";
	    $texto_inicio = $texto_inicio . "<tr >";
		$texto_inicio = $texto_inicio ."<th style='text-align: left;'>";
		$texto_inicio = $texto_inicio . "Cliente: $razon_social_clientes";
		$texto_inicio = $texto_inicio ."</th>";
		$texto_inicio = $texto_inicio ."<th style='text-align: left;'>";
		$texto_inicio = $texto_inicio ."Ruc: $ruc_clientes";
		$texto_inicio = $texto_inicio ."</th>";
		$texto_inicio = $texto_inicio ."</tr>";
		
		$texto_inicio = $texto_inicio ."<tr>";
		$texto_inicio = $texto_inicio ."<th style='text-align: left;'>";
		$texto_inicio = $texto_inicio ."Dirección: $direccion_clientes";
		$texto_inicio = $texto_inicio ."</th>";
		$texto_inicio = $texto_inicio ."<th style='text-align: left;'>";
		$texto_inicio = $texto_inicio ."Teléfono: $telefono_clientes";
		$texto_inicio = $texto_inicio ."</th>";
		$texto_inicio = $texto_inicio ."</tr>";
		
		$texto_inicio = $texto_inicio ."<tr>";
		$texto_inicio = $texto_inicio ."<th style='text-align: left;'>";
		$texto_inicio = $texto_inicio ."Vendedor: $usuario_usuarios";
		$texto_inicio = $texto_inicio ."</th>";
		$texto_inicio = $texto_inicio ."<th style='text-align: left;'>";
		$texto_inicio = $texto_inicio ."Plazo: 5 Días";
		$texto_inicio = $texto_inicio ."</th>";
		$texto_inicio = $texto_inicio ."</tr>";
		
		$texto_inicio = $texto_inicio ."<tr>";
		$texto_inicio = $texto_inicio ."<th style='text-align: left;'>";
		$texto_inicio = $texto_inicio ."Fecha: $fcha_pedidos_cab";
		$texto_inicio = $texto_inicio ."</th>";
		$texto_inicio = $texto_inicio ."<th style='text-align: left;'>";
		$texto_inicio = $texto_inicio ."Página: 1";
		$texto_inicio = $texto_inicio ."</th>";
		$texto_inicio = $texto_inicio ."</tr>";
	

		
	}
	$texto_inicio = $texto_inicio . "</table>";
}
$tabla_cabeza = $texto_inicio;





$tabla_detalle = "";
$texto_detalle = "";
$Total ="";
if ($dt_detpedido !="")
{

	$texto_detalle = "<table border='1' style='width:100%;'  >";
	
	$texto_detalle = $texto_detalle . "<tr >";
	$texto_detalle = $texto_detalle ."<th>";
	$texto_detalle = $texto_detalle. "Codigo";
	$texto_detalle = $texto_detalle ."</th>";
	$texto_detalle = $texto_detalle ."<th>";
	$texto_detalle = $texto_detalle ."Nombre";
	$texto_detalle = $texto_detalle."</th>";
	$texto_detalle = $texto_detalle ."<th>";
	$texto_detalle = $texto_detalle ."IMP Presenta";
	$texto_detalle = $texto_detalle."</th>";
	$texto_detalle = $texto_detalle ."<th>";
	$texto_detalle = $texto_detalle ."Cantidad";
	$texto_detalle = $texto_detalle."</th>";
	$texto_detalle = $texto_detalle ."<th>";
	$texto_detalle = $texto_detalle ."Precio V/U";
	$texto_detalle = $texto_detalle."</th>";
	$texto_detalle = $texto_detalle ."<th>";
	$texto_detalle = $texto_detalle ."Precio Total";
	$texto_detalle = $texto_detalle."</th>";
	
	$texto_detalle = $texto_detalle ."</tr>";

	foreach($dt_detpedido as $res)
	{

	$id_pedidos_det    							= $res->id_pedidos_det;
	$id_pedidos_cab								= $res->id_pedidos_cab;
	$codigo_productos							= $res->codigo_productos;
	$nombre_productos 							= $res->nombre_productos;
	$iva_productos 								= $res->iva_productos;
	$id_unidades_medida 						= $res->id_unidades_medida;
	$cantidad_pedidos_det 						= $res->cantidad_pedidos_det;
	$precio_uno_productos 						= $res->precio_uno_productos;
	$Total = $cantidad_pedidos_det * $precio_uno_productos;
	

	$texto_detalle = $texto_detalle . "<tr style='text-align: center;'>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$codigo_productos;
	$texto_detalle = $texto_detalle ."</td>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$nombre_productos;
	$texto_detalle = $texto_detalle ."</td>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$iva_productos;
	$texto_detalle = $texto_detalle ."</td>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$cantidad_pedidos_det;
	$texto_detalle = $texto_detalle ."</td>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$precio_uno_productos;
	$texto_detalle = $texto_detalle ."</td>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$Total;
	$texto_detalle = $texto_detalle ."</td>";
	$texto_detalle = $texto_detalle ."</tr>";
		


	}
	$texto_detalle = $texto_detalle . "</table>";
}
$tabla_detalle = $texto_detalle;




$directorio=$_SERVER['DOCUMENT_ROOT'].'/Entregas/FrameworkMVC';
require_once($directorio.'/view/dompdf/dompdf_config.inc.php');
$logo=$directorio.'/view/images/logo.png';	
$logo_imagen='<img src="'.$logo.'" alt="Responsive image" width="200" height="70">';




$html =
  '<html>'.
  '<head>'.
  	'<meta charset="utf-8"/>'.
  	'<title> '. $numero_pedidos_cab  .' Entregas 2017</title>'.
  	
  '</head>'.
  '<body>'.
  
  '<div style="margin-top:10px;   font-family: sans-serif; font-size:75%; width:100%;">'.
  '<strong>'.'<center>'.'DETALLE DE PEDIDO No: '.$numero_pedidos_cab  .'</center>'.'</strong>'.
  '</div>'.
  
  '<div style="font-family: sans-serif;  whidth: 100%; text-align: left; ">'.$logo_imagen.'</div>'.
  
  '<div style=" position: absolute;  margin-left: 0%; width:100%;">'.
  	    
  '<div style="text-align: center; width:100%;" >'.
  $tabla_cabeza.
  '</div>'.
  '<div style="text-align: center; width:100%;" >'.
  $tabla_detalle.
  '</div>'.
  
  
  
  
  
  
  
  '<div  style= "margin-top:70%">'.
  		'<center>'.
  		'<table border="1"   style="width:100%;" >'.
  
  
  		
  		'<tr>'.
  		'<th align="center">'. '<strong>'.'<font size=2>'.  'IMPULSOR '. '<font>'. '</strong>'.'</th>'.
  		
  		'<th align="center">'. '<strong>'.'<font size=2>'.  'LIQUIDADOR '. '<font>'. '</strong>'.'</th>'.
  		
  		'</tr>'.
  		'<tr>'.
  		'<td align="center">'.'<font size=2>'.'Ab. '. $numero_pedidos_cab. '<font>'.'</td>'.
  		'<td align="center">'.'<font size=2>'.'Ab. '. $numero_pedidos_cab. '<font>'.'</td>'.
  		
  		'</tr>'.
  
  		'</table>'.
  		'</center>'.
  		'</div>'.
  
  
  
  
  
  
  '</div>'.
  '</body></html>';
 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream($codigo_productos .'.pdf',array('Attachment'=>0));

?>