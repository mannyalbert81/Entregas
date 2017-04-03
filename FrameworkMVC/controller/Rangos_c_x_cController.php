<?php

class Rangos_c_x_cController extends ControladorBase{

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
		
		
		$Rangos = new Rangos_c_x_cModel();
	    $columnas = "   rangos_c_x_c.id_rangos_c_x_c,
  										entidades.nombre_entidades,
  										rangos_c_x_c.nombre_rangos_c_x_c,
  										rangos_c_x_c.valor_min_c_x_c,
 										rangos_c_x_c.valor_max_c_x_c,
  										rangos_c_x_c.creado,
  										rangos_c_x_c.modificado";
		$tablas   = "public.entidades,
  									public.rangos_c_x_c";
		$where    = " entidades.id_entidades = rangos_c_x_c.id_entidades AND entidades.id_entidades='$_id_entidades'";
		$id       = "id_rangos_c_x_c";
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
			
			
			$nombre_controladores = "Rangos_c_x_c";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $Rangos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_rangos_c_x_c"])   )
				{
					
					$nombre_controladores = "Rangos_c_x_c";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $Rangos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_rangos_c_x_c = $_GET["id_rangos_c_x_c"];
						
						$columnas = "   rangos_c_x_c.id_rangos_c_x_c, 
								        entidades.id_entidades,
  										entidades.nombre_entidades, 
  										rangos_c_x_c.nombre_rangos_c_x_c, 
  										rangos_c_x_c.valor_min_c_x_c, 
 										rangos_c_x_c.valor_max_c_x_c, 
  										rangos_c_x_c.creado, 
  										rangos_c_x_c.modificado";
						$tablas   = "public.entidades, 
  									public.rangos_c_x_c";
						$where    = " entidades.id_entidades = rangos_c_x_c.id_entidades AND rangos_c_x_c.id_rangos_c_x_c = '$_id_rangos_c_x_c'"; 
						$id       = "id_rangos_c_x_c";
						
						
						$resultEdit = $Rangos->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Rangos_c_x_c";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_rangos_c_x_c;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Rangos_c_x_c"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->cartera("Rangos_c_x_c",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEnt"=>$resultEnt
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Rangos_c_x_c"
				
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
	
	public function InsertaRango_c_x_c(){
			
		session_start();
		
		$Rangos = new Rangos_c_x_cModel();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Rangos_c_x_c";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
			if (isset ($_POST["nombre_rangos_c_x_c"]) )
				
			{
				
				$_id_entidades = $_POST["id_entidades"];
				$_nombre_rangos_c_x_c = $_POST["nombre_rangos_c_x_c"];
				$_valor_min_c_x_c = $_POST["valor_min_c_x_c"];
				$_valor_max_c_x_c = $_POST["valor_max_c_x_c"];
				
				
						
				$funcion = "ins_rangos_c_x_c";
				$parametros = " '$_id_entidades', '$_nombre_rangos_c_x_c', '$_valor_min_c_x_c', '$_valor_max_c_x_c' ";
				$Rangos->setFuncion($funcion);
		        $Rangos->setParametros($parametros);
		        $resultado=$Rangos->Insert();
				
				
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Rangos_c_x_c";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_rangos_c_x_c;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 
		
			}
			$this->redirect("Rangos_c_x_c", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Identificacion"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Rangos_c_x_c";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_rangos_c_x_c"]))
			{
				$id_rangos_c_x_c=(int)$_GET["id_rangos_c_x_c"];
				
				
				$Rangos = new Rangos_c_x_cModel();
				
				$Rangos->deleteBy(" id_rangos_c_x_c",$id_rangos_c_x_c);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Rangos_c_x_c";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_rangos_c_x_c;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Rangos_c_x_c", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Identificacion"
			
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