<?php

class MayorGeneralController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function MayorGeneral(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		
		$ccomprobantes = new CComprobantesModel();
		$dcomprobantes = new DComprobantesModel();
		$tipo_comprobantes = new TipoComprobantesModel();
		$entidades = new EntidadesModel();
		
		
		$tipo_comprobante=new TipoComprobantesModel();
		$resultTipCom = $tipo_comprobante->getAll("nombre_tipo_comprobantes");
		
		
		$columnas_enc = "entidades.id_entidades,
  							entidades.nombre_entidades";
		$tablas_enc ="public.usuarios,
						  public.entidades";
		$where_enc ="entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
		$id_enc="entidades.nombre_entidades";
		$resultEnt=$entidades->getCondiciones($columnas_enc ,$tablas_enc ,$where_enc, $id_enc);
		
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "MayorGeneral";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $ccomprobantes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"]))
				{
	
	
					$id_entidades=$_POST['id_entidades'];
					$id_tipo_comprobantes=$_POST['id_tipo_comprobantes'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
										
					$columnas = " mayor.id_mayor, 
								  ccomprobantes.id_ccomprobantes, 
								  usuarios.nombre_usuarios, 
								  tipo_comprobantes.nombre_tipo_comprobantes, 
								  entidades.nombre_entidades, 
							      entidades.ruc_entidades, 
								  entidades.telefono_entidades, 
								  entidades.direccion_entidades, 
								  entidades.ciudad_entidades,
								  ccomprobantes.numero_ccomprobantes, 
								  ccomprobantes.ruc_ccomprobantes, 
								  ccomprobantes.nombres_ccomprobantes, 
								  ccomprobantes.retencion_ccomprobantes, 
								  ccomprobantes.valor_ccomprobantes, 
								  ccomprobantes.concepto_ccomprobantes, 
								  ccomprobantes.valor_letras, 
								  ccomprobantes.fecha_ccomprobantes, 
								  ccomprobantes.referencia_doc_ccomprobantes, 
								  ccomprobantes.numero_cuenta_banco_ccomprobantes, 
								  ccomprobantes.numero_cheque_ccomprobantes, 
								  ccomprobantes.observaciones_ccomprobantes, 
							      plan_cuentas.id_plan_cuentas,
								  plan_cuentas.codigo_plan_cuentas, 
								  plan_cuentas.nombre_plan_cuentas, 
								  plan_cuentas.saldo_fin_plan_cuentas, 
								  mayor.fecha_mayor, 
								  mayor.debe_mayor, 
								  mayor.haber_mayor, 
								  mayor.saldo_mayor, 
								  mayor.saldo_ini_mayor, 
								  mayor.creado, 
								  ccomprobantes.creado";
	
	
	
					$tablas=" public.ccomprobantes, 
							  public.mayor, 
							  public.plan_cuentas, 
							  public.tipo_comprobantes, 
							  public.usuarios, 
							  public.entidades";
								
					$where=" ccomprobantes.id_usuarios = usuarios.id_usuarios AND
							  mayor.id_ccomprobantes = ccomprobantes.id_ccomprobantes AND
							  plan_cuentas.id_plan_cuentas = mayor.id_plan_cuentas AND
							  tipo_comprobantes.id_tipo_comprobantes = ccomprobantes.id_tipo_comprobantes AND
							  entidades.id_entidades = ccomprobantes.id_entidades AND usuarios.id_usuarios='$_id_usuarios'";
	
					$id="plan_cuentas.codigo_plan_cuentas, ccomprobantes.creado";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	
					if($id_tipo_comprobantes!=0){$where_1=" AND tipo_comprobantes.id_tipo_comprobantes='$id_tipo_comprobantes'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_2=" AND  mayor.fecha_mayor BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2;
	
					//carga toda la informacion
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
							$html.='<th>Entidad</th>';
							$html.='<th>Codigo Cuenta</th>';
							$html.='<th>Nombre</th>';
							$html.='<th>Concepto</th>';
							$html.='<th>Saldo Inicial</th>';
							$html.='<th>Debe</th>';
							$html.='<th>Haber</th>';
							$html.='<th>Saldo Final</th>';
							$html.='<th>Fecha</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
								
							foreach ($resultSet as $res)
							{
								
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_entidades.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->codigo_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->concepto_ccomprobantes.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_ini_mayor.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_mayor.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_mayor.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_mayor.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->fecha_mayor.'</td>';
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
						$parametros['id_tipo_comprobantes']=(isset($_POST['id_tipo_comprobantes']))?trim($_POST['id_tipo_comprobantes']):'';
						$parametros['fecha_desde']=(isset($_POST['fecha_desde']))?trim($_POST['fecha_desde']):'';
						$parametros['fecha_hasta']=(isset($_POST['fecha_hasta']))?trim($_POST['fecha_hasta']):'';
						$parametros['reporte']=(isset($_POST['fecha_hasta']))?trim($_POST['reporte']):'';
						
						//para local 
						$pagina="conMayorDetallado.aspx";
												
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						$conexion_rpt['port']="59584";
						
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
						
						die();
						
					}
	
	
				}
				
				$this->view("MayorGeneral",array(
						"resultSet"=>$resultSet, "resultTipCom"=> $resultTipCom,
						"resultEnt"=>$resultEnt
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso Mayor General"
	
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
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_mayor_general(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_mayor_general(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_mayor_general(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_mayor_general(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_mayor_general(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_mayor_general($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_mayor_general(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
}
?>