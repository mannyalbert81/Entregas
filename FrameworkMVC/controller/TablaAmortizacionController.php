<?php

class TablaAmortizacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		session_start();
		$resultRes="";
        $clientes = new ClientesModel();
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TablaAmortizacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if(isset($_POST["buscar"]))
				{
				  
					
					$identificacion=$_POST['identificacion'];
						
					
						$columnas = "fc_clientes.id_clientes,
								  fc_clientes.ruc_clientes,
								  fc_clientes.razon_social_clientes,
								  entidades.nombre_entidades";
				
						$tablas=" public.fc_clientes,
  							public.entidades";
				
						$where="entidades.id_entidades = fc_clientes.id_entidades";
				
						$id="fc_clientes.id_clientes";
				
				
						$where_0 = "";
				
				
						if($identificacion!=""){$where_0=" AND fc_clientes.ruc_clientes='$identificacion'";}
				
				
							
						$where_to  = $where . $where_0;
							
						$resultRes = $clientes->getCondiciones($columnas, $tablas, $where_to, $id);
							
							
					
				
				}
		
				
				$this->view("TablaAmortizacion",array(
						"resultRes"=>$resultRes
			
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
				
				if($_nombre_tipo_cierre==""){
					
					
				}
				else{
					
					
				
				
				
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
		
			}
			$this->redirect("TipoCierre", "index");

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