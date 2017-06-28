<?php
 
include('MPDF57/mpdf.php'); 

$html1 = 'hola';

//echo getcwd().'\n'; //para ver ubicacion de directorio

$dic_cabecera =$dt_cabpedido;
$dic_detalle =$dt_detpedido;

$diccionario = array(
 'titulopag'=>'Reporte Pedidos - Alldelivery 2017',
 'empresa'=>'Prodimeda',
 'numpag'=>'1',
 'totregistros'=> count($dic_cabecera),
 'datetoday'=>'hoy'
);

$diccionariocab = array(
		'identificacion'=>$dt_cabpedido[0]->ruc_clientes,
		'cliente'=>$dt_cabpedido[0]->razon_social_clientes,
		'numpedido'=>$dt_cabpedido[0]->numero_pedidos_cab,
		'fecha'=>$dt_cabpedido[0]->fcha_pedidos_cab,
		'direccion'=>$dt_cabpedido[0]->direccion_clientes,
		'telefono'=>$dt_cabpedido[0]->telefono_clientes,
		'usuario'=>$dt_cabpedido[0]->usuario_usuarios
);

$template = file_get_contents('./report/template/test.html');

foreach ($diccionario as $clave=>$valor) {
	$template = str_replace('{'.$clave.'}', $valor, $template);
}

foreach ($diccionariocab as $clave=>$valor) {
	$template = str_replace('{'.$clave.'}', $valor, $template);
}

//creacion del detalle

$detalle='';


foreach ($dic_detalle as $res)
{
	$total=0;
	$cantidad = (int)$res->cantidad_pedidos_det;
	$precio = (float)$res->precio_uno_productos;
	$total = $cantidad* $precio;
	$detalle.='<tr>';
	$detalle.='<td>'.$res->codigo_productos.'</td>';
	$detalle.='<td>'.$res->nombre_productos.'</td>';
	$detalle.='<td>'.$res->iva_productos.'</td>';
	$detalle.='<td>'.$res->id_unidades_medida.'</td>';
	$detalle.='<td>'.$res->cantidad_pedidos_det.'</td>';
	$detalle.='<td>'.$res->precio_uno_productos.'</td>';
	$detalle.='<td style="color:#000000;font-size:80%;">'.$total.'</td>';
	$detalle.='</tr>';
		
}

$template = str_replace('{detalle}', $detalle, $template);

//creacion del pdf
$mpdf=new mPDF();
$mpdf->Bookmark('inicio del pagina');
//$stylesheet = '<style>'.file_get_contents('./view/css/bootstrap.css').'</style>'; // la ruta a tu css
//print $stylesheet; die();
//$mpdf->WriteHTML($stylesheet,1);
//$mpdf->WriteHTML($template,2);
$mpdf->WriteHTML($template);
$mpdf->SetDisplayMode('default');
 
$mpdf->Output();

exit();
 
?>
