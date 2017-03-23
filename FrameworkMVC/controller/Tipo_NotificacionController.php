<?php

class Tipo_NotificacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	
		$tipo_notificacion = new Tipo_NotificacionModel();
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_notificacion->getAll("id_tipo_notificacion");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "Tipo_Notificacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_notificacion->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_tipo_notificacion"])   )
				{
					
					$nombre_controladores = "Tipo_Notificacion";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_notificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_notificacion = $_GET["id_tipo_notificacion"];
						
						$columnas =  " 	tipo_notificacion.id_tipo_notificacion, 
									 	tipo_notificacion.descripcion_notificacion, 
  										tipo_notificacion.controlador_tipo_notificacion, 
 										tipo_notificacion.accion_tipo_notificacion, 
  										tipo_notificacion.nombre_icon_tipo_notificacion";
						$tablas   = " public.tipo_notificacion";
						$where    = "id_tipo_notificacion = '$_id_tipo_notificacion' "; 
						$id       = "id_tipo_notificacion";
						
						
						
							
						
						$resultEdit = $tipo_notificacion->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "id_tipo_notificacion";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_notificacion;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo de Notificacion"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->view("Tipo_Notificacion",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipo de Notificacion"
				
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
	
	public function InsertaNotificacion(){
			
		session_start();
		
		$tipo_notificacion = new Tipo_NotificacionModel();
		$permisos_rol=new PermisosRolesModel();



		$nombre_controladores = "Tipo_Notificacion";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		$resultPer = $tipo_notificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
		
		
			//_nombre_controladores
			
			if (isset ($_POST["descripcion_notificacion"]) )
				
			{
				
				
				
				$_descripcion_notificacion = $_POST["descripcion_notificacion"];
				$_controlador_tipo_notificacion = $_POST["controlador_tipo_notificacion"];
				$_accion_tipo_notificacion = $_POST["accion_tipo_notificacion"];
				$_nombre_icon_tipo_notificacion = $_POST["nombre_icon_tipo_notificacion"];
				
				
				
				if(isset($_POST["id_tipo_notificacion"])) 
				{
					
					$_id_tipo_notificacion = $_POST["id_tipo_notificacion"];
					
					$colval = " descripcion_notificacion = '$_descripcion_notificacion'   ";
					$colval = " controlador_tipo_notificacion = '$_controlador_tipo_notificacion'   ";
					$colval = " accion_tipo_notificacion = '$_accion_tipo_notificacion'   ";
					$colval = " nombre_icon_tipo_notificacion = '$_nombre_icon_tipo_notificacion'   ";
					$tabla = "tipo_notificacion";
					$where = "id_tipo_notificacion = '$_id_tipo_notificacion'    ";
					
					$resultado=$tipo_notificacion->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_tipo_notificacion";
				
				$parametros = " '$_descripcion_notificacion', '$_controlador_tipo_notificacion','$_accion_tipo_notificacion','$_nombre_icon_tipo_notificacion' ";
					
				$tipo_notificacion->setFuncion($funcion);
		
				$tipo_notificacion->setParametros($parametros);
		
		
				$resultado=$tipo_notificacion->Insert();
				
				//$this->view("Error",array(
							
						//"resultado"=>$resultado[0]
				
				//));
				//exit();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Notificacion";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_descripcion_notificacion;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("Tipo_Notificacion", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Notificacion"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Tipo_Notificacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_notificacion"]))
			{
				$id_tipo_notificacion=(int)$_GET["id_tipo_notificacion"];
				
				
				$tipo_notificacion = new Tipo_NotificacionModel();
				
				$tipo_notificacion->deleteBy(" id_tipo_notificacion",$id_tipo_notificacion);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Notificacion";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_notificacion;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Tipo_Notificacion", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Notificacion"
			
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