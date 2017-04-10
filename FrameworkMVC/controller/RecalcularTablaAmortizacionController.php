<?php

class RecalcularTablaAmortizacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
		$resultRes="";
		$resultSet="";
        $clientes = new ClientesModel();
        
       
        
        
        
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$_id_usuarios= $_SESSION['id_usuarios'];
			$usuarios = new UsuariosModel();
			$resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
			$_id_entidades=$resultEnt[0]->id_entidades;
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "RecalcularTablaAmortizacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
			
				
				if(isset($_POST["buscar"]))
				{
				  
					$identificacion=$_POST['ruc_clientes'];
					$razon_social=$_POST['razon_social_clientes'];
						
					if ($identificacion!=""){
					
						$columnas = "fc_clientes.id_clientes, 
									  fc_clientes.ruc_clientes, 
									  fc_clientes.razon_social_clientes, 
									  fc_clientes.direccion_clientes, 
									  fc_clientes.telefono_clientes, 
									  fc_clientes.celular_clientes, 
									  fc_clientes.email_clientes, 
									  entidades.id_entidades, 
									  entidades.nombre_entidades, 
									  amortizacion_cabeza.id_amortizacion_cabeza, 
									  amortizacion_cabeza.numero_credito_amortizacion_cabeza, 
									  amortizacion_cabeza.numero_pagare_amortizacion_cabeza, 
									  tipo_creditos.id_tipo_creditos, 
									  tipo_creditos.nombre_tipo_creditos, 
									  amortizacion_cabeza.capital_prestado_amortizacion_cabeza, 
									  amortizacion_cabeza.tasa_interes_amortizacion_cabeza, 
									  amortizacion_cabeza.plazo_meses_amortizacion_cabeza, 
									  amortizacion_cabeza.plazo_dias_amortizacion_cabeza, 
									  intereses.id_intereses, 
									  intereses.valor_intereses, 
									  amortizacion_cabeza.fecha_amortizacion_cabeza, 
									  amortizacion_cabeza.cantidad_cuotas_amortizacion_cabeza, 
									  amortizacion_cabeza.interes_normal_mensual_amortizacion_cabeza, 
									  amortizacion_cabeza.interes_mora_mensual_amortizacion_cabeza";
				
						$tablas=" public.amortizacion_cabeza, 
								  public.fc_clientes, 
								  public.entidades, 
								  public.tipo_creditos, 
								  public.intereses";
				
						$where="amortizacion_cabeza.id_intereses = intereses.id_intereses AND
								  amortizacion_cabeza.id_entidades = entidades.id_entidades AND
								  fc_clientes.id_clientes = amortizacion_cabeza.id_fc_clientes AND
								  entidades.id_entidades = fc_clientes.id_entidades AND
								  tipo_creditos.id_tipo_creditos = amortizacion_cabeza.id_tipo_creditos AND entidades.id_entidades= '$_id_entidades'";
				
						$id="fc_clientes.id_clientes";
				
				
						$where_0 = "";
						$where_1 = "";
				
				
						if($identificacion!=""){$where_0=" AND fc_clientes.ruc_clientes='$identificacion'";}
						if($razon_social!=""){$where_1=" AND fc_clientes.razon_social_clientes LIKE '$razon_social'";}
				
				
							
						$where_to  = $where . $where_0 . $where_1;
							
						$resultRes = $clientes->getCondiciones($columnas, $tablas, $where_to, $id);
							
					
					}
				}
					
				if(isset($_GET["id_amortizacion_cabeza"]) && isset ($_GET["id_clientes"])){
					
					$_id_amortizacion_cabeza = $_GET['id_amortizacion_cabeza'];
					$_id_clientes = $_GET['id_clientes'];
					
					
					$columnas = "fc_clientes.id_clientes, 
								  fc_clientes.ruc_clientes, 
								  fc_clientes.razon_social_clientes, 
								  fc_clientes.direccion_clientes, 
								  fc_clientes.telefono_clientes, 
								  fc_clientes.celular_clientes, 
								  fc_clientes.email_clientes, 
								  amortizacion_cabeza.id_amortizacion_cabeza, 
								  amortizacion_cabeza.numero_credito_amortizacion_cabeza, 
								  amortizacion_cabeza.numero_pagare_amortizacion_cabeza, 
								  tipo_creditos.id_tipo_creditos, 
								  tipo_creditos.nombre_tipo_creditos, 
								  amortizacion_cabeza.capital_prestado_amortizacion_cabeza, 
								  amortizacion_cabeza.tasa_interes_amortizacion_cabeza, 
								  amortizacion_cabeza.plazo_meses_amortizacion_cabeza, 
								  amortizacion_cabeza.plazo_dias_amortizacion_cabeza, 
								  intereses.id_intereses, 
								  tipo_intereses.id_tipo_intereses, 
								  tipo_intereses.nombre_tipo_intereses, 
								  intereses.valor_intereses, 
							      amortizacion_detalle.id_amortizacion_detalle, 
								  amortizacion_detalle.numero_cuota_amortizacion_detalle, 
								  amortizacion_detalle.saldo_inicial_amortizacion_detalle, 
								  amortizacion_detalle.interes_amortizacion_detalle, 
								  amortizacion_detalle.amortizacion_amortizacion_detalle, 
								  amortizacion_detalle.pagos_amortizacion_detalle, 
								  amortizacion_detalle.fecha_pagos_amortizacion_detalle, 
								  amortizacion_detalle.estado_cancelado_amortizacion_detalle";
					
					$tablas="  public.amortizacion_cabeza, 
								  public.amortizacion_detalle, 
								  public.fc_clientes, 
								  public.intereses, 
								  public.tipo_creditos, 
								  public.tipo_intereses";
					
					$where=" amortizacion_cabeza.id_fc_clientes = fc_clientes.id_clientes AND
							  amortizacion_cabeza.id_tipo_creditos = tipo_creditos.id_tipo_creditos AND
							  amortizacion_detalle.id_amortizacion_cabeza = amortizacion_cabeza.id_amortizacion_cabeza AND
							  intereses.id_intereses = amortizacion_cabeza.id_intereses AND
							  tipo_intereses.id_tipo_intereses = intereses.id_tipo_intereses AND fc_clientes.id_clientes='$_id_clientes'  AND amortizacion_cabeza.id_amortizacion_cabeza = '$_id_amortizacion_cabeza' AND amortizacion_detalle.estado_cancelado_amortizacion_detalle = 'FALSE'";
												
					$id="amortizacion_detalle.numero_cuota_amortizacion_detalle";
					
					$resultSet = $clientes->getCondiciones($columnas, $tablas, $where, $id);
					
					
				}
				
				
				
				
				$this->view("RecalcularTablaAmortizacion",array(
						'resultRes'=>$resultRes, 'resultSet'=>$resultSet
						
					    
				));
		
				
				
			}
			
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Recalcular Tabla Amortización"
				
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
	
	
	public function InsertaRecalculaTablaAmortizacion(){
		session_start();
	
		$resultado = null;
		
		$_id_usuarios= $_SESSION['id_usuarios'];
		$usuarios = new UsuariosModel();
		$resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
		$_id_entidades=$resultEnt[0]->id_entidades;
		
		
		$permisos_rol=new PermisosRolesModel();
		$recaudacion = new RecaudacionModel();
		$camortizacion = new AmortizacionCabezaModel();
		$damortizacion = new AmortizacionDetalleModel();
		$clientes = new ClientesModel();
		$nombre_controladores = "RecalcularTablaAmortizacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $recaudacion->getPermisosEditar("nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
	
		if (!empty($resultPer))
		{
				
			if (isset ($_POST["Guardar"])   )
			{
				$_numero_cuota_recaudacion = $_POST["numero_cuota_recaudacion"];
				$_capital_pagado_recaudacion = $_POST["capital_pagado_recaudacion"];
				$_fecha_pago_recaudacion = $_POST["fecha_pago_recaudacion"];
				$_nombre_entidad_financiera_recaudacion = $_POST["nombre_entidad_financiera_recaudacion"];
				$_numero_papeleta_recaudacion = $_POST["numero_papeleta_recaudacion"];
				$_concepto_pago_amortizacion = $_POST["concepto_pago_amortizacion"];
				$_array_amortizacion_detalle = $_POST["id_amortizacion_detalle"];
				
	
	
	
	
				foreach($_array_amortizacion_detalle  as $id  )
				{
						
					if (!empty($id) )
					{
						
						try
						{
							
							$_id_amortizacion_detalle = $id;
							$resultCabeza = $damortizacion->getBy("id_amortizacion_detalle ='$_id_amortizacion_detalle' AND id_entidades ='$_id_entidades'");
					        $_id_amortizacion_cabeza=$resultCabeza[0]->id_amortizacion_cabeza;
					        $_numero_cuota_recaudacion=$resultCabeza[0]->numero_cuota_amortizacion_detalle;
	
					        
					        $resultClientes= $camortizacion->getBy("id_amortizacion_cabeza ='$_id_amortizacion_cabeza' AND id_entidades ='$_id_entidades'");
					        $_id_clientes=$resultClientes[0]->id_fc_clientes;
					        
					       
							$funcion = "ins_recaudacion";
							$parametros = "'$_id_clientes','$_id_entidades', '$_id_amortizacion_cabeza','$_capital_pagado_recaudacion','$_numero_cuota_recaudacion','$_fecha_pago_recaudacion', '$_id_amortizacion_detalle', '$_nombre_entidad_financiera_recaudacion', '$_numero_papeleta_recaudacion', '$_concepto_pago_amortizacion'";
							$recaudacion->setFuncion($funcion);
							$recaudacion->setParametros($parametros);
							$resultado=$recaudacion->Insert();
								
							$damortizacion->UpdateBy("estado_cancelado_amortizacion_detalle='TRUE'", "amortizacion_detalle", "id_amortizacion_detalle='$_id_amortizacion_detalle'");
								

							$traza=new TrazasModel();
							$_nombre_controlador = "RecalcularTablaAmortizacion";
							$_accion_trazas  = "Guardar";
							$_parametros_trazas = $_id_amortizacion_detalle;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
							
							
								
	
						} catch (Exception $e)
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Recalcular ->". $id
							));
						}
							
					}
	
				}
	
			}
	
	
			$this->redirect("RecalcularTablaAmortizacion", "index");
				
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Recalcular Tabla de Amortizacion"
	
			));
	
		}
	
	}
	
	
}
?>