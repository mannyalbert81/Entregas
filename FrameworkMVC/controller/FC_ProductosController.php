<?php

class FC_ProductosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{	
			
			$fc_catalogos = new FC_CatalogosModel();
			$fc_foto_productos = new FC_FotoProductosModel();
			$fc_productos = new FC_ProductosModel();
			
			$usuarios = new UsuariosModel();
			$resultEnt = $usuarios->getBy("id_usuarios='$_id_usuarios'");
			$_id_entidades=$resultEnt[0]->id_entidades;
			
			
			
			$fc_grupo_productos = new FC_GrupoProductosModel();
			$columnas = "fc_grupo_productos.id_grupo_productos, 
							  fc_grupo_productos.nombre_grupo_productos, 
							  fc_grupo_productos.descripcion_grupo_productos, 
							  fc_grupo_productos.id_entidades";
			$tablas ="public.fc_grupo_productos, 
  						  public.entidades";
			$where ="entidades.id_entidades = fc_grupo_productos.id_entidades AND fc_grupo_productos.id_entidades='$_id_entidades'";
			$id="fc_grupo_productos.id_grupo_productos";
			$result_FC_grupo_productos=$fc_grupo_productos->getCondiciones($columnas ,$tablas ,$where, $id);
			
			
			
			$fc_unidades_medida = new FC_UnidadesMedidaModel();
			$columnas_med = "fc_unidades_medida.id_unidades_medida, 
							  fc_unidades_medida.nombre_unidades_medida, 
							  fc_unidades_medida.id_entidades";
			$tablas_med ="public.entidades, 
  						public.fc_unidades_medida";
			$where_med ="entidades.id_entidades = fc_unidades_medida.id_entidades AND fc_unidades_medida.id_entidades='$_id_entidades'";
			$id_med="fc_unidades_medida.id_unidades_medida";
			$result_FC_unidades_medida=$fc_unidades_medida->getCondiciones($columnas_med ,$tablas_med ,$where_med, $id_med);
				
			
			
			
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
			
			
		    $permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "FC_Productos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $fc_productos->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol'");
				
			if (!empty($resultPer))
			{
				
				
					$this->facturacion_compras("FC_Productos",array(
							
							"result_FC_grupo_productos"=>$result_FC_grupo_productos, "resultEnt"=>$resultEnt, "result_FC_unidades_medida"=>$result_FC_unidades_medida
					));
			
			}else{
				
				
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Registrar FC Productos"
				
					
				));
				die();
			}
		}
		else
		{
	
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
					   ));
		}
	
	}
	 
	
   public function InsertaFC_Productos(){
   
   	session_start();
   	$permisos_rol=new PermisosRolesModel();
   	$fc_catalogos = new FC_CatalogosModel();
   	$fc_foto_productos = new FC_FotoProductosModel();
   	$fc_grupo_productos = new FC_GrupoProductosModel();
   	$fc_productos = new FC_ProductosModel();
   		
   
   
   	$nombre_controladores = "FC_Productos";
   	$id_rol= $_SESSION['id_rol'];
   	$resultPer = $fc_productos->getPermisosEditar("nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol'");
   
   	if (!empty($resultPer))
   	{
   		$_id_usuarios= $_SESSION['id_usuarios'];
   		
   		if ($_FILES['archivo_foto_productos']['tmp_name']!="")
   		{
   		
   			//para la foto
   			$directorio = $_SERVER['DOCUMENT_ROOT'].'/contabilidad/fotos_productos/';
   			$nombre = $_FILES['archivo_foto_productos']['name'];
   			$tipo = $_FILES['archivo_foto_productos']['type'];
   			$tamano = $_FILES['archivo_foto_productos']['size'];
   		
   			// temporal al directorio definitivo
   			move_uploaded_file($_FILES['archivo_foto_productos']['tmp_name'],$directorio.$nombre);
   			$data = file_get_contents($directorio.$nombre);
   			$archivo_foto_productos= pg_escape_bytea($data);
   			$_descripcion_foto_productos = $_POST["descripcion_foto_productos"];
   		
   		
   			$funcion = "ins_fc_foto_productos";
   			$parametros = " '$archivo_foto_productos' ,'$_descripcion_foto_productos' , '$_id_usuarios'";
   			$fc_foto_productos->setFuncion($funcion);
   			$fc_foto_productos->setParametros($parametros);
   			$resultado=$fc_foto_productos->Insert();
   		
   		}else 
   		{
   			
   			///no hace nada
   		}
   			
   		if ($_FILES['archivo_catalogos']['tmp_name']!="")
   		{
   		
   			//para la foto
   			$directorio1 = $_SERVER['DOCUMENT_ROOT'].'/contabilidad/catalogo_productos/';
   			$nombre1 = $_FILES['archivo_catalogos']['name'];
   			$tipo1 = $_FILES['archivo_catalogos']['type'];
   			$tamano1 = $_FILES['archivo_catalogos']['size'];
   			 
   			// temporal al directorio definitivo
   			move_uploaded_file($_FILES['archivo_catalogos']['tmp_name'],$directorio1.$nombre1);
   			$data = file_get_contents($directorio1.$nombre1);
   			$archivo_catalogos= pg_escape_bytea($data);
   			$_descripcion_catalogos = $_POST["descripcion_catalogos"];
   			 
   			 
   			$funcion = "ins_fc_catalogos";
   			$parametros = " '$archivo_catalogos' ,'$_id_usuarios' , '$_descripcion_catalogos'";
   			$fc_catalogos->setFuncion($funcion);
   			$fc_catalogos->setParametros($parametros);
   			$resultado=$fc_catalogos->Insert();
   		}
   		else 
   		{
   			
   			///no hace nada
   		}
   		
   		
   		
   		
   		if (isset ($_POST["id_entidades"]))
   		{
   			
   			$_id_entidades   		 = $_POST["id_entidades"];
   			$_id_grupo_productos  	 = $_POST["id_grupo_productos"];
   			$_nombre_productos       = $_POST["nombre_productos"];
   			$_descripcion_productos  = $_POST["descripcion_productos"];
   			$_precio_uno_productos    = $_POST["precio_uno_productos"];
   			$_utilidad_uno_productos  = $_POST["utilidad_uno_productos"];
   			$_precio_dos_productos    = $_POST["precio_dos_productos"];
   			$_utilidad_dos            = $_POST["utilidad_dos"];
   			$_precio_tres_productos   = $_POST["precio_tres_productos"];
   			$_utilidad_tres           = $_POST["utilidad_tres"];
   			$_observaciones_productos  = $_POST["observaciones_productos"];
   			$_id_unidades_medida       = $_POST["id_unidades_medida"];
   			$_iva_productos            = $_POST["iva_productos"];
   			
   		
   		}
   		
   		$this->redirect("FC_Productos","index")	;
   	}
   	else
   	{
   		$this->view("Error",array(
   				"resultado"=>"No tiene Permisos de Insertar FC Productos"
   
   		));
   	}
   
   }	
}
?>