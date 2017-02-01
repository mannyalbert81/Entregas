<?php

class PlanCuentasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$entidades=new EntidadesModel();
     	$monedas = new MonedasModel();
     	$centro_costos= new CentroCostosModel();
     	$plan_cuentas = new PlanCuentasModel();
					//Conseguimos todos los usuarios
		$resultSet=array();
				
		$resultEdit = "";
		
		//arrays
		$resultMoneda=array();
		$resultEntidad=array();
		$resultCentroC=array();
		$resultCodigo_p_cuentas=array();

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//Notificaciones
			
			$nombre_controladores = "PlanCuentas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $entidades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				$id_usuarios=$_SESSION['id_usuarios'];
				
				
				//consultar  monedas
				$resultMoneda = $monedas->getAll("nombre_monedas");
				//consultar entidad por el usuario
				$resultEntidad=$entidades->getCondiciones("entidades.id_entidades,entidades.nombre_entidades","public.usuarios,public.entidades",
						"usuarios.id_entidades=entidades.id_entidades AND usuarios.id_usuarios='$id_usuarios'",
						"entidades.id_entidades");
				//consultar centro costos de acuerdo a la entidad y elk usuario
				$resultCentroC=$centro_costos->getCondiciones("centro_costos.id_centro_costos,centro_costos.nombre_centro_costos",
						"public.centro_costos, public.entidades, public.usuarios", 
						"entidades.id_entidades = centro_costos.id_entidades AND  entidades.id_entidades = usuarios.id_entidades AND
						 usuarios.id_usuarios='$id_usuarios'", "centro_costos.id_centro_costos");
				
				$columnas_p_cuentas=" plan_cuentas.id_plan_cuentas,plan_cuentas.codigo_plan_cuentas, 
									  plan_cuentas.nombre_plan_cuentas,monedas.nombre_monedas, 
									  plan_cuentas.n_plan_cuentas,plan_cuentas.t_plan_cuentas, 
									  centro_costos.nombre_centro_costos,plan_cuentas.nivel_plan_cuentas";
				
				$tablas_p_cuentas="public.plan_cuentas,public.usuarios,public.entidades,public.monedas,
								   public.centro_costos";
				
				$where_p_cuentas="entidades.id_entidades = plan_cuentas.id_entidades AND
								  entidades.id_entidades = usuarios.id_entidades AND
								  monedas.id_monedas = plan_cuentas.id_modenas AND
								  centro_costos.id_centro_costos = plan_cuentas.id_centro_costos AND
							      usuarios.id_usuarios='$id_usuarios'";
				
				$resultSet=$plan_cuentas->getCondiciones($columnas_p_cuentas, $tablas_p_cuentas, $where_p_cuentas, "plan_cuentas.codigo_plan_cuentas");
				
				if(isset($_POST['Buscar']))
				{
					$contenido=$_POST['contenido'];
					$criterio=$_POST['criterio'];
					
					$where1="";
					$where2="";
					$where3="";
					$where4="";
					
					switch ($criterio)
					{
						case "codigo":
							$where1=" AND plan_cuentas.codigo_plan_cuentas LIKE '$contenido%'";
						break;
						case "nombre":
							$where2=" AND plan_cuentas.nombre_plan_cuentas = '$contenido'";
						break;
						case "tipo":
							$where3=" AND plan_cuentas.t_plan_cuentas = '$contenido'";
						break;
						case "naturaleza":
							$where4=" AND plan_cuentas.n_plan_cuentas = '$contenido'";
						break;
					}
					
					$columnas_p_cuentas=" plan_cuentas.id_plan_cuentas,plan_cuentas.codigo_plan_cuentas,
									  plan_cuentas.nombre_plan_cuentas,monedas.nombre_monedas,
									  plan_cuentas.n_plan_cuentas,plan_cuentas.t_plan_cuentas,
									  centro_costos.nombre_centro_costos,plan_cuentas.nivel_plan_cuentas";
					
					$tablas_p_cuentas="public.plan_cuentas,public.usuarios,public.entidades,public.monedas,
								   public.centro_costos";
					
					$where_p_cuentas="entidades.id_entidades = plan_cuentas.id_entidades AND
					entidades.id_entidades = usuarios.id_entidades AND
					monedas.id_monedas = plan_cuentas.id_modenas AND
					centro_costos.id_centro_costos = plan_cuentas.id_centro_costos AND
					usuarios.id_usuarios='$id_usuarios'";
					
					$where_to=$where_p_cuentas.$where1.$where2.$where3;
					
					
					$resultSet=$plan_cuentas->getCondiciones($columnas_p_cuentas, $tablas_p_cuentas, $where_to, "plan_cuentas.codigo_plan_cuentas");
					
				}
				
				if (isset ($_GET["id_entidades"])   )
				{
                   if (!empty($resultPer))
					{
					
						$_id_entidades = $_GET["id_entidades"];
						$columnas = " id_entidades, ruc_entidades, nombre_entidades, telefono_entidades, direccion_entidades, ciudad_entidades ";
						$tablas   = "entidades";
						$where    = "id_entidades = '$_id_entidades' "; 
						$id       = "ruc_entidades";
							
						$resultEdit = $entidades->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Entidades";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_entidades;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Plan de Cuentas"
					
						));
					
					
					}
					
				}
				
								
				//array con codigo y subcodigo 
				if(!empty($resultSet)){foreach ($resultSet as $linea=>$val ){
					
					$subcodigo=0;
					
					if($val->nivel_plan_cuentas=='2'){
						$subcodigo=substr($val->codigo_plan_cuentas,2,1);}
					if($val->nivel_plan_cuentas=='3'){
						$subcodigo=substr($val->codigo_plan_cuentas,4,1);}
					
					$resultCodigo_p_cuentas[$linea]['id_p_cuentas']=$val->id_plan_cuentas;
					$resultCodigo_p_cuentas[$linea]['codigo_p_cuentas']=$val->codigo_plan_cuentas;
					$resultCodigo_p_cuentas[$linea]['nivel_p_cuentas']=$val->nivel_plan_cuentas;
					$resultCodigo_p_cuentas[$linea]['subcodigo_p_cuentas']=$subcodigo;
				}}
				
				
				$this->view("PlanCuentas",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"resultMoneda"=>$resultMoneda,
						"resultEntidad"=>$resultEntidad,"resultCentroC"=>$resultCentroC,
						"resultCodigo_p_cuentas"=>$resultCodigo_p_cuentas
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Plan de Cuentas"
				
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
	
	public function InsertaPlanCuentas(){
			
		session_start();
		$plan_cuentas = new PlanCuentasModel();
		
		$nombre_controladores = "PlanCuentas";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $plan_cuentas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
			$resultado = null;
			
			
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["Guardar"]))				
			{
				
				$_id_cuenta = $_POST["id_cuenta"];	
				
				if($_id_cuenta==-1||$_id_cuenta=="-1")
				{					
					$_codigo1_cuenta = $_POST["codigo1_cuenta"];
					$_codigo2_cuenta = $_POST["codigo2_cuenta"];
					$_nombre_cuenta = strtoupper($_POST["nombre_cuenta"]);
					
					if($_codigo1_cuenta!='' && $_codigo2_cuenta!=''&& $_nombre_cuenta!='')
					{
						$_id_moneda_cuenta = $_POST["id_moneda_cuenta"];
						$_id_naturaleza_cuenta = $_POST["id_naturaleza_cuenta"];
						$_tipo_cuenta = $_POST["tipo_cuenta"];
						$_nivel_cuenta = $_POST["nivel_cuenta"];
						$_id_entidades = $_POST["id_entidad"];
						$_id_centro_costos = $_POST["id_centro_c"];
						
						$_codigo_p_cuentas = $_codigo1_cuenta.$_codigo2_cuenta;
						
						
						$funcion = "ins_plan_cuentas";
						
						$parametros = "'$_id_entidades', '$_codigo_p_cuentas', '$_nombre_cuenta', '$_id_moneda_cuenta',
						'$_id_naturaleza_cuenta','$_tipo_cuenta','$_id_centro_costos','$_nivel_cuenta'";
							
						$plan_cuentas->setFuncion($funcion);
				
						$plan_cuentas->setParametros($parametros);
				
						$resultado=$plan_cuentas->Insert();
				
						$traza=new TrazasModel();
						$_nombre_controlador = "Plan_cuentas";
						$_accion_trazas  = "Guardar";
						$_parametros_trazas = $_nombre_cuenta." de la entidad -> ".$_id_entidades;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					
					}
				}else{
					
					$_codigo1_cuenta = $_POST["codigo1_subcuenta"];
					$_codigo2_cuenta = $_POST["codigo2_subcuenta"];
					$_nombre_cuenta = $_POST["nombre_subcuenta"];
					
					if($_codigo1_cuenta!='' && $_codigo2_cuenta!=''&& $_nombre_cuenta!='')
					{
						$_id_moneda_cuenta = $_POST["id_moneda_subcuenta"];
						$_id_naturaleza_cuenta = $_POST["id_naturaleza_subcuenta"];
						$_tipo_cuenta = $_POST["tipo_subcuenta"];
						$_nivel_cuenta = $_POST["nivel_subcuenta"];
						$_id_entidades = $_POST["id_entidad"];
						$_id_centro_costos = $_POST["id_centro_c_subcuenta"];
							
						$_codigo_p_cuentas = $_codigo1_cuenta.$_codigo2_cuenta;
							
							
						$funcion = "ins_plan_cuentas";
							
						$parametros = "'$_id_entidades', '$_codigo_p_cuentas', '$_nombre_cuenta', '$_id_moneda_cuenta',
						'$_id_naturaleza_cuenta','$_tipo_cuenta','$_id_centro_costos','$_nivel_cuenta'";
						
						$plan_cuentas->setFuncion($funcion);
							
						$plan_cuentas->setParametros($parametros);
							
						$resultado=$plan_cuentas->Insert();
						
							
						$traza=new TrazasModel();
						$_nombre_controlador = "Plan_cuentas";
						$_accion_trazas  = "Guardar";
						$_parametros_trazas = $_nombre_cuenta." de la entidad -> ".$_id_entidades;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}	
				}
				
			}else {
				
				$this->view("Error",array(
						"resultado"=>"Error al Guardar Datos"
				));
				die();
					
			}
			
			$this->redirect("PlanCuentas", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Plan de Cuentas"
		
			));
		
		
		}
		
	}
	
	public function ActualizarCuenta()
	{
		$respuesta='';
		session_start();
		$permisos_rol=new PermisosRolesModel();
		$plan_cuentas = new PlanCuentasModel();
		
		$nombre_controladores = "PlanCuentas";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_POST["id_entidad_p_cuentas"]))
			{
				
				$_id_entidad = $_POST["id_entidad_p_cuentas"];
				$_id_plan_cuentas = $_POST["id_p_cuentas"];
				$_nombre_plan_cuentas = $_POST["nombre_p_cuentas"];
				$_codigo_plan_cuentas = $_POST["codigo_p_cuentas"];
				$_n_plan_cuentas = $_POST["n_p_cuentas"];
				$_id_moneda_plan_cuentas = $_POST["id_moneda_p_cuentas"];
				$_id_centro_costos_plan_cuentas = $_POST["id_centro_c_p_cuentas"];	
				
				
				
				$colval="nombre_plan_cuentas='$_nombre_plan_cuentas',id_modenas='$_id_moneda_plan_cuentas',n_plan_cuentas='$_n_plan_cuentas',id_centro_costos='$_id_centro_costos_plan_cuentas'";
				$tabla="plan_cuentas";
				$where="id_plan_cuentas='$_id_plan_cuentas' AND id_entidades='$_id_entidad'";
				
				try {
					
					$update=$plan_cuentas->UpdateBy($colval, $tabla, $where);
					$respuesta='1';
					
				}catch (Exception $ex)
				{
					
				}
				
				$traza=new TrazasModel();
				$_nombre_controlador = "PlanCuentas";
				$_accion_trazas  = "Update";
				$_parametros_trazas = $_id_plan_cuentas;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
				
		}
		else
		{
			$respuesta='sin permisos';
		}
		
		echo json_encode($respuesta);
	
	}
	
	public function borrarId()
	{

		session_start();
		$permisos_rol=new PermisosRolesModel();
		$plan_cuentas = new PlanCuentasModel();
		$mayor = new MayorModel();
		$nombre_controladores = "PlanCuentas";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar(" controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_p_cuentas"]))
			{
				$id_plan_cuentas=(int)$_GET["id_p_cuentas"];
				
				
				$resultCuenta=$plan_cuentas->getBy("id_plan_cuentas='$id_plan_cuentas'");
				
												
				if(!empty($resultCuenta))
				{
					$codigo_cuenta=$resultCuenta[0]->codigo_plan_cuentas;
					$id_entidad_cuenta=$resultCuenta[0]->id_entidades;
					
					if($codigo_cuenta!=""){$codigo_cuenta.=$codigo_cuenta.'%';}
				
					$resultMayor=$mayor->getCondiciones("mayor.id_plan_cuentas, plan_cuentas.codigo_plan_cuentas",
														"public.plan_cuentas, public.mayor",
														"plan_cuentas.id_plan_cuentas = mayor.id_plan_cuentas AND 
														 plan_cuentas.codigo_plan_cuentas LIKE '$codigo_cuenta' AND
														 plan_cuentas.id_entidades='$id_entidad_cuenta'",
														"mayor.id_plan_cuentas"
														);
					
						if(empty($resultMayor))
						{
							
						$plan_cuentas->deleteByWhere(" id_entidades='$id_entidad_cuenta' AND codigo_plan_cuentas LIKE '$codigo_cuenta'");
						
						$traza=new TrazasModel();
						$_nombre_controlador = "PlanCuentas";
						$_accion_trazas  = "Borrar";
						$_parametros_trazas = $codigo_cuenta;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
						}
				}		
		
			}
			
			$this->redirect("PlanCuentas", "index");
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Plan de Cuentas"
			
			));
		}
				
	}
	
	
	public function AgregarGrupo()
	{
		$respuesta="0";
		session_start();
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$plan_cuentas= new PlanCuentasModel();
			
			$id_entidad_p_cuentas=$_POST['id_entidad_p_cuentas'];
			$nombre_p_cuentas=strtoupper($_POST['nombre_p_cuentas']);
		    $codigo_p_cuentas=$_POST['codigo_p_cuentas'];
		    $id_moneda_p_cuentas=$_POST['id_moneda_p_cuentas'];
		    $n_p_cunetas=$_POST['n_p_cunetas'];
		    $t_p_cuentas=$_POST['t_p_cuentas'];
		    $id_centro_c_p_cuentas=$_POST['id_centro_c_p_cuentas'];
		    $nivel_p_cuentas=$_POST['nivel_p_cuentas'];
		    
		    
		    $funcion = "ins_plan_cuentas";
		    	
		    
		    $parametros = "'$id_entidad_p_cuentas', '$codigo_p_cuentas', '$nombre_p_cuentas', '$id_moneda_p_cuentas',
		    '$n_p_cunetas','$t_p_cuentas','$id_centro_c_p_cuentas','$nivel_p_cuentas'";
		    
		    $plan_cuentas->setFuncion($funcion);
		    	
		    $plan_cuentas->setParametros($parametros);
		    	
		    $resultado=$plan_cuentas->Insert();
		    
		    if($resultado)
		    {
		    	$respuesta="1";
		    }else {
		    	$respuesta="0";
		    }    
		    
		    
		}else {
			
			$respuesta="0";
		}
		
		echo json_encode($respuesta);
	}
	
	public function AgregarSubGrupo()
	{
		$respuesta="0";
		session_start();
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$plan_cuentas= new PlanCuentasModel();
				
			$id_entidad_p_cuentas=$_POST['id_entidad_p_cuentas'];
			$nombre_p_cuentas=strtoupper($_POST['nombre_p_cuentas']);
			$codigo_p_cuentas=$_POST['codigo_p_cuentas'];
			$id_moneda_p_cuentas=$_POST['id_moneda_p_cuentas'];
			$n_p_cunetas=$_POST['n_p_cunetas'];
			$t_p_cuentas=$_POST['t_p_cuentas'];
			$id_centro_c_p_cuentas=$_POST['id_centro_c_p_cuentas'];
			$nivel_p_cuentas=$_POST['nivel_p_cuentas'];
		
			$funcion = "ins_plan_cuentas";
			 
		
			$parametros = "'$id_entidad_p_cuentas', '$codigo_p_cuentas', '$nombre_p_cuentas', '$id_moneda_p_cuentas',
			'$n_p_cunetas','$t_p_cuentas','$id_centro_c_p_cuentas','$nivel_p_cuentas'";
		
			$plan_cuentas->setFuncion($funcion);
			 
			$plan_cuentas->setParametros($parametros);
			 
			try
			{
				$resultado=$plan_cuentas->Insert();
				$respuesta="1";
				
			}catch (exception $x)
			{
				$respuesta="0";
			}
			
		
		}else {
				
			$respuesta="0";
		}
		
		echo json_encode($respuesta);
	}
	
	
	public function returnGrupo()
	{
		
		$id_grupo=(int)$_POST["idcuentas"];
		$id_entidades=(int)$_POST["identidades"];
		$codigo_plan_cuentas=$id_grupo.'%';
		
		$plan_cuentas = new PlanCuentasModel();
		
		$columnas = "id_plan_cuentas,nombre_plan_cuentas,nivel_plan_cuentas";
		$tablas="plan_cuentas";
		$id="id_plan_cuentas";		
		$where=" t_plan_cuentas='G'
				AND nivel_plan_cuentas=2
				AND id_entidades='$id_entidades'
				AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
		
		$resultado=$plan_cuentas->getCondiciones($columnas ,$tablas , $where, $id);
		
		echo json_encode($resultado);
	
	}
	
	public function returnSubGrupo()
	{
	
		$id_grupo=(int)$_POST["idcuentas"];
		$id_entidades=(int)$_POST["identidades"];
		$codigo_plan_cuentas=$id_grupo.'%';
	
		$plan_cuentas = new PlanCuentasModel();
	
		$columnas = "id_plan_cuentas,nombre_plan_cuentas,nivel_plan_cuentas";
		$tablas="plan_cuentas";
		$id="id_plan_cuentas";
		$where=" t_plan_cuentas='G'
		AND nivel_plan_cuentas=3
		AND id_entidades='$id_entidades'
		AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
	
		$resultado=$plan_cuentas->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultado);
	
	}
	
	public function returnSubGrupo1()
	{
	
		$id_grupo=(int)$_POST["idgrupo"];
		$id_entidades=(int)$_POST["identidades"];
		$codigo_plan_cuentas=$id_grupo.'%';
	
		$plan_cuentas = new PlanCuentasModel();
		
		$resultGrupo= $plan_cuentas->getBy("id_plan_cuentas='$id_grupo'");
		
		$resultado=array();
		
		if(!empty($resultGrupo))
		{
			$codigoGrupo=$resultGrupo[0]->codigo_plan_cuentas;
			
			$columnas = "id_plan_cuentas,nombre_plan_cuentas,nivel_plan_cuentas,codigo_plan_cuentas";
			$tablas="plan_cuentas";
			$id="id_plan_cuentas";
			$where=" t_plan_cuentas='G'
			AND nivel_plan_cuentas=3
			AND id_entidades='$id_entidades'
			AND codigo_plan_cuentas like '$codigoGrupo%'";
			
			$resultado=$plan_cuentas->getCondiciones($columnas ,$tablas , $where, $id);
			
		}
		
		echo json_encode($resultado);
	
	}
	
	
	public function returnCodGrupo()
	{
	
		$id_grupo=(int)$_POST["idcuentas"];
		$id_entidades=(int)$_POST["identidades"];
		$codigo_plan_cuentas=$id_grupo.'%';
	
		$plan_cuentas = new PlanCuentasModel();
	
		$columnas = "id_plan_cuentas,codigo_plan_cuentas,substring(codigo_plan_cuentas,3,1) as subcodigo";
		
		$tablas="plan_cuentas";
				
	    $id="subcodigo";
				
		$where=" t_plan_cuentas='G'
				AND nivel_plan_cuentas=2
				AND id_entidades='$id_entidades'
				AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
				
		$resultado=$plan_cuentas->getCondicionesDesc($columnas ,$tablas , $where, $id);
		$respuesta=1;
		
		if(!empty($resultado)){$respuesta=$resultado[0]->subcodigo;	$respuesta=$respuesta+1;}
	
		echo json_encode($respuesta);
	
	}
	
	public function returnCodSubGrupo()
	{
	
		
		$id_cuenta=(int)$_POST["idcuentas"];
		$id_entidades=(int)$_POST["identidades"];
		$id_grupo=(int)$_POST["idgrupo"];
		
	
		$plan_cuentas = new PlanCuentasModel();
		
		$resultGrupo=$plan_cuentas->getBy("id_plan_cuentas='$id_grupo'");
		
		//print_r($resultGrupo);
		
		$respuesta=0;
		
		if(!empty($resultGrupo)){
		
		$codigoGrupo_l2=$resultGrupo[0]->codigo_plan_cuentas;
		
		$codigo_plan_cuentas=$codigoGrupo_l2.'%';
	
		$columnas = "id_plan_cuentas,codigo_plan_cuentas,substring(codigo_plan_cuentas,5,1) as subcodigo";
	
		$tablas="plan_cuentas";
	
		$id="subcodigo";
	
		$where=" t_plan_cuentas='G'
		AND nivel_plan_cuentas=3
		AND id_entidades='$id_entidades'
		AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
	
		$resultado=$plan_cuentas->getCondicionesDesc($columnas ,$tablas , $where, $id);
		
		$respuesta=$codigoGrupo_l2.'1.';
	
		if(!empty($resultado)){	$temp=$resultado[0]->subcodigo; $temp=$temp+1; $respuesta=(string)$codigoGrupo_l2.$temp.'.';}
		
		}
		
		echo json_encode($respuesta);
	
	}
	
	public function returnCodCuenta()
	{
	
		$id_codgrupo_l3=(string)$_POST["cod_grupo"];
		$id_entidades=(int)$_POST["identidades"];
		$codigoGrupo_l3=$id_codgrupo_l3.'%';
	
		$plan_cuentas = new PlanCuentasModel();
	
		$columnas = "id_plan_cuentas,codigo_plan_cuentas,substring(codigo_plan_cuentas,7,1) as subcodigo";
	
		$tablas="plan_cuentas";
	
		$id="subcodigo";
	
		$where=" t_plan_cuentas='C'
		AND nivel_plan_cuentas=4
		AND id_entidades='$id_entidades'
		AND codigo_plan_cuentas like '$codigoGrupo_l3'";
	
		$resultado=$plan_cuentas->getCondicionesDesc($columnas ,$tablas , $where, $id);
		
		$respuesta=$id_codgrupo_l3.'1.';
	
		if(!empty($resultado)){	$temp=$resultado[0]->subcodigo; $temp=$temp+1; $respuesta=(string)$id_codgrupo_l3.$temp.'.';}
		
		echo json_encode($respuesta);
	
	}
	
	public function returnCuenta()
	{
	
		$id_grupo=(int)$_POST["idgrupo"];
		$id_entidades=(int)$_POST["identidades"];
		$codigo_plan_cuentas=$id_grupo.'%';
	
		$plan_cuentas = new PlanCuentasModel();
	
		
		$resultado=array();
	
				
			$columnas = "id_plan_cuentas,nombre_plan_cuentas,nivel_plan_cuentas,codigo_plan_cuentas";
			$tablas="plan_cuentas";
			$id="id_plan_cuentas";
			$where=" t_plan_cuentas='C'
			AND nivel_plan_cuentas=4
			AND id_entidades='$id_entidades'
			AND codigo_plan_cuentas like '$codigo_plan_cuentas'";
				
			$resultado=$plan_cuentas->getCondiciones($columnas ,$tablas , $where, $id);
				
		
	
		echo json_encode($resultado);
	
	}
	
	public function returnCuentaAnalisis()
	{
	
		$id_p_cuenta=(int)$_POST["id_plan_cuentas"];
		$id_entidades=(int)$_POST["identidades"];
	
		$plan_cuentas = new PlanCuentasModel();
		
		$resultGrupo= $plan_cuentas->getBy("id_plan_cuentas='$id_p_cuenta'");
		
		$resultado=array();
		
		if(!empty($resultGrupo))
		{
			$codigoCuenta=$resultGrupo[0]->codigo_plan_cuentas;
			
			$columnas = "id_plan_cuentas,nombre_plan_cuentas,nivel_plan_cuentas,codigo_plan_cuentas";
			$tablas="plan_cuentas";
			$where=" t_plan_cuentas='S'
			AND nivel_plan_cuentas=5
			AND id_entidades='$id_entidades'
			AND codigo_plan_cuentas like '$codigoCuenta%'";
			$id="id_plan_cuentas";
			
			$resultado=$plan_cuentas->getCondiciones($columnas ,$tablas , $where, $id);
			
		}
		
		echo json_encode($resultado);
	
	}
	
	
	public function ImprimirConsultarPlanCuentas(){
		
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		
		$plan_cuentas= new PlanCuentasModel();
		
		$entidades = new EntidadesModel();
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
			$nombre_controladores = "PlanCuentas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $plan_cuentas->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"])){
		
		
					$id_entidades=$_POST['id_entidades'];
					
		
						
		
		
					$columnas = " entidades.id_entidades, 
								  entidades.ruc_entidades, 
								  entidades.nombre_entidades, 
								  entidades.telefono_entidades, 
								  entidades.direccion_entidades, 
								  entidades.ciudad_entidades, 
								  entidades.logo_entidades, 
								  usuarios.id_usuarios, 
								  plan_cuentas.id_plan_cuentas, 
								  plan_cuentas.codigo_plan_cuentas, 
								  plan_cuentas.nombre_plan_cuentas, 
								  monedas.nombre_monedas, 
								  plan_cuentas.n_plan_cuentas, 
								  plan_cuentas.t_plan_cuentas, 
								  plan_cuentas.nivel_plan_cuentas";
		
		
		
					$tablas="  public.plan_cuentas, 
							  public.usuarios, 
							  public.entidades, 
							  public.monedas";
		
					$where="plan_cuentas.id_modenas = monedas.id_monedas AND
							  entidades.id_entidades = usuarios.id_entidades AND
							  entidades.id_entidades = plan_cuentas.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		
					$id="plan_cuentas.codigo_plan_cuentas";
		
		
					$where_0 = "";
					
		
						
						
		
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
		
					
		
					$where_to  = $where . $where_0;
		
		
					//$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
		
						
					//comienza paginacion
						
						
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
						
					if($action == 'ajax')
					{
						$html="";
						$resultSet=$plan_cuentas->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$resultSet[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
						$resultSet=$plan_cuentas->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
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
							$html.='<th>Nombre Entidad</th>';
							$html.='<th>Codigo Cuenta</th>';
							$html.='<th>Nombre Cuenta</th>';
							$html.='<th>Nivel Cuenta</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							foreach ($resultSet as $res)
							{
								//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
									
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_entidades.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->codigo_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nivel_plan_cuentas.'</td>';
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
						$parametros['id_usuarios'] = $_SESSION['id_usuarios']?trim($_SESSION['id_usuarios']):'';
							
		
						//para local
						$pagina="conPlanCuentas.aspx";
		
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						$conexion_rpt['port']="59584";
		
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
		
						die();
		
					}
						
		
				}
		
		
				$this->view("ImprimirConsultarPlanCuentas",array(
						"resultSet"=>$resultSet, "resultEnt"=>$resultEnt
		
							
							
				));
		
		
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consultar e Imprimir Plan Cuentas"
		
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
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_plan_cuentas(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_plan_cuentas(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_plan_cuentas(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_plan_cuentas(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_plan_cuentas(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_plan_cuentas($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_plan_cuentas(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
}
?>