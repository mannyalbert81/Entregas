<?php

class ChatController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
	
     	$entidades=new EntidadesModel();
     
     	
		
				
		

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$nombre_controladores = "Chat";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $entidades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
					
				
		
				
				$this->chat("index",array(
						
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Chat en linea"
				
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
	
	
	
	
}
?>