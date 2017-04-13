	
 
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

			$("#buscar").click(function(){

				var ruc_clientes = $("#ruc_clientes").val();
				var razon_social_clientes = $("#razon_social_clientes").val();
				
				

				if (ruc_clientes == "" &&  razon_social_clientes == "")
				{
					$("#mensaje_razon_social_clientes").text("Ingrese una Cedula o un Nombre");
		    		$("#mensaje_razon_social_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}
				

				});

			
				 $( "#razon_social_clientes" ).focus(function() {
				 $("#mensaje_razon_social_clientes").fadeOut("slow");
				 
				  return true;
			    });

				 $( "#ruc_clientes" ).focus(function() {
					 $("#mensaje_razon_social_clientes").fadeOut("slow");
					 
					  return true;
				    });
			 
			 
        });
		</script>
		
		
		<script>
		$(document).ready(function(){

			$("#Calcular").click(function(){

				var capital_pagado_recaudacion = $("#capital_pagado_recaudacion").val();
				var fecha_pago_recaudacion = $("#fecha_pago_recaudacion").val();
				
				

				if (capital_pagado_recaudacion == "")
				{
					$("#mensaje_capital_pagado_recaudacion").text("Ingrese un Valor");
		    		$("#mensaje_capital_pagado_recaudacion").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}

				if (fecha_pago_recaudacion == "")
				{
					$("#mensaje_fecha_pago_recaudacion").text("Ingrese una Fecha");
		    		$("#mensaje_fecha_pago_recaudacion").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}

				});

			
				 $( "#capital_pagado_recaudacion" ).focus(function() {
				 $("#mensaje_capital_pagado_recaudacion").fadeOut("slow");
				 
				  return true;
			    });

				 $( "#fecha_pago_recaudacion" ).focus(function() {
					 $("#mensaje_fecha_pago_recaudacion").fadeOut("slow");
					 
					  return true;
				    });
			 
			 
        });
		</script>
		
		<script >
	        $(document).ready(function() {
			$('#Recuperar').click(function(){
		        var selected = '';  
		          
		        $('.marcados').each(function(){
		            if (this.checked) {
		                selected +=$(this)+' esta '+$(this).val()+', ';
		            }
		        }); 
	
		        if (selected != '') {
		            return true;
		        }
		        else {
		            alert('Debes seleccionar un Credito.');
		            return false;
		        }
	
	
		      
		    }); 
	
		});
		</script>
	
	
	    <script >
	        $(document).ready(function() {
			$('#Guardar').click(function(){
		        var selected = '';  
		          
		        $('.marcados').each(function(){
		            if (this.checked) {
		                selected +=$(this)+' esta '+$(this).val()+', ';
		            }
		        }); 
	
		        if (selected != '') {
		            return true;
		        }
		        else {
		            alert('Debes seleccionar una Cuota.');
		            return false;
		        }
	
	
		      
		    }); 
	
		});
		</script>
		
		
		<script >
	        $(document).ready(function() {
			$('#Calcular').click(function(){
		        var selected = '';  
		          
		        $('.marcados').each(function(){
		            if (this.checked) {
		                selected +=$(this)+' esta '+$(this).val()+', ';
		            }
		        }); 
	
		        if (selected != '') {
		            return true;
		        }
		        else {
		            alert('Debes seleccionar una Cuota.');
		            return false;
		        }
	
	
		      
		    }); 
	
		});
		</script>
		
		
		
		<script>
       $(document).ready(function(){
    	   $("#capital_pagado_recaudacion").prop("disabled","disabled");
    	   $("#fecha_pago_recaudacion").prop("disabled","disabled");
    	   $("#Calcular").prop("disabled","disabled");
    	   $("#nombre_entidad_financiera_recaudacion").prop("disabled","disabled");
    	   $("#numero_papeleta_recaudacion").prop("disabled","disabled");
    	   $("#concepto_pago_amortizacion").prop("disabled","disabled");
    	 
 
            $(".marcados").click(function(){
            	var cant = $("input:checked").length;
            	
                if(cant!=0)
                {
            	 $("#capital_pagado_recaudacion").prop("disabled","");
            	 $("#fecha_pago_recaudacion").prop("disabled","");
          	     $("#Calcular").prop("disabled","");
          	     $("#nombre_entidad_financiera_recaudacion").prop("disabled","");
          	     $("#numero_papeleta_recaudacion").prop("disabled","");
          	     $("#concepto_pago_amortizacion").prop("disabled","");
          	     
                }else
                    {
                	  $("#capital_pagado_recaudacion").prop("disabled","disabled");
                	  $("#fecha_pago_recaudacion").prop("disabled","disabled");
               	      $("#Calcular").prop("disabled","disabled");
               	      $("#nombre_entidad_financiera_recaudacion").prop("disabled","disabled");
               	      $("#numero_papeleta_recaudacion").prop("disabled","disabled");
               	      $("#concepto_pago_amortizacion").prop("disabled","disabled");
               	      
                    }
                
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
  
  <script language="JavaScript">

var era;
function uncheckRadio(rbutton){
if(rbutton.checked==true && era==true){rbutton.checked=false;}
era=rbutton.checked;
}

</script>
  
    </head>
   <body class="cuerpo">
   
       
   
       
       
 <?php

 $sel_ruc_clientes="";
 $sel_razon_social_clientes="";
/*
 $sel_capital_pagado_recaudacion="";
 $sel_fecha_pago_recaudacion="";
 $sel_nombre_entidad_financiera_recaudacion="";
 $sel_numero_papeleta_recaudacion="";
 $sel_concepto_pago_amortizacion="";

 */
 
 if($_SERVER['REQUEST_METHOD']=='POST' )
 {
 	$sel_ruc_clientes=$_POST['ruc_clientes'];
    $sel_razon_social_clientes=$_POST['razon_social_clientes'];
    /*
    $sel_capital_pagado_recaudacion=$_POST['capital_pagado_recaudacion'];
    $sel_fecha_pago_recaudacion=$_POST['fecha_pago_recaudacion'];
    $sel_nombre_entidad_financiera_recaudacion=$_POST['nombre_entidad_financiera_recaudacion'];
    $sel_numero_papeleta_recaudacion=$_POST['numero_papeleta_recaudacion'];
    $sel_concepto_pago_amortizacion=$_POST['concepto_pago_amortizacion'];
    */
	
 }


 $habilitar="disabled";
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
			  	<input type="text"  name="ruc_clientes" id="ruc_clientes" value="" onkeypress="return numeros(event)" class="form-control"/> 
			   
            	</div>
            	</div>
		   		<div class="form-group">
		   		<div class="col-xs-4 col-md-4">
			  	<label for="razon_social_clientes" class="control-label">Razón Social:</label>
			  	<input type="text"  name="razon_social_clientes" id="razon_social_clientes" value="" class="form-control"/> 
			   	  <div id="mensaje_razon_social_clientes" class="errores"></div>
              </div>
             	  
              </div>
		   	
		     <div class="col-xs-3 col-md-3">
			 <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-info " style="margin-top: 23px;"/> 	
		    
		     </div>
		  
		
		    </div>
            </div>
            
          
	      
	       <?php if(!empty($resultRes)){?>
	       <div class="panel-body" > 
	       <section style="overflow-y:scroll;">
           <table class="table table-hover ">
       
       
           <tr>
                    <th style="color:#456789;font-size:80%;"></th>
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
                       <th style="color:#456789;font-size:80%;"><input type="radio"  id="id_amortizacion_cabeza[]"   name="id_amortizacion_cabeza[]"  value="<?php echo $res->id_amortizacion_cabeza; ?>" onclick="uncheckRadio(this)" class="marcados"></th>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->ruc_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->razon_social_clientes; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_credito_amortizacion_cabeza; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_pagare_amortizacion_cabeza; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_creditos; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->capital_prestado_amortizacion_cabeza; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->tasa_interes_amortizacion_cabeza; ?>  </td>
		           	   <td style="color:#000000;font-size:80%;"> <?php echo $res->plazo_meses_amortizacion_cabeza; echo " meses"; ?>  </td>
		    </tr>
	 	
	 	 
	 	
	      <?php } }?>
	      </table>     
		</section>
		
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					   
            					   <input type="submit" id="Recuperar" name="Recuperar"  value="Recuperar" class="btn btn-warning" style="margin-top: 23px;"/> 	
		     
            </div>
            </div>
            </div>
        </div> 
	      <?php }?>
          
          
	        	
	    
	         
	    <?php if(!empty($resultSet)){?>
	    <div class="panel-body"> 
	    <div class="row">
  		    <div class="form-group" style="margin-top: 25px;">
		    <div class="col-xs-2 col-md-2" style="text-align: center;">
			  	<label for="capital_pagado_recaudacion" class="control-label">Capital Pagado:</label>
			  	<input type="text"  name="capital_pagado_recaudacion" id="capital_pagado_recaudacion" value="" onkeypress="return numeros(event)" class="form-control"/> 
			   	 <div id="mensaje_capital_pagado_recaudacion" class="errores"></div>
            </div>
            </div>
            
            <div class="form-group">
		   	<div class="col-xs-2 col-md-2" style="text-align: center;">
			  	<label for="fecha_pago_recaudacion" class="control-label">Fecha Pago:</label>
			  	<input type="date"  name="fecha_pago_recaudacion" id="fecha_pago_recaudacion" value="<?php ?>"  class="form-control"/> 
			   	 <div id="mensaje_fecha_pago_recaudacion" class="errores"></div>
            </div>
            </div>
            <div class="form-group">
            <div class="col-xs-1 col-md-1">
			 <input type="submit" id="Calcular" name="Calcular"  value="Calcular" class="btn btn-warning " style="margin-top: 23px;"/> 	
		    </div>
		     </div> 
            <div class="form-group">
		   	<div class="col-xs-4 col-md-4" style="text-align: center;">
			  	<label for="nombre_entidad_financiera_recaudacion" class="control-label">Entidad Financiera:</label>
			  	<input type="text"  name="nombre_entidad_financiera_recaudacion" id="nombre_entidad_financiera_recaudacion" value="<?php  ?>" class="form-control"/> 
			   	
            </div>
            </div>
            <div class="form-group">
		   	<div class="col-xs-3 col-md-3" style="text-align: center;">
			  	<label for="numero_papeleta_recaudacion" class="control-label"># Papeleta:</label>
			  	<input type="text"  name="numero_papeleta_recaudacion" id="numero_papeleta_recaudacion" value="<?php  ?>" class="form-control"/> 
			   	
            </div>
            </div>
        </div>   
	       
	     <div class="row">
  		     <div class="form-group" style="margin-top: 15px;">
             <div class="col-xs-12 col-md-12">
		                          <label for="concepto_pago_amortizacion" class="control-label">Concepto de Pago:</label>
                                  <input type="text"  id="concepto_pago_amortizacion" name="concepto_pago_amortizacion" value="<?php ?>"  placeholder="Observaciones" class="form-control"/>
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
	    		<th style="color:#456789;font-size:80%;"><b>Interes Normal</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Interes Días</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Amortización</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Pagos</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Fecha Pago</b></th>
	    	</tr>
	    	
	                     
	      <?php	foreach ($resultSet as $res)	{ ?>
	               
	        		<tr>
	        		   <th style="color:#456789;font-size:80%;"><input type="radio" id="id_amortizacion_detalle[]"   name="id_amortizacion_detalle[]"  value="<?php  echo $res->id_amortizacion_detalle;  ?> " onclick="uncheckRadio(this)" class="marcados"></th>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_cuota_amortizacion_detalle; ?></td>
	            	   <td style="color:#000000;font-size:80%;"> <?php echo number_format($res->saldo_inicial_amortizacion_detalle,2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo number_format($res->interes_amortizacion_detalle,2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo number_format($res->interes_dias_amortizacion_detalle,2); ?>     </td> 
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