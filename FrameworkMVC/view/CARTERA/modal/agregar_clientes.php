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
	      if (empty($_POST['ruc_clientes'])){
	 	
			$errors[] = "El ruc es requerido";
			
		} else if (empty($_POST['razon_social_clientes'])){
			
			$errors[] = "La razón social es requerida";
			
		}  else if (empty($_POST['id_provincias'])){
			
			$errors[] = "La provincia es requerida";
			
		}  else if (empty($_POST['id_ciudad'])){
			
			$errors[] = "La ciudad es requerida";
			
		} else if (empty($_POST['direccion_clientes'])){
			
			$errors[] = "La dirección es requerida";
			
		} else if (empty($_POST['telefono_clientes'])){
				
			$errors[] = "El teléfono es requerido";
				
		}  else if (empty($_POST['celular_clientes'])){
				
			$errors[] = "El celular es requerido";
				
		}  else if (empty($_POST['email_clientes'])){
				
			$errors[] = "El email es requerido";
				
		}
	       elseif (strlen($_POST['email_clientes']) > 64) {
	       	
			$errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
			
		} elseif (!filter_var($_POST['email_clientes'], FILTER_VALIDATE_EMAIL)) {
			
			$errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida. ";
		}
		
		
		$ruc_clientes=pg_escape_string($conn,(strip_tags($_POST["ruc_clientes"],ENT_QUOTES)));
		$razon_social_clientes=pg_escape_string($conn,(strip_tags($_POST["razon_social_clientes"],ENT_QUOTES)));
		$id_provincias=pg_escape_string($conn,(strip_tags($_POST["id_provincias"],ENT_QUOTES)));
		$id_ciudad=pg_escape_string($conn,(strip_tags($_POST["id_ciudad"],ENT_QUOTES)));
		$direccion_clientes=pg_escape_string($conn,(strip_tags($_POST["direccion_clientes"],ENT_QUOTES)));
		$telefono_clientes=pg_escape_string($conn,(strip_tags($_POST["telefono_clientes"],ENT_QUOTES)));
		$celular_clientes=pg_escape_string($conn,(strip_tags($_POST["celular_clientes"],ENT_QUOTES)));
		$email_clientes=pg_escape_string($conn,(strip_tags($_POST["email_clientes"],ENT_QUOTES)));
		
		
		$sql = "SELECT * FROM fc_clientes WHERE ruc_clientes = '" . $ruc_clientes . "' AND id_entidades = '" . $id_entidades . "';";
		$query_check_user_name = pg_query($conn,$sql);
		$query_check_user=pg_num_rows($query_check_user_name);
		
		if ($query_check_user == 1) {
			
			$errors[] = "Lo sentimos, el ruc ya existe.";
		}
		else 
		{

		
		$sql="INSERT INTO fc_clientes (id_clientes, ruc_clientes, razon_social_clientes, id_provincias, id_ciudad, direccion_clientes, telefono_clientes, celular_clientes, email_clientes, id_usuario, id_entidades) VALUES (DEFAULT,'$ruc_clientes','$razon_social_clientes','$id_provincias','$id_ciudad','$direccion_clientes','$telefono_clientes','$celular_clientes','$email_clientes','$_id_usuarios', '$id_entidades')";
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