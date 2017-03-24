<?php

class Tipo_OperacionesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	
		$tipo_operaciones = new Tipo_OperacionesModel();
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_operaciones->getAll("id_tipo_operaciones");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "Tipo_Operaciones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_operaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_tipo_operaciones"])   )
				{
					
					$nombre_controladores = "Tipo_Operaciones";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_operaciones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_operaciones = $_GET["id_tipo_operaciones"];
						
						$columnas = " id_tipo_operaciones, nombre_tipo_operaciones";
						$tablas   = "tipo_operaciones";
						$where    = "id_tipo_operaciones = '$_id_tipo_operaciones' "; 
						$id       = "id_tipo_operaciones";
						
						
						
							
						
						$resultEdit = $tipo_operaciones->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo_Operaciones";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_operaciones;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo de Operaciones"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->view("Tipo_Operaciones",array(
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
	
	public function InsertaOperacion(){
			
		session_start();
		
		$tipo_operaciones = new Tipo_OperacionesModel();
		$permisos_rol=new PermisosRolesModel();
		

		
		

		$nombre_controladores = "Tipo_Operaciones";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		$resultPer = $tipo_operaciones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
		
		
			//_nombre_controladores
			
			if (isset ($_POST["nombre_tipo_operaciones"]) )
				
			{
				
				
				
				$_nombre_tipo_operaciones = $_POST["nombre_tipo_operaciones"];
				
				
				
				if(isset($_POST["id_tipo_operaciones"])) 
				{
					
					$_id_tipo_operaciones = $_POST["id_tipo_operaciones"];
					
					$colval = " nombre_tipo_operaciones = '$_nombre_tipo_operaciones'   ";
					$tabla = "tipo_operaciones";
					$where = "id_tipo_operaciones = '$_id_tipo_operaciones'    ";
					
					$resultado=$tipo_operaciones->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_tipo_operaciones";
				
				$parametros = " '$_nombre_tipo_operaciones'  ";
					
				$tipo_operaciones->setFuncion($funcion);
		
				$tipo_operaciones->setParametros($parametros);
		
		
				$resultado=$tipo_operaciones->Insert();
				
				//$this->view("Error",array(
							
						//"resultado"=>$resultado[0]
				
				//));
				//exit();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Operaciones";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_operaciones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("Tipo_Operaciones", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Operaciones"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Tipo_Operaciones";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_operaciones"]))
			{
				$id_tipo_operaciones=(int)$_GET["id_tipo_operaciones"];
				
				
				$tipo_operaciones = new Tipo_OperacionesModel();
				
				$tipo_operaciones->deleteBy(" id_tipo_operaciones",$id_tipo_operaciones);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Operaciones";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_operaciones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Tipo_Operaciones", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Operaciones"
			
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