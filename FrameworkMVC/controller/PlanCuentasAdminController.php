<?php

class PlanCuentasAdminController extends ControladorBase{

	public function __construct() {
		parent::__construct();
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
	
	
	
	/////////////////////////////////////super administrador ////////////////////////////////////////////////////////////////
	
	
	public function ImprimirConsultarPlanCuentasAdmin(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
	
		$plan_cuentas= new PlanCuentasModel();
	
		$entidades = new EntidadesModel();
		$resultEnt=$entidades->getAll("nombre_entidades");
		
		
	
	
		$columnas_niv = "plan_cuentas.nivel_plan_cuentas";
		$tablas_niv ="public.plan_cuentas,
					  public.entidades";
		$where_niv ="entidades.id_entidades = plan_cuentas.id_entidades";
		$grupo_niv="plan_cuentas.nivel_plan_cuentas";
		$id_niv="plan_cuentas.nivel_plan_cuentas";
		$resultNiv=$plan_cuentas->getCondiciones_GrupBy_OrderBy($columnas_niv, $tablas_niv, $where_niv, $grupo_niv, $id_niv);
	
		$columnas_t = "plan_cuentas.t_plan_cuentas";
		$tablas_t ="public.plan_cuentas,
					  public.entidades";
		$where_t ="entidades.id_entidades = plan_cuentas.id_entidades AND plan_cuentas.t_plan_cuentas!=''";
		$grupo_t="plan_cuentas.t_plan_cuentas";
		$id_t="plan_cuentas.t_plan_cuentas";
		$resultTip=$plan_cuentas->getCondiciones_GrupBy_OrderBy($columnas_t, $tablas_t, $where_t, $grupo_t, $id_t);
	
		$columnas_n = "plan_cuentas.n_plan_cuentas";
		$tablas_n ="public.plan_cuentas,
					  public.entidades";
		$where_n ="entidades.id_entidades = plan_cuentas.id_entidades";
		$grupo_n="plan_cuentas.n_plan_cuentas";
		$id_n="plan_cuentas.n_plan_cuentas";
		$resultNat=$plan_cuentas->getCondiciones_GrupBy_OrderBy($columnas_n, $tablas_n, $where_n, $grupo_n, $id_n);
	
	
	
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "PlanCuentasAdmin";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $plan_cuentas->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"])){
	
	
					$id_entidades=$_POST['id_entidades'];
					$codigo_plan_cuentas=$_POST['codigo_plan_cuentas'];
					$nombre_plan_cuentas=$_POST['nombre_plan_cuentas'];
					$nivel_plan_cuentas=$_POST['nivel_plan_cuentas'];
					$t_plan_cuentas=$_POST['t_plan_cuentas'];
					$n_plan_cuentas=$_POST['n_plan_cuentas'];
						
	
	
					$columnas = " entidades.id_entidades,
								  entidades.ruc_entidades,
								  entidades.nombre_entidades,
								  entidades.telefono_entidades,
								  entidades.direccion_entidades,
								  entidades.ciudad_entidades,
								  entidades.logo_entidades,
								  plan_cuentas.id_plan_cuentas,
								  plan_cuentas.codigo_plan_cuentas,
								  plan_cuentas.nombre_plan_cuentas,
								  monedas.nombre_monedas,
								  plan_cuentas.n_plan_cuentas,
								  plan_cuentas.t_plan_cuentas,
								  plan_cuentas.nivel_plan_cuentas";
	
	
	
					$tablas="  public.plan_cuentas,
							  public.entidades,
							  public.monedas";
	
					$where="plan_cuentas.id_modenas = monedas.id_monedas AND
					entidades.id_entidades = plan_cuentas.id_entidades";
	
					$id="plan_cuentas.codigo_plan_cuentas";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_5 = "";
						
	
	
	
	
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
					if($codigo_plan_cuentas!=""){$where_1=" AND plan_cuentas.codigo_plan_cuentas LIKE '%$codigo_plan_cuentas%'";}
					if($nombre_plan_cuentas!=""){$where_2=" AND plan_cuentas.nombre_plan_cuentas LIKE '%$nombre_plan_cuentas%'";}
					if($nivel_plan_cuentas!=""){$where_3=" AND plan_cuentas.nivel_plan_cuentas='$nivel_plan_cuentas'";}
					if($t_plan_cuentas!=""){$where_4=" AND plan_cuentas.t_plan_cuentas='$t_plan_cuentas'";}
					if($n_plan_cuentas!=""){$where_5=" AND plan_cuentas.n_plan_cuentas='$n_plan_cuentas'";}
	
						
	
					$where_to  = $where . $where_0. $where_1. $where_2. $where_3. $where_4. $where_5;
	
	
					//$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
					//comienza paginacion
	
	
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
					if($action == 'ajax')
					{
						$html="";
						$resultSet=$plan_cuentas->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$resultSet[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
						$resultSet=$plan_cuentas->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
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
							$html.='<th>Nombre Entidad</th>';
							$html.='<th>Codigo Cuenta</th>';
							$html.='<th>Nombre Cuenta</th>';
							$html.='<th>Nivel Cuenta</th>';
							$html.='<th>Tipo Cuenta</th>';
							$html.='<th>Naturaleza Cuenta</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							foreach ($resultSet as $res)
							{
								//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
									
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_entidades.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->codigo_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nivel_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->t_plan_cuentas.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->n_plan_cuentas.'</td>';
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
	
						$t_plan_cuentas= strtoupper($_POST['t_plan_cuentas']);
						$n_plan_cuentas= strtoupper($_POST['n_plan_cuentas']);
						
						
						
						$parametros = array();
		
						$parametros['id_entidades']=isset($_POST['id_entidades'])?trim($_POST['id_entidades']):'';
						$parametros['codigo_plan_cuentas']=isset($_POST['codigo_plan_cuentas'])?trim($_POST['codigo_plan_cuentas']):'';
						$parametros['nombre_plan_cuentas']=isset($_POST['nombre_plan_cuentas'])?trim($_POST['nombre_plan_cuentas']):'';
						//$parametros['id_usuarios'] = $_SESSION['id_usuarios']?trim($_SESSION['id_usuarios']):'';
						$parametros['nivel_plan_cuentas']=isset($_POST['nivel_plan_cuentas'])?trim($_POST['nivel_plan_cuentas']):'';
						$parametros['t_plan_cuentas']=isset($t_plan_cuentas)?trim($t_plan_cuentas):'';
						$parametros['n_plan_cuentas']=isset($n_plan_cuentas)?trim($n_plan_cuentas):'';
						
	
	
	
						//para local
						$pagina="conPlanCuentasAdmin.aspx";
	
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						//$conexion_rpt['port']="59584";
	
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
	
	
						die();
	
	
					}
	
	
				}
	
	
				$this->view("ImprimirConsultarPlanCuentasAdmin",array(
						"resultSet"=>$resultSet, "resultEnt"=>$resultEnt, "resultNiv"=>$resultNiv, "resultTip"=>$resultTip, "resultNat"=>$resultNat
	
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consultar e Imprimir Plan Cuentas"
	
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