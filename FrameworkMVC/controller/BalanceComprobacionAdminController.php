<?php

class BalanceComprobacionAdminController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function BalanceComprobacionAdmin(){
	//rfrf
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		
		$ccomprobantes = new CComprobantesModel();
		$dcomprobantes = new DComprobantesModel();
		$cierre_mes = new CierreMesModel();
		$cuenta_cierre_mes = new CuentasCierreMesModel();
		
		$entidades = new EntidadesModel();
		$resultEnt=$entidades->getAll("nombre_entidades");
		
		
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$resultSet="";
			$registrosTotales = 0;
			$arraySel = "";
			
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "BalanceComprobacionAdmin";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $cuenta_cierre_mes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
				
				if(isset($_POST["buscar"]))
				{	
					
				$reporte=$_POST['reporte'];
				if($reporte=="detallado")
				{
	
					
					$mes=$_POST['mes'];
				   if($mes=='1'){
	             	
				   	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	
	             	$columnas="entidades.id_entidades, 
							  entidades.nombre_entidades, 
							  usuarios.id_usuarios, 
							  usuarios.nombre_usuarios, 
							  plan_cuentas.codigo_plan_cuentas, 
							  plan_cuentas.nombre_plan_cuentas, 
							  cuentas_cierre_mes.debe_ene, 
							  cuentas_cierre_mes.haber_ene, 
							  cuentas_cierre_mes.saldo_final_ene, 
							  cuentas_cierre_mes.fecha_ene_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_ene_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas, 
							  public.entidades, 
							  public.cuentas_cierre_mes, 
							  public.cierre_mes, 
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
							  cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
							  cierre_mes.id_entidades = entidades.id_entidades AND
							  cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
							  usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_ene_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             		
	             		
	             	
	             	
	             	
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             		
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_ene_cuentas_cierre_mes,'MM')='$mes'";}
	             	
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	
	             	
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             		
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE ENERO</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             				
	             		}
	             			
	             		echo $html;
	             		die();
	             			
	             	}
	             	
	             	
	             	
	             }elseif ($mes=='2'){
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_feb,
							  cuentas_cierre_mes.haber_feb,
							  cuentas_cierre_mes.saldo_final_feb,
							  cuentas_cierre_mes.fecha_feb_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_feb_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_feb_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_feb_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE FEBRERO</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_feb.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_feb.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_feb.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='3'){
	             	
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_mar,
							  cuentas_cierre_mes.haber_mar,
							  cuentas_cierre_mes.saldo_final_mar,
							  cuentas_cierre_mes.fecha_mar_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_mar_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_mar_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_mar_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE MARZO</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_mar.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_mar.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_mar.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='4'){
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_abr,
							  cuentas_cierre_mes.haber_abr,
							  cuentas_cierre_mes.saldo_final_abr,
							  cuentas_cierre_mes.fecha_abr_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_abr_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_abr_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_abr_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE ABRIL</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_abr.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_abr.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_abr.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='5'){
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_may,
							  cuentas_cierre_mes.haber_may,
							  cuentas_cierre_mes.saldo_final_may,
							  cuentas_cierre_mes.fecha_may_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_may_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_may_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_may_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE MAYO</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_may.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_may.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_may.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             
	             }elseif ($mes=='6'){
	             	
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_jun,
							  cuentas_cierre_mes.haber_jun,
							  cuentas_cierre_mes.saldo_final_jun,
							  cuentas_cierre_mes.fecha_jun_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_jun_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_jun_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_jun_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE JUNIO</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_jun.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_jun.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_jun.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='7'){
	             	
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_jul,
							  cuentas_cierre_mes.haber_jul,
							  cuentas_cierre_mes.saldo_final_jul,
							  cuentas_cierre_mes.fecha_jul_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_jul_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_jul_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	            
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_jul_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE JULIO</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_jul.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_jul.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_jul.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='8'){
	             	
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_ago,
							  cuentas_cierre_mes.haber_ago,
							  cuentas_cierre_mes.saldo_final_ago,
							  cuentas_cierre_mes.fecha_ago_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_ago_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_ago_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_ago_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE AGOSTO</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_ago.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_ago.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_ago.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='9'){
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_sep,
							  cuentas_cierre_mes.haber_sep,
							  cuentas_cierre_mes.saldo_final_sep,
							  cuentas_cierre_mes.fecha_sep_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_sep_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_sep_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_sep_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
	             	
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
	             			$html.='<center><span ><strong>MES DE SEPTIEMBRE</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_sep.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_sep.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_sep.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='10'){
	             	
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_oct,
							  cuentas_cierre_mes.haber_oct,
							  cuentas_cierre_mes.saldo_final_oct,
							  cuentas_cierre_mes.fecha_oct_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_oct_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_oct_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_oct_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
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
	             			$html.='<center><span ><strong>MES DE OCTUBRE</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover" id="products-table"  style="overflow-y:scroll">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_oct.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_oct.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_oct.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='11'){
	             	
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_nov,
							  cuentas_cierre_mes.haber_nov,
							  cuentas_cierre_mes.saldo_final_nov,
							  cuentas_cierre_mes.fecha_nov_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_nov_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_nov_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_nov_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
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
	             			$html.='<center><span ><strong>MES DE NOVIEMBRE</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_nov.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_nov.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_nov .'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             	
	             }elseif ($mes=='12'){
	             	
	             	$id_entidades=$_POST['id_entidades'];
	             	$id_usuarios=$_POST['id_usuarios'];
	             	$mes=$_POST['mes'];
	             	$años=$_POST['año'];
	             	 
	             	$columnas="entidades.id_entidades,
							  entidades.nombre_entidades,
							  usuarios.id_usuarios,
							  usuarios.nombre_usuarios,
							  plan_cuentas.codigo_plan_cuentas,
							  plan_cuentas.nombre_plan_cuentas,
							  cuentas_cierre_mes.debe_dic,
							  cuentas_cierre_mes.haber_dic,
							  cuentas_cierre_mes.saldo_final_dic,
							  cuentas_cierre_mes.fecha_dic_cuentas_cierre_mes,
							  cuentas_cierre_mes.cerrado_dic_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
	             	$tablas=" public.plan_cuentas,
							  public.entidades,
							  public.cuentas_cierre_mes,
							  public.cierre_mes,
							  public.usuarios";
	             	$where=" plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
	             	cuentas_cierre_mes.id_cierre_mes = cierre_mes.id_cierre_mes AND
	             	cierre_mes.id_entidades = entidades.id_entidades AND
	             	cierre_mes.id_usuario_creador = usuarios.id_usuarios AND
	             	usuarios.id_entidades = entidades.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND cuentas_cierre_mes.cerrado_dic_cuentas_cierre_mes='TRUE'";
	             	$id="plan_cuentas.codigo_plan_cuentas";
	             	
	             	
	             	 
	             	 
	             	 
	             	$where_0 = "";
	             	$where_1 = "";
	             	$where_2 = "";
	             	$where_3 = "";
	             	
	             	if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	             	 
	             	if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
	             	 
	             	if($mes!=""){$where_2=" AND TO_CHAR(fecha_dic_cuentas_cierre_mes,'MM')='$mes'";}
	             	 
	             	if($años!=""){$where_3=" AND  cuentas_cierre_mes.year='$años'";}
	             	 
	             	 
	             	$where_to  = $where . $where_0 . $where_1 . $where_2 . $where_3;
	             	
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
	             			$html.='<center><span ><strong>MES DE DICIEMBRE</strong></span></center>';
	             			$html.='<div class="pull-left">';
	             			$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
	             			$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
	             			$html.='</div><br>';
	             			$html.='<section style="height:425px; overflow-y:scroll;">';
	             			$html.='<table class="table table-hover">';
	             			$html.='<thead>';
	             			$html.='<tr class="info">';
	             			$html.='<th>Entidad</th>';
	             			$html.='<th>Codigo</th>';
	             			$html.='<th>Cuenta</th>';
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
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->debe_dic.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->haber_dic.'</td>';
	             				$html.='<td style="color:#000000;font-size:80%;">'.$res->saldo_final_dic.'</td>';
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
	             			$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el mes y año seleccionado';
	             			$html.='</div>';
	             	
	             		}
	             		 
	             		echo $html;
	             		die();
	             		 
	             	}
	             }
					
					
	            
					//////////fin de simplificado////////////////////
					
					
				}
				else
				{
					
					$id_entidades=$_POST['id_entidades'];
					$id_usuarios=$_POST['id_usuarios'];
					$anio=$_POST['anio'];
					
					
					
					
					
					
					$columnas="entidades.id_entidades, 
							  entidades.nombre_entidades, 
							  usuarios.id_usuarios, 
							  usuarios.nombre_usuarios, 
							  plan_cuentas.codigo_plan_cuentas, 
							  plan_cuentas.nombre_plan_cuentas, 
							  cuentas_cierre_mes.cerrado_ene_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_feb_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_mar_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_abr_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_may_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_jun_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_jul_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_ago_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_sep_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_oct_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_nov_cuentas_cierre_mes, 
							  cuentas_cierre_mes.cerrado_dic_cuentas_cierre_mes,
	             			  cuentas_cierre_mes.year";
					$tablas=" public.plan_cuentas, 
							  public.entidades, 
							  public.cuentas_cierre_mes, 
							  public.cierre_mes, 
							  public.usuarios";
					$where="  cierre_mes.id_cierre_mes = cuentas_cierre_mes.id_cierre_mes AND
							  plan_cuentas.id_plan_cuentas = cuentas_cierre_mes.id_plan_cuentas AND
							  entidades.id_entidades = plan_cuentas.id_entidades AND
							  usuarios.id_entidades = entidades.id_entidades ";
					
					$id="plan_cuentas.codigo_plan_cuentas";
					 
					 
					
					
					
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					
					 
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
					
					if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
					
					if($anio!=0){$where_2=" AND  cuentas_cierre_mes.year='$anio'";}
					
					
					$where_to  = $where . $where_0 . $where_1 . $where_2 ;
					 
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
							//$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
							//$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
							$html.='</div><br>';
							$html.='<section style="height:300px; overflow-y:scroll;">';
							$html.='<table class="table table-hover" id="products-table"  style="overflow-y:scroll">';
							$html.='<thead>';
							$html.='<tr class="info">';
							$html.='<th>Entidad</th>';
							$html.='<th style="text-aling:center" colspan=2>Meses Cerrados</th>';
							$html.='<th colspan=11></th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
					
							foreach ($resultSet as $res)
							{
								 
								$_enero="ENERO";
								$_febrero="FEBRERO";
								$_marzo="MARZO";
								$_abril="ABRIL";
								$_mayo="MAYO";
								$_junio="JUNIO";
								$_julio="JULIO";
								$_agosto="AGOSTO";
								$_septiembre="SEPTIEMBRE";
								$_octubre="OCTUBRE";
								$_noviembre="NOVIEMBRE";
								$_diciembre="DICIEMBRE";
							
								
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_entidades.'</td>';
								if($res->cerrado_ene_cuentas_cierre_mes=="t"){
								$html.='<td style="color:#000000;font-size:80%;">'.$_enero.'</td>';
								}
								else{}
								if($res->cerrado_feb_cuentas_cierre_mes=="t"){
								$html.='<td style="color:#000000;font-size:80%;">'.$_febrero.'</td>';
								}
								else{}
								if($res->cerrado_mar_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_marzo.'</td>';
								}
								else{}
								if($res->cerrado_abr_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_abril.'</td>';
								}
								else{}
								if($res->cerrado_may_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_mayo.'</td>';
								}
								else{}
								if($res->cerrado_jun_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_junio.'</td>';
								}
								else{}
								if($res->cerrado_jul_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_julio.'</td>';
								}
								else{}
								if($res->cerrado_ago_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_agosto.'</td>';
								}
								else{}
								if($res->cerrado_sep_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_septiembre.'</td>';
								}
								else{}
								if($res->cerrado_oct_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_octubre.'</td>';
								}
								else{}
								if($res->cerrado_nov_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_noviembre.'</td>';
								}
								else{}
								if($res->cerrado_dic_cuentas_cierre_mes=="t"){
									$html.='<td style="color:#000000;font-size:80%;">'.$_diciembre.'</td>';
								}
								else{}
								$html.='</tr>';
								 
								break;
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
							$html.='<h4>Aviso!!!</h4> No hay datos para mostrar en el año seleccionado';
							$html.='</div>';
							 
						}
						 
						echo $html;
						die();
						 
					}
				}
		
			
				}else {
					
					
				}
			
			
			
		
			
	         if(isset($_POST["reporte_rpt"])){
				
				
			
				$reporte=$_POST['reporte'];
				
				
				if($reporte=="simplificado"){
					
					
					$parametros = array();
					$parametros['id_entidades']=isset($_POST['id_entidades'])?trim($_POST['id_entidades']):'';
					$parametros['id_usuarios']=isset($_POST['id_usuarios'])?trim($_POST['id_usuarios']):'';
					//$parametros['mes']=(isset($_POST['mes']))?trim($_POST['mes']):'';
					$parametros['anio']=isset($_POST['anio'])?trim($_POST['anio']):'';
					$parametros['reporte']='simplificado';
					$pagina="conBalanceComprobacionDetallado.aspx";
					
					$conexion_rpt = array();
					$conexion_rpt['pagina']=$pagina;
					//$conexion_rpt['port']="59584";
					
					$this->view("ReporteRpt", array(
							"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
					));
					die();
					
					
					//gcfhgchg
				}elseif($reporte=="detallado"){
				
					$parametros = array();
					$parametros['id_entidades']=isset($_POST['id_entidades'])?trim($_POST['id_entidades']):'';
					$parametros['id_usuarios']=isset($_POST['id_usuarios'])?trim($_POST['id_usuarios']):'';
					$parametros['mes']=isset($_POST['mes'])?trim($_POST['mes']):'';
					$parametros['anio']=isset($_POST['año'])?trim($_POST['año']):'';
					$parametros['reporte']='detallado';
					$pagina="conBalanceComprobacionDetallado.aspx";
					
					
					$conexion_rpt = array();
					$conexion_rpt['pagina']=$pagina;
					//$conexion_rpt['port']="59584";
					
					$this->view("ReporteRpt", array(
							"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
					));
					
					die();
					
				} 
				
					
				
			}else{
				
				
				
			}
			
			
			$this->view("BalanceComprobacionAdmin",array(
					"resultSet"=>$resultSet,
					"resultEnt"=>$resultEnt
						
			
			
			));
			
			
			
			
		}else
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