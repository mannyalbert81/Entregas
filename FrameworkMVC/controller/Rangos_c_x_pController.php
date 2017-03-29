<?php

class Rangos_c_x_pController extends ControladorBase{

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
		
		
		$Rangos = new Rangos_c_x_pModel();
	    $columnas = "   rangos_c_x_p.id_rangos_c_x_p,
  										entidades.nombre_entidades,
  										rangos_c_x_p.nombre_rangos_c_x_p,
  										rangos_c_x_p.valor_min_c_x_p,
 										rangos_c_x_p.valor_max_c_x_p,
  										rangos_c_x_p.creado,
  										rangos_c_x_p.modificado";
		$tablas   = "public.entidades,
  									public.rangos_c_x_p";
		$where    = " entidades.id_entidades = rangos_c_x_p.id_entidades AND entidades.id_entidades='$_id_entidades'";
		$id       = "id_rangos_c_x_p";
		$resultSet = $Rangos->getCondiciones($columnas ,$tablas ,$where, $id);
			
		
				
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
			
			
			$nombre_controladores = "Rangos_c_x_p";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $Rangos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_rangos_c_x_p"])   )
				{
					
					$nombre_controladores = "Rangos_c_x_p";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $Rangos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_rangos_c_x_p = $_GET["id_rangos_c_x_p"];
						
						$columnas = "   rangos_c_x_p.id_rangos_c_x_p, 
								        entidades.id_entidades,
  										entidades.nombre_entidades, 
  										rangos_c_x_p.nombre_rangos_c_x_p, 
  										rangos_c_x_p.valor_min_c_x_p, 
 										rangos_c_x_p.valor_max_c_x_p, 
  										rangos_c_x_p.creado, 
  										rangos_c_x_p.modificado";
						$tablas   = "public.entidades, 
  									public.rangos_c_x_p";
						$where    = " entidades.id_entidades = rangos_c_x_p.id_entidades AND rangos_c_x_p.id_rangos_c_x_p = '$_id_rangos_c_x_p'"; 
						$id       = "id_rangos_c_x_p";
						
						
						$resultEdit = $Rangos->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Rangos_c_x_p";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_rangos_c_x_p;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Rangos_c_x_p"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->cartera("Rangos_c_x_p",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEnt"=>$resultEnt
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Rangos_c_x_p"
				
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
	
	public function InsertaRango_c_x_p(){
			
		session_start();
		
		$Rangos = new Rangos_c_x_pModel();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Rangos_c_x_p";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
			if (isset ($_POST["nombre_rangos_c_x_p"]) )
				
			{
				
				$_id_entidades = $_POST["id_entidades"];
				$_nombre_rangos_c_x_p = $_POST["nombre_rangos_c_x_p"];
				$_valor_min_c_x_p = $_POST["valor_min_c_x_p"];
				$_valor_max_c_x_p = $_POST["valor_max_c_x_p"];
				
				
						
				$funcion = "ins_rangos_c_x_p";
				$parametros = " '$_id_entidades', '$_nombre_rangos_c_x_p', '$_valor_min_c_x_p', '$_valor_max_c_x_p' ";
				$Rangos->setFuncion($funcion);
		        $Rangos->setParametros($parametros);
		        $resultado=$Rangos->Insert();
				
				
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Rangos_c_x_p";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_rangos_c_x_p;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 
		
			}
			$this->redirect("Rangos_c_x_p", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Rangos_c_x_p"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Rangos_c_x_p";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_rangos_c_x_p"]))
			{
				$id_rangos_c_x_p=(int)$_GET["id_rangos_c_x_p"];
				
				
				$Rangos = new Rangos_c_x_pModel();
				
				$Rangos->deleteBy(" id_rangos_c_x_p",$id_rangos_c_x_p);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Rangos_c_x_p";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_rangos_c_x_p;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Rangos_c_x_p", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Rangos_c_x_p"
			
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