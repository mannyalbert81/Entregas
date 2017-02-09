<?php

class ReporteUsuariosAdminController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//maycol

		
	
	public function index(){
	
		session_start();
		$_id_usuarios= $_SESSION['id_usuarios'];
		//Creamos el objeto usuario
		$resultSet="";
		$registrosTotales = 0;
		$arraySel = "";
		
		$usuarios = new UsuariosModel();
		
		$entidades = new EntidadesModel();
		$resultEnt=$entidades->getAll("nombre_entidades");
		
		$rol = new RolesModel();
		$resultRol=$rol->getBy("nombre_rol='ADMINISTRADOR' OR nombre_rol='CLIENTE' OR nombre_rol='CONTADOR' OR nombre_rol='VISITANTE' OR nombre_rol='USUARIO'");
		
		$estado = new EstadoModel();
		$resultEst=$estado->getAll("nombre_estado");
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ReporteUsuariosAdmin";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["id_entidades"])){
	
	
					$id_entidades=$_POST['id_entidades'];
					$nombre_usuarios=$_POST['nombre_usuarios'];
					$cedula_usuarios=$_POST['cedula_usuarios'];
					$correo_usuarios=$_POST['correo_usuarios'];
					$id_rol=$_POST['id_rol'];
					$id_estado=$_POST['id_estado'];
						
					
	
						
					$columnas = "  	  usuarios.id_usuarios, 
									  usuarios.nombre_usuarios, 
									  usuarios.telefono_usuarios, 
									  usuarios.celular_usuarios, 
									  usuarios.correo_usuarios, 
									  rol.nombre_rol, 
									  estado.nombre_estado, 
									  usuarios.creado, 
									  usuarios.cedula_usuarios, 
									  usuarios.imagen_usuarios, 
									  entidades.id_entidades, 
									  entidades.ruc_entidades, 
									  entidades.nombre_entidades, 
									  entidades.telefono_entidades, 
									  entidades.direccion_entidades, 
									  entidades.ciudad_entidades, 
									  entidades.logo_entidades";
	
	
	
					$tablas=" public.usuarios, 
							  public.rol, 
							  public.estado, 
							  public.entidades";
	
					$where="rol.id_rol = usuarios.id_rol AND
							  estado.id_estado = usuarios.id_estado AND
							  entidades.id_entidades = usuarios.id_entidades";
	
					$id="usuarios.id_usuarios";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_5 = "";
						
				
					
			
	
					if($id_entidades!=0){$where_0=" AND entidades.id_entidades='$id_entidades'";}
	
					if($nombre_usuarios!=""){$where_1=" AND usuarios.nombre_usuarios LIKE '%$nombre_usuarios%'";}
	
					if($cedula_usuarios!=""){$where_2=" AND usuarios.cedula_usuarios = '$cedula_usuarios'";}
						
					if($correo_usuarios!=""){$where_3=" AND usuarios.correo_usuarios LIKE '%$correo_usuarios%'";}
	
					if($id_rol!=0){$where_4=" AND rol.id_rol ='$id_rol'";}
	
					if($id_estado!=0){$where_5=" AND estado.id_estado ='$id_estado'";}
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3. $where_4. $where_5;
	
	
					//$resultSet=$ccomprobantes->getCondiciones($columnas ,$tablas , $where_to, $id);
	
					
					//comienza paginacion
					
					
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
					
					if($action == 'ajax')
					{
						$html="";
						$resultSet=$usuarios->getCantidad("*", $tablas, $where_to);
						$cantidadResult=(int)$resultSet[0]->total;
							
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
							
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
							
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
						$resultSet=$usuarios->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
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
							$html.='<th>Fotografia</th>';
							$html.='<th>Nombre</th>';
							$html.='<th>Cedula</th>';
							$html.='<th>Correo</th>';
							$html.='<th>Telefono</th>';
							$html.='<th>Rol</th>';
							$html.='<th>Estado</th>';
							$html.='<th>Entidad</th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
					
							foreach ($resultSet as $res)
							{
								//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
						
									
								$html.='<tr>';
								$html.='<td><input type="image" name="image" src="view/DevuelveImagen.php?id_valor='.$res->id_usuarios.'&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="'. $res->id_usuarios.'" width="80" height="60" ></td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_usuarios.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->cedula_usuarios.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->correo_usuarios.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->telefono_usuarios.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_rol.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_estado.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_entidades.'</td>';
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
						$parametros['nombre_usuarios']=(isset($_POST['nombre_usuarios']))?trim($_POST['nombre_usuarios']):'';
						$parametros['cedula_usuarios']=(isset($_POST['cedula_usuarios']))?trim($_POST['cedula_usuarios']):'';
						$parametros['correo_usuarios']=(isset($_POST['correo_usuarios']))?trim($_POST['correo_usuarios']):'';
						$parametros['id_rol']=(isset($_POST['id_rol']))?trim($_POST['id_rol']):'';
						$parametros['id_estado']=(isset($_POST['id_estado']))?trim($_POST['id_estado']):'';
						
						//para local 
						$pagina="conReporteUsuarios.aspx";
												
						$conexion_rpt = array();
						$conexion_rpt['pagina']=$pagina;
						//$conexion_rpt['port']="59584";
						
						$this->view("ReporteRpt", array(
								"parametros"=>$parametros,"conexion_rpt"=>$conexion_rpt
						));
						
						die();
						
					}
					
	
		}
	
				
				$this->view("ReporteUsuariosAdmin",array(
						"resultSet"=>$resultSet, "resultRol"=> $resultRol,
						"resultEnt"=>$resultEnt, "resultEst"=> $resultEst
						
							
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Reporte Usuarios Administrador"
	
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
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_admin(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_admin(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_admin(1)'>1</a></li>";
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
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_admin(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_admin(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_usuarios_admin($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_usuarios_admin(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	
    
		
}
?>