<?php

class BalanceComprobacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function BalanceComprobacion(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		
		$ccomprobantes = new CComprobantesModel();
		$dcomprobantes = new DComprobantesModel();
		$cierre_mes = new CierreMesModel();
		$cuenta_cierre_mes = new CuentasCierreMesModel();
		
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
		
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "BalanceComprobacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $cuenta_cierre_mes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				
				
				
				
				
				if(isset($_POST["id_entidades"]))
				{
	
	
					$id_entidades=$_POST['id_entidades'];
					$id_usuarios=$_POST['id_usuarios'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
										
					$columnas = " plan_cuentas.codigo_plan_cuentas, 
								  plan_cuentas.nombre_plan_cuentas, 
								  entidades.id_entidades, 
							      entidades.nombre_entidades, 
								  plan_cuentas.saldo_plan_cuentas, 
								  usuarios.nombre_usuarios, 
								  cierre_mes.fecha_cierre_mes, 
								  tipo_cierre.nombre_tipo_cierre, 
								  cuentas_cierre_mes.debe_ene, 
								  cuentas_cierre_mes.haber_ene, 
								  cuentas_cierre_mes.saldo_final_ene, 
								  cuentas_cierre_mes.año_cuentas_cierre_mes, 
								  cuentas_cierre_mes.debe_feb, 
								  cuentas_cierre_mes.haber_feb, 
								  cuentas_cierre_mes.saldo_final_feb, 
								  cuentas_cierre_mes.debe_abr, 
								  cuentas_cierre_mes.haber_abr, 
								  cuentas_cierre_mes.saldo_final_abr, 
								  cuentas_cierre_mes.debe_mar, 
								  cuentas_cierre_mes.haber_mar, 
								  cuentas_cierre_mes.saldo_final_mar, 
								  cuentas_cierre_mes.debe_may, 
								  cuentas_cierre_mes.haber_may, 
								  cuentas_cierre_mes.saldo_final_may, 
								  cuentas_cierre_mes.debe_jun, 
								  cuentas_cierre_mes.haber_jun, 
								  cuentas_cierre_mes.saldo_final_jun, 
								  cuentas_cierre_mes.debe_jul, 
								  cuentas_cierre_mes.haber_jul, 
								  cuentas_cierre_mes.saldo_final_jul, 
								  cuentas_cierre_mes.debe_ago, 
								  cuentas_cierre_mes.haber_ago, 
								  cuentas_cierre_mes.saldo_final_ago, 
								  cuentas_cierre_mes.debe_sep, 
								  cuentas_cierre_mes.haber_sep, 
								  cuentas_cierre_mes.saldo_final_sep, 
								  cuentas_cierre_mes.debe_oct, 
								  cuentas_cierre_mes.haber_oct, 
								  cuentas_cierre_mes.saldo_final_oct, 
								  cuentas_cierre_mes.debe_nov, 
								  cuentas_cierre_mes.haber_nov, 
								  cuentas_cierre_mes.saldo_final_nov, 
								  cuentas_cierre_mes.debe_dic, 
								  cuentas_cierre_mes.haber_dic, 
								  cuentas_cierre_mes.saldo_final_dic";
	
	
	
					$tablas=" public.cuentas_cierre_mes, 
							  public.cierre_mes, 
							  public.plan_cuentas, 
							  public.entidades, 
							  public.usuarios, 
							  public.tipo_cierre";
								
					$where=" cuentas_cierre_mes.id_plan_cuentas = plan_cuentas.id_plan_cuentas AND
							  cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
							  cierre_mes.id_entidades = entidades.id_entidades AND
							  entidades.id_entidades = usuarios.id_entidades AND
							  usuarios.id_usuarios = cierre_mes.id_usuario_creador AND
							  tipo_cierre.id_tipo_cierre = cierre_mes.id_tipo_cierre AND usuarios.id_usuarios='$_id_usuarios'";
	
					$id="plan_cuentas.codigo_plan_cuentas";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	
					if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_2=" AND cierre_mes.fecha_cierre_mes BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2;
	
					//carga toda la informacion
					//$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
					
					
					//comienza paginacion
						
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
						
					if($action == 'ajax')
					{
						//echo $columnas.'<br>'.$tablas.'<br>'.$where_to;
						//die();
						
						$html="";
						$resultSet=$cuenta_cierre_mes->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$resultSet[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
						$resultSet=$cuenta_cierre_mes->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
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
							$html.='<th>Entidad</th>';
							$html.='<th>Codigo Cuenta</th>';
							$html.='<th>Nombre</th>';
							$html.='<th>Fecha Cierre</th>';
							$html.='<th>Debe</th>';
							$html.='<th>Haber</th>';
							$html.='<th>Saldo</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							foreach ($resultSet as $res)
							{
								
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_entidades.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->codigo_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->fecha_cierre_mes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_ene.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_ene.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_ene.'</td>';
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
					
					if(isset($_POST["reporte_rpt"]))
					{
						//parametros q van al servidor de reportes
						
						$parametros = array();
						
						$parametros['id_entidades']=isset($_POST['id_entidades'])?trim($_POST['id_entidades']):'';
						$parametros['id_usuarios'] = $_SESSION['id_usuarios'];
						$parametros['fecha_desde']=(isset($_POST['fecha_desde']))?trim($_POST['fecha_desde']):'';
						$parametros['fecha_hasta']=(isset($_POST['fecha_hasta']))?trim($_POST['fecha_hasta']):'';
						$parametros['reporte']=(isset($_POST['fecha_hasta']))?trim($_POST['reporte']):'';
						
						//para local 
						$pagina="";
						
						//para localizar el reporte
						if($_POST['reporte']=='detallado')
						{   $pagina="conBalanceComprobacionDetallado.aspx";
						}else if($_POST['reporte']=='simplificado'){
							$pagina="conBalanceComprobacionSimplificado.aspx";
						}
												
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						$conexion_rpt['port']="59584";
						
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
						
						die();
						
					}
	
	
				}
				
				$this->view("BalanceComprobacion",array(
						"resultSet"=>$resultSet,
						"resultEnt"=>$resultEnt
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Balance De Comprobacion"
	
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
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_balance_comprobacion(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_balance_comprobacion(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_balance_comprobacion(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_balance_comprobacion(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_balance_comprobacion(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_balance_comprobacion($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_balance_comprobacion(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
}
?>