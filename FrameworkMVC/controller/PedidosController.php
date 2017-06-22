<?php

class PedidosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



public function index(){
	
		
		$controladores = new ControladoresModel();
				
		$resultEdit = "";
		$resultSet = "";
		$dsclientes = "";
		$dtclientepedidos = "";
		$dtproductos = "";
		$dtpedidos = "";
		$dtpedidosclientes = "";
		$dttmppedidos = "";
		
		
		session_start();	

	
		if (isset( $_SESSION['usuario_usuarios']) )
		{		
			
			$nombre_controladores = "Pedidos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $controladores->getPermisosVer("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				//die('hola');
				
				//para pruebas
				
				//var_dump($this->Ac_BuscarProducto());
				
				//cuando se busca el cliente
				if(isset($_POST['buscar']))
				{
					
					$cl_pedidos = new PedidosModel();
					
					$identificacion = $_POST['f_clientes'];
					
					if($identificacion!="")
						{
					
							$columnas="c.id_clientes, c.ruc_clientes, c.razon_social_clientes";
							$tablas = "public.fc_clientes c";
							$where =  "c.ruc_clientes like '".$identificacion."%'";
							
							$dsclientes=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "c.id_clientes");
						}
					
				}
				
				//cuando se seleciona el cliente
				if(isset($_GET['id_clientes']))
				{
					$cl_pedidos = new PedidosModel();
					$varclientes =$_GET['id_clientes']; 
					
					if($varclientes!="")
					{
							
						$columnas="c.id_clientes, c.ruc_clientes, c.razon_social_clientes, c.email_clientes";
						$tablas = "public.fc_clientes c";
						$where =  "c.id_clientes = '".$varclientes."'";
							
						$dtclientepedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "c.id_clientes");
					}
				}
				
				//cuando se busca producto
				if(isset($_POST['buscarproducto']))
				{
					$cl_pedidos = new PedidosModel();
					$varproductos =$_POST['f_productos'];
						
					if($varproductos!="")
					{
							
						$columnas="p.id_productos, p.nombre_productos, p.descripcion_productos";
						$tablas = "public.fc_productos p";
						$where =  " p.nombre_productos like '".$varproductos."%'";
							
						$dtproductos=$cl_pedidos->getCondicionesPag($columnas, $tablas, $where, "p.id_productos"," limit 5");
					}
					
					$varclientes =$_POST['hd_idclientes'];
						
					if($varclientes!="")
					{
							
						$columnas="c.id_clientes, c.ruc_clientes, c.razon_social_clientes, c.email_clientes";
						$tablas = "public.fc_clientes c";
						$where =  "c.id_clientes = '".$varclientes."'";
							
						$dtclientepedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "c.id_clientes");
					}
					
				}
				
				//cuando se seleciona el producto
				if(isset($_GET['id_producto']))
				{
					$cl_pedidos = new PedidosModel();
					$varclientes =$_GET['clienteid'];
						
					if($varclientes!="")
					{
							
						$columnas="c.id_clientes, c.ruc_clientes, c.razon_social_clientes, c.email_clientes";
						$tablas = "public.fc_clientes c";
						$where =  "c.id_clientes = '".$varclientes."'";
							
						$dtclientepedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "c.id_clientes");
					}
					
					$varproductos =$_GET['id_producto'];
					
					if($varproductos!="")
					{
							
						$columnas="p.id_productos, p.nombre_productos, p.descripcion_productos";
						$tablas = "public.fc_productos p";
						$where =  " p.id_productos = '".$varproductos."'";
							
						$dtpedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "p.id_productos");
					}
				}
				
				//para agregar pedidos temporales
				if(isset($_POST['agregar']))
				{
					$cl_pedidos = new PedidosModel();
					$varclientes =$_POST['hd_idclientes'];
					
					if($varclientes!="")
					{
							
						$columnas="c.id_clientes, c.ruc_clientes, c.razon_social_clientes, c.email_clientes";
						$tablas = "public.fc_clientes c";
						$where =  "c.id_clientes = '".$varclientes."'";
							
						$dtclientepedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "c.id_clientes");
					}
						
					$varproductos =$_POST['hd_productoid'];
						
					if($varproductos!="")
					{
							
						$columnas="p.id_productos, p.nombre_productos, p.descripcion_productos";
						$tablas = "public.fc_productos p";
						$where =  " p.id_productos = '".$varproductos."'";
							
						$dtpedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "p.id_productos");
						
						
					}
					
					if(!empty($dtpedidos))
					{

						foreach ($dtpedidos as $res){
						
							$dttmppedidos[] = array(
									'codigo' => $res->id_productos,
									'valor' => $res->nombre_productos,
									'alias' => $res->descripcion_productos
							);
						
						}
						
					}
					
					
				}
				
				//para realizar los pedidos insertado
				if(isset($_POST['hacerpedido']))
				{
					$varin_clientes= $_POST['hd_idclientes'];
					$varin_productos= $_POST['hd_idproductos'];
					$varin_cantidad= $_POST['txt_cantidad'];
					
					$this->InsertaPedidos($varin_clientes, $varin_productos, $varin_cantidad);
				}
				
				// para editar los componentes
				$resultPer = $controladores->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo de Controladores"
					
						));
					
					}
					
				
				$this->view("Pedidos",array(
						"dsclientes"=>$dsclientes,"dtclientepedidos"=>$dtclientepedidos,"dtproductos"=>$dtproductos,
						"dtpedidosclientes"=>$dtpedidosclientes,"dtpedidos"=>$dtpedidos,"dttmppedidos"=>$dttmppedidos
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipo de Controladores"
				
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
	

			
public function InsertaPedidos($in_clientes,$in_productos,$in_cantidad)
	{
		
		//_id_clientes integer, _id_productos integer, _fcha_pedidos date, _cantidad_pedidos integer, _medida_pedidos character varying
		
		//variable de fecha
		$varfechapedido  = date('Y-m-d G:i:s');
         
		
		$funcion = "ins_pedidos";
						
		$parametros = " '$in_clientes','$in_productos','$varfechapedido','$in_cantidad' ";
							
		$controladores->setFuncion($funcion);
						
		$controladores->setParametros($parametros);
						
		$resultado=$controladores->Insert();
						
		$traza=new TrazasModel();
		$_nombre_controlador = "Pedidos";
		$_accion_trazas  = "Guardar";
		$_parametros_trazas = $_nombre_controladores;
		$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					
	}
				
				
				
				
				
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Controladores";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_controladores"]))
			{
				$id_controladores=(int)$_GET["id_controladores"];
				
				
				$controladores = new ControladoresModel();
				
				$controladores->deleteBy("id_controladores",$id_controladores);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Controladores";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_controladores;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Controladores", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipo de Controladores"
			
			));
		}
				
	}
	
	
	
	
	
	public function Ac_BuscarProducto()
	{
	
		$c_pedidos = new PedidosModel();
		$varproductos = $_GET['term'];
		
				 
		$columnas="p.id_productos, p.nombre_productos, p.descripcion_productos";
		$tablas = "public.fc_productos p";
		$where =  " p.nombre_productos like '".$varproductos."%'";
		//$where =  " 1=1";
			
		$dtpedidos=$c_pedidos->getCondiciones($columnas, $tablas, $where, "p.id_productos");;
	
	
		if(!empty($dtpedidos)){
	
			foreach ($dtpedidos as $res){
				
				$jq_dtpedidos[] = array(
						'id' => $res->id_productos,
						'value' => $res->nombre_productos,
						'descp' => $res->descripcion_productos
				);
	
			}
			echo json_encode($jq_dtpedidos);
			
		}
	
	}
	
	
}
?>