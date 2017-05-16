<!DOCTYPE html>
<html lang="en">
<head>

<?php require_once 'config/global.php';?> 

  <title>Contabilidad - 2016</title>
  <link rel="shortcut icon" href="view/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
   		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="view/css/estilos.css">
		<link rel="stylesheet" href="view/css/bootstrap.css">
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        
        <style>

.sub-menu {
    padding: 0;
    max-height: 200px; /* 1.5 x 3 */
    overflow-y: auto;
}
</style>
		


<script>
$(document).ready(function(){
	$("46").click(function(){
		alert("hola");

		});
});

</script>

<!-- para hacer que refresque pag -->
	
	<script>
    $(document).ready(function(){
        
    	setTimeout( '$("#noti_btn").load();' , 1000);
    });
	</script>
 
 <style>	
			.Icon input{
background: #A8A6A6;
padding: 0px;
border-radius: 100px;
float:left;
}
		.Icon{
	margin-top: 0px;
	margin-bottom:0px; 
    color: #FFF;
    font-size: 40px;
    text-align: center;
}	
	
			</style>	
	
</head>
<body>

<div class="container"  style=" -webkit-box-shadow: 0px 2px 2px 2px rgba(0,0,0,0.49);-moz-box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.49); box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.49);">
  
  
  <div class="row head" class="col-xs-6 col-md-8" style="text-align: center;">
  
  <div style=" margin-top: 10px;  text-align: center;"   class="col-xs-6 col-md-8"  >
  <img src="view/images/logo.png" class="img-responsive" alt="Responsive image" width="350" height="350">
  </div>
  
 
  
  <div  style="margin-top: 20px;" class="col-xs-6 col-md-4">
 		<div class="">
 		
 		<p> <strong> <?php //echo CLIENTE?>  </strong>  </p>
 		</div>	
		<?php  
		$status = session_status();
		
			 if  (isset( $_SESSION['nombre_usuarios'] ))  {  
		?>
		
		<?php /*
			$usuarios = new UsuariosModel();
			$id_usuarios=$_SESSION['id_usuarios'];
			$resultRol1 = $usuarios->getBy("id_usuarios=$id_usuarios");
			$_id_rol1=$resultRol1[0]->id_rol;
			
			if($_id_rol1=="6"){
				
				$_nombre_rol="SUPER ADMINISTRADOR";
				?>
				
				<span><FONT SIZE=3 style="color:#FFFFFF;"><b><?php echo $_nombre_rol;?></b></FONT></span>
			    
			    
			<?php
			}else{
				
				$rol = new RolesModel();
				$resultNomRol = $rol->getBy("id_rol=$_id_rol1");
				$_nombre_rol1=$resultNomRol[0]->nombre_rol;
				$_id_entidades=$resultRol1[0]->id_entidades;
				
				$entidades = new EntidadesModel();
				$resultNomEnt = $entidades->getBy("id_entidades=$_id_entidades");
				$_nombre_entidades=$resultNomEnt[0]->nombre_entidades;
				
				?>
				
				<span><FONT SIZE=3 style="color:#FFFFFF;"><b><?php echo $_nombre_rol1.' DE '.$_nombre_entidades;?></b></FONT></span>
			<?php	
			}*/
			?>	 
		 <div class="Icon">
		 <input class="col-xs-2 col-md-2" type="image" src="view/DevuelveImagen.php?id_valor=<?php echo $_SESSION['id_usuarios']; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $_SESSION['id_usuarios'];?> width="70" height="60"">
 		 </div>
		 <div class="col-xs-10 col-md-10" style ="margin-top: 15px;">
		 <div class="dropdown" class="col-xs-10 col-md-10">
				  <button id="noti_btn" class="col-xs-10 col-md-10 btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><span class="col-xs-10 col-md-10 glyphicon glyphicon-user" ><?php echo " ".$_SESSION['nombre_usuarios'];?></span>
				  <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu col-xs-10 col-md-10" style ="margin-top: 40px;">
				    <li><a href="index.php?controller=Usuarios&action=cerrar_sesion">Cerrar Sesión</a></li>
				    <li><a href="index.php?controller=Usuarios&action=Actualiza">Actualizar Datos de Usuario</a></li>
				    <li><a href="#">Conectado desde: <?php echo $_SESSION['ip_usuarios']?></a></li>
				  </ul>
		 </div>
		 </div>
		 <?php  } else { ?>
			<div class="dropdown" class="col-xs-6 col-md-6">
				<button class="btn btn-success dropdown-toggle col-xs-6 col-md-6"  style="float:left"; type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-lock col-xs-4 col-md-6"> Iniciar Sesión </span>
			    </button>
		    </div>
		<?php }?>
		 
   </div>  
   </div>
 </div>
   
</body>
</html>
