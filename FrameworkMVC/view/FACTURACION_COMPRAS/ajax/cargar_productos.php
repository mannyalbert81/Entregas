<?php
  session_start();
  $_id_usuarios= $_SESSION['id_usuarios'];
  
    	$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad_des host=186.4.241.148");
		
		if(!$conn)
		{
			die( "No se pudo conectar");
		}

		
		 $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
		  if($action == 'ajax'){
		  
		  	$c =  pg_escape_string($conn,(strip_tags($_REQUEST['c'], ENT_QUOTES)));
		  
		  	if ( $_GET['c'] != "" )
		  	{
		  	
		  	//$q = "codigo_plan_cuentas LIKE '%".$q."%'";
		  	//$q = "nombre_plan_cuentas LIKE '%".$q."%'";
		  	}
		  	
		  
			include 'pagination.php'; 
			//las variables de paginación
			
			
			$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
			$per_page = 10; //la cantidad de registros que desea mostrar
			$adjacents  = 4; //brecha entre páginas después de varios adyacentes
			$offset = ($page - 1) * $per_page;
			
			
			
			
			$count_query   = pg_query($conn,"SELECT count(*) AS numrows FROM public.fc_productos, public.fc_foto_productos, public.usuarios, public.fc_grupo_productos, public.fc_catalogos, public.fc_unidades_medida, public.entidades WHERE fc_productos.id_entidades = entidades.id_entidades AND
            fc_foto_productos.id_foto_productos = fc_productos.id_foto_productos AND usuarios.id_usuarios = fc_productos.id_usuarios AND fc_grupo_productos.id_grupo_productos = fc_productos.id_grupo_productos AND fc_catalogos.id_catalogos = fc_productos.id_catalogos AND fc_unidades_medida.id_unidades_medida = fc_productos.id_unidades_medida AND entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios' AND (fc_productos.codigo_productos LIKE '%".$c."%' OR fc_productos.nombre_productos LIKE '%".$c."%') ");
			
			if ($row= pg_fetch_array($count_query)){$numrows = $row['numrows'];}
			$total_pages = ceil($numrows/$per_page);
			$reload = 'index.php';
			//consulta principal para recuperar los datos
			
			$query = pg_query($conn,"SELECT * FROM public.fc_productos, public.fc_foto_productos, public.usuarios, public.fc_grupo_productos, public.fc_catalogos, public.fc_unidades_medida, public.entidades WHERE fc_productos.id_entidades = entidades.id_entidades AND
            fc_foto_productos.id_foto_productos = fc_productos.id_foto_productos AND usuarios.id_usuarios = fc_productos.id_usuarios AND fc_grupo_productos.id_grupo_productos = fc_productos.id_grupo_productos AND fc_catalogos.id_catalogos = fc_productos.id_catalogos AND fc_unidades_medida.id_unidades_medida = fc_productos.id_unidades_medida AND entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'  AND (fc_productos.codigo_productos LIKE '%".$c."%' OR fc_productos.nombre_productos LIKE '%".$c."%') ORDER BY fc_productos.id_productos LIMIT $per_page OFFSET $offset");
			
			if ($numrows>0){
				?>
				 <section style="height:425px; overflow-y:scroll;">
                  <table class="table table-hover">
					  <thead>
						<tr class="info">
						  <th></th>
						  <th style="text-align: center;">Codigo</th>
						  <th style="text-align: center;">Nombre</th>
						  <th style="text-align: center;">Grupo</th>
						  <th style="text-align: center;">$ 1</th>
						  <th style="text-align: center;">$ 2</th>
						  <th style="text-align: center;">$ 3</th>
						  <th style="text-align: center;">U/M</th>
						  <th style="text-align: center;">IVA</th>
						  <th style="text-align: center;">Ficha</th>
						  <th style="text-align: center;">Catálogo</th>
						</tr>
					</thead>
					<tbody>
					<?php
					while($row = pg_fetch_array($query)){
						
						$id_productos=$row['id_productos'];
						$id_catalogos=$row['id_catalogos'];
						$id_entidades= $row['id_entidades'];
						
						?>
						<tr>
						    <td> <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $row['id_foto_productos']; ?>&id_nombre=id_foto_productos&tabla=fc_foto_productos&campo=archivo_foto_productos"  alt="<?php $row['id_foto_productos']; ?>" width="60" height="60" ></td>
		                    <td><?php echo $row['codigo_productos'];?></td>
							<td><?php echo $row['nombre_productos'];?></td>
							<td><?php echo $row['nombre_grupo_productos'];?></td>
							<td><?php if ($row['precio_uno_productos']==""){ echo "0.0000";}else { echo $row['precio_uno_productos'];}?></td>
							<td><?php if ($row['precio_dos_productos']==""){ echo "0.0000";}else { echo $row['precio_dos_productos'];}?></td>
							<td><?php if ($row['precio_tres_productos']==""){ echo "0.0000";}else { echo $row['precio_tres_productos'];}?></td>
							<td><?php echo $row['nombre_unidades_medida'];?></td>
							<td><?php if ($row['iva_productos']=="t"){ echo "Si";}else { echo "No";}?></td>
							<td>
							<span class="pull-right">
							<a href="index.php?controller=FC_Productos&action=Ficha&id_productos=<?php echo $id_productos; ?>&id_entidades=<?php echo $id_entidades; ?>" target="_blank">--Ver--</a>
							</span>
							</td>
							<td>
							<span class="pull-right">
							<a href="http://localhost:4000/contabilidad/FrameworkMVC/view/DevuelveCatalogoView.php?id_catalogos=<?php echo $id_catalogos; ?>" target="blank">--Ver--</a>
			            	</span>
							</td>
					
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
				</section>
				
				<div class="table-pagination pull-right">
					<?php echo paginate($reload, $page, $total_pages, $adjacents);?>
				</div>
				<div class="col-md-3 col-lg-3 pull-left" style="margin-bottom:0px;">
				<span><strong>Registros: </strong><?php echo $numrows;?></span>
				</div>
		
				
					<?php
					
				} else {
					?>
					<div class="alert alert-warning alert-dismissable">
		              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		              <h4>Aviso!!!</h4> No hay datos para mostrar
		              
		            </div>
					<?php
				}
			}
					
?>