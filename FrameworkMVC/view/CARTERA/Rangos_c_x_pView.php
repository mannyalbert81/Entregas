	
 
 <?php include("view/modulos/head.php"); ?>
      
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Rangos_c_x_p - Contabilidad 2016</title>

		  <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarRangos_c_x_p.js"></script>
	
	 <script >   
    function numeros(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = "0123456789";
    especiales = [8,37,39,46];
 
    tecla_especial = false
    for(var i in especiales){
    if(key == especiales[i]){
     tecla_especial = true;
     break;
        } 
    }
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
        return false;
     }
    </script > 	
    </head>
   <body class="cuerpo">
   
       
       <?php include("view/modulos/menu.php"); ?>
       
       

 
  
  <div class="container">
  
  <div class="row" style="background-color: #FAFAFA;">
  
       <!-- empieza el form --> 
       
      <form id="form-rangos_c_x_p" action="<?php echo $helper->url("Rangos_c_x_p","InsertaRango_c_x_p"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            <br>
         
        	     <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            
            
            
             <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Insertar Rango c_x_p</h4>
	         </div>
	         <div class="panel-body">
  			
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
		       
			   					<label for="nombre_rangos_c_x_p" class="control-label">Nombre_Rangos_c_x_p</label>
                                  <input type="text" class="form-control" id="nombre_rangos_c_x_p" name="nombre_rangos_c_x_p" value="<?php echo $resEdit->nombre_rangos_c_x_p; ?>"  placeholder="Nombre_Rangos_c_x_p">
                                    <input type="hidden" class="form-control" id="id_rangos_c_x_p" name="id_rangos_c_x_p" value="<?php echo $resEdit->id_rangos_c_x_p; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="valor_min_c_x_p" class="control-label">Valor_Min_c_x_p</label>
                                  <input type="text" class="form-control" id="valor_min_c_x_p" name="valor_min_c_x_p" value="<?php echo $resEdit->valor_min_c_x_p; ?>"  onkeypress="return numeros(event)" placeholder="0.00">
                                    <input type="hidden" class="form-control" id="id_rangos_c_x_p" name="id_rangos_c_x_p" value="<?php echo $resEdit->id_rangos_c_x_p; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
		     <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		       
			   					<label for="valor_max_c_x_p" class="control-label">Valor_Max_c_x_p</label>
                                  <input type="text" class="form-control" id="valor_max_c_x_p" name="valor_max_c_x_p" value="<?php echo $resEdit->valor_max_c_x_p; ?>"  onkeypress="return numeros(event)"  placeholder="0.00">
                                    <input type="hidden" class="form-control" id="id_rangos_c_x_p" name="id_rangos_c_x_p" value="<?php echo $resEdit->id_rangos_c_x_p; ?>"  placeholder="">
                                
                                  <span class="help-block"></span>
			</div>
		    </div>
            </div>
		   
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
            </div>
            </div>
            </div> 	 
         	   	 	
		    
		    </div>
	        </div>
	        </div>
            
          	
		    
		     <?php } } else {?>
		     
		     
		     
		     
		     <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Insertar Rango c_x_p</h4>
	         </div>
	         <div class="panel-body">
  			
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
		    
		     					  <label for="nombre_rangos_c_x_p" class="control-label">Nombre_Rangos_c_x_p</label>
                                  <input type="text" class="form-control" id="nombre_rangos_c_x_p" name="nombre_rangos_c_x_p" value=""  placeholder="Nombre_Rangos_c_x_p">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		    
		     					  <label for="valor_min_c_x_p" class="control-label">Valor_Min_c_x_p</label>
                                  <input type="text" class="form-control" id="valor_min_c_x_p" name="valor_min_c_x_p" value=""  onkeypress="return numeros(event)" placeholder="0.00">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group">
		    
		     					  <label for="valor_max_c_x_p" class="control-label">Valor_Max_c_x_p</label>
                                  <input type="text" class="form-control" id="valor_max_c_x_p" name="valor_max_c_x_p" value=""  onkeypress="return numeros(event)" placeholder="0.00">
                                  <span class="help-block"></span>
		    </div>
		    </div>
            </div>
		   
		   	<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
            </div>
            </div>
            </div>
         	   	 	
		    
		    </div>
	        </div>
	        </div>
		     
		     
		     
		   
               	
		     <?php } ?>
		     
		     
		    
        
       </form>
       <!-- termina el form --> 
       
       <form action="<?php echo $helper->url("Rangos_c_x_p","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     	

     	<div class="col-lg-12">
	         <br>
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Tipo de Rango_c_x_p Registrado</h4>
	         </div>
	         <div class="panel-body">
  			
		        <div class="datagrid"> 
       <section style="height:380px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
                    <th style="font-size:100%;">Id</th>
		    		<th style="font-size:100%;">Entidades</th>
		    		<th style="font-size:100%;">Nombre_Rangos_c_x_p</th>
		    		<th style="font-size:100%;">Valor_Min_c_x_p</th>
		    		<th style="font-size:100%;">Valor_Max_c_x_p</th>
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
	   		           <td style="font-size:80%;"> <?php echo $res->id_rangos_c_x_p ; ?></td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_entidades; ?>     </td> 
		               <td style="font-size:80%;"> <?php echo $res->nombre_rangos_c_x_p; ?>     </td>
		               <td style="font-size:80%;"> <?php echo $res->valor_min_c_x_p; ?>     </td>
		               <td style="font-size:80%;"> <?php echo $res->valor_max_c_x_p; ?>     </td>
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Rangos_c_x_p","index"); ?>&id_rangos_c_x_p=<?php echo $res->id_rangos_c_x_p; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			           </td>
			           <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("Rangos_c_x_p","borrarId"); ?>&id_rangos_c_x_p=<?php echo $res->id_rangos_c_x_p; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
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
	        </div>
	        </div>

        </form> 
          
          
          
       
      </div>
      </div>
   </body>  

</html>   