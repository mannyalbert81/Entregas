<?php

class ReportesAsignadosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		
		
		//Creamos el objeto usuario
     	$reportes_asignados=new ReportesAsignadosModel();
		//Conseguimos todos los usuarios
		$resultSet=$reportes_asignados->getAll("id_reportes_asignados");
				
		$resultEdit = "";
		
	
			
		
		
		session_start();
		
	
			
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//Notificaciones
			
			$entidades = new EntidadesModel();
			$resultEntidad = $entidades->getAll("nombre_entidades");
				
			$usuarios = new UsuariosModel();
			$resultUsu = $usuarios->getAll("nombre_usuarios");

	
			$nombre_controladores = "ReportesAsignados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $reportes_asignados->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
	
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_reportes_asignados"])   )
				{

					
					$nombre_controladores = "ReportesAsignados";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $reportes_asignados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
			
					if (!empty($resultPer))
					{
					
		
						
						$_id_entidades = $_GET["id_reportes_asignados"];
						$columnas = "   reportes_asignados.nombre_reportes_asignados, 
										  reportes_asignados.id_reportes_asignados, 
										  entidades.nombre_entidades, 
										  usuarios.nombre_usuarios";
						$tablas   = "  public.reportes_asignados, 
										  public.usuarios, 
										  public.entidades";
						$where    = "  reportes_asignados.id_usuarios = usuarios.id_usuarios AND
  									entidades.id_entidades = reportes_asignados.id_entidades; = '$_id_reportes_asignados' "; 
						$id       = "reportes_asignados.nombre_reportes_asignados";
							
						$resultEdit = $reportes_asignados->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "ReportesAsignados";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_reportes_asignados;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Reportes Asignados"
					
						));
					
					
					}
					
				}
		
				
				$this->view("ReportesAsignados",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEntidad"=>$resultEntidad, "resultUsu"=>$resultUsu
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Reportes Asignados"
				
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
	
	public function InsertaReportesAsignados(){
			
		session_start();
		$reportes_asignados=new ReportesAsignadosModel();
		

		$nombre_controladores = "ReportesAsignados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $reportes_asignados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$reportes_asignados=new ReportesAsignadosModel();
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["id_reportes_asignados"])   )
				
			{
				
				$_id_reportes_asignados = $_POST["id_reportes_asignados"];
				$_nombre_reportes_asignados = $_POST["nombre_reportes_asignados"];
				$_id_entidades = $_POST["nombre_entidades"];
				$_id_usuarios = $_POST["nombre_usuarios"];
				
			$funcion = "ins_reportes_asignados";
									
				$reportes_asignados->setFuncion($funcion);
		
				$reportes_asignados->setParametros($parametros);
				
						
				$resultado=$reportes_asignados->Insert();
				
		
				//$this->view("Error",array(
				//"resultado"=>"entro"
				//));
				
				$traza=new TrazasModel();
				$_nombre_controlador = "ReportesAsignados";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_reportes_asignados;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			$this->redirect("ReportesAsignados", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Reportes Asignados"
		
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
			if(isset($_GET["id_reportes_asignados"]))
			{
				$id_reportes_asignados=(int)$_GET["id_reportes_asignados"];
		
				$reportes_asignados=new EntidadesModel();
				
				$reportes_asignados->deleteBy(" id_reportes_asignados",$id_entidades);
				
				
				$traza=new TrazasModel();
				$_nombre_controlador = "ReportesAsignados";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_reportes_asignados;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				
			}
			
			$this->redirect("ReportesAsignados", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Reportes Asignados"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$entidades=new EntidadesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_reportes_asignados, nombre_reportes_asignados", " nombre_reportes_asignados != '' ");
			$this->report("ReportesAsignados",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
			
	//public function Imagen_php(){
		//echo '<div>';
		//echo '<input type="image" name="image" src="./view/DevuelveImagen.php?id_valor=3&id_nombre=id_entidades&tabla=entidades&campo=logo_entidades"  alt="13" width="80" height="60" >';
		//echo '</div>';
	//}
	
	
	
}
?>