 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Balance Comprobacion - contabilidad 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="view/css/bootstrap.css">
         <link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 		
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

			load_balance_comprobacion(1);
			
			});
	});

	
	function load_balance_comprobacion(pagina){
		
		//iniciar variables
		 var con_id_entidades=$("#id_entidades").val();
		 var con_id_usuarios=$("#id_usuarios").val();
		 var con_reporte=$("#reporte").val();
		 var con_mes=$("#mes").val();
		 var con_años=$("#año").val();
		 var con_anio=$("#anio").val();

		  var con_datos={
				  id_entidades:con_id_entidades,
				  id_usuarios:con_id_usuarios,
				  reporte:con_reporte,
				  mes:con_mes,
				  año:con_años,
				  anio:con_anio,
				  action:'ajax',
				  page:pagina,
				  buscar:$("#buscar").val(),
				  reporte_rpt:$("#reporte_rpt").val()
				  
				  };


		$("#balance_comprobacion").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("BalanceComprobacion","BalanceComprobacion");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#balance_comprobacion").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".div_balance_comprobacion").html(data).fadeIn('slow');
				$("#balance_comprobacion").html("");
			}
		})
	}
	
	</script>


      <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#reporte").click(function() {
				
               

               var id_reporte = $(this).val();

				
               //para estudiante
               if(id_reporte == 'detallado')
               {
            	   $("#div_reporte_simplificado").fadeIn("slow");
               }
            	
               else
               {
            	   $("#div_reporte_simplificado").fadeOut("slow");
               }
              
		    });

		    $("#reporte").change(function() {
				
	               

	               var id_reporte = $(this).val();

					
	               
	               if(id_reporte == 'simplificado')
	               {
	            	   $("#div_reporte_detallado").fadeIn("slow");
	               }
	            	
	               else
	               {
	            	   $("#div_reporte_detallado").fadeOut("slow");
	               }
	               
	               
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
       $sel_id_usuarios="";
       $sel_reporte="";
       $sel_mes="";
       $sel_años="";
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_entidades = $_POST['id_entidades'];
        $sel_id_usuarios=$_POST['id_usuarios'];
       	$sel_reporte=$_POST['reporte'];
        $sel_mes=$_POST['mes'];
       	$sel_años=$_POST['año'];
       
       }
       
       $arrayOpciones=array("detallado"=>'DETALLADO',"simplificado"=>'SIMPLIFICADO');
       $arrayMeses=array("1"=>'ENERO',"2"=>'FEBRERO',"3"=>'MARZO',"4"=>'ABRIL',"5"=>'MAYO',"6"=>'JUNIO',"7"=>'JULIO',"8"=>'AGOSTO',"9"=>'SEPTIEMBRE',"10"=>'OCTUBRE',"11"=>'NOVIEMBRE',"12"=>'DICIEMBRE');
       $arrayAños=array("2010"=>'2010',"2011"=>'2011',"2012"=>'2012',"2013"=>'2013',"2014"=>'2014',"2015"=>'2015',"2016"=>'2016',"2017"=>'2017',"2018"=>'2018',"2019"=>'2019',"2020"=>'2020');
       ?>
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("BalanceComprobacion","BalanceComprobacion"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" target="_blank">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Balance Comprobación</h4>
       	 
       	 
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
			  	<p  class="formulario-subtitulo">Usuario:</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" readonly>
			  		<?php foreach($resultEnt as $res) {?>
						<option value="<?php echo $res->id_usuarios; ?>"<?php if($sel_id_usuarios==$res->id_usuarios){echo "selected";}?> ><?php echo $res->nombre_usuarios;  ?> </option>
			            <?php } ?>
				</select>

         </div>
         
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Reporte</p>
			  	<select name="reporte" id="reporte"  class="form-control">
			  	<option value="" selected="selected">--Seleccione--</option>
					<?php foreach($arrayOpciones as $res=>$val) {?>
						<option value="<?php echo $res; ?>" <?php if($sel_reporte==$res){echo "selected";}?>><?php echo $val;  ?> </option>
					<?php } ?>
		        </select>
         </div>
         
         <div id="div_reporte_simplificado" style="display: none;">
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Mes:</p>
			  	<select name="mes" id="mes"  class="form-control">
					<?php foreach($arrayMeses as $res=>$val) {?>
						<option value="<?php echo $res; ?>" <?php if($sel_mes==$res){echo "selected";}?>><?php echo $val;  ?> </option>
					<?php } ?>
		        </select>
		 </div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Año:</p>
          		<select name="año" id="año"  class="form-control">
					<?php foreach($arrayAños as $res=>$val) {?>
						<option value="<?php echo $res; ?>" <?php if($sel_años==$res){echo "selected";}?>><?php echo $val;  ?> </option>
					<?php } ?>
		        </select>
		</div>
		 </div>
		 
		 <div id="div_reporte_detallado" style="display: none;">
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Año:</p>
          		<select name="anio" id="anio"  class="form-control">
					<?php foreach($arrayAños as $res=>$val) {?>
						<option value="<?php echo $res; ?>" <?php if($sel_años==$res){echo "selected";}?>><?php echo $val;  ?> </option>
					<?php } ?>
		        </select>
		</div>
		 </div>
		 
		 
  			</div>
  		 <div class="col-lg-12">
		 <div class="col-lg-12">
	     </div>
	     </div>
  		
  		<div class="col-lg-12" style="text-align: center; margin-top: 30px">
  		    
		 <button type="button" id="buscar" name="buscar"  class="btn btn-info" style="margin-top: 10px;"><i class="glyphicon glyphicon-search"></i></button>
		 <button type="submit" id="reporte_rpt" name="reporte_rpt" value="Reporte"   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-print"></i></button>         
	     </div>
		 </div>
         </div>
		 
		 
		 <div class="col-lg-12">
		 <div class="col-lg-12">
	     <div style="height: 200px; display: block;">
		
		 <h4 style="color:#ec971f;"></h4>
			  <div>					
					<div id="balance_comprobacion" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="div_balance_comprobacion" ></div><!-- Datos ajax Final -->
		      </div>
		       <br>
				  
		 </div>
		 
		 </div>
		 
		 <?php /* ?> 
		 <div class="col-lg-12">
		
		 
		 
		 <section class="" style="height:300px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	            
	    		<th style="color:#456789;font-size:80%;">Entidad</th>
	    		<th style="color:#456789;font-size:80%;">Codigo Cuenta</th>
	    		<th style="color:#456789;font-size:80%;">Nombre</th>
	    		<th style="color:#456789;font-size:80%;">Concepto</th>
	    		<th style="color:#456789;font-size:80%;">Saldo Inicial</th>
	    		<th style="color:#456789;font-size:80%;">Debe</th>
	    		<th style="color:#456789;font-size:80%;">Haber</th>
	    		<th style="color:#456789;font-size:80%;">Saldo Final</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
	    	    <th></th>
	    		<th></th>
	  		</tr>
	        
           <?php  $paginas =   0;  ?>
		    <?php  $registros = 0; ?>
	  		
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		
	 	               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->codigo_plan_cuentas; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_plan_cuentas; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->concepto_ccomprobantes; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->saldo_ini_mayor; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->debe_mayor; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->haber_mayor; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->saldo_mayor; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_mayor; ?>  </td>
		               <?php  $registros = $registros + 1 ; ?>
		    		</tr>
		        <?php }   ?>
            
       	</table> 
       	
       	</section>
       	<!--       			<table class="table">
				<th class="text-center">
				    	<nav>
						  <ul id="pagina" name="pagina" class="pagination">
						    <?php if ($paginasTotales > 0) {?>
						    		<?php if ($ultima_pagina > 1 ) {?>
						    			<input type="submit" value="<?php echo "<<"; ?>" id="anterior_pagina"    name="anterior_pagina" class="btn btn-info"/>
						    		<?php }?>
						    <?php for ($i = $ultima_pagina; $i< $paginasTotales+1; $i++)  { ?>
						    		
						    		<?php if ($i  < $ultima_pagina + 5) {  ?>
						    			<input type="hidden" value="<?php echo $i+1; ?>" id="ultima_pagina"    name="ultima_pagina" class="btn btn-info"/>
						    			<input type="submit" value="<?php echo $i; ?>" id="pagina"  <?php if ($i == $pagina_actual ) { echo 'style="color: #1454a3 " '; }  ?>     name="pagina" class="btn btn-info"/>
						    			
						    		<?php } ?>
						    		<?php if ($paginasTotales  == $i) {  ?>
						    			<input type="submit" value="<?php echo ">>"; ?>" id="siguiente_pagina"    name="siguiente_pagina" class="btn btn-info"/>
						    		<?php } ?>
						    		
						    <?php    } }?>
						    
						  </ul>
						</nav>	   	   
			
				</th>
				<tr class="bg-primary">
						<p class="text-center"> <strong> Registros Cargados: <?php echo  $registros?> Registros Totales: <?php echo  $registrosTotales?> </strong>  </p>
	     		  	
				</tr>			
		</table>
		 	-->
 				<?php  }   else { ?>
		        <?php }  ?>    
		        
      
     
		 
		 </div>
		 
		 <?php */?>
		 
		 </div>
		 
	
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
       
 
   </body>  

    </html>   
    
  
    