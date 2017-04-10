	
 
    <?php include("view/modulos/head.php"); ?>
    <?php include("view/modulos/menu.php"); ?>
    
  
      
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Recalcular Tabla de Amortización - Contabilidad 2016</title>
        <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		   <script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		   </script>
				
		<script>
		$(document).ready(function(){

			$("#Generar").click(function(){

				var numero_credito_amortizacion_cabeza = $("#numero_credito_amortizacion_cabeza").val();
				var numero_pagare_amortizacion_cabeza = $("#numero_pagare_amortizacion_cabeza").val();
				var id_tipo_creditos = $("#id_tipo_creditos").val();
				var capital_prestado_amortizacion_cabeza = $("#capital_prestado_amortizacion_cabeza").val();
				var capital_prestado_amortizacion_cabeza = $("#capital_prestado_amortizacion_cabeza").val();
				
				if (numero_credito_amortizacion_cabeza == "" )
		    	{
					$("#mensaje_numero_credito_amortizacion_cabeza").text("Ingrese un número de crédito");
		    		$("#mensaje_numero_credito_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				if (numero_pagare_amortizacion_cabeza == "" )
				{
					$("#mensaje_numero_pagare_amortizacion_cabeza").text("Ingrese un número de pagaré");
		    		$("#mensaje_numero_pagare_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}
				if (id_tipo_creditos == "" )
		    	{
					$("#mensaje_id_tipo_creditos").text("Ingrese un tipo de crédito");
		    		$("#mensaje_id_tipo_creditos").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				if (capital_prestado_amortizacion_cabeza == "" )
		    	{
					$("#mensaje_capital_prestado_amortizacion_cabeza").text("Ingrese un capital");
		    		$("#mensaje_capital_prestado_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				if (capital_prestado_amortizacion_cabeza == "" )
		    	{
					$("#mensaje_capital_prestado_amortizacion_cabeza").text("Ingrese un capital");
		    		$("#mensaje_capital_prestado_amortizacion_cabeza").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				

				});

			 $( "#numero_credito_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_numero_credito_amortizacion_cabeza").fadeOut("slow");
				  return true;
			    });
				 $( "#numero_pagare_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_numero_pagare_amortizacion_cabeza").fadeOut("slow");
				  return true;
			    });
			 $( "#id_tipo_creditos" ).focus(function() {
				 
				  $("#mensaje_id_tipo_creditos").fadeOut("slow");
				  return true;
			    });
			 $( "#capital_prestado_amortizacion_cabeza" ).focus(function() {
				 
				  $("#mensaje_capital_prestado_amortizacion_cabeza").fadeOut("slow");
				  return true;
			    });
			 
        });
		</script>
		
		
		
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
   
       
   
       
       
 <?php

 $sel_ruc_clientes="";
 $sel_razon_social_clientes="";
 $sel_id_fc_clientes="";
 
 if($_SERVER['REQUEST_METHOD']=='POST' )
 {
 	$sel_ruc_clientes=$_POST['ruc_clientes'];
 	$sel_id_fc_clientes=$_POST['id_fc_clientes'];
 	$sel_razon_social_clientes=$_POST['razon_social_clientes'];
	
 }

 ?>
 
  
 
  
  <div class="container" >
  
  <div class="row" style="background-color: #FAFAFA;">	
  
       <!-- empieza el form --> 
       
      <form  action="<?php echo $helper->url("RecalcularTablaAmortizacion","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" style=" padding-bottom:300px;">
            <br>
   
	         <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Recalcular Tabla de Amortización</h4>
	         </div>
	         <div class="panel-body">
  			 <div class="row">
  			 <div class="form-group" style="margin-top: 25px;">
		    	<div class="col-xs-2 col-md-2" style="text-align: center;">
			  	 <label for="ruc_clientes" class="control-label">Nro. Identificación:</label>
			  	<input type="text"  name="ruc_clientes" id="ruc_clientes" value="<?php if ($sel_ruc_clientes!="")  {echo $sel_ruc_clientes;} else { if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {echo $resEdit->ruc_clientes;} }  }?>" onkeypress="return numeros(event)" class="form-control"/> 
			    <input type="hidden"  name="id_fc_clientes" id="id_fc_clientes" value="<?php if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {echo $resEdit->id_clientes;} } else  {echo $sel_id_fc_clientes;} ?>" class="form-control"/> 
			   
            	</div>
            	</div>
		   		<div class="form-group">
		   		<div class="col-xs-4 col-md-4" style="text-align: center;">
			  	<label for="razon_social_clientes" class="control-label">Razón Social:</label>
			  	<input type="text"  name="razon_social_clientes" id="razon_social_clientes" value="<?php if (!empty($resultRes)) {  foreach($resultRes as $resEdit) {echo $resEdit->razon_social_clientes;} }  else {echo $sel_razon_social_clientes;} ?>" class="form-control"/> 
			   	
              </div>
              </div>
		   	
		     <div class="col-xs-3 col-md-3">
			 <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-info " style="margin-top: 23px;"/> 	
		     </div>
		  
		
		    </div>
            </div>
            
          
			
	       
	      
	       <?php if(!empty($resultRes)){?>
	        <div class="panel-body"> 
	       <section style="overflow-y:scroll;">
           <table class="table table-hover ">
       
       
           <tr>
		            <th style="color:#456789;font-size:80%;"><b>Ruc</b></th>
		    		<th style="color:#456789;font-size:80%;"><b>Nombre</b></th>
		    		<th style="color:#456789;font-size:80%;"><b># Crédito</b></th>
		    		<th style="color:#456789;font-size:80%;"><b># Pagare</b></th>
		    		<th style="color:#456789;font-size:80%;"><b>Tipo Crédito</b></th>
		    		<th style="color:#456789;font-size:80%;"><b>Capital Prestado</b></th>
		    		<th style="color:#456789;font-size:80%;"><b>Taza</b></th>
		    		<th style="color:#456789;font-size:80%;"><b>Plazo</b></th>
		    		<th></th>
		    		
	  		</tr>
	   
            <?php if (!empty($resultRes)) {  foreach($resultRes as $res) {?>
	        	 
             <tr>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->ruc_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->razon_social_clientes; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_credito_amortizacion_cabeza; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_pagare_amortizacion_cabeza; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_creditos; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->capital_prestado_amortizacion_cabeza; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->tasa_interes_amortizacion_cabeza; ?>  </td>
		           	   <td style="color:#000000;font-size:80%;"> <?php echo $res->plazo_meses_amortizacion_cabeza; echo " meses"; ?>  </td>
		           	   
		           	   <td>
			           			<div class="right">
			                    	<a href="<?php echo $helper->url("RecalcularTablaAmortizacion","index"); ?>&id_amortizacion_cabeza=<?php echo $res->id_amortizacion_cabeza; ?>&id_clientes=<?php echo $res->id_clientes; ?>" class="btn btn-warning" style="font-size:70%;">Seleccionar</a>
			               		</div>
			           </td>
	       </tr>
	 	
	 	
	      <?php } }?>
	      </table>     
		</section>
        </div> 
	      <?php }?>
          
          
	        	
	    
	         
	    <?php if(!empty($resultSet)){?>
	    <div class="panel-body"> 
	    <div class="row">
  		    <div class="form-group" style="margin-top: 25px;">
		    <div class="col-xs-2 col-md-2" style="text-align: center;">
			  	 <label for="numero_cuota_recaudacion" class="control-label"># Cuota:</label>
		 	     <input type="text"  name="numero_cuota_recaudacion" id="numero_cuota_recaudacion" value=""  class="form-control" readonly/> 
			</div>
            </div>
            
		   	<div class="form-group">
		   	<div class="col-xs-2 col-md-2" style="text-align: center;">
			  	<label for="capital_pagado_recaudacion" class="control-label">Capital Pagado:</label>
			  	<input type="text"  name="capital_pagado_recaudacion" id="capital_pagado_recaudacion" value="" onkeypress="return numeros(event)" class="form-control"/> 
			   	
            </div>
            </div>
            
            <div class="form-group">
		   	<div class="col-xs-2 col-md-2" style="text-align: center;">
			  	<label for="fecha_pago_recaudacion" class="control-label">Fecha Pago:</label>
			  	<input type="date"  name="fecha_pago_recaudacion" id="fecha_pago_recaudacion" class="form-control"/> 
			   	
            </div>
            </div>
            <div class="form-group">
		   	<div class="col-xs-4 col-md-4" style="text-align: center;">
			  	<label for="nombre_entidad_financiera_recaudacion" class="control-label">Entidad Financiera:</label>
			  	<input type="text"  name="nombre_entidad_financiera_recaudacion" id="nombre_entidad_financiera_recaudacion" class="form-control"/> 
			   	
            </div>
            </div>
            <div class="form-group">
		   	<div class="col-xs-2 col-md-2" style="text-align: center;">
			  	<label for="numero_papeleta_recaudacion" class="control-label"># Papeleta:</label>
			  	<input type="text"  name="numero_papeleta_recaudacion" id="numero_papeleta_recaudacion" class="form-control"/> 
			   	
            </div>
            </div>
        </div>   
	       
	     <div class="row">
  		     <div class="form-group" style="margin-top: 15px;">
             <div class="col-xs-12 col-md-12">
		                          <label for="concepto_pago_amortizacion" class="control-label">Concepto de Pago:</label>
                                  <textarea type="text" class="form-control" id="concepto_pago_amortizacion" name="concepto_pago_amortizacion" value=""  placeholder="Observaciones"></textarea>
                                  <span class="help-block"></span>
             </div>
		     </div> 
	     </div> 
	     
	   
	       
	       
        <section style="height:452px; overflow-y:scroll; margin-top:10px">
        <table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"></th>
	    		<th style="color:#456789;font-size:80%;"><b>Cuota</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Saldo Inicial</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Interes</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Amortizacion</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Pagos</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Fecha Pago</b></th>
	    	</tr>
	    	
	                     
	      <?php	foreach ($resultSet as $res)	{ ?>
	               
	        		<tr>
	        		   <th style="color:#456789;font-size:80%;"><input type="checkbox" id="id_amortizacion_detalle[]"   name="id_amortizacion_detalle[]"  value="<?php echo $res->id_amortizacion_detalle; ?>" class="marcados"></th>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_cuota_amortizacion_detalle; ?></td>
	            	   <td style="color:#000000;font-size:80%;"> <?php echo number_format($res->saldo_inicial_amortizacion_detalle,2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo number_format($res->interes_amortizacion_detalle,2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo number_format($res->amortizacion_amortizacion_detalle,2); ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo number_format($res->pagos_amortizacion_detalle,2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_pagos_amortizacion_detalle; ?></td>
	               </tr>
		
		  		    
		  		  <?php } ?>
		</table>  
       	</section>
		
		  <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:25px" > 
            <div class="form-group">
            					   
            					  <button type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php echo $helper->url("RecalcularTablaAmortizacion","InsertaRecalculaTablaAmortizacion"); ?>'" class="btn btn-success" >Guardar</button>
                                   
            </div>
            </div>
            </div>
		 </div> 		  
		  		  <?php } ?>
		
	   </div>   
	    </div> 
        </form>
       
      </div>
      </div>
      
   </body>  

</html>   