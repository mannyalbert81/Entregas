<?php

class ClientesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		$usuarios = new UsuariosModel();
		$resultEnt = $usuarios->getBy("id_usuarios ='$_id_usuarios'");
		$_id_entidades=$resultEnt[0]->id_entidades;
		
	    $tipo_intereses=new TipoInteresesModel();
		$resultInt = $tipo_intereses->getAll("nombre_tipo_intereses");
		
        	
		$Intereses = new InteresesModel();
	    $columnas = "intereses.id_intereses, 
						  entidades.nombre_entidades, 
						  tipo_intereses.nombre_tipo_intereses, 
						  intereses.valor_intereses, 
						  intereses.creado, 
						  intereses.modificado";
		$tablas   = "public.intereses, 
					 public.entidades, 
					 public.tipo_intereses";
		$where    = "entidades.id_entidades = intereses.id_entidades AND tipo_intereses.id_tipo_intereses = intereses.id_tipo_intereses AND intereses.id_entidades='$_id_entidades'";
		$id       = "id_intereses";
		$resultSet = $Intereses->getCondiciones($columnas ,$tablas ,$where, $id);
			
		
				
		$resultEdit = "";

		$entidades = new EntidadesModel();
		$columnas_enc = "entidades.id_entidades,
  							entidades.nombre_entidades,
				usuarios.id_usuarios,
				usuarios.nombre_usuarios";
		$tablas_enc ="public.usuarios,
						  public.entidades";
		$where_enc ="entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		$id_enc="entidades.nombre_entidades";
		$resultEnt=$entidades->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $Intereses->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_intereses"])   )
				{
					
					$nombre_controladores = "Clientes";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $Intereses->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_intereses = $_GET["id_intereses"];
						
						$columnas = "     intereses.id_intereses, 
										  entidades.nombre_entidades, 
										  tipo_intereses.nombre_tipo_intereses, 
										  intereses.valor_intereses, 
										  intereses.creado, 
										  intereses.modificado";
						$tablas   = "public.intereses, 
									  public.entidades, 
									  public.tipo_intereses";
						$where    = " entidades.id_entidades = intereses.id_entidades AND tipo_intereses.id_tipo_intereses = intereses.id_tipo_intereses AND intereses.id_entidades='$_id_intereses'"; 
						$id       = "id_intereses";
						$resultEdit = $Intereses->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Clientes";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_intereses;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Intereses"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->cartera("Clientes",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEnt"=>$resultEnt, "resultInt" =>$resultInt
			
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
				$_id_usuario = $_POST["id_usuario"];
				$_id_entidades = $_POST["id_entidades"];				
						
				$funcion = "ins_fc_clientes";
				$parametros = " '$_ruc_clientes', '$_razon_social_clientes', '$_id_provincias', '$_id_ciudad', '$_direccion_clientes', '$_telefono_clientes', '$_celular_clientes', '$_email_clientes', '$_id_usuario', '$_id_entidades'";
				$Clientes->setFuncion($funcion);
		        $Clientes->setParametros($parametros);
		        $resultado=$Clientes->Insert();
				
				
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Clientes";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_valor_intereses;
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
			if(isset($_GET["id_intereses"]))
			{
				$id_intereses=(int)$_GET["id_intereses"];
				
				
				$Intereses = new InteresesModel();
				
				$Intereses->deleteBy(" id_intereses",$id_intereses);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Clientes";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_intereses;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Clientes", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Intereses"
			
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