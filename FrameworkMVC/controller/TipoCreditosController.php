<?php

class TipoCreditosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
<<<<<<< HEAD
	//mYCOL
		//Creamos el objeto usuario
     	
		$tipo_persona = new Tipo_PersonaModel();
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_persona->getAll("id_tipo_persona");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "TipoCreditos";
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
								"resultado"=>"No tiene Permisos de Editar Tipo de Creditos"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->cartera("TipoCreditos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipo de Creditos"
				
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
	
	public function InsertaTipoCreditos(){
			
		session_start();
		
		$tipo_creditos = new TipoCreditosModel();
		
		
		$permisos_rol=new PermisosRolesModel();
		$controladores=new ControladoresModel();
		$nombre_controladores = "TipoCreditos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		$resultPer = $controladores->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
				//_nombre_controladores
			
			if (isset ($_POST["nombre_tipo_creditos"]) )
				
			{
				$_nombre_tipo_creditos = $_POST["nombre_tipo_creditos"];
				
				if(isset($_POST["id_tipo_creditos"])) 
				{
					
					$_id_tipo_creditos = $_POST["id_tipo_creditos"];
					
					$colval = " nombre_tipo_creditos = '$_nombre_tipo_creditos'   ";
					$tabla = "tipo_creditos";
					$where = "id_tipo_creditos = '$_id_tipo_creditos'    ";
					
					$resultado=$tipo_creditos->UpdateBy($colval, $tabla, $where);
					
				}else {
				
				$funcion = "ins_tipo_creditos";
				
				$parametros = " '$_nombre_tipo_creditos'  ";
					
				$tipo_creditos->setFuncion($funcion);
		
				$tipo_creditos->setParametros($parametros);
		
		
				$resultado=$tipo_creditos->Insert();
				
				//$this->view("Error",array(
							
						//"resultado"=>$resultado[0]
				
				//));
				//exit();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "TipoCreditos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_creditos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("TipoCreditos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Creditos"
		
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
				
				$tipo_persona->deleteBy(" id_tipo_persona",$id_tipo_persona);
				
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
	
	
=======
		
		session_start();
		$tipo_creditos = new TipoCreditosModel();
	    $resultSet=$tipo_creditos->getAll("id_tipo_creditos");
		$resultEdit = "";

		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "TipoCreditos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_creditos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_tipo_creditos"])   )
				{
					
					$nombre_controladores = "TipoCreditos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_creditos->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_creditos = $_GET["id_tipo_creditos"];
						
						$columnas = " id_tipo_creditos, nombre_tipo_creditos";
						$tablas   = "tipo_creditos";
						$where    = "id_tipo_creditos = '$_id_tipo_creditos' "; 
						$id       = "id_tipo_creditos";
						
						
						$resultEdit = $tipo_creditos->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "TipoCreditos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_creditos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo de Creditos"
					
						));
					
					
					}
					
				}
				
				$this->cartera("TipoCreditos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipo de Creditos"
				
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
	
	public function InsertaTipoCreditos(){
			
		session_start();
		$tipo_creditos = new TipoCreditosModel();
		
		
		$permisos_rol=new PermisosRolesModel();
		
		$nombre_controladores = "TipoCreditos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		$resultPer = $tipo_creditos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			
			if (isset ($_POST["nombre_tipo_creditos"]) )
				
			{
				$_nombre_tipo_creditos = $_POST["nombre_tipo_creditos"];
				
				if(isset($_POST["id_tipo_creditos"])) 
				{
					
					$_id_tipo_creditos = $_POST["id_tipo_creditos"];
					$colval = " nombre_tipo_creditos = '$_nombre_tipo_creditos'";
					$tabla = "tipo_creditos";
					$where = "id_tipo_creditos = '$_id_tipo_creditos'";
					$resultado=$tipo_creditos->UpdateBy($colval, $tabla, $where);
					
					
				}else {
				
				$funcion = "ins_tipo_creditos";
				$parametros = " '$_nombre_tipo_creditos'  ";
				$tipo_creditos->setFuncion($funcion);
				$tipo_creditos->setParametros($parametros);
				$resultado=$tipo_creditos->Insert();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "TipoCreditos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_creditos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 
				
				$this->cartera("TipoCreditos",array("resultado"=>"Guardar"));
				
				die();
				
				}
		
			}
			$this->redirect("TipoCreditos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Creditos"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "TipoCreditos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_creditos"]))
			{
				$id_tipo_creditos=(int)$_GET["id_tipo_creditos"];
				
				
				$tipo_creditos = new TipoCreditosModel();
				
				$tipo_creditos->deleteBy("id_tipo_creditos",$id_tipo_creditos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "TipoCreditos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_creditos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			
				
			
			}
			
			
			
			$this->redirect("TipoCreditos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Credito"
			
			));
		}
				
	}
>>>>>>> branch 'master' of https://github.com/mannyalbert81/contabilidad.git
	
	
		
}
?>