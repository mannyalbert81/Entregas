<?php

class TipoCierreController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipo_cierre= new TipoCierreModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_cierre->getAll("id_tipo_cierre");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$tipo_cierre= new TipoCierreModel();
			
			$entidades=new EntidadesModel();
			$resultEnt = $entidades->getBy("nombre_entidades='MUNDO DIGITAL'");
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TipoCierre";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_cierre->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_cierre"])   )
				{

					$nombre_controladores = "TipoCierre";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_cierre->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_cierre = $_GET["id_tipo_cierre"];
						$columnas = " id_tipo_cierre, nombre_tipo_cierre";
						$tablas   = "tipo_cierre";
						$where    = "id_tipo_cierre = '$_id_tipo_cierre' "; 
						$id       = "nombre_tipo_cierre";
							
						$resultEdit = $tipo_cierre->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "TipoCierre";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_cierre;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Cierre"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoCierre",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEnt"=>$resultEnt,
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Cierre"
				
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
	
	public function InsertaTipoCierre(){
			
		session_start();

		
		$tipo_cierre=new TipoCierreModel();
		$nombre_controladores = "TipoCierre";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_cierre->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_cierre=new TipoCierreModel();
		   
		   	if (isset ($_POST["Guardar"]) )
				
							
			{
				$_nombre_tipo_cierre = $_POST["nombre_tipo_cierre"];
				$_id_entidades = $_POST["id_entidades"];
				
				if(isset($_POST["id_tipo_cierre"])) 
				{
					
					$_id_tipo_cierre = $_POST["id_tipo_cierre"];
					$colval = " nombre_tipo_cierre = '$_nombre_tipo_cierre'   ";
					$tabla = "tipo_cierre";
					$where = "id_tipo_cierre = '$_id_tipo_cierre'    ";
					
					$resultado=$tipo_cierre->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_cierre";
				
				$parametros = " '$_nombre_tipo_cierre','$_id_entidades'  ";
					
				$tipo_cierre->setFuncion($funcion);
		
				$tipo_cierre->setParametros($parametros);
		
		
				$resultado=$tipo_cierre->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Cierre";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_cierre;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("tipo_cierre", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Cierre"
		
			));
		
		
		}
	

		$tipo_cierre=new TipoCierreModel();

		$nombre_controladores = "TipoCierre";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_cierre->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_cierre=new TipoCierreModel();
		
			
			
			if (isset ($_POST["nombre_tipo_cierre"]) )
				
			{
				$_nombre_tipo_cierre = $_POST["nombre_tipo_cierre"];
				
				if(isset($_POST["id_tipo_cierre"]))
				{
				$_id_tipo_cierre = $_POST["id_tipo_cierre"];
				$colval = " nombre_tipo_cierre = '$_nombre_tipo_cierre'   ";
				$tabla = "tipo_cierre";
				$where = "id_tipo_cierre = '$_id_tipo_cierre'    ";
					
				$resultado=$tipo_cierre->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_cierre";
				
				$parametros = " '$_nombre_tipo_cierre'  ";
					
				$tipo_cierre->setFuncion($funcion);
		
				$tipo_cierre->setParametros($parametros);
		
		
				$resultado=$tipo_cierre->Insert();
			 }
		
			}
			$this->redirect("TipoCierre", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Cierre"
		
			));
		
		
		}
		
	}




	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Roles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_cierre"]))
			{
				$id_tipo_cierre=(int)$_GET["id_tipo_cierre"];
				
				$tipo_cierre=new TipoCierreModel();
				
				$tipo_cierre->deleteBy(" id_tipo_cierre",$id_tipo_cierre);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "TipoCierre";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_cierre;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoCierre", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Cierre"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_cierre=new TipoCierreModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoCierre",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>