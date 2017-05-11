<?php include("view/modulos/head.php"); ?>
      
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Permisos Roles - Control Entrega - 2017</title>
        <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarTipoComprobantes.js"></script>
    </head>
    <body class="cuerpo">
    
     
       
       <?php include("view/modulos/menu.php"); ?>
  
   <div class="container">
  
  <div class="row" style="background-color: #FAFAFA;">
 
       
      <form id="form-permisos-roles" action="<?php echo $helper->url("PermisosRoles","InsertaPermisosRoles"); ?>" method="post" enctype="multipart/form-data" class="col-lg-4">
<br>
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	            	
	            
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Nombres Permisos Roles</h4>
	         </div>
	         <div class="panel-body">
  			
		     	<div class="row">
		     	
		     	<div class="col-xs-6 col-md-12">
		    <div class="form-group">
               <label for="nombre_permisos_rol" class="control-label">Nombre:</label>
					  	<input type="text" id="nombre_permisos_rol" name="nombre_permisos_rol" value="<?php echo $resEdit->nombre_permisos_rol; ?>" class="form-control"/>
					  	<div id="mensaje_nombres" class="errores"></div>
					  	 <span class="help-block"></span>                 
            </div>
		    </div>
		     	
			  
	            	
	            	
	            	<div class="col-xs-6 col-md-12">
		   			 <div class="form-group">
	            	<label for="id_rol" class="control-label">Rol:</label>
	            	 <select name="id_rol" id="id_rol"  class="form-control">
									<?php foreach($resultRol as $resRol) {?>
				 						<option value="<?php echo $resRol->id_rol; ?>" <?php if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $resRol->nombre_rol; ?> </option>
						            <?php } ?>
								    	
									</select>
									<span class="help-block"></span>
									
					</div>
					</div>
					
					
					<div class="col-xs-6 col-md-12">
		   			 <div class="form-group">
	            	<label for="id_rol" class="control-label">Controlador:</label>
		   		   
	            	 <select name="id_controladores" id="id_controladores"  class="form-control">
									<?php foreach($resultCon as $resCon) {?>
				 						<option value="<?php echo $resCon->id_controladores; ?>" <?php if ($resCon->id_controladores == $resEdit->id_controladores )  echo  ' selected="selected" '  ;  ?> ><?php echo $resCon->nombre_controladores; ?> </option>
						            <?php } ?>
								    	
									</select>
									
									
					</div>
					</div>
		   		   
		   		   <table class="table">
		   		   	<tr>
		   		   		<th style="width: 33.3%" > Ver</th>
		   		   		<th style="width: 33.3%"> Editar</th>
		   		   		<th style="width: 33.3%"> Borrar</th>
		   		   	</tr>
		   		   	<tr>
					  <td> 
		   		   		<select name="ver_permisos_rol" id="ver_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->ver_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->ver_permisos_rol =='f')  echo ' selected="selected" ' ; ?> >Denegar </option>
					    </select>
		   		   		</td>
		   		   		<td> 
		   		   		<select name="editar_permisos_rol" id="editat_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->editar_permisos_rol =='t')  echo ' selected="selected" ' ; ?>>Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->editar_permisos_rol =='f')  echo ' selected="selected" ' ; ?>  >Denegar </option>
					    </select>
					    </td>
		   		   		<td>
		   		   		<select name="borrar_permisos_rol" id="borrar_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->borrar_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->borrar_permisos_rol =='f')  echo ' selected="selected" ' ; ?>  >Denegar </option>
					    </select>
		   		   		</td>
		   		
		   		   	</tr>
		   		   </table>
		   		    </div>
		   		   
		   		   
		   <div class="row">
		   <div class="col-xs-12 col-md-12" style="text-align: center;" >
           <input type="submit" value="Guardar" onClick="Ok()" class="btn btn-success"/>
           </div>
           </div>
	    
		    </div>
	        </div>
	        </div>
    
	
		     <?php } } else {?>
		    
		    
		    <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Nombres Permisos Roles</h4>
	         </div>
	         <div class="panel-body">
  			<div class="row">
		    <div class="col-xs-12 col-md-12">
		    <div class="form-group">
                                  <label for="nombre_permisos_rol" class="control-label">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_permisos_rol" name="nombre_permisos_rol" value=""  placeholder="Nombre de Permisos Rol">
                                  <span class="help-block"></span>
            </div>
		    </div>
          
            <div class="col-xs-6 col-md-12">
		    <div class="form-group">
                                  <label for="id_rol" class="control-label">Rol</label>
                                  <select name="id_rol" id="id_rol"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultRol as $resRol) {?>
										<option value="<?php echo $resRol->id_rol; ?>"  ><?php echo $resRol->nombre_rol; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            
            <div class="col-xs-6 col-md-12">
		    <div class="form-group">
                                  <label for="id_controladores" class="control-label">Controladores</label>
                                  <select name="id_controladores" id="id_controladores"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultCon as $resCon) {?>
										<option value="<?php echo $resCon->id_controladores; ?>"  ><?php echo $resCon->nombre_controladores; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
           
		     		
		    	   <table class="table">
		   			<tr>
		   		   		<th style="width: 33.3%">   Ver</th>
		   		   		<th style="width: 33.3%"> Editar</th>
		   		   		<th style="width: 33.3%"> Borrar</th>
		   		   	</tr>
		   		   	<tr>
		   		   		<td> 
		   		   		<select name="ver_permisos_rol" id="ver_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
		   		   		</td>
		   		   		<td> 
		   		   		<select name="editar_permisos_rol" id="editat_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
					    </td>
		   		   		<td>
		   		   		<select name="borrar_permisos_rol" id="borrar_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
		   		   		</td>
		   		   	</tr>
		   		   </table>
		   		   </div>
		     
	    <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
           <input type="submit" value="Guardar" onClick="Ok()" class="btn btn-success"/>
           </div>
           </div>
		    </div>
	        </div>
	        </div>
		    
		       </form>
		        
		     <?php } ?>
		        
		      <div class="col-lg-8">
	         <br>
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i>Permisos Rol</h4>
	         </div>
	         <div class="panel-body">
	         
	         
	           			
		     <section class="col-lg-12 usuario" style="height:370px;overflow-y:scroll; margin-top: 10px;">
        <table class="table table-hover">
	         <tr>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Permisos Rol</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Rol</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Controlador</th>
	    		<th style="color:#456789;font-size:80%;">Ver</th>
	    		<th style="color:#456789;font-size:80%;">Editar</th>
	    		<th style="color:#456789;font-size:80%;">Borrar</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_permisos_rol; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_permisos_rol; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_rol; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_controladores; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->ver_permisos_rol; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->editar_permisos_rol; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->borrar_permisos_rol; ?>     </td>
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("PermisosRoles","index"); ?>&id_permisos_rol=<?php echo $res->id_permisos_rol; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("PermisosRoles","borrarId"); ?>&id_permisos_rol=<?php echo $res->id_permisos_rol; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
			                
		               </td>
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
		     		 
		    
		    </div>
	        </div>
	        </div>
     
       
       
      
       
      </div>
      </div>
       <?php include("view/modulos/footer.php"); ?>
     </body>  
    </html>     