<?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>

<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Reporte Tabla Amortizacion - contabilidad 2016</title>
        
       <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
          
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
         
    <script type="text/javascript">
	$(document).ready(function(){
		//load_juicios(1);

		$("#buscar").click(function(){

			load_tabla_amortizacion(1);
			
			});
	});

	
	function load_tabla_amortizacion(pagina){
		//iniciar variables
		var con_id_entidades=$("#id_entidades").val();
		var con_ruc_clientes=$("#ruc_clientes").val();
		 var con_ruc_clientes=$("#ruc_clientes").val();
		 var con_razon_social_clientes=$("#razon_social_clientes").val();
		 var con_numero_credito_amortizacion_cabeza=$("#numero_credito_amortizacion_cabeza").val();
		 var con_numero_pagare_amortizacion_cabeza=$("#numero_pagare_amortizacion_cabeza").val();

		 		  var con_datos={
		 				id_entidades:con_id_entidades,  
		 				ruc_clientes:con_ruc_clientes,
		 				razon_social_clientes:con_razon_social_clientes,
		 				numero_credito_amortizacion_cabeza:con_numero_credito_amortizacion_cabeza,
		 				numero_pagare_amortizacion_cabeza:con_numero_pagare_amortizacion_cabeza,
				  action:'ajax',
				  page:pagina
				  };
		 		
		$("#tabla_amortizacion").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("ReporteTablaAmortizacion","index");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#tabla_amortizacion").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".div_tabla_amortizacion").html(data).fadeIn('slow');
				$("#tabla_amortizacion").html("");
			}
		})
	}
	
	</script>
 </head>
    <body style="background-color: #d9e3e4;">
       <?php
       
     $sel_id_entidades="";
     $sel_ruc_clientes="";
	 $sel_razon_social_clientes="";
	 $sel_numero_credito_amortizacion_cabeza="";
	 $sel_numero_pagare_amortizacion_cabeza="";
	 
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_entidades = $_POST['id_entidades'];
       	$sel_ruc_clientes = $_POST['ruc_clientes'];
        $sel_razon_social_clientes=$_POST['razon_social_clientes'];
        $sel_numero_credito_amortizacion_cabeza=$_POST['numero_credito_amortizacion_cabeza'];
        $sel_numero_pagare_amortizacion_cabeza=$_POST['numero_pagare_amortizacion_cabeza'];
       
       }
       ?>
 
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("ReporteTablaAmortizacion","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" target="_blank">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Reporte Tabla Amortizacion</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  					
          <div class="col-xs-3">
			  	<p  class="formulario-subtitulo">Entidades:</p>
			  	<select name="id_entidades" id="id_entidades"  class="form-control" readonly>
			  			 <?php foreach($resultEnt as $res) {?>
						<option value="<?php echo $res->id_entidades; ?>"<?php if($sel_id_entidades==$res->id_entidades){echo "selected";}?>><?php echo $res->nombre_entidades;  ?> </option>
			            <?php } ?>
				</select>
		 </div>

		 
		  
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Ruc Social</p>
			  	<input type="text"  name="ruc_clientes" id="ruc_clientes" value="<?php echo $sel_ruc_clientes;?>" class="form-control"/> 
          </div>
		
         <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Razón Social</p>
			  	<input type="text"  name="razon_social_clientes" id="razon_social_clientes" value="<?php echo $sel_razon_social_clientes;?>" class="form-control"/> 
         </div>
         
         <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Número de Crédito</p>
			  	<input type="text"  name="numero_credito_amortizacion_cabeza" id="numero_credito_amortizacion_cabeza" value="<?php echo $sel_numero_credito_amortizacion_cabeza;?>" class="form-control"/> 
         </div>
         
         <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Número de Pagaré</p>
			  	<input type="text"  name="numero_pagare_amortizacion_cabeza" id="numero_pagare_amortizacion_cabeza" value="<?php echo $sel_numero_pagare_amortizacion_cabeza;?>" class="form-control"/> 
         </div>
      		</div>
  		
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
  		<button type="button" id="buscar" name="buscar" value="Buscar"   class="btn btn-info" style="margin-top: 10px;"><i class="glyphicon glyphicon-search"></i></button>    
		 
		 <button type="submit" id="reporte" name="reporte" value="reporte"   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-print"></i></button>         
	  
	  <?php if(!empty($resultSet))  {?>
	  <a href="<?php echo IP_REPORTE; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success"><i class="glyphicon glyphicon-download-alt"></i></a>
	
	  <!-- 
		 <a href="/contabilidad/FrameworkMVC/view/ireports/ContReporteComprobantesReport.php?id_entidades=<?php  echo $sel_id_entidades ?>&id_tipo_comprobantes=<?php  echo $sel_id_tipo_comprobantes?>&numero_ccomprobantes=<?php  echo $sel_numero_ccomprobantes?>&referencia_doc_ccomprobantes=<?php  echo $sel_referencia_doc_ccomprobantes?>&fecha_desde=<?php  echo $sel_fecha_desde?>&fecha_hasta=<?php  echo $sel_fecha_hasta?>&id_usuarios=<?php echo $_SESSION['id_usuarios'];?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success"><i class="glyphicon glyphicon-download-alt"></i></a>
	   -->
       <?php } else {?>
		  <?php } ?>
	
		  </div>
		 
		</div>
        	
		 </div>
		 
		 
		 <div class="col-lg-12">
		 
		 <div class="col-lg-12">
		 
		 <div style="height: 200px; display: block;">
		
		 <h4 style="color:#ec971f;"></h4>
			  <div>					
					<div id="tabla_amortizacion" style="position: absolute;	text-align: center;	top: 10px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="div_tabla_amortizacion" >
					
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
       
 <br>
 <br>
 <br>
   </body>  

    </html>   
    
  
    