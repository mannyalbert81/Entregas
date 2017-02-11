<?php

class ComprobantesAdminController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//maycol

		
	
	public function ReporteComprobantes(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		
		$ccomprobantes = new CComprobantesModel();
		$dcomprobantes = new DComprobantesModel();
		$tipo_comprobantes = new TipoComprobantesModel();
		
		
		$tipo_comprobante=new TipoComprobantesModel();
		$resultTipCom = $tipo_comprobante->getAll("nombre_tipo_comprobantes");
		
		$entidades = new EntidadesModel();
		$resultEnt=$entidades->getAll("nombre_entidades");
		
		
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ComprobantesAdmin";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $ccomprobantes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"])){
	
	
					$id_entidades=$_POST['id_entidades'];
					$id_tipo_comprobantes=$_POST['id_tipo_comprobantes'];
					$numero_ccomprobantes=$_POST['numero_ccomprobantes'];
					$referencia_doc_ccomprobantes=$_POST['referencia_doc_ccomprobantes'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
						
					
	
						
					$columnas = " ccomprobantes.id_ccomprobantes, 
							      tipo_comprobantes.id_tipo_comprobantes, 
								  tipo_comprobantes.nombre_tipo_comprobantes, 
								  ccomprobantes.concepto_ccomprobantes, 
							      entidades.id_entidades, 
								  entidades.nombre_entidades, 
								  ccomprobantes.valor_letras, 
								  ccomprobantes.fecha_ccomprobantes, 
								  ccomprobantes.numero_ccomprobantes, 
								  ccomprobantes.ruc_ccomprobantes, 
								  ccomprobantes.nombres_ccomprobantes, 
								  ccomprobantes.retencion_ccomprobantes, 
								  ccomprobantes.valor_ccomprobantes, 
								  ccomprobantes.referencia_doc_ccomprobantes, 
								  ccomprobantes.numero_cuenta_banco_ccomprobantes, 
								  ccomprobantes.numero_cheque_ccomprobantes, 
								  ccomprobantes.observaciones_ccomprobantes, 
								  forma_pago.nombre_forma_pago";
	
	
	
					$tablas=" public.ccomprobantes, 
							  public.entidades, 
							  public.tipo_comprobantes, 
							  public.forma_pago";
	
					$where="ccomprobantes.id_forma_pago = forma_pago.id_forma_pago  AND
							  entidades.id_entidades = ccomprobantes.id_entidades AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes";
	
					$id="ccomprobantes.numero_ccomprobantes";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
						
					
					
	
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	
					if($id_tipo_comprobantes!=0){$where_1=" AND tipo_comprobantes.id_tipo_comprobantes='$id_tipo_comprobantes'";}
	
					if($numero_ccomprobantes!=""){$where_2=" AND ccomprobantes.numero_ccomprobantes LIKE '%$numero_ccomprobantes%'";}
						
					if($referencia_doc_ccomprobantes!=""){$where_3=" AND ccomprobantes.referencia_doc_ccomprobantes LIKE '%$referencia_doc_ccomprobantes%'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  ccomprobantes.fecha_ccomprobantes BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3. $where_4;
	
	
					//$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
	
					
					//comienza paginacion
					
					
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
					
					if($action == 'ajax')
					{
						$html="";
						$resultSet=$ccomprobantes->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$resultSet[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
						$resultSet=$ccomprobantes->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
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
							$html.='<th>Tipo</th>';
							$html.='<th>Concepto</th>';
							$html.='<th>Entidad</th>';
							$html.='<th>Valor</th>';
							$html.='<th>Fecha</th>';
							$html.='<th>Numero de Comprobante</th>';
							$html.='<th>Forma de Pago</th>';
							$html.='<th></th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
					
							foreach ($resultSet as $res)
							{
								//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
									
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_tipo_comprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->concepto_ccomprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_entidades.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->valor_letras.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->fecha_ccomprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_ccomprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_forma_pago.'</td>';
								$html.='<td style="color:#000000;font-size:80%;"><span class="pull-right"><a href="index.php?controller=ComprobantesAdmin&action=Reporte_ImprimirComprobantesAdmin&id_ccomprobantes='. $res->id_ccomprobantes .'&id_entidades='. $res->id_entidades.'&id_tipo_comprobantes='. $res->id_tipo_comprobantes.' " target="_blank"><i class="glyphicon glyphicon-print"></i></a></span></td>';
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
						$parametros['id_tipo_comprobantes']=(isset($_POST['id_tipo_comprobantes']))?trim($_POST['id_tipo_comprobantes']):'';
						$parametros['numero_ccomprobantes']=(isset($_POST['numero_ccomprobantes']))?trim($_POST['numero_ccomprobantes']):'';
						$parametros['referencia_doc_ccomprobantes']=(isset($_POST['referencia_doc_ccomprobantes']))?trim($_POST['referencia_doc_ccomprobantes']):'';
						$parametros['fecha_desde']=(isset($_POST['fecha_desde']))?trim($_POST['fecha_desde']):'';
						$parametros['fecha_hasta']=(isset($_POST['fecha_hasta']))?trim($_POST['fecha_hasta']):'';
						
						//para local 
						$pagina="conReporteComprobantesAdmin.aspx";
												
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						//$conexion_rpt['port']="59584";
						
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
						
						die();
						
					}
					
	
		}
	
				
				$this->view("ReporteComprobantesAdmin",array(
						"resultSet"=>$resultSet, "resultTipCom"=> $resultTipCom,
						"resultEnt"=>$resultEnt
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Reporte Comprobantes"
	
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
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_comprobantes(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_comprobantes(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_comprobantes(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_comprobantes(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_comprobantes(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_comprobantes($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_comprobantes(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
    
	public function Reporte_ImprimirComprobantesAdmin()
	{
		if(isset($_REQUEST['id_ccomprobantes']))
		{
	
			$id_ccomprobantes= $_GET['id_ccomprobantes'];
			$id_entidades= $_GET['id_entidades'];
			$id_tipo_comprobantes= $_GET['id_tipo_comprobantes'];
			
			$tipo_comprobantes = new TipoComprobantesModel();
			$resultTip = $tipo_comprobantes->getBy("id_tipo_comprobantes='$id_tipo_comprobantes'");
			$_nombre_tipo_comprobantes=$resultTip[0]->nombre_tipo_comprobantes;
			
			
			if ($_nombre_tipo_comprobantes == "INGRESOS")
			{
				
				
				
				$parametros = array();
				
				$parametros['id_ccomprobantes']=isset($id_ccomprobantes)?trim($id_ccomprobantes):'';
				$parametros['id_entidades']=isset($id_entidades)?trim($id_entidades):'';
				$parametros['id_tipo_comprobantes']=isset($id_tipo_comprobantes)?trim($id_tipo_comprobantes):'';
				
				$pagina="conComprobantesIngresosAdmin.aspx";
				
				$conexion_rpt = array();
				$conexion_rpt['pagina']=$pagina;
				//$conexion_rpt['port']="59584";
				
				$this->view("ReporteRpt", array(
						"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
				));
				
				
				die();
				
				
			}elseif ($_nombre_tipo_comprobantes == "EGRESOS") {
				
				
				
				$parametros = array();
				
				$parametros['id_ccomprobantes']=isset($id_ccomprobantes)?trim($id_ccomprobantes):'';
				$parametros['id_entidades']=isset($id_entidades)?trim($id_entidades):'';
				$parametros['id_tipo_comprobantes']=isset($id_tipo_comprobantes)?trim($id_tipo_comprobantes):'';
				
				$pagina="conComprobantesEgresosAdmin.aspx";
				
				$conexion_rpt = array();
				$conexion_rpt['pagina']=$pagina;
				//$conexion_rpt['port']="59584";
				
				$this->view("ReporteRpt", array(
						"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
				));
				
				
				die();
				
			}elseif ($_nombre_tipo_comprobantes == "CONTABLE") {
				
				
				$parametros = array();
				
				$parametros['id_ccomprobantes']=isset($id_ccomprobantes)?trim($id_ccomprobantes):'';
				$parametros['id_entidades']=isset($id_entidades)?trim($id_entidades):'';
				$parametros['id_tipo_comprobantes']=isset($id_tipo_comprobantes)?trim($id_tipo_comprobantes):'';
				
				$pagina="conComprobantesContablesAdmin.aspx";
				
				$conexion_rpt = array();
				$conexion_rpt['pagina']=$pagina;
				//$conexion_rpt['port']="59584";
				
				$this->view("ReporteRpt", array(
						"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
				));
				
				
				die();
				
			}
			
	
		}
	
	}
	
	
	
	public function AutocompleteNComprobantes(){
	
		
	
		$ccomprobantes = new CComprobantesModel();
		$numero_ccomprobantes = $_GET['term'];
	
		$resultSet=$ccomprobantes->getBy("numero_ccomprobantes LIKE '$numero_ccomprobantes%'");
	
	
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
	
				$_numero_ccomprobantes[] = $res->numero_ccomprobantes;
			}
			echo json_encode($_numero_ccomprobantes);
		}
	
	}
	
	public function AutocompleteRComprobantes(){
	
	
	
		$ccomprobantes = new CComprobantesModel();
		$referencia_doc_ccomprobantes = $_GET['term'];
	
		$resultSet=$ccomprobantes->getBy("referencia_doc_ccomprobantes LIKE '$referencia_doc_ccomprobantes%'");
	
	
		if(!empty($resultSet)){
	
			foreach ($resultSet as $res){
	
				$_referencia_doc_ccomprobantes[] = $res->referencia_doc_ccomprobantes;
			}
			echo json_encode($_referencia_doc_ccomprobantes);
		}
	
	}
	
}
?>