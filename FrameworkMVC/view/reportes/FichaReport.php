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
$SubTotal =0;
$Iva =0;
$TotalTotal =0;

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
	$id_unidades_medida 						= $res->nombre_unidades_medida;
	$cantidad_pedidos_det 						= $res->cantidad_pedidos_det;
	$precio_uno_productos 						= number_format($res->precio_uno_productos, 2);
	$Total = number_format($cantidad_pedidos_det * $precio_uno_productos, 2);
	$SubTotal=  number_format($SubTotal+$Total, 2) ;
	$Iva=  number_format($SubTotal*0.12, 2);
	$TotalTotal=  number_format($SubTotal + $Iva, 2);
	

	$texto_detalle = $texto_detalle . "<tr style='text-align: left;'>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$codigo_productos;
	$texto_detalle = $texto_detalle ."</td>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$nombre_productos;
	$texto_detalle = $texto_detalle ."</td>";
	$texto_detalle = $texto_detalle ."<td>";
	$texto_detalle = $texto_detalle .$id_unidades_medida;
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
$logo_imagen='<img src="'.$logo.'" alt="Responsive image" width="200" height="60">';


$html =
  '<html>'.
  '<head>'.
  
  	'<meta charset="utf-8"/>'.
  	'<title>Entregas 2017</title>'.
  	
  	
  '</head>'.
  '<body>'.
  
  '<div style="margin-top:10px; text-align: left; border-style: double; font-family: sans-serif; font-size:60%; width:100%;">'.
  '<div style="font-family: sans-serif; text-align: left; ">'.$logo_imagen.'<strong>'.'<center>'.'<H1>'.'DETALLE DE PEDIDO No: '.$numero_pedidos_cab  .'<H1>'.'</center>'.'</strong>'.
  '</div>'.
  '</div>'.
  '<div style=" position: absolute;  margin-left: 0%; width:100%;">'.
  	    
  '<div style="text-align: center; width:100%;" >'.
  $tabla_cabeza.
  '</div>'.
  '<div style="text-align: center; width:100%;" >'.
  $tabla_detalle.
  '</div>'.
  
  
  
  
  
  
  
  '<div  style= "margin-top:65%">'.
  		'<center>'.
  		'<table border="1" style="width:100%; height:10%;" >'.
  
  		'<tr>'.
  		'<td VALIGN="TOP" '.'<th style="text-align: left;">'.'Comentarios: '.$SubTotal.'<BR>'.'<BR><center>'.$usuario_usuarios.'<BR>'.'____________________'.'<BR>'.'ELABORADO POR'. '</th>'.'</td>'.
  		'<td VALIGN="TOP" '.'<th style="text-align: right;">'.'Subtotal: <span style="color:#ffffff">--------------------</span>' .$SubTotal.'<BR>'.'Descuento 0%: <span style="color:#ffffff">----------------------</span> 0.00'.'<BR>'.'NETO: <span style="color:#ffffff">--------------------</span>'.$SubTotal.'<BR>'.'IVA 12%: <span style="color:#ffffff">---------------------</span>'.$Iva.'<BR>'.'TOTAL: <span style="color:#ffffff">--------------------</span>'.$TotalTotal.
  		'</th>'.
  		'</td>'.
  		  			
  		'</tr>'.
  
  		
  		'</table>'.
  		'</center>'.
  		'<br>'.
  		'</div>'.
  
  
  
  
  
  
  '</div>'.
  '</body></html>';
 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream($codigo_productos .'.pdf',array('Attachment'=>0));

?>