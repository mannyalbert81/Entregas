	
 
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
       
       
 <?php
       // variables para tabla de amortizacion
       
       $interes=null;
       $total=null;
       $porcentaje_capital=null;
       $total_capital=0;
       
       if(!empty($resultDatos)){
       	foreach ($resultDatos as $res){
       		$interes=0;
       		$total=$res['total'];
       		$porcentaje_capital=$res['porcentaje_capital'];
       		$total_capital=$res['total_capital'];
       	}
       }
       
  
       
       $fecha_actual=strtotime(Date("Y-m-d"));
       $hoy=Date("y-m-d");
       ?>
 
  
  <div class="container" >
  
  <div class="row" style="background-color: #FAFAFA;">	
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("TablaAmortizacion","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" style=" padding-bottom:300px;">
            <br>
          
           <?php if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {?> 
   
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Tabla de Amortización</h4>
	         </div>
	         <div class="panel-body">
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
                                  <input type="text" class="form-control" id="id_tipo_creditos" name="id_tipo_creditos" value=""  placeholder="Tipo Crédito">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Cap. Prestado</label>
                                  <input type="text" class="form-control" id="capital_prestado_amortizacion_cabeza" name="capital_prestado_amortizacion_cabeza" value=""  placeholder="Cap. Prestado">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Tasa</label>
                                  <input type="text" class="form-control" id="tasa_interes_amortizacion_cabeza" name="tasa_interes_amortizacion_cabeza" value=""  placeholder="Tasa">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Plazo</label>
                                  <input type="text" class="form-control" id="plazo_meses_amortizacion_cabeza" name="plazo_meses_amortizacion_cabeza" value=""  placeholder="Plazo">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
			<div class="row">
		 	<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Int. Mensual</label>
                                  <input type="text" class="form-control" id="interes_normal_mensual_amortizacion_cabeza" name="interes_normal_mensual_amortizacion_cabeza" value=""  placeholder="Int. Mensual">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Plazo 2</label>
                                  <input type="text" class="form-control" id="plazo_dias_amortizacion_cabeza" name="plazo_dias_amortizacion_cabeza" value=""  placeholder="Plazo 2">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Cuotas</label>
                                  <input type="text" class="form-control" id="cantidad_cuotas_amortizacion_cabeza" name="cantidad_cuotas_amortizacion_cabeza" value=""  placeholder="Cuotas">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">MORA</label>
                                  <input type="text" class="form-control" id="interes_mora_mensual_amortizacion_cabeza" name="interes_mora_mensual_amortizacion_cabeza" value=""  placeholder="MORA">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			<div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">M. Mensual</label>
                                  <input type="text" class="form-control" id="interes_normal_mensual_amortizacion_cabeza" name="interes_normal_mensual_amortizacion_cabeza" value=""  placeholder="M. Mensual">
                                  <span class="help-block"></span>
		    </div>
		    </div>
		     <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">CUOTA</label>
                                  <input type="text" class="form-control" id="cantidad_cuotas_amortizacion_cabeza" name="cantidad_cuotas_amortizacion_cabeza" value=""  placeholder="CUOTA">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			</div>
			
			<div class="row">
		    <div class="col-xs-2 col-md-2">
		    <div class="form-group">
		    
		     					  <label for="nombre_tipo_identificacion" class="control-label">Fecha</label>
                                  <input type="text" class="form-control" id="fecha_amortizacion_cabeza" name="fecha_amortizacion_cabeza" value=""  placeholder="Fecha">
                                  <span class="help-block"></span>
		    </div>
		    </div>
			 </div>
			  </div>
            	
            
		    
		
		     
		     
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					
            					   <input type="submit" id="Generar" name="Generar"  value="Generar" class="btn btn-success " />
            </div>
            </div>
            </div>
            
            
	        </div>
	        </div>
	  
          <?php } } else {?>
           
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Tabla de Amortizacion</h4>
	         </div>
	         <div class="panel-body">
  			 
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
		    
		    
		    </div>
	        </div>
	        </div>
	     
         <?php } ?>
         <?php if(!empty($resultDatos)){?>
        
        <div class="col-lg-12 col-xs-6">
		
		<section class="col-lg-12 usuario" style=" min-height: 100px; 	max-height: 400px; overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Periodo</b></th>
	    		<th style="color:#456789;font-size:80%;">Fecha Vencimiento</th>
	    		<th style="color:#456789;font-size:80%;">Abono Capital</th>
	    		<th style="color:#456789;font-size:80%;">Interes</th>
	    		<th style="color:#456789;font-size:80%;">Capital+Interes</th>
	    		<th style="color:#456789;font-size:80%;">Saldo Capital</th>
	    		<th style="color:#456789;font-size:80%;">Saldo Honorarios</th>
	    		<th style="color:#456789;font-size:80%;">Otros Rubros</th>
	    		<th style="color:#456789;font-size:80%;">Cuota a Cancelar</th>
	    	</tr>
	    	
	      <?php if (!empty($resultAmortizacion)) {
	      	
	      	foreach ($resultAmortizacion['tabla'] as $res)	{
	      		
	       ?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['periodo']; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['fecha_vencimiento']; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['abono_capital'],2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['interes'],2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['capital_interes'],2); ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo abs(round($res[0]['saldo_capital'],2)); ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['saldo_honorarios'],2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['otros'],2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['cuota']; ?>     </td>  
		               
		    </tr>
		    
		    
		    
		        
            	<?php }}} ?>
            
            
       	</table>  
       	
       	
       	  
      </section>
		
		</div>  
                
       </form>
       
       <!-- termina el form --> 
       
     
          
          
          
       
      </div>
      </div>
      
   </body>  

</html>   