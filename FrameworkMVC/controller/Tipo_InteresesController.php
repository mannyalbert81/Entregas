<?php

class Tipo_InteresesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	
		$tipo_intereses = new Tipo_InteresesModel();
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_intereses->getAll("id_tipo_intereses");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "Tipo_Intereses";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_intereses->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_tipo_intereses"])   )
				{
					
					$nombre_controladores = "Tipo_Intereses";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_intereses->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_intereses = $_GET["id_tipo_intereses"];
						
						$columnas = " id_tipo_intereses, nombre_tipo_intereses";
						$tablas   = "tipo_intereses";
						$where    = "id_tipo_intereses = '$_id_tipo_intereses' "; 
						$id       = "id_tipo_intereses";
						
						
						
							
						
						$resultEdit = $tipo_intereses->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo_Intereses";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_intereses;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo de Intereses"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->cartera("Tipo_Intereses",array(
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
	
	public function InsertaIntereses(){
			
		session_start();
		
		$tipo_intereses = new Tipo_InteresesModel();
		$permisos_rol=new PermisosRolesModel();
		
		$nombre_controladores = "Tipo_Intereses";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		$resultPer = $tipo_intereses->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
		
		
			//_nombre_controladores
			
			if (isset ($_POST["nombre_tipo_intereses"]) )
				
			{
				
				
				
				$_nombre_tipo_intereses = $_POST["nombre_tipo_intereses"];
				
				
				
				if(isset($_POST["id_tipo_intereses"])) 
				{
					
					$_id_tipo_intereses = $_POST["id_tipo_intereses"];
					
					$colval = " nombre_tipo_intereses = '$_nombre_tipo_intereses'   ";
					$tabla = "tipo_intereses";
					$where = "id_tipo_intereses = '$_id_tipo_intereses'    ";
					
					$resultado=$tipo_intereses->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_tipo_intereses";
				
				$parametros = " '$_nombre_tipo_intereses'  ";
					
				$tipo_intereses->setFuncion($funcion);
		
				$tipo_intereses->setParametros($parametros);
		
		
				$resultado=$tipo_intereses->Insert();
				
				//$this->view("Error",array(
							
						//"resultado"=>$resultado[0]
				
				//));
				//exit();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Intereses";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_intereses;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("Tipo_Intereses", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Intereses"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Tipo_Intereses";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_intereses"]))
			{
				$id_tipo_intereses =(int)$_GET["id_tipo_intereses"];
				
				
				$tipo_intereses = new Tipo_InteresesModel();
				
				$tipo_intereses->deleteBy(" id_tipo_intereses",$id_tipo_intereses);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Intereses";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_intereses;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Tipo_Intereses", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Intereses"
			
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
?>'