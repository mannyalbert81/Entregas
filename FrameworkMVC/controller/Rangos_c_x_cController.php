<?php

class Rangos_c_x_cController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	
		$tipo_identificacion = new Tipo_IdentificacionModel();
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_identificacion->getAll("id_tipo_identificacion");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "Rangos_c_x_c";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_identificacion->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_tipo_identificacion"])   )
				{
					
					$nombre_controladores = "Rangos_c_x_c";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_identificacion = $_GET["id_tipo_identificacion"];
						
						$columnas = " id_tipo_identificacion, nombre_tipo_identificacion";
						$tablas   = "tipo_identificacion";
						$where    = "id_tipo_identificacion = '$_id_tipo_identificacion' "; 
						$id       = "id_tipo_identificacion";
						
						
						
							
						
						$resultEdit = $tipo_identificacion->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo_Identificacion";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_identificacion;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo de Identificacion"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->cartera("Rangos_c_x_c",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipo de Identificacion"
				
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
	
	public function InsertaIdentificacion(){
			
		session_start();
		
		$tipo_identificacion = new Tipo_IdentificacionModel();
		$permisos_rol=new PermisosRolesModel();
		

		
		

		$nombre_controladores = "Tipo_Identificacion";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
		
		
			//_nombre_controladores
			
			if (isset ($_POST["nombre_tipo_identificacion"]) )
				
			{
				
				
				
				$_nombre_tipo_identificacion = $_POST["nombre_tipo_identificacion"];
				
				
				
				if(isset($_POST["id_tipo_identificacion"])) 
				{
					
					$_id_tipo_identificacion = $_POST["id_tipo_identificacion"];
					
					$colval = " nombre_tipo_identificacion = '$_nombre_tipo_identificacion'   ";
					$tabla = "tipo_identificacion";
					$where = "id_tipo_identificacion = '$_id_tipo_identificacion'    ";
					
					$resultado=$tipo_identificacion->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_tipo_identificacion";
				
				$parametros = " '$_nombre_tipo_identificacion'  ";
					
				$tipo_identificacion->setFuncion($funcion);
		
				$tipo_identificacion->setParametros($parametros);
		
		
				$resultado=$tipo_identificacion->Insert();
				
				//$this->view("Error",array(
							
						//"resultado"=>$resultado[0]
				
				//));
				//exit();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Identificacion";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_identificacion;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("Tipo_Identificacion", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Identificacion"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Tipo_Identificacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_identificacion"]))
			{
				$id_tipo_identificacion=(int)$_GET["id_tipo_identificacion"];
				
				
				$tipo_identificacion = new Tipo_IdentificacionModel();
				
				$tipo_identificacion->deleteBy(" id_tipo_identificacion",$id_tipo_identificacion);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Persona";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_identificacion;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Tipo_Identificacion", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Identificacion"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$roles=new RolesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("Roles",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	public function verError(){
		
	$a=stripslashes ($_GET['dato']);
	
	$_dato=urldecode($a);
	
	$_dato=unserialize($a);
		
		$this->view("error", array('resultado'=>print_r($_dato)));
	}
	
	
	
	
		
}
?>