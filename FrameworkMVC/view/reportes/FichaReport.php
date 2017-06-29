<?php

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
}

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
}



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

    
  '<div style="font-family: sans-serif;  whidth: 100%; text-align: left; ">'.
  '<p  ><h2> <strong>'. $logo_imagen  .'   </strong></h2> </p>'.
  '</div>'.
  
  '<div style=" position: absolute;  margin-left: 0%; width:100%;">'.
  	    
		
		'<div style="margin-top:10px;   font-family: sans-serif; font-size:75%; width:100%;">'.
  		'<strong>'.'Usuario:'.'</strong>'.
  		'</div>'.
        '<div style="color:#010a01; font-family: sans-serif; font-size:55%; width:100%; text-align: center;">'.
  		'<p> '.$codigo_productos.'</p>'.
  		'</div>'.
  		
		
		
		'<div style="margin-top:10px; background-color:#999E9A; color:#FFFFFF; font-family: sans-serif; font-size:75%; width:100%;">'.
  		'<strong>'. 'FORMA FARMACÉUTICA:'. '</strong>'.
  		'</div>'.
        '<div style="color:#010a01; font-family: sans-serif; font-size:55%; width:100%; text-align: center;">'.
  		'<p> '.$codigo_productos.'</p>'.
  		'</div>'.
        
        
          
		   '<div style="color:#010a01; font-family: sans-serif; font-size:55%; width:100%;">'.
  			'<p>'.$codigo_productos.'</p>'.	
  			'</div>'.
				
			
             
		 
         '<div style="margin-top:10px; background-color:#999E9A; color:#FFFFFF; font-family: sans-serif; font-size:75%; width:100%;">'.
  			'<strong>'. 'CARACTERISTICAS: '. '</strong>'.
  		'</div>'.
  		'<div style="color:#010a01; font-family: sans-serif; font-size:55%; width:100%;">'.
  			'<p> '.$codigo_productos.'</p>'.
  		'</div>'.
  				
		
	    
        '<div style="margin-top:10px; background-color:#999E9A; color:#FFFFFF; font-family: sans-serif; font-size:75%; width:100%;">'.
  			'<strong>'. 'MECANISMOS DE ACCIÓN: '. '</strong>'.
  		'</div>'.
  		'<div style="color:#010a01; font-family: sans-serif; font-size:55%; width:100%;">'.
  			'<p> '.$codigo_productos.'</p>'.
  		'</div>'.
  					
		
  		
        '<div style="margin-top:10px; background-color:#999E9A; color:#FFFFFF; font-family: sans-serif; font-size:75%; width:100%;">'.
  			'<strong>'. 'INDICACIONES DE USO:  '. '</strong>'.
  		'</div>'.
  		'<div style="color:#010a01; font-family: sans-serif; font-size:55%; width:100%;">'.
  			'<p> '.$codigo_productos.'</p>'.
  		'</div>'.
  		
		
	
  		'<div style="margin-top:10px; background-color:#999E9A; color:#FFFFFF; font-family: sans-serif; font-size:75%; width:100%;">'.
  			'<strong>'. 'DOSIFICACIÓN DE  '. '</strong>'.
			'<strong>'.$codigo_productos. '</strong>'.
  		'</div>'.
		'<div style="color:#010a01; font-family: sans-serif; font-size:55%; width:100%;">'.
  			''.	$codigo_productos .''.	
  			'</div>'.
  		
		
	
  		'<div style="margin-top:10px; background-color:#999E9A; color:#FFFFFF; font-family: sans-serif; font-size:75%; width:100%;">'.
  		'<strong>'. 'PERIODO DE RETIRO:  '. '</strong>'.
  		'</div>'.
  		'<div style="color:#010a01; font-family: sans-serif; font-size:55%; width:100%;">'.
  		'<p> '.$codigo_productos.'</p>'.
  		'</div>'.
  		
		
		
  		'<div style="margin-top:10px; background-color:#999E9A; color:#FFFFFF; font-family: sans-serif; font-size:75%; width:100%;">'.
  		'<strong>'. 'ADVERTENCIAS:'. '</strong>'.
  		'</div>'.
  		'<div style="margin-top:10px; color:#010a01; font-family: sans-serif; font-size:55%; width:100%;">'.
  		'<p>'.$codigo_productos .'</p>'.
  		'</div>'.
  		
		
		
		
  	'</div>'.
  	
	  	

  	
  	

  
  
  '</body></html>';
 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream($codigo_productos .'.pdf',array('Attachment'=>0));

?>