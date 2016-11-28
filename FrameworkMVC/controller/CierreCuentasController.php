<?php

class CierreCuentasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//maycol

	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$tipo_cierre = new TipoCierreModel();	
			
		    $columnas_enc = "tipo_cierre.nombre_tipo_cierre, tipo_cierre.id_tipo_cierre, entidades.id_entidades";
		    $tablas_enc ="public.tipo_cierre, 
						  public.entidades, 
						  public.usuarios";
		    $where_enc ="entidades.id_entidades = tipo_cierre.id_entidades AND
  						usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		    $id_enc="tipo_cierre.nombre_tipo_cierre";
		    $resultTipCierre=$tipo_cierre->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		    	
				
		    $permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "CierreCuentas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				
				
					
					$this->view("CierreCuentas",array(
							
							"resultTipCierre"=>$resultTipCierre, "resultEdit"=>""
					));
			
			
			}else{
				
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos a Cierre de Cuentas"
				
					
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
	 
	
   public function InsertaCierreCuentas(){
   
   	session_start();
   
   	$resultado = null;
   	$permisos_rol=new PermisosRolesModel();
    $cierre_mes = new CierreMesModel();
    $cuentas_cierre_mes = new CuentasCierreMesModel();
    $entidades = new EntidadesModel(); 
    $plan_cuentas = new PlanCuentasModel();
    
   	$nombre_controladores = "CierreCuentas";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $cuentas_cierre_mes->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
   
   	if (!empty($resultPer))
   	{
   		$resultFechaCierre = "";
   		$_fecha_cierre = "";
   		$_id_usuarios = $_SESSION['id_usuarios'];
   		$_id_entidades =$_POST['id_entidades'];
   		$_id_tipo_cierre =$_POST['id_tipo_cierre'];
   		$_fecha_cierre_mes=$_POST['fecha_cierre_mes'];
   		
   		$date = new DateTime($_fecha_cierre_mes);
   		
   		$anio = date("Y",$date);
   		
   		$mes = date("m",$date);
   		//poner parametros de anio y mes
   		$resultFechaCierre = $cierre_mes->getBy(" EXTRACT(YEAR FROM fecha_cierre_mes) = '$anio' AND
   		TO_CHAR(fecha_cierre_mes,'MM') = '$mes' AND id_entidades='$_id_entidades'");
   		
   		if(!empty($resultFechaCierre)){$_fecha_cierre=$resultFechaCierre[0]->fecha_cierre_mes;}
   		
   		var_dump($_fecha_cierre) ;
   		var_dump($anio);
   		var_dump($mes);
   		die();
   		
   		if($_fecha_cierre == $_fecha_cierre_mes)
   		{
   			$this->view("Error",array(
   					"resultado"=>"No pudimos procesar el requerimiento, vuelva a intertarlo utilizando una fecha diferente de cierre, ya existe un cierre el ".$_fecha_cierre
  
   			));
   			exit();
   			
   		}else{
   		
   			
   		if (isset ($_POST["id_tipo_cierre"]))
   		{
   			/*
   			$columnas ="plan_cuentas.id_plan_cuentas, entidades.id_entidades, plan_cuentas.saldo_plan_cuentas, plan_cuentas.saldo_fin_plan_cuentas, SUM(mayor.debe_mayor) as suma_debe, SUM(mayor.haber_mayor) as suma_haber";
   			$tablas ="public.plan_cuentas, 
					  public.usuarios, 
					  public.entidades, 
					  public.mayor";
   			$where =" plan_cuentas.id_entidades = entidades.id_entidades AND
					  usuarios.id_entidades = entidades.id_entidades AND
					  mayor.id_plan_cuentas = plan_cuentas.id_plan_cuentas AND usuarios.id_usuarios='$_id_usuarios' AND entidades.id_entidades='$_id_entidades'";
   			$grupo="plan_cuentas.id_plan_cuentas, entidades.id_entidades, plan_cuentas.saldo_plan_cuentas, plan_cuentas.saldo_fin_plan_cuentas";
   			$orden="plan_cuentas.id_plan_cuentas";
   			$resultCuentas=$plan_cuentas->getCondiciones_GrupBy_OrderBy($columnas ,$tablas ,$where, $grupo, $orden);
   			*/
   			
   			// prueba cierra mes
   			
   			$columnas ='plan_cuentas.id_plan_cuentas,entidades.id_entidades,
						plan_cuentas.saldo_plan_cuentas, plan_cuentas.saldo_mayor,
						SUM(mayor.debe_mayor) as "suma_debe", SUM(mayor.haber_mayor) as "suma_haber"';
   			$tablas ="public.plan_cuentas 
					INNER JOIN public.entidades 
					ON(plan_cuentas.id_entidades = entidades.id_entidades) 
					INNER JOIN public.usuarios
					ON(usuarios.id_entidades = entidades.id_entidades) 
					LEFT JOIN  public.mayor
					ON(mayor.id_plan_cuentas = plan_cuentas.id_plan_cuentas)";
   			$where ="usuarios.id_usuarios='$_id_usuarios' AND 
  					entidades.id_entidades='$_id_entidades'";
   			$grupo="plan_cuentas.id_plan_cuentas, 
				   entidades.id_entidades, 
				   plan_cuentas.saldo_plan_cuentas, 
				   plan_cuentas.saldo_mayor";
   			$orden="plan_cuentas.id_plan_cuentas";
   			$resultCuentas=$plan_cuentas->getCondiciones_GrupBy_OrderBy($columnas ,$tablas ,$where, $grupo, $orden);
   			   			
   			// termina prueba cierra mes
   			
   			
   			
   			try
   			{
   					
   				$funcion = "ins_cierre_mes";
   				$parametros = "'$_id_entidades', '$_id_usuarios', '$_fecha_cierre_mes', '$_id_tipo_cierre'";
   				$cierre_mes->setFuncion($funcion);
   				$cierre_mes->setParametros($parametros);
   				$resultado=$cierre_mes->Insert();
   				
   				$resultCierre = $cierre_mes->getBy("id_entidades ='$_id_entidades' AND id_usuario_creador='$_id_usuarios' AND fecha_cierre_mes='$_fecha_cierre_mes'");
   				$_id_cierre_mes=$resultCierre[0]->id_cierre_mes;   				
   				
   				set_time_limit(60);
   				$traza=new TrazasModel();
   				
   				foreach($resultCuentas as $res)
   				{   
   					
   					
   					try
   					{
   						$_id_plan_cuentas = $res->id_plan_cuentas;
   						$_saldo_inicial = $res->saldo_plan_cuentas;
   						$_debe = (float)$res->suma_debe;
   						$_haber = (float)$res->suma_haber;
   						$_saldo_final = $res->saldo_mayor;
   						
   						
   						/*
   						$resultCierre = $cierre_mes->getBy("id_entidades ='$_id_entidades' AND id_usuario_creador='$_id_usuarios' AND fecha_cierre_mes='$_fecha_cierre_mes'");
   						$_id_cierre_mes=$resultCierre[0]->id_cierre_mes;
   						 */ 						
   						
   						$funcion = "ins_cuentas_cierre_mes";
   						$parametros = "'$_id_cierre_mes','$_id_plan_cuentas','$_saldo_inicial', '$_debe', '$_haber', '$_saldo_final'";
   						$cuentas_cierre_mes->setFuncion($funcion);
   						$cuentas_cierre_mes->setParametros($parametros);
   						$resultado=$cuentas_cierre_mes->Insert();
   						
   							
   						
   						
   						$_nombre_controlador = "CierreCuentas";
   						$_accion_trazas  = "CerrarCuentas";
   						$_parametros_trazas = $_id_plan_cuentas;
   						$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
   						
   					   
   					} catch (Exception $e)
   					{
   						$this->view("Error",array(
   								"resultado"=>"Eror al Insertar Cierre de Cuentas ->".$e
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
   		
   		$this->redirect("CierreCuentas","index");
   	}
   	else
   	{
   		$this->view("Error",array(
   				"resultado"=>"No tiene Permisos de Guardar Cierre de Cuentas"
   
   		));
   
   
   	}
   
   
   
   }
   
    
}
?>