
   <?php include("view/modulos/modal.php"); ?>
 <?php include("view/modulos/head.php"); ?>
      
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Tipo de Notificacion - Contabilidad 2016</title>
        <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		   
  
    </head>
   <body class="cuerpo">
   
       
       <?php include("view/modulos/menu.php"); ?>
       
       

 
  
  <div class="container">
  
  <div class="row" style="background-color: #FAFAFA;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Tipo_Notificacion","InsertaNotificacion"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            <br>
         
        	     <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            <div class="well">
            <h4 style="color:#ec971f;">Insertar Tipo de Notificacion</h4>
  			 <hr/>
          
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="descripcion_notificacion" class="control-label">Descripción</label>
                                  <input type="text" class="form-control" id="descripcion_notificacion" name="descripcion_notificacion" value="<?php echo $resEdit->descripcion_notificacion; ?>"  placeholder="Descripción Notificación">
                                    <input type="hidden" class="form-control" id="id_tipo_notificacion" name="id_tipo_notificacion" value="<?php echo $resEdit->id_tipo_notificacion; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="controlador_tipo_notificacion" class="control-label">Controlador</label>
                                  <input type="text" class="form-control" id="controlador_tipo_notificacion" name="controlador_tipo_notificacion" value="<?php echo $resEdit->controlador_tipo_notificacion; ?>"  placeholder="Controlador Notificacion">
                                    <input type="hidden" class="form-control" id="id_tipo_notificacion" name="id_tipo_notificacion" value="<?php echo $resEdit->id_tipo_notificacion; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
            </div>
             <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="accion_tipo_notificacion" class="control-label">Acción	</label>
                                  <input type="text" class="form-control" id="accion_tipo_notificacion" name="accion_tipo_notificacion" value="<?php echo $resEdit->accion_tipo_notificacion; ?>"  placeholder="Acción Notificación">
                                    <input type="hidden" class="form-control" id="id_tipo_notificacion" name="id_tipo_notificacion" value="<?php echo $resEdit->id_tipo_notificacion; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="nombre_icon_tipo_notificacion" class="control-label">Nombre Icon</label>
                                  <input type="text" class="form-control" id="nombre_icon_tipo_notificacion" name="nombre_icon_tipo_notificacion" value="<?php echo $resEdit->nombre_icon_tipo_notificacion; ?>"  placeholder="Nombre Icon">
                                    <input type="hidden" class="form-control" id="id_tipo_notificacion" name="id_tipo_notificacion" value="<?php echo $resEdit->id_tipo_notificacion; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
            </div>
            </div>	
		    
		     <?php } } else {?>
		     
		    <div class="well">
		    <h4 style="color:#ec971f;">Insertar Tipo de Notificación  </h4>
            <hr/>
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		    
		     					  <label for="descripcion_notificacion" class="control-label">Descripción</label>
                                  <input type="text" class="form-control" id="descripcion_notificacion" name="descripcion_notificacion" value=""  placeholder="Descripción Notificación	">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		    
		     					  <label for="controlador_tipo_notificacion" class="control-label">Controlador</label>
                                  <input type="text" class="form-control" id="controlador_tipo_notificacion" name="controlador_tipo_notificacion" value=""  placeholder="Controlador Notificacion">
                                  <span class="help-block"></span>
		    </div>
		    </div>
            </div>
            
             <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		    
		     					  <label for="accion_tipo_notificacion" class="control-label">Acción</label>
                                  <input type="text" class="form-control" id="accion_tipo_notificacion" name="accion_tipo_notificacion" value=""  placeholder="Acción Notificación">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		    
		     					  <label for="nombre_icon_tipo_notificacion" class="control-label">Nombre Icon</label>
                                  <input type="text" class="form-control" id="nombre_icon_tipo_notificacion" name="nombre_icon_tipo_notificacion" value=""  placeholder="Nombre Icon">
                                  <span class="help-block"></span>
		    </div>
		    </div>
            </div>
            </div>
		    
		   
               	
		     <?php } ?>
		     
		     
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
            </div>
            </div>
            </div>
        
       </form>
       <!-- termina el form --> 
       
       <form action="<?php echo $helper->url("Tipo_Notificacion","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Tipo Notificacion Registrada</h4>
            
            <div class="row">
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    
		    </div>
		  
		    </div>  
             
       
       <div class="datagrid"> 
       <section style="height:380px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
                    <th style="font-size:100%;">Id</th>
		    		<th style="font-size:100%;">Descripción</th>
		    		<th style="font-size:100%;">Controlador</th>
		    		<th style="font-size:100%;">Acción</th>
		    		<th style="font-size:100%;">Nombre Icon</th>
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
	   		           <td style="font-size:80%;"> <?php echo $res->id_tipo_notificacion; ?></td>
		               <td style="font-size:80%;"> <?php echo $res->descripcion_notificacion; ?>     </td> 
		               <td style="font-size:80%;"> <?php echo $res->controlador_tipo_notificacion; ?>     </td> 
		               <td style="font-size:80%;"> <?php echo $res->accion_tipo_notificacion; ?>     </td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_icon_tipo_notificacion; ?>     </td> 
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Tipo_Notificacion","index"); ?>&id_tipo_notificacion=<?php echo $res->id_tipo_notificacion; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			           </td>
			           <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("Tipo_Notificacion","borrarId"); ?>&id_tipo_notificacion=<?php echo $res->id_tipo_notificacion; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
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
   </body>  

</html>   