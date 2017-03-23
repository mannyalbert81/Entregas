<?php

class FC_ImpuestosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
		session_start();
		
		$impuestos = new FC_ImpuestosModel();
	    $_id_usuarios= $_SESSION['id_usuarios'];
		
		$usuarios = new UsuariosModel();
		$resultEnt = $usuarios->getBy("id_usuarios='$_id_usuarios'");
		$_id_entidades=$resultEnt[0]->id_entidades;
		
		$columnas="fc_impuestos.id_impuestos, 
				  fc_impuestos.nombre_impuestos, 
				  fc_impuestos.valor_impuestos, 
				  fc_impuestos.id_entidades, 
				  fc_impuestos.id_usuarios";
		$tablas="public.fc_impuestos, 
				 public.entidades";
		$where="fc_impuestos.id_entidades = entidades.id_entidades AND
  				 fc_impuestos.id_entidades='$_id_entidades' AND fc_impuestos.id_usuarios='$_id_usuarios'";
		$id="fc_impuestos.id_impuestos";
		$resultSet=$impuestos->getCondiciones($columnas, $tablas, $where, $id);
				
		
		$resultEdit = "";

		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$nombre_controladores = "FC_Impuestos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $impuestos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_impuestos"])   )
				{
					
					$nombre_controladores = "FC_Impuestos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $impuestos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_impuestos = $_GET["id_impuestos"];
						
						$columnas_edit = " fc_impuestos.id_impuestos, 
						  fc_impuestos.nombre_impuestos, 
						  fc_impuestos.valor_impuestos, 
						  fc_impuestos.id_entidades, 
						  fc_impuestos.id_usuarios";
						$tablas_edit   = "public.fc_impuestos, 
									  public.entidades";
						$where_edit    = "fc_impuestos.id_entidades = entidades.id_entidades AND
                                    id_impuestos = '$_id_impuestos' "; 
						$id_edit      = "fc_impuestos.id_impuestos";
							
						
						$resultEdit = $impuestos->getCondiciones($columnas_edit ,$tablas_edit ,$where_edit, $id_edit);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "FC_Impuestos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_impuestos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Impuestos"
					
						));
					
					
					}
					
				}
				
				
		
				
				$this->facturacion_compras("FC_Impuestos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Impuestos"
				
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
	
	public function InsertaImpuestos(){
			
		session_start();
		
		
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		
		$usuarios = new UsuariosModel();
		$resultEnt = $usuarios->getBy("id_usuarios='$_id_usuarios'");
		$_id_entidades=$resultEnt[0]->id_entidades;

		$permisos_rol=new PermisosRolesModel();

		$impuestos=new FC_ImpuestosModel();


		$nombre_controladores = "FC_Impuestos";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
        $resultPer = $impuestos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		     $resultado = null;
			
			if (isset ($_POST["nombre_impuestos"]) )
				
			{
				$_nombre_impuestos = $_POST["nombre_impuestos"];
				$_valor_impuestos = $_POST["valor_impuestos"];
				
				
				if(isset($_POST["id_impuestos"])) 
				{
					
					$_id_impuestos = $_POST["id_impuestos"];
					
					$colval = " nombre_impuestos = '$_nombre_impuestos'   ";
					$colval = " valor_impuestos = '$_valor_impuestos'   ";
					$tabla = "fc_impuestos";
					$where = "id_impuestos = '$_id_impuestos'    ";
					
					$resultado=$impuestos->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_fc_impuestos";
				$parametros = " '$_nombre_impuestos', '$_valor_impuestos', '$_id_entidades', '$_id_usuarios'";
				$impuestos->setFuncion($funcion);
		        $impuestos->setParametros($parametros);
		        $resultado=$impuestos->Insert();
				
			    
		        $traza=new TrazasModel();
				$_nombre_controlador = "FC_Impuestos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_controladores;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("FC_Impuestos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Impuestos"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "FC_Impuestos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_impuestos"]))
			{
				$id_impuestos=(int)$_GET["id_impuestos"];
				
				$impuestos=new FC_ImpuestosModel();
				
				$impuestos->deleteBy("id_impuestos",$id_impuestos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "FC_Impuestos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_impuestos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("FC_Impuestos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Impuestos"
			
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