<?php

	# conectare la base de datos
	
	session_start();
	$_id_usuarios= $_SESSION['id_usuarios'];
	
		
	
	
	$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad_des host=186.4.241.148");
	
	if(!$conn)
	{
		die( "No se pudo conectar");
	}

	$query   = pg_query($conn,"SELECT usuarios.id_entidades FROM public.usuarios, public.entidades WHERE entidades.id_entidades = usuarios.id_entidades AND usuarios.id_usuarios='$_id_usuarios'");
	
	while($row = pg_fetch_array($query)){
	
		$id_entidades=$row['id_entidades'];
	
		
						}
	
	
	/*Inicia validacion del lado del servidor*/
	 if (empty($_POST['nombre_grupo_productos'])){
	 	
			$errors[] = "El nombre es requerido";
			
		} else if (empty($_POST['descripcion_grupo_productos'])){
			
			$errors[] = "La descripción es requerida";
			
		}  
		
		$nombre_grupo_productos=pg_escape_string($conn,(strip_tags($_POST["nombre_grupo_productos"],ENT_QUOTES)));
		$descripcion_grupo_productos=pg_escape_string($conn,(strip_tags($_POST["descripcion_grupo_productos"],ENT_QUOTES)));
		
		
		$sql = "SELECT * FROM fc_grupo_productos WHERE nombre_grupo_productos = '" . $nombre_grupo_productos . "' AND id_entidades = '" . $id_entidades . "';";
		$query_check_user_name = pg_query($conn,$sql);
		$query_check_user=pg_num_rows($query_check_user_name);
		
		if ($query_check_user == 1) {
			
			$errors[] = "Lo sentimos , el nombre de grupo ya existe.";
		}
		else 
		{

		
		$sql="INSERT INTO fc_grupo_productos (id_grupo_productos, nombre_grupo_productos, descripcion_grupo_productos, id_usuario, id_entidades) VALUES (DEFAULT,'$nombre_grupo_productos','$descripcion_grupo_productos','$_id_usuarios', '$id_entidades')";
		$query_new_insert = pg_query($conn,$sql);
			if ($query_new_insert){
				$messages[] = "Los datos han sido guardados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".($conn);
			}
		} 
		
		
		
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>	