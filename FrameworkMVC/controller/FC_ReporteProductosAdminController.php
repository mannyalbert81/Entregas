<?php

class FC_ReporteProductosAdminController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}
   
   public function FichaAdmin()
   {
   	
   		if(isset($_REQUEST['id_productos']))
   		{
   			
   			
   	
   			$parametros = array();
   			$parametros['id_entidades']=isset($_GET['id_entidades'])?trim($_GET['id_entidades']):'';
   			$parametros['id_productos']=isset($_GET['id_productos'])?trim($_GET['id_productos']):'';
   			
   			
   			//aqui poner la pagina
   	
   			$pagina="conFichaProductos.aspx";
   	
   			$conexion_rpt = array();
   			$conexion_rpt['pagina']=$pagina;
   			//$conexion_rpt['port']="59584";
   	
   			$this->view("ReporteRpt", array(
   					"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
   			));
   	
   	
   		}
   	
   	
   }
   
   
   
   public function index(){
   
   	session_start();
   	$_id_usuarios= $_SESSION['id_usuarios'];
   	//Creamos el objeto usuario
   	$resultSet="";
   	$registrosTotales = 0;
   	$arraySel = "";
   
   	$fc_catalogos = new FC_CatalogosModel();
   	$fc_foto_productos = new FC_FotoProductosModel();
   	$fc_productos = new FC_ProductosModel();
   		
   	$usuarios = new UsuariosModel();
   	$resultEnt = $usuarios->getBy("id_usuarios='$_id_usuarios'");
   	$_id_entidades=$resultEnt[0]->id_entidades;
   		
   	
   		
   	$fc_grupo_productos = new FC_GrupoProductosModel();
   	$result_FC_grupo_productos= $fc_grupo_productos->getAll("nombre_grupo_productos");
   	
   	
   		
   	$fc_unidades_medida = new FC_UnidadesMedidaModel();
   	$result_FC_unidades_medida= $fc_unidades_medida->getAll("nombre_unidades_medida");
   	
   	
   		
   		
   		
   	$entidades = new EntidadesModel();
   	$resultEnt= $entidades->getAll("nombre_entidades");
   	
   		
   
   
   	if (isset(  $_SESSION['usuario_usuarios']) )
   	{
   		$permisos_rol = new PermisosRolesModel();
   		$nombre_controladores = "FC_ReporteProductosAdmin";
   		$id_rol= $_SESSION['id_rol'];
   		$resultPer = $fc_productos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
   
   		if (!empty($resultPer))
   		{
   				
   			if(isset($_POST["id_entidades"])){
   
   
   				$id_entidades=$_POST['id_entidades'];
   				$codigo_productos=$_POST['codigo_productos'];
   				$nombre_productos=$_POST['nombre_productos'];
   				$id_grupo_productos=$_POST['id_grupo_productos'];
   				$id_unidades_medida=$_POST['id_unidades_medida'];
   				$iva_productos=$_POST['iva_productos'];
   
   					
   
   
   				$columnas = " fc_productos.id_productos, 
							  fc_grupo_productos.id_grupo_productos, 
							  fc_grupo_productos.nombre_grupo_productos, 
							  entidades.id_entidades, 
   						      entidades.nombre_entidades, 
							  usuarios.nombre_usuarios, 
							  fc_productos.nombre_productos, 
							  fc_productos.descripcion_productos, 
							  fc_foto_productos.id_foto_productos, 
							  fc_foto_productos.archivo_foto_productos, 
							  fc_catalogos.id_catalogos, 
							  fc_catalogos.archivo_catalogos, 
							  fc_productos.precio_uno_productos, 
							  fc_productos.utilidad_uno_productos, 
							  fc_productos.precio_dos_productos, 
							  fc_productos.utilidad_dos, 
							  fc_productos.precio_tres_productos, 
							  fc_productos.utilidad_tres, 
							  fc_productos.observaciones_productos, 
							  fc_productos.iva_productos, 
							  fc_unidades_medida.id_unidades_medida, 
							  fc_unidades_medida.nombre_unidades_medida, 
							  fc_productos.codigo_productos, 
							  fc_productos.creado";
   
   
   
   				$tablas="  public.fc_productos, 
						  public.fc_foto_productos, 
						  public.usuarios, 
						  public.fc_grupo_productos, 
						  public.fc_catalogos, 
						  public.fc_unidades_medida, 
						  public.entidades";
   
   				$where="fc_productos.id_entidades = entidades.id_entidades AND
					  fc_foto_productos.id_foto_productos = fc_productos.id_foto_productos AND
					  usuarios.id_usuarios = fc_productos.id_usuarios AND
					  fc_grupo_productos.id_grupo_productos = fc_productos.id_grupo_productos AND
					  fc_catalogos.id_catalogos = fc_productos.id_catalogos AND
					  fc_unidades_medida.id_unidades_medida = fc_productos.id_unidades_medida AND
					  entidades.id_entidades = usuarios.id_entidades";
   
   				$id="fc_productos.id_productos";
   
   
   				$where_0 = "";
   				$where_1 = "";
   				$where_2 = "";
   				$where_3 = "";
   				$where_4 = "";
   				$where_5 = "";
   
   				 
   				
   					
   
   				if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
   
   				if($codigo_productos!=""){$where_1=" AND fc_productos.codigo_productos='$codigo_productos'";}
   
   				if($nombre_productos!=""){$where_2=" AND fc_productos.nombre_productos ='$nombre_productos'";}
   
   				if($id_grupo_productos!=0){$where_3=" AND fc_grupo_productos.id_grupo_productos ='$id_grupo_productos'";}
   
   				if($id_unidades_medida!=0){$where_4=" AND fc_unidades_medida.id_unidades_medida ='$id_unidades_medida'";}
   				
   				if($iva_productos!=""){$where_5=" AND fc_productos.iva_productos ='$iva_productos'";}
   				 
   				 
   				$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3. $where_4. $where_5;
   
   				 
   				//$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
   
   					
   				//comienza paginacion
   					
   					
   				$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
   					
   				if($action == 'ajax')
   				{
   					$html="";
   					$resultSet=$fc_productos->getCantidad("*", $tablas, $where_to);
   					$cantidadResult=(int)$resultSet[0]->total;
   						
   					$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
   						
   					$per_page = 50; //la cantidad de registros que desea mostrar
   					$adjacents  = 9; //brecha entre páginas después de varios adyacentes
   					$offset = ($page - 1) * $per_page;
   						
   					$limit = " LIMIT   '$per_page' OFFSET '$offset'";
   						
   						
   					$resultSet=$fc_productos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
   						
   					$count_query   = $cantidadResult;
   						
   					$total_pages = ceil($cantidadResult/$per_page);
   						
   					if ($cantidadResult>0)
   					{
   							
   						//<th style="color:#456789;font-size:80%;"></th>
   
   						$html.='<div class="pull-left">';
   						$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
   						$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
   						$html.='</div><br>';
   						$html.='<section style="height:425px; overflow-y:scroll;">';
   						$html.='<table class="table table-hover">';
   						$html.='<thead>';
   						$html.='<tr class="info">';
   						$html.='<th></th>';
   						$html.='<th>Codigo</th>';
   						$html.='<th>Nombre</th>';
   						$html.='<th>1er $</th>';
   						$html.='<th>2do $</th>';
   						$html.='<th>3cer $</th>';
   						$html.='<th>Grupo</th>';
   						$html.='<th>U/M</th>';
   						$html.='<th>Iva</th>';
   						$html.='<th>Ficha</th>';
   						$html.='<th>Catálogo</th>';
   						$html.='</tr>';
   						$html.='</thead>';
   						$html.='<tbody>';
   							
   						foreach ($resultSet as $res)
   						{
   								
   							$_precio_default="0.0000";
   							$_si="Si";
   							$_no="No";
   							
   							
   							$html.='<tr>';
   							$html.='<td style="color:#000000;font-size:80%;"><input type="image" name="image" src="view/DevuelveImagen.php?id_valor='. $res->id_foto_productos .'&id_nombre=id_foto_productos&tabla=fc_foto_productos&campo=archivo_foto_productos" alt='. $res->id_foto_productos .' width="60" height="60" ></td>';
   							$html.='<td style="color:#000000;font-size:80%;">'.$res->codigo_productos.'</td>';
   							$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_productos.'</td>';
   							
   							if($res->precio_uno_productos==""){
   								$html.='<td style="color:#000000;font-size:80%;">'.$_precio_default.'</td>';
   							}
   							else{
   							
   								$html.='<td style="color:#000000;font-size:80%;">'.$res->precio_uno_productos.'</td>';
   							}
   							
   							if($res->precio_dos_productos==""){
   								$html.='<td style="color:#000000;font-size:80%;">'.$_precio_default.'</td>';
   							}
   							else{
   							
   								$html.='<td style="color:#000000;font-size:80%;">'.$res->precio_dos_productos.'</td>';
   							}
   							
   							if($res->precio_tres_productos==""){
   								$html.='<td style="color:#000000;font-size:80%;">'.$_precio_default.'</td>';
   							}
   							else{
   							
   								$html.='<td style="color:#000000;font-size:80%;">'.$res->precio_tres_productos.'</td>';
   							}
   							
   							
   							$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_grupo_productos.'</td>';
   							$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_unidades_medida.'</td>';
   							
   							if($res->iva_productos=="t"){
   								$html.='<td style="color:#000000;font-size:80%;">'.$_si.'</td>';
   							}
   							else{
   							
   								$html.='<td style="color:#000000;font-size:80%;">'.$res->$_no.'</td>';
   							}
   							$html.='<td style="color:#000000;font-size:95%;"><span class="pull-right"><a href="index.php?controller=FC_ReporteProductosAdmin&action=FichaAdmin&id_productos='. $res->id_productos .'&id_entidades='. $res->id_entidades.'" target="_blank">--Ver--</a></span></td>';
   							$html.='<td style="color:#000000;font-size:95%;"><span class="pull-right"><a href="http://localhost:4000/contabilidad/FrameworkMVC/view/DevuelveCatalogoView.php?id_catalogos='. $res->id_catalogos .'" target="_blank">--Ver--</a></span></td>';
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
   						
   					echo $html;
   					die();
   
   				}
   					
   				if(isset($_POST['reporte']))
   				{
   
   					//parametros q van al servidor de reportes
   
   					$parametros = array();
   
   					
   					$parametros['id_entidades']=isset($_POST['id_entidades'])?trim($_POST['id_entidades']):'';
   					$parametros['codigo_productos']=(isset($_POST['codigo_productos']))?trim($_POST['codigo_productos']):'';
   					$parametros['nombre_productos']=(isset($_POST['nombre_productos']))?trim($_POST['nombre_productos']):'';
   					$parametros['id_grupo_productos']=(isset($_POST['id_grupo_productos']))?trim($_POST['id_grupo_productos']):'';
   					$parametros['id_unidades_medida']=(isset($_POST['id_unidades_medida']))?trim($_POST['id_unidades_medida']):'';
   					$parametros['iva_productos']=(isset($_POST['iva_productos']))?trim($_POST['iva_productos']):'';
   
   					//para local
   					$pagina="conReporteProductos.aspx";
   
   					$conexion_rpt = array();
   					$conexion_rpt['pagina']=$pagina;
   					//$conexion_rpt['port']="59584";
   
   					$this->view("ReporteRpt", array(
   							"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
   					));
   
   					die();
   
   				}
   					
   
   			}
   
   
   			$this->facturacion_compras("FC_ReporteProductosAdmin",array(
   					"resultSet"=>$resultSet, "result_FC_grupo_productos"=>$result_FC_grupo_productos,
   					"resultEnt"=>$resultEnt, "result_FC_unidades_medida"=>$result_FC_unidades_medida
   
   						
   						
   			));
   
   
   		}
   		else
   		{
   			$this->view("Error",array(
   					"resultado"=>"No tiene Permisos de Acceso a Reporte Productos"
   
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
   
   public function paginate($reload, $page, $tpages, $adjacents) {
   
   	$prevlabel = "&lsaquo; Prev";
   	$nextlabel = "Next &rsaquo;";
   	$out = '<ul class="pagination pagination-large">';
   
   	// previous label
   
   	if($page==1) {
   		$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
   	} else if($page==2) {
   		$out.= "<li><span><a href='javascript:void(0);' onclick='load_productos(1)'>$prevlabel</a></span></li>";
   	}else {
   		$out.= "<li><span><a href='javascript:void(0);' onclick='load_productos(".($page-1).")'>$prevlabel</a></span></li>";
   
   	}
   
   	// first label
   	if($page>($adjacents+1)) {
   		$out.= "<li><a href='javascript:void(0);' onclick='load_productos(1)'>1</a></li>";
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
   			$out.= "<li><a href='javascript:void(0);' onclick='load_productos(1)'>$i</a></li>";
   		}else {
   			$out.= "<li><a href='javascript:void(0);' onclick='load_productos(".$i.")'>$i</a></li>";
   		}
   	}
   
   	// interval
   
   	if($page<($tpages-$adjacents-1)) {
   		$out.= "<li><a>...</a></li>";
   	}
   
   	// last
   
   	if($page<($tpages-$adjacents)) {
   		$out.= "<li><a href='javascript:void(0);' onclick='load_productos($tpages)'>$tpages</a></li>";
   	}
   
   	// next
   
   	if($page<$tpages) {
   		$out.= "<li><span><a href='javascript:void(0);' onclick='load_productos(".($page+1).")'>$nextlabel</a></span></li>";
   	}else {
   		$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
   	}
   
   	$out.= "</ul>";
   	return $out;
   }
   
   
   
   public function AutocompleteCodigoProductos(){
   
   
   
   $fc_productos= new FC_ProductosModel();
   	$codigo_productos = $_GET['term'];
   
   	$resultSet=$fc_productos->getBy("codigo_productos LIKE '$codigo_productos%'");
   
   
   	if(!empty($resultSet)){
   
   		foreach ($resultSet as $res){
   
   			$_codigo_productos[] = $res->codigo_productos;
   		}
   		echo json_encode($_codigo_productos);
   	}
   
   }
   
   
   
   public function AutocompleteNombreProductos(){
   	 
   	 
   	 
   	$fc_productos= new FC_ProductosModel();
   	$nombre_productos = $_GET['term'];
   	 
   	$resultSet=$fc_productos->getBy("nombre_productos LIKE '$nombre_productos%'");
   	 
   	 
   	if(!empty($resultSet)){
   		 
   		foreach ($resultSet as $res){
   			 
   			$_nombre_productos[] = $res->nombre_productos;
   		}
   		echo json_encode($_nombre_productos);
   	}
   	 
   }
   
}
?>