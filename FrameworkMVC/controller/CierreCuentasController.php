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
				
				//jhkjh
					
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
    $mayor = new MayorModel();
    
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
   		$anio = $date->format("Y");
   		$mes = $date->format("m");
   		
   		
   		//poner parametros de anio 
   		$resultAnioCierre = $cierre_mes->getBy(" EXTRACT(YEAR FROM fecha_cierre_mes) = '$anio' AND id_entidades='$_id_entidades'");
   		//valiar anio y mes 
   		//$resultMesCierre = $cierre_mes->getBy(" EXTRACT(YEAR FROM fecha_cierre_mes) = '$anio' AND
   		//TO_CHAR(fecha_cierre_mes,'MM') = '$mes' AND id_entidades='$_id_entidades'");
   		
   		
   			if (isset ($_POST["id_tipo_cierre"]))
   			{
   			
   				if(!empty($resultAnioCierre))
   				{
   					
   					$id_cierre_mes = $resultAnioCierre[0]->id_cierre_mes;
   					
   					$debe=(float)0;
   					$haber=(float)0;
   					$saldo=(float)0;
   					
   					try
   					{
   							
   						//set_time_limit(60);
   						$funcion_cuentas_cierre_mes = "";
   						$columna = "";
   						$mes = (int)$mes;
   					
   						switch ($mes)
   						{
   							case 1:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_ene";
   								$columna="cerrado_ene_cuentas_cierre_mes";
   								break;
   							case 2:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_feb";
   								$columna="cerrado_feb_cuentas_cierre_mes";
   								break;
   							case 3:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_mar";
   								$columna="cerrado_mar_cuentas_cierre_mes";
   								break;
   							case 4:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_abr";
   								$columna="cerrado_abr_cuentas_cierre_mes";
   								break;
   							case 5:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_may";
   								$columna="cerrado_may_cuentas_cierre_mes";
   								break;
   							case 6:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_jun";
   								$columna="cerrado_jun_cuentas_cierre_mes";
   								break;
   							case 7:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_jul";
   								$columna="cerrado_jul_cuentas_cierre_mes";
   								break;
   							case 8:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_ago";
   								$columna="cerrado_ago_cuentas_cierre_mes";
   								break;
   							case 9:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_sep";
   								$columna="cerrado_sep_cuentas_cierre_mes";
   								break;
   							case 10:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_oct";
   								$columna="cerrado_oct_cuentas_cierre_mes";
   								break;
   							case 11:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_nov";
   								$columna="cerrado_nov_cuentas_cierre_mes";
   								break;
   							case 12:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_dic";
   								$columna="cerrado_dic_cuentas_cierre_mes";
   								break;
   							default:
   								$funcion_cuentas_cierre_mes="ins_cuentas_cierre_mes_ene";
   								$columna="cerrado_ene_cuentas_cierre_mes";
   								break;
   						}
   					
   						
   						$resultCuentas_cierre = $cuentas_cierre_mes->getBy("id_cierre_mes='$id_cierre_mes'");
   						//parametros
   						
   						if(!empty($resultCuentas_cierre))
   						{
   						    $cta_cerrada = $resultCuentas_cierre[0]->$columna;
   						    if($cta_cerrada=='t')
   						    {
   						    	echo $cta_cerrada;
   						    	die();
   						    }else{
   						    	die('mes sin cerrar');
   						    }
   							
   						}else 
   						{
   							
   						}
   						
   						echo $funcion_cuentas_cierre_mes;
   						
   						var_dump($resultCuentas_cierre);
   						die();
   						
   							
   							try
   							{
   								$_id_plan_cuentas = $res->id_plan_cuentas;
   								
   								$parametros = "'$_id_cierre_mes','$_id_plan_cuentas', '$debe', '$haber', '$saldo', '$anio'";
   								$cuentas_cierre_mes->setFuncion($funcion_cuentas_cierre_mes);
   								$cuentas_cierre_mes->setParametros($parametros);
   								$resultado=$cuentas_cierre_mes->Insert();
   									
   							} catch (Exception $e)
   							{
   								$this->view("Error",array(
   										"resultado"=>"Eror al Insertar Cierre de Cuentas ->".$e
   								));
   								exit();
   							}
   					
   							
   						$columnas_mayor="mayor.id_plan_cuentas,
						  SUM(mayor.debe_mayor) as suma_debe,
						  SUM(mayor.haber_mayor) as suma_haber";
   					
   						$tablas_mayor="public.mayor,
						  public.plan_cuentas,
						  public.entidades,
						  public.usuarios";
   							
   						$where_mayor="plan_cuentas.id_plan_cuentas = mayor.id_plan_cuentas AND
   						entidades.id_entidades = plan_cuentas.id_entidades AND
   						usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios'
   						AND entidades.id_entidades='$_id_entidades'  AND TO_CHAR(fecha_mayor,'MM') = '$mes' AND
   						EXTRACT(YEAR FROM fecha_mayor) = '$anio'";
   					
   						$grupo = "mayor.id_plan_cuentas";
   						$id="mayor.id_plan_cuentas";
   							
   						$resultCuentasMayor = $mayor->getCondiciones_GrupBy_OrderBy($columnas_mayor ,$tablas_mayor ,$where_mayor, $grupo, $id);
   							
   							
   							
   						foreach($resultCuentasMayor as $res)
   						{
   							try
   							{
   									
   					
   								$_id_plan_cuentas_mayor = $res->id_plan_cuentas;
   								$resultSaldo = $mayor->getBy("id_plan_cuentas = '$_id_plan_cuentas_mayor'  ORDER BY id_mayor DESC LIMIT 1");
   								$_saldo_mayor=$resultSaldo[0]->saldo_mayor;
   								$_suma_debe_mayor = (float)$res->suma_debe;
   								$_suma_haber_mayor = (float)$res->suma_haber;
   					
   								$colval = "debe_ene='$_suma_debe_mayor' , haber_ene='$_suma_haber_mayor',saldo_final_ene='$_saldo_mayor'";
   								$tabla = "cuentas_cierre_mes";
   								$where = "id_plan_cuentas = '$_id_plan_cuentas_mayor' AND id_cierre_mes='$_id_cierre_mes'";
   								$resultado=$cuentas_cierre_mes->UpdateBy($colval, $tabla, $where);
   									
   									
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
   					
   					
   					try {
   					
   						$result="";
   						$result = $cuentas_cierre_mes->CierrePlanCuentas($_id_entidades, $anio);
   					} catch (Exception $e)
   					{
   						echo "Erro al Cuadrar Balances: " + $e;
   					}
   					
   				
   				}
   				else
   				{
   				   				
   				$columnas="plan_cuentas.id_plan_cuentas,
					  plan_cuentas.id_entidades,
					  plan_cuentas.codigo_plan_cuentas,
					  plan_cuentas.nombre_plan_cuentas";
   				 
   				$tablas=" public.plan_cuentas,
					  public.entidades,
					  public.usuarios";
   				$where="entidades.id_entidades = plan_cuentas.id_entidades AND
   				usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND entidades.id_entidades='$_id_entidades'";
   				$id=" plan_cuentas.codigo_plan_cuentas";
   			
   				$resultCuentas = $plan_cuentas->getCondiciones($columnas ,$tablas ,$where, $id);
   			
   			
   				$debe=(float)0;
   				$haber=(float)0;
   				$saldo=(float)0;
   			
   			
   				try
   				{
   			
   					$funcion = "ins_cierre_mes";
   					$parametros = "'$_id_entidades', '$_id_usuarios', '$_fecha_cierre_mes', '$_id_tipo_cierre'";
   					$cierre_mes->setFuncion($funcion);
   					$cierre_mes->setParametros($parametros);
   					$resultado=$cierre_mes->Insert();
   						
   					$resultCierre = $cierre_mes->getBy("id_entidades ='$_id_entidades' AND id_usuario_creador='$_id_usuarios' AND fecha_cierre_mes='$_fecha_cierre_mes'");
   					$_id_cierre_mes=$resultCierre[0]->id_cierre_mes;
   						
   					//set_time_limit(60);
   					
   					$funcion = "";
   					$mes = (int)$mes;
   					
   					switch ($mes)
   					{
   						case 1:
   							$funcion="ins_cuentas_cierre_mes_ene";
   							break;
   						case 2:
   							$funcion="ins_cuentas_cierre_mes_feb";
   							break;
   						case 3:
   							$funcion="ins_cuentas_cierre_mes_mar";
   							break;
   						case 4:
   							$funcion="ins_cuentas_cierre_mes_abr";
   							break;
   						case 5:
   							$funcion="ins_cuentas_cierre_mes_may";
   							break;
   						case 6:
   							$funcion="ins_cuentas_cierre_mes_jun";
   							break;
   						case 7:
   							$funcion="ins_cuentas_cierre_mes_jul";
   							break;
   						case 8:
   							$funcion="ins_cuentas_cierre_mes_ago";
   							break;
   						case 9:
   							$funcion="ins_cuentas_cierre_mes_sep";
   							break;
   						case 10:
   							$funcion="ins_cuentas_cierre_mes_oct";
   							break;
   						case 11:
   							$funcion="ins_cuentas_cierre_mes_nov";
   							break;
   						case 12:
   							$funcion="ins_cuentas_cierre_mes_dic";
   							break;
   						default:
   							$funcion="ins_cuentas_cierre_mes_ene";
   							break;
   					}
   					
   					foreach($resultCuentas as $res)
   					{
   						try
   						{
   							$_id_plan_cuentas = $res->id_plan_cuentas;
   							
   							$parametros = "'$_id_cierre_mes','$_id_plan_cuentas', '$debe', '$haber', '$saldo', '$anio'";
   							$cuentas_cierre_mes->setFuncion($funcion);
   							$cuentas_cierre_mes->setParametros($parametros);
   							$resultado=$cuentas_cierre_mes->Insert();
   								
   						} catch (Exception $e)
   						{
   							$this->view("Error",array(
   									"resultado"=>"Eror al Insertar Cierre de Cuentas ->".$e
   							));
   							exit();
   						}
   							
   					}
   						
   					$columnas_mayor="mayor.id_plan_cuentas,
						  SUM(mayor.debe_mayor) as suma_debe,
						  SUM(mayor.haber_mayor) as suma_haber";
   			
   					$tablas_mayor="public.mayor,
						  public.plan_cuentas,
						  public.entidades,
						  public.usuarios";
   						
   					$where_mayor="plan_cuentas.id_plan_cuentas = mayor.id_plan_cuentas AND
   					entidades.id_entidades = plan_cuentas.id_entidades AND
   					usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' 
   					AND entidades.id_entidades='$_id_entidades'  AND TO_CHAR(fecha_mayor,'MM') = '$mes' AND
   					EXTRACT(YEAR FROM fecha_mayor) = '$anio'";
   			
   					$grupo = "mayor.id_plan_cuentas";
   					$id="mayor.id_plan_cuentas";
   						
   					$resultCuentasMayor = $mayor->getCondiciones_GrupBy_OrderBy($columnas_mayor ,$tablas_mayor ,$where_mayor, $grupo, $id);
   						
   						
   						
   					foreach($resultCuentasMayor as $res)
   					{
   						try
   						{
   								
   			
   							$_id_plan_cuentas_mayor = $res->id_plan_cuentas;
   							$resultSaldo = $mayor->getBy("id_plan_cuentas = '$_id_plan_cuentas_mayor'  ORDER BY id_mayor DESC LIMIT 1");
   							$_saldo_mayor=$resultSaldo[0]->saldo_mayor;
   							$_suma_debe_mayor = (float)$res->suma_debe;
   							$_suma_haber_mayor = (float)$res->suma_haber;
   			
   							$colval = "debe_ene='$_suma_debe_mayor' , haber_ene='$_suma_haber_mayor',saldo_final_ene='$_saldo_mayor'";
   							$tabla = "cuentas_cierre_mes";
   							$where = "id_plan_cuentas = '$_id_plan_cuentas_mayor' AND id_cierre_mes='$_id_cierre_mes'";
   							$resultado=$cuentas_cierre_mes->UpdateBy($colval, $tabla, $where);
   								
   								
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
   	
   			
   				try {
   			
   					$result="";
   					$result = $cuentas_cierre_mes->CierrePlanCuentas($_id_entidades, $anio);
   				} catch (Exception $e)
   				{
   					echo "Erro al Cuadrar Balances: " + $e;
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