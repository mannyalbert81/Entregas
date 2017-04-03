	
 
 <?php include("view/modulos/head.php"); ?>
      
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Tipo de Identificacion - Contabilidad 2016</title>
        <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		   
  
    </head>
   <body class="cuerpo">
   
       
       <?php include("view/modulos/menu.php"); ?>
       
       

 
  
  <div class="container">
  
  <div class="row" style="background-color: #FAFAFA;">	
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("TablaAmortizacion","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
            <br>
         <div class="col-lg-12">
         <h4 style="color:#ec971f;"><center>TABLA DE AMORTIZACIÓN</center></h4>
        </br>
         <?php if ($resultRes !="" ) { foreach($resultRes as $resEdit) {?>  
         
         <div class="row">
  			<div class="form-group" style="margin-top: 25px;">
		    <div class="col-xs-2 col-md-2" style="text-align: center;">
			  	 <label for="identificacion" class="control-label">Nro. Identificación:</label>
			  	<input type="text"  name="identificacion" id="identificacion" value="<?php echo $resEdit->ruc_clientes; ?>" class="form-control"/> 
			   
            </div>
            </div>
		   <div class="form-group">
		   <div class="col-xs-4 col-md-4" style="text-align: center;">
			  	<label for="numero_titulo_credito" class="control-label">Razón Social:</label>
			  	<input type="text"  name="numero_titulo_credito" id="numero_titulo_credito" value="<?php echo $resEdit->razon_social_clientes; ?>" class="form-control"/> 
			   	
            </div>
              </div>
		   
		   <div class="col-xs-3 col-md-3">
			 <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-info " style="margin-top: 25px;"/> 	
		  
		  </div>
		  </div>
         
         <br>
          <div class="row">
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Nro. Crédito</label>
                                  <input type="text" class="form-control" id="numero_credito_amortizacion_cabeza" name="numero_credito_amortizacion_cabeza" value=""  placeholder="Nro. Crédito">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Pagare Nro.</label>
                                  <input type="text" class="form-control" id="numero_pagare_amortizacion_cabeza" name="numero_pagare_amortizacion_cabeza" value=""  placeholder="Pagare Nro.">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			 <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Tipo Crédito</label>
                                  <input type="text" class="form-control" id="id_tipo_creditos" name="nombre_tipo_identificacion" value=""  placeholder="Tipo Crédito">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Cap. Prestado</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="Cap. Prestado">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Tasa</label>
                                  <input type="text" class="form-control" id="tasa_interes_amortizacion_cabeza" name="nombre_tipo_identificacion" value=""  placeholder="Tasa">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Plazo</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="Plazo">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
			<div class="row">
		 	<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Int. Mensual</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="Int. Mensual">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Plazo 2</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="Plazo 2">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Cuotas</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="Cuotas">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">MORA</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="MORA">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">M. Mensual</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="M. Mensual">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		     <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">CUOTA</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="CUOTA">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
			<div class="row">
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Fecha</label>
                                  <input type="text" class="form-control" id="nombre_tipo_identificacion" name="nombre_tipo_identificacion" value=""  placeholder="Fecha">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
            </div>
            
		    
		
		     
		     
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Generar</button>
            </div>
            </div>
            </div>
       .        
		            
		
         
         <?php } } else {?>
         
         <div class="row">
  			<div class="form-group" style="margin-top: 25px;">
		    <div class="col-xs-2 col-md-2" style="text-align: center;">
			  	 <label for="identificacion" class="control-label">Nro. Identificación:</label>
			  	<input type="text"  name="identificacion" id="identificacion" value="" class="form-control"/> 
			   
            </div>
            </div>
		   <div class="form-group">
		   <div class="col-xs-4 col-md-4" style="text-align: center;">
			  	<label for="numero_titulo_credito" class="control-label">Razón Social:</label>
			  	<input type="text"  name="numero_titulo_credito" id="numero_titulo_credito" value="" class="form-control"/> 
			   	
            </div>
              </div>
		   
		   <div class="col-xs-3 col-md-3">
			 <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-info " style="margin-top: 25px;"/> 	
		  
		  </div>
		    </div> 
		         </form>
       <!-- termina el form --> 
		        <form action="<?php echo $helper->url("TablaAmortizacion","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Tipo de Identificacion Registrado</h4>
            
            <div class="row">
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    
		    </div>
		  
		    </div>  
             
       
       <div class="datagrid"> 
       <section style="height:380px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
                    <th style="font-size:100%;">Pagos Trimestrales</th>
		    		<th style="font-size:100%;">Saldo Inicial</th>
		    		<th style="font-size:100%;">Interes</th>
		    		<th style="font-size:100%;">Amortización</th>
		    		<th style="font-size:100%;">Pagos</th>
		    		<th style="font-size:100%;">Fecha Pago</th>
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
	   		           <td style="font-size:80%;"> <?php echo $res->id_tipo_identificacion; ?></td>
	   		           <td style="font-size:80%;"> <?php echo $res->nombre_tipo_identificacion; ?></td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_tipo_identificacion; ?></td> 
		               <td style="font-size:80%;"> <?php echo $res->nombre_tipo_identificacion; ?></td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_tipo_identificacion; ?></td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_tipo_identificacion; ?></td>
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("TablaAmortizacion","index"); ?>&id_tipo_identificacion=<?php echo $res->id_tipo_identificacion; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			           </td>
			           <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("TablaAmortizacion","borrarId"); ?>&id_tipo_identificacion=<?php echo $res->id_tipo_identificacion; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
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
          
         
         <?php } ?>  
             
        
  
       
  
          
          
       
      </div>
      </div>
   </body>  

</html>   