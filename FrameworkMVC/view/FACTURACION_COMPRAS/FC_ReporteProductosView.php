<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Reporte Productos - contabilidad 2016</title>
        
         <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		  <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
		
       <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
         
         	<script>
	$(document).ready(function(){
			$("#fecha_hasta").change(function(){
				 var startDate = new Date($('#fecha_desde').val());

                 var endDate = new Date($('#fecha_hasta').val());

                 if (startDate > endDate){
 
                    $("#mensaje_fecha_hasta").text("Fecha desde no debe ser mayor ");
		    		$("#mensaje_fecha_hasta").fadeIn("slow"); //Muestra mensaje de error  
		    		$("#fecha_hasta").val("");

                        }
				});

			 $( "#fecha_hasta" ).focus(function() {
				  $("#mensaje_fecha_hasta").fadeOut("slow");
			   });
			});
        </script>
        
    <script type="text/javascript">
	$(document).ready(function(){
		//load_juicios(1);

		$("#buscar").click(function(){

			load_comprobantes(1);
			
			});
	});

	
	function load_comprobantes(pagina){
		
		//iniciar variables
		 var con_id_entidades=$("#id_entidades").val();
		 var con_id_tipo_comprobantes=$("#id_tipo_comprobantes").val();
		 var con_numero_ccomprobantes=$("#numero_ccomprobantes").val();
		 var con_referencia_doc_ccomprobantes=$("#referencia_doc_ccomprobantes").val();
		 var con_fecha_desde=$("#fecha_desde").val();
		 var con_fecha_hasta=$("#fecha_hasta").val();

		  var con_datos={
				  id_entidades:con_id_entidades,
				  id_tipo_comprobantes:con_id_tipo_comprobantes,
				  numero_ccomprobantes:con_numero_ccomprobantes,
				  referencia_doc_ccomprobantes:con_referencia_doc_ccomprobantes,
				  fecha_desde:con_fecha_desde,
				  fecha_hasta:con_fecha_hasta,
				  action:'ajax',
				  page:pagina
				  };


		$("#comprobantes").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("ComprobantesAdm","ReporteComprobantesAdm");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#comprobantes").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".div_comprobantes").html(data).fadeIn('slow');
				$("#comprobantes").html("");
			}
		})
	}
	
	</script>

    <script>
	       	$(document).ready(function(){ 	
				$( "#numero_ccomprobantes" ).autocomplete({
      				source: "<?php echo $helper->url("ComprobantesAdm","AutocompleteNComprobantes"); ?>",
      				minLength: 1
    			});
	
    		});

     </script>
     
     
     <script>
	       	$(document).ready(function(){ 	
				$( "#referencia_doc_ccomprobantes" ).autocomplete({
      				source: "<?php echo $helper->url("ComprobantesAdm","AutocompleteRComprobantes"); ?>",
      				minLength: 1
    			});
	
    		});

     </script>


    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php
       
       $sel_id_entidades = "";
       $sel_id_tipo_comprobantes="";
       $sel_numero_ccomprobantes="";
       $sel_referencia_doc_ccomprobantes="";
       $sel_fecha_desde="";
       $sel_fecha_hasta="";
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_entidades = $_POST['id_entidades'];
        $sel_id_tipo_comprobantes=$_POST['id_tipo_comprobantes'];
       	$sel_numero_ccomprobantes=$_POST['numero_ccomprobantes'];
       	$sel_referencia_doc_ccomprobantes=$_POST['referencia_doc_ccomprobantes'];
       	$sel_fecha_desde=$_POST['fecha_desde'];
       	$sel_fecha_hasta=$_POST['fecha_hasta'];
       
       }
       ?>
 
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("FC_Productos","Reporte_Productos"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" target="_blank">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Reporte Productos</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  					
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo">Entidades:</p>
			  	<select name="id_entidades" id="id_entidades"  class="form-control" readonly>
			  	
			  		<?php foreach($resultEnt as $res) {?>
						<option value="<?php echo $res->id_entidades; ?>"<?php if($sel_id_entidades==$res->id_entidades){echo "selected";}?>><?php echo $res->nombre_entidades;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo">Tipo Comprobantes:</p>
			  	<select name="id_tipo_comprobantes" id="id_tipo_comprobantes"  class="form-control" >
			  		<option value="0"><?php echo "--TODOS--";  ?> </option>
					<?php foreach($resultTipCom as $res) {?>
						<option value="<?php echo $res->id_tipo_comprobantes; ?>"<?php if($sel_id_tipo_comprobantes==$res->id_tipo_comprobantes){echo "selected";}?> ><?php echo $res->nombre_tipo_comprobantes;  ?> </option>
			            <?php } ?>
				</select>
		  </div>
          
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Comprobantes</p>
			  	<input type="text"  name="numero_ccomprobantes" id="numero_ccomprobantes" value="<?php echo $sel_numero_ccomprobantes;?>" class="form-control"/> 
          </div>
		
         <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Referencia Doc:</p>
			  	<input type="text"  name="referencia_doc_ccomprobantes" id="referencia_doc_ccomprobantes" value="<?php echo $sel_referencia_doc_ccomprobantes;?>" class="form-control"/> 
         </div>
         
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_desde" id="fecha_desde" value="<?php echo $sel_fecha_desde;?>" class="form-control "/> 
			    <div id="mensaje_fecha_desde" class="errores"></div>
		 </div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_hasta" id="fecha_hasta" value="<?php echo $sel_fecha_hasta;?>" class="form-control "/> 
			    <div id="mensaje_fecha_hasta" class="errores"></div>
		</div>
		 
  			</div>
  		
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
  		    
		 <button type="button" id="buscar" name="buscar" value="Buscar"   class="btn btn-info" style="margin-top: 10px;"><i class="glyphicon glyphicon-search"></i></button>
		 <button type="submit" id="reporte" name="reporte" value="reporte"   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-print"></i></button>         
	  
	  
	
		  </div>
		 
		</div>
        	
		 </div>
		 
		 
		  
		  
		   <div class="col-lg-12">
		 
		 <div class="col-lg-12">
		 
		 <div style="height: 200px; display: block;">
		
		 <h4 style="color:#ec971f;"></h4>
			  <div>					
					<div id="comprobantes" style="position: absolute;	text-align: center;	top: 10px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="div_comprobantes" >
							
					</div><!-- Datos ajax Final -->
					
		      </div>
		       <br>
				  
		 </div>
		
		 
		 
		 </div>
		 
		 
		 </div>
		 
		
	
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
       
 
   </body>  

    </html>   
    
  
    