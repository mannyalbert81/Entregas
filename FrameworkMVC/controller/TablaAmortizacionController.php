<?php

class TablaAmortizacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		
		session_start();
		$arrayGet=array();
		$resultRes="";
        $clientes = new ClientesModel();
        
        
        $interes_mensual = 0;
        $plazo_dias = 0;
        $cant_cuotas = 0;
        $tasa_mora = 0;
        $mora_mensual = 0;
        $valor_cuota = 0;
        
        
        
        $tipo_creditos = new TipoCreditosModel();
        $resultCre = $tipo_creditos->getAll("nombre_tipo_creditos");
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TablaAmortizacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				$resultAmortizacion=array();
				$resultDatos=array();
				$resultRubros=array();
				
				if(isset($_POST["buscar"]))
				{
				  
					$identificacion=$_POST['ruc_clientes'];
						
					if ($identificacion!=""){
					
						$columnas = "fc_clientes.id_clientes,
								  fc_clientes.ruc_clientes,
								  fc_clientes.razon_social_clientes,
								  entidades.nombre_entidades";
				
						$tablas=" public.fc_clientes,
  							public.entidades";
				
						$where="entidades.id_entidades = fc_clientes.id_entidades";
				
						$id="fc_clientes.id_clientes";
				
				
						$where_0 = "";
				
				
						if($identificacion!=""){$where_0=" AND fc_clientes.ruc_clientes='$identificacion'";}
				
				
							
						$where_to  = $where . $where_0;
							
						$resultRes = $clientes->getCondiciones($columnas, $tablas, $where_to, $id);
							
					
					}
				}
					
					
		     	if(isset($_POST["Generar"]))
					{
								
						$interes=0;
						$total= isset($_POST['capital_prestado_amortizacion_cabeza'])?(double)$_POST['capital_prestado_amortizacion_cabeza']:2; 
						$porcentaje_capital=isset($_POST['tasa_interes_amortizacion_cabeza'])?(double)$_POST['tasa_interes_amortizacion_cabeza']:2;
						$total_capital=$total-($total*($porcentaje_capital/100));
						$fecha_corte=$_POST['fecha_amortizacion_cabeza'];
						$fecha_emision='';
							
							
						array_push($resultDatos,array('total'=> $total,'porcentaje_capital'=>$porcentaje_capital,'total_capital'=>$total_capital));
		
						
						//valores
						$_tasa_interes_amortizacion_cabeza = $_POST['tasa_interes_amortizacion_cabeza']; 
						$_capital_prestado_amortizacion_cabeza = $_POST['capital_prestado_amortizacion_cabeza'];
						$_plazo_meses_amortizacion_cabeza = $_POST['plazo_meses_amortizacion_cabeza'];
						
						////resultados
						$interes_mensual = $_tasa_interes_amortizacion_cabeza / 12;
						$plazo_dias = $_plazo_meses_amortizacion_cabeza * 30;
						$cant_cuotas = $_plazo_meses_amortizacion_cabeza;
						$tasa_mora = 0;  /// recuperar
						$mora_mensual = 0;   // recuperar y calcular
						$valor_cuota = 0;
						
						
						
						$interes_mensual = 
						array_push($resultDatos2,array('interes_mensual'=> $interes_mensual,'plazo_dias'=>$plazo_dias,'cant_cuotas'=>$cant_cuotas
								,'tasa_mora'=>$tasa_mora ,'mora_mensual'=>$mora_mensual ,'valor_cuota'=>$valor_cuota  
								
						));
						//pruebas tabla amortizacion
							
						$saldo_capital=$total-($total*($porcentaje_capital/100));
						$tasa_interes=8.86;
						$numero_cuotas=$_POST['plazo_meses_amortizacion_cabeza'];
							
						$saldo_honorarios=0;
							
						$resultAmortizacion=$this->tablaAmortizacion($saldo_capital, $numero_cuotas, $fecha_corte, $total );
							
						$interes=0.812;
							
						$dias_mora=$this->diasMora($fecha_corte, $fecha_emision);
							
						$resultRubros=$this->tablaRubros($total, $interes, $dias_mora);
							
						
				}
		
				
				$this->view("TablaAmortizacion",array(
						"resultRes"=>$resultRes,'resultDatos'=>$resultDatos,'resultAmortizacion'=>$resultAmortizacion,'resultRubros'=>$resultRubros,'resultCre'=>$resultCre ,
						"resultDatos2"=>$resultDatos2
			
				));
		
				
				
			}
			
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Cierre"
				
				));
				
				exit();	
			}
				
		}
		else 
		{
				$this->view("ErrorSesion",array(
						"resultSet"=>""
			
				));
		
		}
	
	}
	
	public function tablaAmortizacion($saldo_capital,$numero_cuotas,$fecha_corte, $total)
	{
		//array donde guardar tabla amortizacion
		$resultAmortizacion=array();
	
	
		$tasa_interes=8.86;
	
		$saldo_honorarios=0;
		$otros=0;
		$total_Capital=0;
		$total_Honorarios=0;
		$total_Convenio=0;
		$total_Interes=0;
	
	
		$plazo=$numero_cuotas;
	
		$honoraExon = $saldo_honorarios / ($plazo);
	
		$porcent = ($tasa_interes / 12)/100;
			
		$capinteres = $saldo_capital * (($porcent * (pow((1 + $porcent), ((int)($plazo))))) / (pow((1 + $porcent), ((int)($plazo))) - 1));
	
	
		$inter = 1*$saldo_capital*$porcent;
	
		$abono = $capinteres-$inter;
			
		$saldocap = $saldo_capital;
	
		$cuota = round($capinteres,2)+round($honoraExon,2)+round($otros,2);
			
			
			
	
		for( $i = 1; $i <= $plazo; $i++) {
	
	
			$inter = 1*$saldocap*$porcent;
			$abono = $capinteres-$inter;
			$saldocap = $saldocap-$abono;
	
			$total_Interes = $total_Interes + $inter;
	
			$total_Capital = $total_Capital + $abono;
	
			$total_Honorarios = $total_Honorarios + $honoraExon;
	
			$total_Convenio = $total_Convenio + $cuota;
	
			$fecha=strtotime('+1 month',strtotime($fecha_corte));
	
			$fecha=date('Y-m-d',$fecha);
	
			$fecha_corte=$fecha;
				
				
			$resultAmortizacion['tabla'][]=array(
					array('periodo'=> $i,
							'fecha_vencimiento'=>$fecha,
							'abono_capital'=>$abono,
							'interes'=>$inter,
							'capital_interes'=>$capinteres,
							'saldo_capital'=>$saldocap,
							'saldo_honorarios'=>$honoraExon,
							'otros'=>$otros,
							'cuota'=>$cuota
					)
			);
		}
	
		$resultAmortizacion['totales']=array(
				array('total_capital'=> $total_Capital,
						'total_interes'=>$total_Interes,
						'total_honorarios'=>$total_Honorarios,
						'total_otros'=>$otros,
						'total_convenio'=>$total_Convenio
	
				));
	
		return $resultAmortizacion;
	
	
	}
	
	
	public function tablaRubros($saldo_capital,$interes,$dias_mora)
	{
		//****rubros
		//Interés Normal:	Interés Mora:	Costos Operativos (Gastos Cobranza: $0.00):	Capital:
		//Cuantía:	Mora Coactiva:	Emisión Título C.	Costas Procesales:	Honorarios:	Deuda Total:
		//****cabeceras
		//Rubros 	Deuda 	Interes Rebaja	% Rebaja de Intereses	Cuota Inicial 	Saldos
	
		$resultRubros=array();
		$deuda=0;
		$interes_rebaja=0;
		$porc_rebaja=0;
		$cuota_inicial=0;
		$saldos=0;
	
		$mora=($saldo_capital*$interes*12*$dias_mora)/3600;
		$fila=array('rubros'=>'','deuda'=>$deuda,'interes_rebaja'=>$interes_rebaja,'porc_rebaja'=>$porc_rebaja,'cuota_inicial'=>$cuota_inicial,'saldos'=>$saldos);
	
	
		$rubros=array('interes_normal'=>'Interés Normal:','interes_mora'=>'Interés Mora:','costos_operativos'=>'Costos Operativos(Gastos Cobranza: $0.00):','capital'=>	'Capital:',
				'cuantia'=>'Cuantía:','mora_coactiva'=>	'Mora Coactiva:','emision_titulo'=>'Emisión Título C:','costos_procesales'=>'Costos Procesales:','honorarios'=>'Honorarios:',
				'deudatotal'=>'Deuda Total:');
	
		$fila['rubros']=$rubros['interes_normal'];
		$resultRubros['interes_normal']=$fila;
	
		$fila['rubros']=$rubros['interes_mora'];
		$resultRubros['interes_mora']=$fila;
	
		$fila['rubros']=$rubros['costos_operativos'];
		$resultRubros['costos_operativos']=$fila;
	
		$fila['rubros']=$rubros['capital'];
		$fila['deuda']=$saldo_capital;
		$fila['saldos']=$saldo_capital;
		$resultRubros['capital']=$fila;
	
		$fila['rubros']=$rubros['cuantia'];
		$fila['deuda']=0;
		$fila['saldos']=0;
		$resultRubros['cuantia']=$fila;
	
		$fila['rubros']=$rubros['mora_coactiva'];
		$fila['deuda']=round($mora,2);
		$fila['saldos']=round($mora,2);
		$resultRubros['mora_coactiva']=$fila;
	
		$fila=array('rubros'=>'','deuda'=>$deuda,'interes_rebaja'=>$interes_rebaja,'porc_rebaja'=>$porc_rebaja,'cuota_inicial'=>$cuota_inicial,'saldos'=>$saldos);
		$fila['rubros']=$rubros['emision_titulo'];
		$resultRubros['emision_titulo']=$fila;
	
		$fila['rubros']=$rubros['costos_procesales'];
		$resultRubros['costos_procesales']=$fila;
	
		$fila['rubros']=$rubros['honorarios'];
		$resultRubros['honorarios']=$fila;
	
		$fila['rubros']=$rubros['deudatotal'];
		$resultRubros['deudatotal']=$fila;
	
	
		return $resultRubros;
	}
	
	public function diasMora($fecha_corte,$fecha_emision)
	{
	
		$_fecha_corte=date_create($fecha_corte);
	
		$_fecha_emision=date_create($fecha_emision);
	
		$dias_mora=date_diff($_fecha_emision, $_fecha_corte);
	
		$dias_mora=$dias_mora->format('%a');;
	
		return  $dias_mora;
	}
	
	
	




	
	
	
	
	
	
}
?>