<?php

class Tipo_PersonaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	//mYCOL
		//Creamos el objeto usuario
     	
		$tipo_persona = new Tipo_PersonaModel();
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_persona->getAll("id_tipo_persona");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "Tipo_Persona";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_persona->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_tipo_persona"])   )
				{
					
					$nombre_controladores = "Tipo_Persona";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_persona->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_persona = $_GET["id_tipo_persona"];
						
						$columnas = " id_tipo_persona, nombre_tipo_persona";
						$tablas   = "tipo_persona";
						$where    = "id_tipo_persona = '$_id_tipo_persona' "; 
						$id       = "id_tipo_persona";
						
						
						
							
						
						$resultEdit = $tipo_persona->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo_Persona";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_persona;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo de Persona"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->view("Tipo_Persona",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipo de Persona"
				
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
	
	public function InsertaPersona(){
			
		session_start();
		
		$tipo_persona = new Tipo_PersonaModel();
		$permisos_rol=new PermisosRolesModel();

		$controladores=new ControladoresModel();


		$nombre_controladores = "Tipo_Persona";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		$resultPer = $controladores->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
		
		
			//_nombre_controladores
			
			if (isset ($_POST["nombre_tipo_persona"]) )
				
			{
				
				
				
				$_nombre_tipo_persona = $_POST["nombre_tipo_persona"];
				
				
				
				if(isset($_POST["id_tipo_persona"])) 
				{
					
					$_id_tipo_persona = $_POST["id_tipo_persona"];
					
					$colval = " nombre_tipo_persona = '$_nombre_tipo_persona'   ";
					$tabla = "tipo_persona";
					$where = "id_tipo_persona = '$_id_tipo_persona'    ";
					
					$resultado=$tipo_persona->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_tipo_persona";
				
				$parametros = " '$_nombre_tipo_persona'  ";
					
				$tipo_persona->setFuncion($funcion);
		
				$tipo_persona->setParametros($parametros);
		
		
				$resultado=$tipo_persona->Insert();
				
				//$this->view("Error",array(
							
						//"resultado"=>$resultado[0]
				
				//));
				//exit();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Persona";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_persona;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("Tipo_Persona", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Persona"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Tipo_Persona";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_persona"]))
			{
				$id_tipo_persona=(int)$_GET["id_tipo_persona"];
				
				
				$tipo_persona = new Tipo_PersonaModel();
				
				$tipo_persona->deleteBy("id_tipo_persona",$id_tipo_persona);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Persona";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_persona;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Tipo_Persona", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Contribuyente"
			
			));
		}
				
	}
	
	
}
?>