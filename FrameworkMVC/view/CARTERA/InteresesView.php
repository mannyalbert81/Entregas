	
 
 <?php include("view/modulos/head.php"); ?>
      
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Intereses - Contabilidad 2016</title>
        <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		 		  <script src="view/js/ValidarIntereses.js"></script>  
  
    </head>
   <body class="cuerpo">
   
       
       <?php include("view/modulos/menu.php"); ?>
       
       

 
  
  <div class="container">
  
  <div class="row" style="background-color: #FAFAFA;">
  
       <!-- empieza el form --> 
       
      <form id="form-Intereses" action="<?php echo $helper->url("Intereses","InsertaIntereses"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            <br>
         
        	     <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            <div class="well">
            <h4 style="color:#ec971f;">Insertar Intereses</h4>
  			 <hr/>
          
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="id_entidades" class="control-label">Entidad</label>
                                  <select name="id_entidades" id="id_entidades"  class="form-control" readonly >
                            		<?php foreach($resultEnt as $res) {?>
										<option value="<?php echo $res->id_entidades; ?>" <?php if ($res->id_entidades == $resEdit->id_entidades )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_entidades; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
             <div class="col-xs-6 col-md-6">
		   <div class="form-group">
                                  <label for="id_tipo_intereses" class="control-label">Tipo Intereses</label>
                                  <select name="id_tipo_intereses" id="id_tipo_intereses"  class="form-control"  >
                            		<?php foreach($resultInt as $res) {?>
										<option value="<?php echo $res->id_tipo_intereses; ?>" <?php if ($res->id_tipo_intereses == $resEdit->id_tipo_intereses )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_tipo_intereses; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="valor_min_c_x_c" class="control-label">Valor Interes</label>
                                  <input type="text" class="form-control" id="valor_intereses" name="valor_intereses" value="<?php echo $resEdit->valor_intereses; ?>"  placeholder="0.00">
                                    <input type="hidden" class="form-control" id="id_intereses" name="id_intereses" value="<?php echo $resEdit->id_intereses; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		     <div class="col-xs-6 col-md-6">
		
		    </div>
            </div>
            </div>	
		    
		     <?php } } else {?>
		     
		    <div class="well">
		    <h4 style="color:#ec971f;">Insertar Intereses </h4>
            <hr/>
            <div class="row">
            <div class="col-xs-6 col-md-6">
		    <div class="form-group">
                                  <label for="id_entidades" class="control-label">Entidad</label>
                                  <select name="id_entidades" id="id_entidades"  class="form-control" readonly>
                                  
									<?php foreach($resultEnt as $res) {?>
										<option value="<?php echo $res->id_entidades; ?>"  ><?php echo $res->nombre_entidades; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
		    <div class="col-xs-6 col-md-6">
		<div class="form-group">
                                  <label for="id_entidades" class="control-label">Tipo Intereses</label>
                                  <select name="id_tipo_intereses" id="id_tipo_intereses"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($resultInt as $res) {?>
										<option value="<?php echo $res->id_tipo_intereses; ?>"  ><?php echo $res->nombre_tipo_intereses; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		    
		     					  <label for="valor_intereses" class="control-label">Valor Intereses</label>
                                  <input type="text" class="form-control" id="valor_intereses" name="valor_intereses" value=""  placeholder="0.00">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    
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
       
       <form action="<?php echo $helper->url("Intereses","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Tipo de Intereses Registrado</h4>
            
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
		    		<th style="font-size:100%;">Entidades</th>
		    		<th style="font-size:100%;">Tipo Intereses</th>
		    		<th style="font-size:100%;">Valor Intereses</th>
		    		
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
	   		           <td style="font-size:80%;"> <?php echo $res->id_intereses ; ?></td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_entidades; ?>     </td> 
		               <td style="font-size:80%;"> <?php echo $res->nombre_tipo_intereses; ?>     </td>
		               <td style="font-size:80%;"> <?php echo $res->valor_intereses; ?>     </td>
	
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Intereses","index"); ?>&id_intereses=<?php echo $res->id_intereses; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			           </td>
			           <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("Intereses","borrarId"); ?>&id_intereses=<?php echo $res->id_intereses; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
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