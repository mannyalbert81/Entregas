<?php //include("view/modulos/modal.php"); ?>
<?php include("view/modulos/head.php"); ?>
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Reportes Asignados - Contabilidad 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarEntidades.js"></script>
	</head>
    <body class="cuerpo">
    
       
       <?php include("view/modulos/menu.php"); ?>
  
 	    <div class="container">
  		<div class="row" style="background-color: #FAFAFA;">
        <form id="form-entidades" action="<?php echo $helper->url("ReportesAsignados","InsertaReportesAsignados"); ?>" method="post" enctype="multipart/form-data" class="col-lg-6">
            <br>
            
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	       
	        <div class="well">
	        <h4 style="color:#ec971f;">Registrar Reportes Asignados</h4>
            <hr/>
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="nombre_reportes_asignados" class="control-label">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_reportes_asignados" name="nombre_reportes_asignados" value="<?php echo $resEdit->nombre_reportes_asignados; ?>"  placeholder="Nombre">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
             <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="id_entidad" class="control-label">Entidad</label>
                                  <select name="id_entidad" id="id_entidad"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultEntidad as $res) {?>
										<option value="<?php echo $res->id_entidades; ?>" <?php if ($res->id_entidades == $resEdit->id_entidades )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_entidades; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
	         
	        <div class="row">
		  <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="id_entidad" class="control-label">Usuarios</label>
                                  <select name="id_usuarios" id="id_usuarios"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultUsu as $res) {?>
										<option value="<?php echo $res->id_usuarios; ?>" <?php if ($res->id_usuarios == $resEdit->id_usuarios )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_usuarios; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
		    
		    </div>
	        
	        
	        </div>
	     	
	            	  
            
		     <?php } } else {?>
		    
		    <div class="well">
		    <h4 style="color:#ec971f;">Registrar Reportes Asignados</h4>
            <hr/>
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="nombre_reportes_asignados" class="control-label">Nombre</label>
                                  <input type="text" class="form-control" id="nombre_reportes_asignados" name="nombre_reportes_asignados" value=""  placeholder="Ruc">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    
		   <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="id_entidad" class="control-label">Entidad</label>
                                  <select name="id_entidad" id="id_entidad"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultEntidad as $res) {?>
										<option value="<?php echo $res->id_entidades; ?>"  ><?php echo $res->nombre_entidades; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
			</div>
	         
	        <div class="row">
	        <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="id_usuarios" class="control-label">Usuarios</label>
                                  <select name="id_usuarios" id="id_usuarios"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultUsu as $res) {?>
										<option value="<?php echo $res->id_usuarios; ?>"  ><?php echo $res->nombre_usuarios; ?> </option>
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
       
       
            
            <form action="<?php echo $helper->url("ReportesAsignados","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Reportes Asignados Registrados</h4>
            
            <div class="row">
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <input type="text" class="form-control" id="contenido" name="contenido" value="">
                                  
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" ><?php echo $desc ?> </option>
                                    <?php } ?>
                                  </select>
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <button type="submit" id="Buscar" name="Buscar" class="btn btn-info">Buscar</button>
            </div>
		    </div>
			</div>  
             
       
       <div class="datagrid"> 
       <section style="height:380px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
           			<th style="font-size:100%;">Id</th>
                    <th style="font-size:100%;">Nombre</th>
		    		<th style="font-size:100%;">Entidad</th>
		    		<th style="font-size:100%;">Usuario</th>
		    	
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
	   					<td style="font-size:80%;"> <?php echo $res->id_reportes_asignados; ?>  </td>
	   					<td style="font-size:80%;"> <?php echo $res->nombre_reportes_asignados; ?>  </td>
		                <td style="font-size:80%;" > <?php echo $res->nombre_entidades; ?>     </td> 
		                <td style="font-size:80%;"> <?php echo $res->nombre_usuarios; ?>     </td>
		              
		                <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("ReportesAsignados","index"); ?>&id_reportes_asignados=<?php echo $res->id_reportes_asignados; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			            </td>
			            <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("ReportesAsignados","borrarId"); ?>&id_reportes_asignados=<?php echo $res->id_reportes_asignados; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
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