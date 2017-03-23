<?php

class Tipo_ContribuyenteController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	
		$tipo_contribuyente = new Tipo_ContribuyenteModel();
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_contribuyente->getAll("id_tipo_contribuyente");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "Tipo_Contribuyente";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_contribuyente->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_tipo_contribuyente"])   )
				{
					
					$nombre_controladores = "Tipo_Contribuyente";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_contribuyente->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_contribuyente = $_GET["id_tipo_contribuyente"];
						
						$columnas = " id_tipo_contribuyente, nombre_tipo_contribuyente";
						$tablas   = "tipo_contribuyente";
						$where    = "id_tipo_contribuyente = '$_id_tipo_contribuyente' "; 
						$id       = "id_tipo_contribuyente";
						
						
						
							
						
						$resultEdit = $tipo_contribuyente->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo_Contribuyente";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_contribuyente;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo de Contribuyente"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->view("Tipo_Contribuyente",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipo de Contribuyente"
				
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
	
	public function InsertaContribuyente(){
			
		session_start();
		
		$tipo_contribuyente = new Tipo_ContribuyenteModel();
		$permisos_rol=new PermisosRolesModel();

		$controladores=new ControladoresModel();


		$nombre_controladores = "Tipo_Contribuyente";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		$resultPer = $controladores->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
		
		
			//_nombre_controladores
			
			if (isset ($_POST["nombre_tipo_contribuyente"]) )
				
			{
				
				
				
				$_nombre_tipo_contribuyente = $_POST["nombre_tipo_contribuyente"];
				
				
				
				if(isset($_POST["id_tipo_contribuyente"])) 
				{
					
					$_id_tipo_contribuyente = $_POST["id_tipo_contribuyente"];
					
					$colval = " nombre_tipo_contribuyente = '$_nombre_tipo_contribuyente'   ";
					$tabla = "tipo_contribuyente";
					$where = "id_tipo_contribuyente = '$_id_tipo_contribuyente'    ";
					
					$resultado=$tipo_contribuyente->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_tipo_contribuyente";
				
				$parametros = " '$_nombre_tipo_contribuyente'  ";
					
				$tipo_contribuyente->setFuncion($funcion);
		
				$tipo_contribuyente->setParametros($parametros);
		
		
				$resultado=$tipo_contribuyente->Insert();
				
				//$this->view("Error",array(
							
						//"resultado"=>$resultado[0]
				
				//));
				//exit();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Contribuyente";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_contribuyente;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("Tipo_Contribuyente", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Contribuyente"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Tipo_Contribuyente";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_contribuyente"]))
			{
				$id_tipo_contribuyente=(int)$_GET["id_tipo_contribuyente"];
				
				
				$tipo_contribuyente = new Tipo_ContribuyenteModel();
				
				$tipo_contribuyente->deleteBy(" id_tipo_contribuyente",$id_tipo_contribuyente);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo_Contribuyente";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_contribuyente;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Tipo_Contribuyente", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Contribuyente"
			
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