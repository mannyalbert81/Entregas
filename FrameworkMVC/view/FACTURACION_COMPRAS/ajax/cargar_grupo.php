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
		  	
		  	
			$query = pg_query($conn,"SELECT fc_grupo_productos.id_grupo_productos,
							  fc_grupo_productos.nombre_grupo_productos,
							  fc_grupo_productos.descripcion_grupo_productos,
							  fc_grupo_productos.id_entidades
					
					FROM public.fc_grupo_productos,
  						  public.entidades
					
					WHERE entidades.id_entidades = fc_grupo_productos.id_entidades AND fc_grupo_productos.id_usuario='$_id_usuarios'");
			
			if ($query!=""){
			
				?>
				
				
	        
				<?php
					
				} else {
					
					
				}
					?>
				
					<?php
					}
					?>
					
