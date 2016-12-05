<?php

class ComprobantesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//maycol

	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$arrayGet=array();
			$temp_comprobantes=new ComprobantesTemporalModel();
			$d_comprobantes = new DComprobantesModel();
			
			$tipo_comprobante=new TipoComprobantesModel();
			$resultTipCom = $tipo_comprobante->getBy("nombre_tipo_comprobantes='INGRESOS' OR nombre_tipo_comprobantes='EGRESOS'");
			
			$forma_pago = new FormaPagoModel();
			$resultForm = $forma_pago->getAll("nombre_forma_pago");
			
		    $columnas_enc = "entidades.id_entidades, 
  							entidades.nombre_entidades";
		    $tablas_enc ="public.usuarios, 
						  public.entidades";
		    $where_enc ="entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		    $id_enc="entidades.nombre_entidades";
		    $resultSet=$d_comprobantes->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		    	
				
		    $permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Comprobantes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				
				if (isset($_POST['ruc_ccomprobantes'])){
					
				$_ruc_ccomprobantes =$_POST['ruc_ccomprobantes'];
				$_nombres_ccomprobantes =$_POST['nombres_ccomprobantes'];
				$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
				$_retencion_ccomprobantes =$_POST['retencion_ccomprobantes'];
				$_concepto_ccomprobantes =$_POST['concepto_ccomprobantes'];
				$resultTipoComprobantes = $tipo_comprobante->getBy("id_tipo_comprobantes='$_id_tipo_comprobantes'");
				$_fecha_ccomprobantes =$_POST['fecha_ccomprobantes'];
				$_referencia_doc_ccomprobantes =$_POST['referencia_doc_ccomprobantes'];
				$_id_forma_pago =$_POST['id_forma_pago'];
				$_numero_cuenta_banco_ccomprobantes=$_POST['numero_cuenta_banco_ccomprobantes'];
				$_numero_cheque_ccomprobantes=$_POST['numero_cheque_ccomprobantes'];
				$_observaciones_ccomprobantes=$_POST['observaciones_ccomprobantes'];
				
					
				$arrayGet['array_ruc_ccomprobantes']=$_ruc_ccomprobantes;
				$arrayGet['array_nombres_ccomprobantes']=$_nombres_ccomprobantes;
				//$arrayGet['array_nombre_tipo_comprobantes']=$resultTipoComprobantes[0]->nombre_tipo_comprobantes;
				$arrayGet['array_id_tipo_comprobantes']=$resultTipoComprobantes[0]->id_tipo_comprobantes;
				$arrayGet['array_retencion_ccomprobantes']=$_retencion_ccomprobantes;
				$arrayGet['array_concepto_ccomprobantes']=$_concepto_ccomprobantes;
				$arrayGet['array_fecha_ccomprobantes']=$_fecha_ccomprobantes;
				$arrayGet['array_referencia_doc_ccomprobantes']=$_referencia_doc_ccomprobantes;
				$arrayGet['array_id_forma_pago']=$_id_forma_pago;
				$arrayGet['array_numero_cuenta_banco_ccomprobantes']=$_numero_cuenta_banco_ccomprobantes;
				$arrayGet['array_numero_cheque_ccomprobantes']=$_numero_cheque_ccomprobantes;
				$arrayGet['array_observaciones_ccomprobantes']=$_observaciones_ccomprobantes;
					
				}
				
					
				if(isset($_GET["id_temp_comprobantes"]))
				{
					$_id_usuarios= $_SESSION['id_usuarios'];
					$id_temp_comprobantes=(int)$_GET["id_temp_comprobantes"];
						
					$where = "id_usuario_registra = '$_id_usuarios' AND id_temp_comprobantes = '$id_temp_comprobantes'  ";
					$resultado = $temp_comprobantes->deleteByWhere($where);
						
					//$temp_comprobantes->deleteBy(" id_temp_comprobantes",$id_temp_comprobantes);
				
					$traza=new TrazasModel();
					$_nombre_controlador = "Comprobantes";
					$_accion_trazas  = "Borrar";
					$_parametros_trazas = $id_temp_comprobantes;
					$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				
				
				if(isset($_POST["plan_cuentas"])){
					$_id_plan_cuentas= $_POST["plan_cuentas"];
				
					if($_id_plan_cuentas==""){
							
					}else
					{
							
							
						$_descripcion_dcomprobantes= $_POST["descripcion_dcomprobantes"];
				
						$_debe_dcomprobantes= $_POST["debe_dcomprobantes"];
							
						if ($_debe_dcomprobantes=="")
						{
							$_debe_dcomprobantes=0;
				
						}
						$_haber_dcomprobantes= $_POST["haber_dcomprobantes"];
							
						if ($_haber_dcomprobantes=="")
						{
							$_haber_dcomprobantes=0;
								
						}
							
						$funcion = "ins_temp_comprobantes";
						$parametros = "'$_id_usuarios','$_id_plan_cuentas','$_descripcion_dcomprobantes','$_debe_dcomprobantes','$_haber_dcomprobantes'";
						$temp_comprobantes->setFuncion($funcion);
						$temp_comprobantes->setParametros($parametros);
						$resultado=$temp_comprobantes->Insert();
							
					}
				}	
				
					$columnas_res = " temp_comprobantes.id_temp_comprobantes,
				          plan_cuentas.id_plan_cuentas,
		    		      plan_cuentas.codigo_plan_cuentas,
						  plan_cuentas.nombre_plan_cuentas,
						  temp_comprobantes.observacion_temp_comprobantes,
						  temp_comprobantes.debe_temp_comprobantes,
						  temp_comprobantes.haber_temp_comprobantes";
				$tablas_res ="public.temp_comprobantes,
						  public.usuarios,
						  public.plan_cuentas,
						  public.entidades";
				$where_res ="temp_comprobantes.id_plan_cuentas = plan_cuentas.id_plan_cuentas AND
				usuarios.id_usuarios = temp_comprobantes.id_usuario_registra AND
				usuarios.id_entidades = entidades.id_entidades AND
				entidades.id_entidades = plan_cuentas.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
				$id_res="temp_comprobantes.id_temp_comprobantes";
				
				$resultRes=$d_comprobantes->getCondiciones($columnas_res ,$tablas_res ,$where_res, $id_res);
				
				
				 
					
					$this->view("Comprobantes",array(
							
							"resultSet"=>$resultSet, "resultRes"=>$resultRes, "resultTipCom"=>$resultTipCom, "arrayGet"=>$arrayGet, "resultForm"=>$resultForm
					));
			
			
			}else{
				
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Generar Comprobantes"
				
					
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
	 
	
	
	/*
	public function InsertarTemporal(){
		
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		
		$temp_comprobantes=new ComprobantesTemporalModel();
		$nombre_controladores = "Comprobantes";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $temp_comprobantes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		
		
		if (isset ($_POST["plan_cuentas"]) && isset ($_POST["descripcion_dcomprobantes"]) && isset ($_POST["debe_dcomprobantes"]) && isset($_POST["haber_dcomprobantes"])  )
		{
		
		
			$_id_plan_cuentas= $_POST["plan_cuentas"];
			$_descripcion_dcomprobantes= $_POST["descripcion_dcomprobantes"];
			$_debe_dcomprobantes= $_POST["debe_dcomprobantes"];
		
			if ($_debe_dcomprobantes=="")
			{
				$_debe_dcomprobantes=0;
					
			}
			$_haber_dcomprobantes= $_POST["haber_dcomprobantes"];
		
			if ($_haber_dcomprobantes=="")
			{
				$_haber_dcomprobantes=0;
		
			}
		
			$funcion = "ins_temp_comprobantes";
			$parametros = "'$_id_usuarios','$_id_plan_cuentas','$_descripcion_dcomprobantes','$_debe_dcomprobantes','$_haber_dcomprobantes'";
			$temp_comprobantes->setFuncion($funcion);
			$temp_comprobantes->setParametros($parametros);
			$resultado=$temp_comprobantes->Insert();
		
		}
	}
		
   */
	
   public function InsertaComprobantes(){
   
   	session_start();
   
   	$resultado = null;
   	$permisos_rol=new PermisosRolesModel();
   
   	
   	$consecutivos = new ConsecutivosModel();
    $ccomprobantes = new CComprobantesModel();
   	$dcomprobantes = new DComprobantesModel();
   	$tem_comprobantes = new ComprobantesTemporalModel();
   	$tipo_comprobantes = new TipoComprobantesModel();
   	$plan_cuentas = new PlanCuentasModel();
   
   
   	$nombre_controladores = "Comprobantes";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $ccomprobantes->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
   
   	if (!empty($resultPer))
   	{
   		
   		if (isset ($_POST["id_entidades"]))
   		{
   
   			$_id_usuarios = $_SESSION['id_usuarios'];
   			
   			$where =  "id_usuario_registra= '$_id_usuarios' ";
   			$resultCom =  $tem_comprobantes->getBy($where);
   			
   			$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
   			$resultTip = $tipo_comprobantes->getBy("id_tipo_comprobantes='$_id_tipo_comprobantes'");
   			$_nombre_tipo_comprobantes=$resultTip[0]->nombre_tipo_comprobantes;
   			
   			
   		if ($_nombre_tipo_comprobantes == "INGRESOS")
   	 	{
   				
   				
   				
   			$_id_entidades =$_POST['id_entidades'];
   			$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
   			$resultConsecutivos = $consecutivos->getBy("nombre_consecutivos LIKE '%INGRESOS%' AND id_entidades='$_id_entidades' AND id_tipo_comprobantes='$_id_tipo_comprobantes'");
   			$_id_consecutivos=$resultConsecutivos[0]->id_consecutivos;
   			
   			$_numero_consecutivos=$resultConsecutivos[0]->numero_consecutivos;
   			$_update_numero_consecutivo=((int)$_numero_consecutivos)+1;
   			$_update_numero_consecutivo=str_pad($_update_numero_consecutivo,6,"0",STR_PAD_LEFT);
   			
   			$_ruc_ccomprobantes =$_POST['ruc_ccomprobantes'];
   			$_nombres_ccomprobantes =$_POST['nombres_ccomprobantes'];
   			$_retencion_ccomprobantes =$_POST['retencion_ccomprobantes'];
   			$_valor_ccomprobantes =$_POST['valor_ccomprobantes'];
   			$_concepto_ccomprobantes =$_POST['concepto_ccomprobantes'];
   			$_id_usuario_creador=$_SESSION['id_usuarios'];
   			$_valor_letras =$_POST['valor_letras'];
   			$_fecha_ccomprobantes = $_POST['fecha_ccomprobantes'];
   			$_referencia_doc_ccomprobantes =$_POST['referencia_doc_ccomprobantes'];
   			$_id_forma_pago =$_POST['id_forma_pago'];
   			$_numero_cuenta_banco_ccomprobantes=$_POST['numero_cuenta_banco_ccomprobantes'];
   			$_numero_cheque_ccomprobantes=$_POST['numero_cheque_ccomprobantes'];
   			$_observaciones_ccomprobantes=$_POST['observaciones_ccomprobantes'];
   
   
   			///PRIMERO INSERTAMOS LA CABEZA DEL COMPROBANTE
   			try
   			{
   					
   				$funcion = "ins_ccomprobantes";
   				$parametros = "'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador', '$_valor_letras', '$_fecha_ccomprobantes', '$_id_forma_pago', '$_referencia_doc_ccomprobantes', '$_numero_cuenta_banco_ccomprobantes', '$_numero_cheque_ccomprobantes', '$_observaciones_ccomprobantes'";
   				$ccomprobantes->setFuncion($funcion);
   				$ccomprobantes->setParametros($parametros);
   				$resultado=$ccomprobantes->Insert();
   				
   				$resultConsecutivo=$consecutivos->UpdateBy("numero_consecutivos='$_update_numero_consecutivo'", "consecutivos", "id_consecutivos='$_id_consecutivos'");
   				
   				
   				//$print="'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador'";
   				//$this->view("Error",array("resultado"=>$print));	
   				//die();
   
   				///INSERTAMOS DETALLE  DEL MOVIMIENTO
   					
   				foreach($resultCom as $res)
   				{
   
   					//busco si existe este nuevo id
   					try
   					{
   						$_id_plan_cuentas = $res->id_plan_cuentas;
   						$_descripcion_dcomprobantes = $res->observacion_temp_comprobantes;
   						$_debe_dcomprobantes = $res->debe_temp_comprobantes;
   						$_haber_dcomprobantes = $res->haber_temp_comprobantes;
   
   						$resultComprobantes = $ccomprobantes->getBy("numero_ccomprobantes ='$_numero_consecutivos' AND id_entidades ='$_id_entidades' AND id_tipo_comprobantes='$_id_tipo_comprobantes'");
   						$_id_ccomprobantes=$resultComprobantes[0]->id_ccomprobantes;
   						
   						
   						
   						$funcion = "ins_dcomprobantes";
   						$parametros = "'$_id_ccomprobantes','$_numero_consecutivos','$_id_plan_cuentas', '$_descripcion_dcomprobantes', '$_debe_dcomprobantes', '$_haber_dcomprobantes'";
   						$dcomprobantes->setFuncion($funcion);
   						$dcomprobantes->setParametros($parametros);
   						$resultado=$dcomprobantes->Insert();
   						
   						$resultSaldoIni = $plan_cuentas->getBy("id_plan_cuentas ='$_id_plan_cuentas' AND id_entidades ='$_id_entidades'");
   						$_saldo_ini=$resultSaldoIni[0]->saldo_fin_plan_cuentas;
   							
   						
   						$_fecha_mayor = getdate();
   						$_fecha_año=$_fecha_mayor['year'];
   						$_fecha_mes=$_fecha_mayor['mon'];
   						$_fecha_dia=$_fecha_mayor['mday'];
   							
   						$_fecha_actual=$_fecha_año.'-'.$_fecha_mes.'-'.$_fecha_dia;
   							
   						////llamas a la funcion mayoriza();
   						$resul = $dcomprobantes->Mayoriza($_id_plan_cuentas, $_id_ccomprobantes, $_fecha_actual, $_debe_dcomprobantes, $_haber_dcomprobantes, $_saldo_ini);
   						$_cadena = $_id_plan_cuentas .'-'. $_id_ccomprobantes .'-'. $_fecha_actual .'-'. $_debe_dcomprobantes .'-'. $_haber_dcomprobantes .'-'. $_saldo_ini ;
   							
   							
   						///LAS TRAZAS
   						$traza=new TrazasModel();
   						$_nombre_controlador = "Comprobantes";
   						$_accion_trazas  = "Guardar";
   						$_parametros_trazas = $_id_plan_cuentas;
   						$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
   							
   						
   						///borro de las solicitudes el carton
   						$where_del = "id_usuario_registra= '$_id_usuarios'";
   						$tem_comprobantes->deleteByWhere($where_del);
   							
   							
   							
   							
   
   					} catch (Exception $e)
   					{
   						$this->view("Error",array(
   								"resultado"=>"Eror al Insertar Comprobantes ->". $id
   						));
   						exit();
   					}
   						
   				}					
   					
   					
   			}
   			catch (Exception $e)
   			{
   
   					
   
   			}
   
   
   			
   		}
   		else{
   			
   			$_id_entidades =$_POST['id_entidades'];
   			$_id_tipo_comprobantes =$_POST['id_tipo_comprobantes'];
   			$resultConsecutivos = $consecutivos->getBy("nombre_consecutivos LIKE '%EGRESOS%' AND id_entidades='$_id_entidades'AND id_tipo_comprobantes='$_id_tipo_comprobantes'");
   			$_id_consecutivos=$resultConsecutivos[0]->id_consecutivos;
   			
   			$_numero_consecutivos=$resultConsecutivos[0]->numero_consecutivos;
   			$_update_numero_consecutivo=((int)$_numero_consecutivos)+1;
   			$_update_numero_consecutivo=str_pad($_update_numero_consecutivo,6,"0",STR_PAD_LEFT);
   			
   			$_ruc_ccomprobantes =$_POST['ruc_ccomprobantes'];
   			$_nombres_ccomprobantes =$_POST['nombres_ccomprobantes'];
   			$_retencion_ccomprobantes =$_POST['retencion_ccomprobantes'];
   			$_valor_ccomprobantes =$_POST['valor_ccomprobantes'];
   			$_concepto_ccomprobantes =$_POST['concepto_ccomprobantes'];
   			$_id_usuario_creador=$_SESSION['id_usuarios'];
   			$_valor_letras =$_POST['valor_letras'];
   			$_fecha_ccomprobantes = $_POST['fecha_ccomprobantes'];
   			$_referencia_doc_ccomprobantes =$_POST['referencia_doc_ccomprobantes'];
   			$_id_forma_pago =$_POST['id_forma_pago'];
   			$_numero_cuenta_banco_ccomprobantes=$_POST['numero_cuenta_banco_ccomprobantes'];
   			$_numero_cheque_ccomprobantes=$_POST['numero_cheque_ccomprobantes'];
   			$_observaciones_ccomprobantes=$_POST['observaciones_ccomprobantes'];
   			 
   			 
   			 
   			///PRIMERO INSERTAMOS LA CABEZA DEL COMPROBANTE
   			try
   			{
   			
   				$funcion = "ins_ccomprobantes";
   				$parametros = "'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador', '$_valor_letras', '$_fecha_ccomprobantes', '$_id_forma_pago', '$_referencia_doc_ccomprobantes', '$_numero_cuenta_banco_ccomprobantes', '$_numero_cheque_ccomprobantes', '$_observaciones_ccomprobantes'";
   				$ccomprobantes->setFuncion($funcion);
   				$ccomprobantes->setParametros($parametros);
   				$resultado=$ccomprobantes->Insert();
   				
   				$resultConsecutivo=$consecutivos->UpdateBy("numero_consecutivos='$_update_numero_consecutivo'", "consecutivos", "id_consecutivos='$_id_consecutivos'");
   					
   					
   				//$print="'$_id_entidades','$_id_tipo_comprobantes', '$_numero_consecutivos','$_ruc_ccomprobantes','$_nombres_ccomprobantes' ,'$_retencion_ccomprobantes' ,'$_valor_ccomprobantes' ,'$_concepto_ccomprobantes', '$_id_usuario_creador', '$_valor_letras'";
   				//$this->view("Error",array("resultado"=>$print));
   				//die();
   				 
   				///INSERTAMOS DETALLE  DEL MOVIMIENTO
   			
   				foreach($resultCom as $res)
   				{
   					 
   					//busco si existe este nuevo id
   					try
   					{
   						$_id_plan_cuentas = $res->id_plan_cuentas;
   						$_descripcion_dcomprobantes = $res->observacion_temp_comprobantes;
   						$_debe_dcomprobantes = $res->debe_temp_comprobantes;
   						$_haber_dcomprobantes = $res->haber_temp_comprobantes;
   						 
   						$resultComprobantes = $ccomprobantes->getBy("numero_ccomprobantes ='$_numero_consecutivos' AND id_entidades ='$_id_entidades' AND id_tipo_comprobantes='$_id_tipo_comprobantes'");
   						$_id_ccomprobantes=$resultComprobantes[0]->id_ccomprobantes;
   							
   							
   							
   						$funcion = "ins_dcomprobantes";
   						$parametros = "'$_id_ccomprobantes','$_numero_consecutivos','$_id_plan_cuentas', '$_descripcion_dcomprobantes', '$_debe_dcomprobantes', '$_haber_dcomprobantes'";
   						$dcomprobantes->setFuncion($funcion);
   						$dcomprobantes->setParametros($parametros);
   						$resultado=$dcomprobantes->Insert();
   			
   						$resultSaldoIni = $plan_cuentas->getBy("id_plan_cuentas ='$_id_plan_cuentas' AND id_entidades ='$_id_entidades'");
   						$_saldo_ini=$resultSaldoIni[0]->saldo_fin_plan_cuentas;
   						
   						
   						$_fecha_mayor = getdate();
   						$_fecha_año=$_fecha_mayor['year'];
   						$_fecha_mes=$_fecha_mayor['mon'];
   						$_fecha_dia=$_fecha_mayor['mday'];
   						
   						$_fecha_actual=$_fecha_año.'-'.$_fecha_mes.'-'.$_fecha_dia;
   						
   						////llamas a la funcion mayoriza();
   						$resul = $dcomprobantes->Mayoriza($_id_plan_cuentas, $_id_ccomprobantes, $_fecha_actual, $_debe_dcomprobantes, $_haber_dcomprobantes, $_saldo_ini);
   						$_cadena = $_id_plan_cuentas .'-'. $_id_ccomprobantes .'-'. $_fecha_actual .'-'. $_debe_dcomprobantes .'-'. $_haber_dcomprobantes .'-'. $_saldo_ini; 
   						
   						
   						
   						///LAS TRAZAS
   						$traza=new TrazasModel();
   						$_nombre_controlador = "Comprobantes";
   						$_accion_trazas  = "Guardar";
   						$_parametros_trazas = $_id_plan_cuentas;
   						$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
   			
   							
   						$where_del = "id_usuario_registra= '$_id_usuarios'";
   						$tem_comprobantes->deleteByWhere($where_del);
   			
   			
   			
   			
   						 
   					} catch (Exception $e)
   					{
   						$this->view("Error",array(
   								"resultado"=>"Eror al Insertar Comprobantes ->". $id
   						));
   						exit();
   					}
   						
   				}
   			
   			
   			}
   			catch (Exception $e)
   			{
   				 
   			
   				 
   			}
   			 
   			
   			
   		}
   		
   		
   
   		}	
   		
   		$this->redirect("Comprobantes","index")	;
   	}
   	else
   	{
   		$this->view("Error",array(
   				"resultado"=>"No tiene Permisos de Guardar Comprobantes"
   
   		));
   
   
   	}
   
   
   
   }
   
    
   /*
   
   public function borrarId()
   {
   
   	session_start();
   
   	$permisos_rol=new PermisosRolesModel();
   	$nombre_controladores = "Comprobantes";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
   		
   	if (!empty($resultPer))
   	{
   		if(isset($_GET["id_temp_comprobantes"]))
   		{
   			$id_temp_comprobantes=(int)$_GET["id_temp_comprobantes"];
   
   			$temp_comprobantes=new ComprobantesTemporalModel();
   			
   			$temp_comprobantes->deleteBy(" id_temp_comprobantes",$id_temp_comprobantes);
   
   			$traza=new TrazasModel();
   			$_nombre_controlador = "Comprobantes";
   			$_accion_trazas  = "Borrar";
   			$_parametros_trazas = $id_temp_comprobantes;
   			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
   		}
   			
   		$this->redirect("Comprobantes", "index");
   			
   			
   	}
   	else
   	{
   		$this->view("Error",array(
   				"resultado"=>"No tiene Permisos de Borrar Comprobantes"
		
   		));
   	}
   
   }
   
    
   */
   
   
		
	
	public function AutocompleteComprobantesCodigo(){
		
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$plan_cuentas = new PlanCuentasModel();
	    $codigo_plan_cuentas = $_GET['term'];
	
	    //$resultSet=$plan_cuentas->getBy("codigo_plan_cuentas LIKE '$codigo_plan_cuentas%'");
	    
	    
	    
		$columnas ="plan_cuentas.codigo_plan_cuentas, 
				  plan_cuentas.nombre_plan_cuentas, 
				  plan_cuentas.id_plan_cuentas";
		$tablas =" public.usuarios, 
				  public.entidades, 
				  public.plan_cuentas";
		$where ="plan_cuentas.codigo_plan_cuentas LIKE '$codigo_plan_cuentas%' AND entidades.id_entidades = usuarios.id_entidades AND
 				 plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'";
		$id ="plan_cuentas.codigo_plan_cuentas";
		
		
		$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
	
	
		if(!empty($resultSet)){
				
			foreach ($resultSet as $res){
	
				$_codigo_plan_cuentas[] = $res->codigo_plan_cuentas;
			}
			echo json_encode($_codigo_plan_cuentas);
		}
	
	}
	
	
	
	
	public function AutocompleteComprobantesDevuelveNombre(){
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		
		$plan_cuentas = new PlanCuentasModel();
		$codigo_plan_cuentas = $_POST['codigo_plan_cuentas'];
		
		
		$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
		$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
		$where ="plan_cuentas.codigo_plan_cuentas = '$codigo_plan_cuentas' AND entidades.id_entidades = usuarios.id_entidades AND
		plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'";
		$id ="plan_cuentas.codigo_plan_cuentas";
		
		
		$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
		
	
		$respuesta = new stdClass();
	
		if(!empty($resultSet)){
				
			$respuesta->nombre_plan_cuentas = $resultSet[0]->nombre_plan_cuentas;
			$respuesta->id_plan_cuentas = $resultSet[0]->id_plan_cuentas;
				
			echo json_encode($respuesta);
		}
	
	}
	
	
	
	
	public function AutocompleteComprobantesNombre(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$plan_cuentas = new PlanCuentasModel();
		$nombre_plan_cuentas = strtoupper($_GET['term']);
	
		//$resultSet=$plan_cuentas->getBy("codigo_plan_cuentas LIKE '$codigo_plan_cuentas%'");
		 
		 
		 
		$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
		$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
		$where ="plan_cuentas.nombre_plan_cuentas LIKE '$nombre_plan_cuentas%' AND entidades.id_entidades = usuarios.id_entidades AND
		plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'";
		$id ="plan_cuentas.codigo_plan_cuentas";
	
	
		$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
	
	
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
	
				$_nombre_plan_cuentas[] = $res->nombre_plan_cuentas;
			}
			echo json_encode($_nombre_plan_cuentas);
		}
	
	}
	
	
	
	
	public function AutocompleteComprobantesDevuelveCodigo(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		$plan_cuentas = new PlanCuentasModel();
	
		$nombre_plan_cuentas = $_POST['nombre_plan_cuentas'];
	

		$columnas ="plan_cuentas.codigo_plan_cuentas,
				  plan_cuentas.nombre_plan_cuentas,
				  plan_cuentas.id_plan_cuentas";
		$tablas =" public.usuarios,
				  public.entidades,
				  public.plan_cuentas";
		$where ="plan_cuentas.nombre_plan_cuentas = '$nombre_plan_cuentas' AND entidades.id_entidades = usuarios.id_entidades AND
		plan_cuentas.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND plan_cuentas.nivel_plan_cuentas='5'";
		$id ="plan_cuentas.codigo_plan_cuentas";
		
		
		$resultSet=$plan_cuentas->getCondiciones($columnas, $tablas, $where, $id);
		
	
		$respuesta = new stdClass();
	
		if(!empty($resultSet)){
	
			$respuesta->codigo_plan_cuentas = $resultSet[0]->codigo_plan_cuentas;
			$respuesta->id_plan_cuentas = $resultSet[0]->id_plan_cuentas;
	
			echo json_encode($respuesta);
		}
	
	}
	
	
	
	public function ReporteComprobantes(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		
		$ccomprobantes = new CComprobantesModel();
		$dcomprobantes = new DComprobantesModel();
		$tipo_comprobantes = new TipoComprobantesModel();
		$entidades = new EntidadesModel();
		
		
		$tipo_comprobante=new TipoComprobantesModel();
		$resultTipCom = $tipo_comprobante->getAll("nombre_tipo_comprobantes");
		
		
		$columnas_enc = "entidades.id_entidades,
  							entidades.nombre_entidades";
		$tablas_enc ="public.usuarios,
						  public.entidades";
		$where_enc ="entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		$id_enc="entidades.nombre_entidades";
		$resultEnt=$entidades->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Comprobantes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $ccomprobantes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"])){
	
	
					$id_entidades=$_POST['id_entidades'];
					$id_tipo_comprobantes=$_POST['id_tipo_comprobantes'];
					$numero_ccomprobantes=$_POST['numero_ccomprobantes'];
					$referencia_doc_ccomprobantes=$_POST['referencia_doc_ccomprobantes'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
						
					
	
						
					$columnas = " ccomprobantes.id_ccomprobantes, 
								  tipo_comprobantes.nombre_tipo_comprobantes, 
								  ccomprobantes.concepto_ccomprobantes, 
								  usuarios.nombre_usuarios, 
								  entidades.nombre_entidades, 
								  ccomprobantes.valor_letras, 
								  ccomprobantes.fecha_ccomprobantes, 
								  ccomprobantes.numero_ccomprobantes, 
								  ccomprobantes.ruc_ccomprobantes, 
								  ccomprobantes.nombres_ccomprobantes, 
								  ccomprobantes.retencion_ccomprobantes, 
								  ccomprobantes.valor_ccomprobantes, 
								  ccomprobantes.referencia_doc_ccomprobantes, 
								  ccomprobantes.numero_cuenta_banco_ccomprobantes, 
								  ccomprobantes.numero_cheque_ccomprobantes, 
								  ccomprobantes.observaciones_ccomprobantes, 
								  forma_pago.nombre_forma_pago";
	
	
	
					$tablas=" public.ccomprobantes, 
							  public.entidades, 
							  public.usuarios, 
							  public.tipo_comprobantes, 
							  public.forma_pago";
	
					$where="ccomprobantes.id_forma_pago = forma_pago.id_forma_pago AND
							  entidades.id_entidades = usuarios.id_entidades AND
							  usuarios.id_usuarios = ccomprobantes.id_usuarios AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND usuarios.id_usuarios='$_id_usuarios'";
	
					$id="ccomprobantes.numero_ccomprobantes";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
						
					
					
	
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	
					if($id_tipo_comprobantes!=0){$where_1=" AND tipo_comprobantes.id_tipo_comprobantes='$id_tipo_comprobantes'";}
	
					if($numero_ccomprobantes!=""){$where_2=" AND ccomprobantes.numero_ccomprobantes='$numero_ccomprobantes'";}
						
					if($referencia_doc_ccomprobantes!=""){$where_3=" AND ccomprobantes.referencia_doc_ccomprobantes ='$referencia_doc_ccomprobantes'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  ccomprobantes.fecha_ccomprobantes BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3. $where_4;
	
	
					//$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
	
					
					//comienza paginacion
					
					
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
					
					if($action == 'ajax')
					{
						$html="";
						$resultSet=$ccomprobantes->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$resultSet[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
						$resultSet=$ccomprobantes->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
						$count_query   = $cantidadResult;
							
						$total_pages = ceil($cantidadResult/$per_page);
							
						if ($cantidadResult>0)
						{
					
							//<th style="color:#456789;font-size:80%;"></th>
								
							$html.='<div class="pull-left">';
							$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
							$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
							$html.='</div><br>';
							$html.='<section style="height:425px; overflow-y:scroll;">';
							$html.='<table class="table table-hover">';
							$html.='<thead>';
							$html.='<tr class="info">';
							$html.='<th>Tipo</th>';
							$html.='<th>Concepto</th>';
							$html.='<th>Entidad</th>';
							$html.='<th>Valor</th>';
							$html.='<th>Fecha</th>';
							$html.='<th>Numero de Comprobante</th>';
							$html.='<th>Forma de Pago</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
					
							foreach ($resultSet as $res)
							{
								//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
									
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_tipo_comprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->concepto_ccomprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_entidades.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->valor_letras.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->fecha_ccomprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_ccomprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_forma_pago.'</td>';
								$html.='</tr>';
									
							}
					
							$html.='</tbody>';
							$html.='</table>';
							$html.='</section>';
							$html.='<div class="table-pagination pull-right">';
							$html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents).'';
							$html.='</div>';
							$html.='</section>';
					
								
						}else{
								
							$html.='<div class="alert alert-warning alert-dismissable">';
							$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
							$html.='<h4>Aviso!!!</h4> No hay datos para mostrar';
							$html.='</div>';
								
						}
							
						echo $html;
						die();
						
					}
					
					if(isset($_POST['reporte']))
					{
						
						//parametros q van al servidor de reportes
						
						$parametros = array();
						
						$parametros['id_entidades']=isset($_POST['id_entidades'])?trim($_POST['id_entidades']):'';
						$parametros['id_tipo_comprobantes']=(isset($_POST['id_tipo_comprobantes']))?trim($_POST['id_tipo_comprobantes']):'';
						$parametros['numero_ccomprobantes']=(isset($_POST['numero_ccomprobantes']))?trim($_POST['numero_ccomprobantes']):'';
						$parametros['referencia_doc_ccomprobantes']=(isset($_POST['referencia_doc_ccomprobantes']))?trim($_POST['referencia_doc_ccomprobantes']):'';
						$parametros['fecha_desde']=(isset($_POST['fecha_desde']))?trim($_POST['fecha_desde']):'';
						$parametros['fecha_hasta']=(isset($_POST['fecha_hasta']))?trim($_POST['fecha_hasta']):'';
						
						//para local 
						$pagina="conComprobantes.aspx";
												
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						$conexion_rpt['port']="59584";
						
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
						
						die();
						
					}
					
	
		}
	
				
				$this->view("ReporteComprobantes",array(
						"resultSet"=>$resultSet, "resultTipCom"=> $resultTipCom,
						"resultEnt"=>$resultEnt
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Reporte Comprobantes"
	
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
	
	public function paginate($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_comprobantes(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_comprobantes(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_comprobantes(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_comprobantes(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_comprobantes(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_comprobantes($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_comprobantes(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	public function ReporteEgresos()
	{
		if(isset($_REQUEST['id_ccomprobantes']))
		{
						
				$parametros = array();
					
				$parametros['id_comprobantes']=isset($_REQUEST['id_ccomprobantes'])?trim($_REQUEST['id_ccomprobantes']):'';
				
				//aqui poner la pagina 
					
				$pagina="conComprobantesEgresos.aspx";
					
				$conexion_rpt = array();
				$conexion_rpt['pagina']=$pagina;
				$conexion_rpt['port']="59584";
					
				$this->view("ReporteRpt", array(
						"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
				));
				
				
		}
		
	}
	
	public function ReporteIngresos()
	{
		if(isset($_REQUEST['id_ccomprobantes']))
		{
	
			$parametros = array();
				
			$parametros['id_comprobantes']=isset($_REQUEST['id_ccomprobantes'])?trim($_REQUEST['id_ccomprobantes']):'';
	
			//aqui poner la pagina
				
			$pagina="conComprobantesIngresos.aspx";
				
			$conexion_rpt = array();
			$conexion_rpt['pagina']=$pagina;
			$conexion_rpt['port']="59584";
				
			$this->view("ReporteRpt", array(
					"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
			));
	
	
		}
	
	}
    
	
	
}
?>