		<?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       
       
<!DOCTYPE HTML>
<html lang="es">

      <head>
          <meta charset="utf-8"/>
         <title>Clientes - Contabilidad 2016</title>
      
      
      
		  <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarUsuarios.js"></script>
		
			
    </head>
    <body class="cuerpo">
    
      <?php include("view/modulos/menu.php"); ?>
    
  	  <div class="container">
  
  	  <div class="row" style="background-color: #FAFAFA;">
      
      <!-- empieza el form --> 
       
      <form  id="form-usuarios" action="<?php echo $helper->url("Clientes","InsertaClientes"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-5">
            <br>
           
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
           
            <div class="well">
            <h4 style="color:#ec971f;">Clientes</h4>
            <hr/>
            <div class="row">
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="ruc_clientes" class="control-label">Ruc</label>
                                  <input type="text" class="form-control" id="ruc_clientes" name="ruc_clientes" value="<?php echo $resEdit->ruc_clientes; ?>"  placeholder="Ruc Clientes">
                                    <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="<?php echo $resEdit->id_clientes; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		    
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="razon_social_clientes" class="control-label">Razón Social</label>
                                  <input type="text" class="form-control" id="razon_social_clientes" name="razon_social_clientes" value="<?php echo $resEdit->razon_social_clientes; ?>"  placeholder="Razón Social">
                                    <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="<?php echo $resEdit->id_clientes; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		  	</div>
		  	
		  	 <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="provincias" class="control-label">Provincias</label>
                                  <select name="provincias" id="provincias"  class="form-control" >
			  	       					 <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultPro as $resPro) {?>
										<option value="<?php echo $resPro->id_provincias; ?>" <?php if ($resPro->id_provincias == $resPro->id_provincias )  echo  ' selected="selected" '  ;  ?> ><?php echo $resPro->nombre_provincias; ?> </option>
			        				<?php } ?>
									</select> 
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
		       
			   					<label for="direccion_clientes" class="control-label">Dirección</label>
                                  <input type="text" class="form-control" id="direccion_clientes" name="direccion_clientes" value="<?php echo $resEdit->direccion_clientes; ?>"  placeholder="Dirección Clientes">
                                    <input type="hidden" class="form-control" id="id_clientes" name="id_clientes" value="<?php echo $resEdit->id_clientes; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		    
            <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="telefono_clientes" class="control-label">Teléfono</label>
                                  <input type="text" class="form-control" id="telefono_clientes" name="telefono_clientes" value="<?php echo $resEdit->telefono_clientes; ?>"  placeholder="Telefono Clientes">
                                    <input type="hidden" class="form-control" id="id_tipo_contribuyente" name="id_tipo_contribuyente" value="<?php echo $resEdit->id_tipo_contribuyente; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
			</div>
            
			<div class="row">
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="nombre_tipo_contribuyente" class="control-label">Celular</label>
                                  <input type="text" class="form-control" id="nombre_tipo_contribuyente" name="nombre_tipo_contribuyente" value="<?php echo $resEdit->nombre_tipo_contribuyente; ?>"  placeholder="Nombre Tipo de Contribuyente">
                                    <input type="hidden" class="form-control" id="id_tipo_contribuyente" name="id_tipo_contribuyente" value="<?php echo $resEdit->id_tipo_contribuyente; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		    
            
             <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="nombre_tipo_contribuyente" class="control-label">E-mail</label>
                                  <input type="text" class="form-control" id="nombre_tipo_contribuyente" name="nombre_tipo_contribuyente" value="<?php echo $resEdit->nombre_tipo_contribuyente; ?>"  placeholder="Nombre Tipo de Contribuyente">
                                    <input type="hidden" class="form-control" id="id_tipo_contribuyente" name="id_tipo_contribuyente" value="<?php echo $resEdit->id_tipo_contribuyente; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
			</div>  
			
		  		    
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="estados" class="control-label">Usuarios</label>
                                  <select name="estados" id="estados"  class="form-control" >
			  	       					 <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultEst as $resEst) {?>
										<option value="<?php echo $resEst->id_estado; ?>" <?php if ($resEst->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $resEst->nombre_estado; ?> </option>
			        				<?php } ?>
									</select> 
                                   <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-6 col-md-6">
            <div class="form-group">
                                  <label for="id_ciudad" class="control-label">Entidades</label>
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
		    
		    </div>
		     <hr>
            
            
		     <?php } } else {?>
		    
		    
            <div class="well">
            <h4 style="color:#ec971f;">Clientes</h4>
            <hr/>
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="ruc_clientes" class="control-label">Ruc</label>
                                  <input type="text" class="form-control" id="ruc_clientes" name="ruc_clientes" value=""  placeholder="Ruc Clientes">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="razon_social_clientes" class="control-label">Razón Social</label>
                                  <input type="text" class="form-control" id="razon_social_clientes" name="razon_social_clientes" value=""  placeholder="Razón Social">
                                  <span class="help-block"></span>
            </div>
            </div>
		 	</div>
		 	
		 	
		 	  <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="provincias" class="control-label">Provincia</label>
                                  <select name="provincias" id="provincias"  class="form-control" >
			  	       					 <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultPro as $resPro) {?>
										<option value="<?php echo $resPro->id_provincias; ?>"  ><?php echo $resPro->nombre_provincias; ?> </option>
			        				<?php } ?>
									</select> 
                                   <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-6 col-md-6">
            <div class="form-group">
                                  <label for="id_ciudad" class="control-label">Ciudad</label>
                                  <select name="id_ciudad" id="id_ciudad"  class="form-control" >
                                        <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCiu as $resCiu) {?>
										<option value="<?php echo $resCiu->id_ciudad; ?>"  ><?php echo $resCiu->nombre_ciudad; ?> </option>
			       					<?php } ?>
								  </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
			</div>
		       
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="direccion_clientes" class="control-label">Dirección</label>
                                  <input type="text" class="form-control" id="direccion_clientes" name="direccion_clientes" value=""  placeholder="Dirección Clientes">
                                  <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-6 col-md-6">
            <div class="form-group">
                                  <label for="telefono_clientes" class="control-label">Teléfono</label>
                                  <input type="text" class="form-control" id="telefono_clientes" name="telefono_clientes" value=""  placeholder="Teléfono Clientes">
                                  <span class="help-block"></span>
            </div>
		    </div>
			</div>
		       
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="clave_usuarios" class="control-label">Celular</label>
                                  <input type="password" class="form-control" id="clave_usuarios" name="clave_usuarios" value=""  placeholder="Clave">
                                  <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-6 col-md-6">
            <div class="form-group">
                                  <label for="cclave_usuarios" class="control-label">E-mail</label>
                                  <input type="password" class="form-control" id="cclave_usuarios" name="cclave_usuarios" value=""  placeholder="Confirme Clave">
                                  <span class="help-block"></span>
            </div>
		    </div>
			</div> 
			  
		    
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="estados" class="control-label">Usuarios</label>
                                  <select name="estados" id="estados"  class="form-control" >
			  	       					 <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultEst as $resEst) {?>
										<option value="<?php echo $resEst->id_estado; ?>"  ><?php echo $resEst->nombre_estado; ?> </option>
			        				<?php } ?>
									</select> 
                                   <span class="help-block"></span>
            </div>
            </div>
            <div class="col-xs-6 col-md-6">
            <div class="form-group">
                                  <label for="id_ciudad" class="control-label">Entidades</label>
                                  <select name="id_ciudad" id="id_ciudad"  class="form-control" >
                                        <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCiu as $resCiu) {?>
										<option value="<?php echo $resCiu->id_ciudad; ?>"  ><?php echo $resCiu->nombre_ciudad; ?> </option>
			       					<?php } ?>
								  </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
			</div>
		      
			</div> 
			
		   
		    
		   
           
		     <?php } ?>
		     
		    <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
		    <div class="form-group">
                                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
            </div>
		    </div>
		    </div>
		    </form>
       
         
       
       		<form action="<?php echo $helper->url("Clientes","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-7">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Clientes Registrados</h4>
                        
       
       <div class="datagrid"> 
       <section style="height:485px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
		            <th style="font-size:100%;"></th>
		    		<th style="font-size:100%;">Nombre</th>
		    		<th style="font-size:100%;">Usuario</th>
		    		<th style="font-size:100%;">Correo</th>
		    		<th style="font-size:100%;">Rol</th>
		    		<th style="font-size:100%;">Estado</th>
		    		<th></th>
		    		<th></th>
		    		<th></th>
	  		</tr>
	   </thead>
       <tfoot>
       		<tr>
					<td colspan="10">
						<div id="paging">
							<ul>
								<li>
									<a href="#">
						<span>Previous</span>
									</a>
								</li>
								<li>
									<a href="#" class="active">
						<span>1</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>2</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>3</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>4</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>5</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>Next</span>
									</a>
								</li>
								</ul>
						</div>
					
			</tr>
       				
       </tfoot>
       
                <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        	 
               
	   <tbody>
	   		<tr>
	        		   <td> <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $res->id_usuarios; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $res->id_usuarios; ?>" width="80" height="60" >      </td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_usuarios; ?>     </td> 
		               <td style="font-size:80%;"> <?php echo $res->usuario_usuarios; ?>  </td>
		               <td style="font-size:80%;"> <?php echo $res->correo_usuarios; ?>  </td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_rol; ?>  </td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_estado; ?>  </td>
		           	   <td>
			           			<div class="right">
			                    	<a href="<?php echo $helper->url("Clientes","index"); ?>&id_usuarios=<?php echo $res->id_usuarios; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			               		</div>
			            
			           </td>
			           <td>   
			                	<div class="right">
			                    	<a href="<?php echo $helper->url("Clientes","borrarId"); ?>&id_usuarios=<?php echo $res->id_usuarios; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
			                	</div>
			           </td>
		               
		     </tr>
	   
	   </tbody>	
	        		
		        <?php } }else{ ?>
            <tr>
            <td></td>
            <td></td>
	                   <td colspan="5" style="color:#ec971f;font-size:8;"> <?php echo '<span id="snResult">No existen resultados</span>' ?></td>
	        <td></td>
		               
		    </tr>
            <?php 
		}
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
		     
      </section>
      
       </div>
        </div>
          </form>
      
      </div>
      </div>
        <br>
         <br>
          <br>
           
			 
			 		 
			 <footer class="col-lg-12">
			 <?php include("view/modulos/footer.php"); ?>
			 </footer> 
			 </body>  
			 </html>   