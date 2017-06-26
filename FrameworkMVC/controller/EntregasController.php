<?php

class EntregasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
				
		
		session_start();
		$resultSet="";
		$resultDatos="";
		$datos=array();
		$usuarios=new UsuariosModel();
		$entregas=new EntregasModel();
		
		$columnas = "usuarios.id_usuarios, 
  					usuarios.nombre_usuarios";
		$tablas   = "public.entregas_cabezas, 
 					 public.usuarios";
		$where    = "usuarios.id_usuarios = entregas_cabezas.id_usuarios group by usuarios.id_usuarios, usuarios.nombre_usuarios";
		$id       = "usuarios.id_usuarios";
		$resultUsu = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
		
		
		$columnas = " entregas_cabezas.id_entregas_cabezas,
						  entregas_cabezas.latitud_entregas_cabezas,
						  entregas_cabezas.longitud_entregas_cabezas,
						  usuarios.id_usuarios,
						  usuarios.nombre_usuarios,
						  entregas_cabezas.creado";
		
		$tablas   = "public.entregas_cabezas,
 						 public.usuarios";
		
		$where    = "usuarios.id_usuarios = entregas_cabezas.id_usuarios";
		
		$id       = "entregas_cabezas.id_entregas_cabezas";
		$resultDatos=$entregas->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
		if(isset($_POST["buscar"])){
				
			
			
			$criterio = $_POST["criterio_busqueda"];
			$contenido = $_POST["contenido_busqueda"];
				
			$columnas = " entregas_cabezas.id_entregas_cabezas, 
						  entregas_cabezas.latitud_entregas_cabezas, 
						  entregas_cabezas.longitud_entregas_cabezas, 
						  usuarios.id_usuarios, 
						  usuarios.nombre_usuarios, 
						  entregas_cabezas.creado";
				
			$tablas   = "public.entregas_cabezas, 
 						 public.usuarios";
				
			$where    = "usuarios.id_usuarios = entregas_cabezas.id_usuarios";
				
			$id       = "entregas_cabezas.id_entregas_cabezas";
				
				
			if ($contenido !="")
			{
			
				$where_0 = "";
				$where_1 = "";
				$where_2 = "";
				
			
				switch ($criterio) {
					case 0:
						$where_0 = " ";
						break;
					case 1:
						//Ruc Cliente/Proveedor
						$where_1 = " AND  usuarios.nombre_usuarios LIKE '$contenido'  ";
						break;
					case 2:
						//Nombre Cliente/Proveedor
						$where_2 = " AND DATE(entregas_cabezas.creado) = '$contenido'  ";
						break;
					
				}
			
			
			
				$where_to  = $where .  $where_0 . $where_1 . $where_2;
				$resultDatos=$entregas->getCondiciones($columnas ,$tablas ,$where_to, $id);
			
			
			}
			
			
			
			
				
		//print_r($resultDatos);
				
		}
				
				$this->view("Bienvenida",array(
						"resultSet"=>$resultSet, "resultUsu"=>$resultUsu, "resultDatos"=>$resultDatos
			
				));
		
				
				
			
				
		
	
	}
	
	
	
}
?>