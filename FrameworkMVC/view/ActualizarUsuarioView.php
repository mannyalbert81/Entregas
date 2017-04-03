
   <?php include("view/modulos/head.php"); ?>

<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        
        <title>Actualizar Usuarios - Contabilidad 2016</title>
         <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
			  <script src="view/js/ValidarActualizarUsuario.js"></script>
		
		
        
    </head>
   <body class="cuerpo">
      
        <?php include("view/modulos/menu.php"); ?>
        
        
 
  
     <div class="container">
  
  	<div class="row" style="background-color: #FAFAFA;">
 
    
      <!-- empieza el form --> 
        
      <form id="form-Actualizar_Usuario" action="<?php echo $helper->url("Usuarios","Actualiza"); ?>" method="post" enctype="multipart/form-data" class="col-lg-6">
            <br>
           
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
           
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Actualizar Datos de Usuario</h4>
	         </div>
	         <div class="panel-body">
  			
		     <div class="row">
            	
            	 <div class="col-xs-6 col-md-6">
				 <div class="form-group">
				       
					   					  <label for="cedula_usuarios" class="control-label">Cedula</label>
		                                  <input type="text" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value="<?php echo $resEdit->cedula_usuarios; ?>"  placeholder="Cedula Usuarios">
		                                  <span class="help-block"></span>
				 </div>
				 </div>
            	
            	 <div class="col-xs-6 col-md-6">
		         <div class="form-group">
		                                  <label for="id_ciudad" class="control-label">Ciudad</label>
		                                  <select name="id_ciudad" id="id_ciudad"  class="form-control" >
		                                        <option value="" selected="selected">--Seleccione--</option>
											<?php foreach($resultCiu as $resCiu) {?>
												<option value="<?php echo $resCiu->id_ciudad; ?>"  <?php if ($resCiu->id_ciudad == $resEdit->id_ciudad ) echo ' selected="selected" '  ; ?> ><?php echo $resCiu->nombre_ciudad; ?> </option>
					       					<?php } ?>
										  </select> 
		                                  <span class="help-block"></span>
		          </div>
				  </div>
			   	  </div>
            
            	<div class="row">
            	
            	 <div class="col-xs-6 col-md-6">
		    	 <div class="form-group">
		       
			   					<label for="nombre_usuarios" class="control-label">Nombres Usuario</label>
                                  <input type="text" class="form-control" id="nombre_usuarios" name="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>"  placeholder="Nombre Usuarios">
                                  <span class="help-block"></span>
				 </div>
		   	 	 </div>
		   	 	 
		   	 	 <div class="col-xs-6 col-md-6">
		    	 <div class="form-group">
		       
			   					<label for="usuario_usuarios" class="control-label">Usuarios</label>
                                  <input type="text" class="form-control" id="usuario_usuarios" name="usuario_usuarios" value="<?php echo $resEdit->usuario_usuarios; ?>"  placeholder="Usuarios">
                                  <span class="help-block"></span>
				 </div>
		   	 	 </div>        	
		   	  	 </div>
		   	  	 
		   	  	 <div class="row">
		   	  	 <div class="col-xs-6 col-md-6">
		    	 <div class="form-group">
		       
			   					<label for="clave_usuarios" class="control-label">Clave Usuario</label>
                                  <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value=""  placeholder="Clave Usuario">
                                  <span class="help-block"></span>
				 </div>
		   	 	 </div> 
		   
		     <div class="col-xs-6 col-md-6">
		    	 <div class="form-group">
		       
			   					<label for="cclave_usuarios" class="control-label">Repita Clave Usuario</label>
                                  <input type="password" class="form-control" id="cclave_usuarios" name="cclave_usuarios" value=""  placeholder="Repita Clave Usuario">
                                  <span class="help-block"></span>
				 </div>
		   	 	 </div>  
		   	 	 </div> 
		   	 	 
		   	 	  <div class="row">
		   	  	 <div class="col-xs-6 col-md-6">
		    	 <div class="form-group">
		       
			   					<label for="telefono_usuarios" class="control-label">Teléfono Usuario</label>
                                  <input type="text" class="form-control" id="telefono_usuarios" name="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>"  placeholder="Teléfono Usuario">
                                  <span class="help-block"></span>
				 </div>
		   	 	 </div> 
		   	 	 
		   	 	 
		   	 	 
		   	  	 <div class="col-xs-6 col-md-6">
		    	 <div class="form-group">
		       
			   					<label for="celular_usuarios" class="control-label">Celular Usuario</label>
                                  <input type="text" class="form-control" id="celular_usuarios" name="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>"  placeholder="Celular Usuario">
                                  <span class="help-block"></span>
				 </div>
		   	 	 </div>  
		   	 	 </div>    	
		 			
		   	 	 <div class="row">
            	 
            	 <div class="col-xs-6 col-md-6">
		    	 <div class="form-group">
		       
			   					<label for="correo_usuarios" class="control-label">Correo Usuario</label>
                                  <input type="email" class="form-control" id="correo_usuarios" name="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>"  placeholder="Correo Usuario">
                                  <span class="help-block"></span>
				 </div>
		   	 	 </div> 
		       	 
		       	 <div class="col-xs-6 col-md-6">
		         <div class="form-group">
                                  <label for="imagen_usuarios" class="control-label">Foto</label>
                                  <input type="file" class="form-control" id="imagen_usuarios" name="imagen_usuarios" value="">
                                  <span class="help-block"></span>
            	</div>
		   		</div>			  
            	</div>
            	<div class="row">
		        <div class="col-xs-12 col-md-12" style="text-align: center; margin-top:28px" >     
                <input type="submit" value="Actualizar" name="Guardar" id="Guardar"  onClick="Ok()" class="btn btn-success"/>
           
           		</div>    
                </div>
            	  
		   	 	
		    
		    </div>
	        </div>
	        </div>
	        
           
           
           
            
		     <?php } } else {?>
		    
		    	
		     <?php } ?>
		             
          	</form>
              
              
        	 
	         <div class="col-lg-6">
	         <br>
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Fotografia del Usuario</h4>
	         </div>
	         <div class="panel-body">
  			
		    <div class="col-xs-12 col-md-12" style="margin-top:20px">
       		 <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $_SESSION['id_usuarios']; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $_SESSION['id_usuarios'];?>" width="450" height="400"  style="float:left;" >
 			</div>
		    
		    </div>
	        </div>
	        </div>
	              
              
         
       </div>
       </div>
       
       <br>
       <br>
       <br>
       
       <?php include("view/modulos/footer.php"); ?>
     </body>  
    </html>   