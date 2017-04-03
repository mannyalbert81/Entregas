<?php

class ClientesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
		session_start();
		
		$clientes = new ClientesModel();
		
		$provincias = new ProvinciasModel();
		$resultPro = $provincias->getAll("nombre_provincias");
		
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
				
		$resultEdit = "";

		
		$columnas = "fc_clientes.id_clientes,
									  fc_clientes.ruc_clientes,
									  fc_clientes.razon_social_clientes,
									  provincias.id_provincias,
									  provincias.nombre_provincias,
									  ciudad.id_ciudad,
									  ciudad.nombre_ciudad,
									  fc_clientes.direccion_clientes,
									  fc_clientes.telefono_clientes,
									  fc_clientes.celular_clientes,
									  fc_clientes.email_clientes,
									  entidades.id_entidades,
									  entidades.nombre_entidades";
		
		$tablas   = " public.fc_clientes,
									  public.ciudad,
									  public.provincias,
									  public.entidades";
		
		$where    = " ciudad.id_ciudad = fc_clientes.id_ciudad AND
		provincias.id_provincias = fc_clientes.id_provincias AND
		entidades.id_entidades = fc_clientes.id_entidades";
		$id       = "fc_clientes.id_clientes";
		$resultSet = $clientes->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_clientes"])   )
				{
					
					$nombre_controladores = "Clientes";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $clientes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_clientes = $_GET["id_clientes"];
						
						$columnas_edit = "fc_clientes.id_clientes, 
									  fc_clientes.ruc_clientes, 
									  fc_clientes.razon_social_clientes, 
									  provincias.id_provincias, 
									  provincias.nombre_provincias, 
									  ciudad.id_ciudad, 
									  ciudad.nombre_ciudad, 
									  fc_clientes.direccion_clientes, 
									  fc_clientes.telefono_clientes, 
									  fc_clientes.celular_clientes, 
									  fc_clientes.email_clientes, 
									  entidades.id_entidades, 
									  entidades.nombre_entidades";
						
						$tablas_edit   = " public.fc_clientes, 
									  public.ciudad, 
									  public.provincias, 
									  public.entidades";
						
						$where_edit    = " ciudad.id_ciudad = fc_clientes.id_ciudad AND
  									  provincias.id_provincias = fc_clientes.id_provincias AND
 								      entidades.id_entidades = fc_clientes.id_entidades AND fc_clientes.id_clientes='$_id_clientes'"; 
						$id_edit       = "fc_clientes.id_clientes";
						$resultEdit = $clientes->getCondiciones($columnas_edit ,$tablas_edit ,$where_edit, $id_edit);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Clientes";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_clientes;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Clientes"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->cartera("Clientes",array(
						"resultEdit" =>$resultEdit, "resultCiu" =>$resultCiu, "resultPro" =>$resultPro, "resultSet" =>$resultSet
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Clientes"
				
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
	
	public function InsertaClientes(){
			
		session_start();
		
		$Clientes = new ClientesModel();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Clientes";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		if (!empty($resultPer))
		{
		
			$resultado = null;
			
			if (isset ($_POST["ruc_clientes"]) )
				
			{
				
				$_ruc_clientes = $_POST["ruc_clientes"];
				$_razon_social_clientes = $_POST["razon_social_clientes"];
				$_id_provincias = $_POST["id_provincias"];
				$_id_ciudad = $_POST["id_ciudad"];
				$_direccion_clientes = $_POST["direccion_clientes"];
				$_telefono_clientes = $_POST["telefono_clientes"];
				$_celular_clientes = $_POST["celular_clientes"];
				$_email_clientes = $_POST["email_clientes"];
			    $_id_usuarios = $_SESSION['id_usuarios'];
			   
			    $usuarios = new UsuariosModel();
			    
			    $resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
			    $_id_entidades=$resultEnt[0]->id_entidades;
						
				$funcion = "ins_fc_clientes";
				$parametros = " '$_ruc_clientes', '$_razon_social_clientes', '$_id_provincias', '$_id_ciudad', '$_direccion_clientes', '$_telefono_clientes', '$_celular_clientes', '$_email_clientes', '$_id_usuarios', '$_id_entidades'";
				$Clientes->setFuncion($funcion);
		        $Clientes->setParametros($parametros);
		        $resultado=$Clientes->Insert();
				
				
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Clientes";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_razon_social_clientes;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 
		
			}
			$this->redirect("Clientes", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Intereses"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Clientes";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_clientes"]))
			{
				$id_clientes=(int)$_GET["id_clientes"];
				
				
					$Clientes = new ClientesModel();
				
				$Clientes->deleteBy(" id_clientes",$id_clientes);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Clientes";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_clientes;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Clientes", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Clientes"
			
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