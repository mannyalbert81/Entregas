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
		$respuesta = 0;
		
		
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
					$cl_temp_pedidos = new PedidosModel("temp_pedidos"); 
					$varclientes =$_POST['hd_idclientes'];
					
					if($varclientes!="")
					{
							
						$columnas="c.id_clientes, c.ruc_clientes, c.razon_social_clientes, c.email_clientes";
						$tablas = "public.fc_clientes c";
						$where =  "c.id_clientes = '".$varclientes."'";
							
						$dtclientepedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "c.id_clientes");
					}
						
					$varproductos =$_POST['hd_productoid'];
					$varDescripcion = $_POST['txt_descripcion'];
					$varnombre = $_POST['f_productos_au'];
					$varCantidad = $_POST['txt_cantidad'];
					$_id_usuarios= $_SESSION['id_usuarios'];
					
						
					if($varproductos!="")
					{
							
						$columnas="p.id_productos, p.nombre_productos, p.descripcion_productos";
						$tablas = "public.fc_productos p";
						$where =  " p.id_productos = '".$varproductos."'";
							
						$dtpedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "p.id_productos");
						
						
					}
					
					
					$funcion = "ins_temp_pedidos";
					$parametros = "'$_id_usuarios','$varproductos','$varDescripcion','$varCantidad','$varnombre','$varclientes'";
					//die($parametros);
					$cl_temp_pedidos->setFuncion($funcion);
					$cl_temp_pedidos->setParametros($parametros);
					$resultado=$cl_temp_pedidos->Insert();
					
					$dttmppedidos=$this->consultemporal($_id_usuarios, $varclientes);
					
					
				}
				
				//para realizar los pedidos insertado
				if(isset($_POST['hacerpedido']))
				{
					$varin_clientes= $_POST['hd_idclientes'];
					$_id_usuarios= $_SESSION['id_usuarios'];
					
					$respuesta=$this->insertaPedidos($_id_usuarios,$varin_clientes);
					
				}
				
				//para eliminacion temporal
				
				if(isset($_GET['acc']))
				{
					$cl_temporal = new TempPedidosModel();
					$var_idtemporal = $_GET['id_tproducto'];
					$_id_usuarios= $_SESSION['id_usuarios'];
					
					$cl_pedidos = new PedidosModel();
					$cl_temp_pedidos = new PedidosModel("temp_pedidos");
					$varclientes =$_GET['clienteid'];
						
					if($varclientes!="")
					{
							
						$columnas="c.id_clientes, c.ruc_clientes, c.razon_social_clientes, c.email_clientes";
						$tablas = "public.fc_clientes c";
						$where =  "c.id_clientes = '".$varclientes."'";
							
						$dtclientepedidos=$cl_pedidos->getCondiciones($columnas, $tablas, $where, "c.id_clientes");
					}
					
					
					
					$where = "id_usuario_registra = '$_id_usuarios' AND id_temp_pedidos = '$var_idtemporal'";
				
					
					$dttmppedidos=$this->consultemporal($_id_usuarios, $varclientes);
					
					
					try {
						
						$rs_deltemp = $cl_temporal->deleteByWhere($where);
						$respuesta = 3;
						
					}catch (Exception $ex)
					{
						$respuesta=5;
					}
					
				}
				
				//para realizar cancelacion pedido
				if(isset($_POST['cancelarpedido']))
				{
					$cl_temporal = new TempPedidosModel();
					$var_clientes= $_POST['hd_idclientes'];
					$_id_usuarios= $_SESSION['id_usuarios'];
					
					$where = "id_usuario_registra = '$_id_usuarios' AND id_clientes = '$var_clientes'";
					
					try {
					
						$rs_deltemp = $cl_temporal->deleteByWhere($where);
						$respuesta = 2;
					
					}catch (Exception $ex)
					{
						$respuesta=5;
					}
					
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
						"dtpedidosclientes"=>$dtpedidosclientes,"dtpedidos"=>$dtpedidos,"dttmppedidos"=>$dttmppedidos,"respuesta"=>$respuesta
			
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
	
	public function consultemporal($in_usuario,$in_idclientes)
	{
		$cl_temp_pedidos = new PedidosModel("temp_pedidos");
		
		$columnas="t.id_temp_pedidos,t.id_usuario_registra,t.id_producto,t.descripcion,t.cantidad,t.nombre_producto,t.id_clientes";
		$tablas = "public.temp_pedidos t";
		$where = " t.id_usuario_registra='".$in_usuario."' AND t.id_clientes ='".$in_idclientes."'";
		
		$dttemppedidos=$cl_temp_pedidos->getCondiciones($columnas, $tablas, $where, "t.id_producto");
		
		return $dttemppedidos;
		
	}
	
	public function insertaPedidos($in_idusuario,$in_idclientes)
	{
		
		$respuesta = 0;
		$cl_secuencia = new SecuenciaModel();
		$cl_temp_pedidos = new TempPedidosModel();
		$cl_pedidos_cab = new CabPedidosModel();
		$cl_pedidos_det = new DetPedidosModel();
		
		$columnas="t.id_temp_pedidos,t.id_usuario_registra,t.id_producto,t.descripcion,t.cantidad,t.nombre_producto,t.id_clientes";
		$tablas = "public.temp_pedidos t";
		$where = " t.id_usuario_registra='".$in_idusuario."' AND t.id_clientes ='".$in_idclientes."'";
		
		$dttemppedidos=$cl_temp_pedidos->getCondiciones($columnas, $tablas, $where, "t.id_producto");
		
		$dtsecuencia = $cl_secuencia->getBy("nombre_secuencia LIKE '%PEDIDOS%'");
		$varidsecuencia=$dtsecuencia[0]->id_secuencia;
		$varvalorsecuencia = $dtsecuencia[0]->valor_secuencia;
		
		$id=$dttemppedidos[0]->id_temp_pedidos;
		
		//insertamos LA cabecera pedido
		try
		{
			$varfechapedido  = date('Y-m-d G:i:s');
			$numeracion = str_pad($varvalorsecuencia, 5, "0", STR_PAD_LEFT);
			$varnumeracionpedido = "PDDO".$numeracion;			
			$funcion = "ins_pedidos_cab";
			//_numero_pedidos_cab character varying, _id_clientes integer,_id_usuarios integer ,_fcha_pedidos_cab timestamp
			$parametros = "'$varnumeracionpedido','$in_idclientes', '$in_idusuario','$varfechapedido'";
			$cl_pedidos_cab->setFuncion($funcion);
			$cl_pedidos_cab->setParametros($parametros);
			
			$resultado=$cl_pedidos_cab->Insert();
				
			$rsSecuencia=$cl_secuencia->UpdateBy("valor_secuencia=valor_secuencia+1", "secuencia", "id_secuencia='$varidsecuencia'");
			
			///insertamos el detalle
			foreach($dttemppedidos as $res)
			{
				//PRINT (count($dttemppedidos));
				//busco si existe este nuevo id
				try
				{
					$var_numeropedidoscab = $varnumeracionpedido;
					$var_idproductos = $res->id_producto;
					$var_nombreproducto = $res->nombre_producto;
					$var_cantidad = $res->cantidad;
					
					$columnas="pc.id_pedidos_cab";
					$tablas = "public.rc_pedidos_cab pc";
					$where = " numero_pedidos_cab ='$var_numeropedidoscab'";
					
					$dt_pedidos_cab=$cl_pedidos_cab->getCondiciones($columnas, $tablas, $where, "pc.id_pedidos_cab");
					
					$_id_pedidos_cab=$dt_pedidos_cab[0]->id_pedidos_cab;
					
					$funcion_det = "ins_pedidos_det";
					//_numero_pedidos_cab character varying, _id_pedidos_cab integer, _id_productos integer, _cantidad_pedidos_det integer)
					$parametros_det = "'$var_numeropedidoscab','$_id_pedidos_cab','$var_idproductos', '$var_cantidad'";
					$cl_pedidos_det->setFuncion($funcion_det);
					$cl_pedidos_det->setParametros($parametros_det);
					$resultado=$cl_pedidos_det->Insert();
					
				} catch (Exception $e)
				{
					$where_del = "numero_pedidos_cab= '$var_numeropedidoscab'";
					$cl_pedidos_cab->deleteByWhere($where_del);
					
					$respuesta =0;
					
						exit();
				}
					
			}
			
			//vaciado de la tabla temporal
			///LAS TRAZAS
			/*$traza=new TrazasModel();
			$_nombre_controlador = "Comprobantes";
			$_accion_trazas  = "Guardar";
			$_parametros_trazas = $_id_plan_cuentas;
			$resulta = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			*/
			
				
			///borro pedidos
			$varborrado_idusuario =  $dttemppedidos[0]->id_usuario_registra;
			$varborrado_idcliente =  $dttemppedidos[0]->id_clientes;
			$where_del = "id_usuario_registra= '$varborrado_idusuario' AND  id_clientes = '$varborrado_idcliente'";
			$cl_temp_pedidos->deleteByWhere($where_del);
			
			$respuesta=1;
			
		} catch (Exception $e)
		{
			
		  $this->view("Error",array(
					"resultado"=>"Eror al Insertar Comprobantes ->". $id
					));
		  $respuesta =0;
					exit();
		}
		
		return $respuesta;
		 
	}
	
public function  ListarPedidos()
{
	  $cl_pedidos = new PedidosModel();
				
		
		$respuesta = 0;
		
		
		session_start();	

	
		if (isset( $_SESSION['usuario_usuarios']) )
		{		
			
			$nombre_controladores = "Pedidos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $cl_pedidos->getPermisosVer("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				$this->view("ListadoPedidos",array(
						"respuesta"=>$respuesta
			
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
	
	public function  traePedidos()
	{
		$cl_pedidos = new PedidosModel();
	
	
		//variable que se dibuja en tabla de consulta
	
		$html = "";
	
		session_start();
	
	
		if (isset( $_SESSION['usuario_usuarios']) )
		{
	
			$nombre_controladores = "Pedidos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $cl_pedidos->getPermisosVer("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
	
	
				if(isset($_POST["buscar"]))
				{
					$id_usuario=$_POST['id_usuario'];
	
					$columnas = " pc.id_pedidos_cab,pc.numero_pedidos_cab,c.ruc_clientes,c.razon_social_clientes,
				                  u.nombre_usuarios,date(pc.fcha_pedidos_cab) AS fecha,pc.estado_pedidos_cab,det.cantidad";
	
					$tablas=" public.usuarios u
							INNER JOIN public.rc_pedidos_cab pc
							ON pc.id_usuarios = u.id_usuarios
							INNER JOIN public.fc_clientes c
							ON c.id_clientes = pc.id_clientes
							INNER JOIN (
									SELECT pd.id_pedidos_cab,SUM(pd.id_productos) AS cantidad
									FROM public.rc_pedidos_det pd
									GROUP BY pd.id_pedidos_cab
									) det
						    ON det.id_pedidos_cab =  pc.id_pedidos_cab";
	
					$where=" pc.id_usuarios=96
						    AND pc.estado_pedidos_cab = 'P'";
	
					$id=" pc.id_pedidos_cab";
	
	
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_5 = "";
						
					/*
						if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
						if($codigo_plan_cuentas!=""){$where_1=" AND plan_cuentas.codigo_plan_cuentas = '$codigo_plan_cuentas'";}
						if($nombre_plan_cuentas!=""){$where_2=" AND plan_cuentas.nombre_plan_cuentas = '$nombre_plan_cuentas'";}
						if($nivel_plan_cuentas!=""){$where_3=" AND plan_cuentas.nivel_plan_cuentas='$nivel_plan_cuentas'";}
						if($t_plan_cuentas!=""){$where_4=" AND plan_cuentas.t_plan_cuentas='$t_plan_cuentas'";}
						if($n_plan_cuentas!=""){$where_5=" AND plan_cuentas.n_plan_cuentas='$n_plan_cuentas'";}
						*/
	
	
					$where_to  = $where . $where_0. $where_1. $where_2. $where_3. $where_4. $where_5;
	
	
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
					if($action == 'ajax')
					{
						$html="";
						$rs_cantidad=$cl_pedidos->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$rs_cantidad[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
						$rs_pedidos=$cl_pedidos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
						$count_query   = $cantidadResult;
							
						$total_pages = ceil($cantidadResult/$per_page);
							
						if ($cantidadResult>0)
						{
	
							//<th style="color:#456789;font-size:80%;"></th>
	
							$html.='<div class="pull-left">';
							$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
							$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
							$html.='</div><br>';
							$html.='<section style="height:auto; overflow-y:scroll;">';
							$html.='<table class="table table-hover">';
							$html.='<thead>';
							$html.='<tr class="info">';
							$html.='<th>Numero Pedido</th>';
							$html.='<th>Ruc/ Identificacion</th>';
							$html.='<th>Razon Social</th>';
							$html.='<th>Registra</th>';
							$html.='<th>Fecha Pedido</th>';
							$html.='<th>Estado</th>';
							$html.='<th>Cantidad Productos</th>';
							$html.='<th>Ver Detalle</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							//var_dump($rs_pedidos);
							
							foreach ($rs_pedidos as $res)
							{
								//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
								
								//pc.id_pedidos_cab,pc.numero_pedidos_cab,c.ruc_clientes,c.razon_social_clientes,
								//u.nombre_usuarios,pc.estado_pedidos_cab,det.Cantidad
									
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_pedidos_cab.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->ruc_clientes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->razon_social_clientes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_usuarios.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->fecha.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->estado_pedidos_cab.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->cantidad.'</td>';
								$html.='<td style="color:#000000;font-size:80%;"><i class="glyphicon glyphicon-eye-open"></i></td>';
								$html.='</tr>';
									
							}
	
							$html.='</tbody>';
							$html.='</table>';
							$html.='</section>';
							$html.='<div class="table-pagination pull-right">';
							$html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents).'';
							$html.='</div>';
							$html.='</section>';
	
	
						}else{
	
							$html.='<div class="alert alert-warning alert-dismissable">';
							$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
							$html.='<h4>Aviso!!!</h4> No hay datos para mostrar';
							$html.='</div>';
	
						}
							
	
	
					}
	
				}
				else
				{
	
				}
	
			}
			else
			{
					
					
			}
		}
	
		echo $html;
	
	}
	

	public function paginate($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_plan_cuentas(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_plan_cuentas(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_plan_cuentas(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_plan_cuentas(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_plan_cuentas(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_plan_cuentas($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_plan_cuentas(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
}
?>