<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Imprimir Consultar Plan Cuentas - contabilidad 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
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
         
         	
        
    <script type="text/javascript">
	$(document).ready(function(){
		//load_juicios(1);

		$("#buscar").click(function(){

			load_plan_cuentas(1);
			
			});
	});

	
	function load_plan_cuentas(pagina){
		
		//iniciar variables
		 var con_id_entidades=$("#id_entidades").val();
		 var con_codigo_plan_cuentas=$("#codigo_plan_cuentas").val();
		 var con_nombre_plan_cuentas=$("#nombre_plan_cuentas").val();
		 var con_nivel_plan_cuentas=$("#nivel_plan_cuentas").val();
		 var con_t_plan_cuentas=$("#t_plan_cuentas").val();
		 var con_n_plan_cuentas=$("#n_plan_cuentas").val();
		

		  var con_datos={
				  id_entidades:con_id_entidades,
				  codigo_plan_cuentas:con_codigo_plan_cuentas,
				  nombre_plan_cuentas:con_nombre_plan_cuentas,
				  nivel_plan_cuentas:con_nivel_plan_cuentas,
				  t_plan_cuentas:con_t_plan_cuentas,
				  n_plan_cuentas:con_n_plan_cuentas,
				  action:'ajax',
				  page:pagina
				  };


		$("#plancuentas").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("PlanCuentas","ImprimirConsultarPlanCuentas");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#plancuentas").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".div_plancuentas").html(data).fadeIn('slow');
				$("#plancuentas").html("");
			}
		})
	}
	
	</script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php
       
       $sel_id_entidades = "";
       $sel_codigo_plan_cuentas = "";
       $sel_nombre_plan_cuentas = "";
       $sel_nivel_plan_cuentas = "";
       $sel_t_plan_cuentas = "";
       $sel_n_plan_cuentas = "";
      
        
      
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_entidades = $_POST['id_entidades'];
       	$sel_codigo_plan_cuentas = $_POST['codigo_plan_cuentas'];
       	$sel_nombre_plan_cuentas = $_POST['nombre_plan_cuentas'];
       	$sel_nivel_plan_cuentas = $_POST['nivel_plan_cuentas'];
       	$sel_t_plan_cuentas = $_POST['t_plan_cuentas'];
       	$sel_n_plan_cuentas = $_POST['n_plan_cuentas'];
      
       
       }
       ?>
 
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("PlanCuentas","ImprimirConsultarPlanCuentas"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" target="_blank">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Imprimir Consultar Plan Cuentas</h4>
       	 
       	 
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
			  	<p  class="formulario-subtitulo" >Codigo:</p>
			  	<input type="text"  name="codigo_plan_cuentas" id="codigo_plan_cuentas" value="<?php echo $sel_codigo_plan_cuentas;?>" class="form-control"/> 
          </div>
		 
		 <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nombre:</p>
			  	<input type="text"  name="nombre_plan_cuentas" id="nombre_plan_cuentas" value="<?php echo $sel_nombre_plan_cuentas;?>" class="form-control"/> 
          </div>
		 
		 <div class="col-xs-2">
			  	<p  class="formulario-subtitulo">Nivel:</p>
			  	<select name="nivel_plan_cuentas" id="nivel_plan_cuentas"  class="form-control">
			  	<option value=""><?php echo "--TODOS--";  ?> </option>
			  		<?php foreach($resultNiv as $res) {?>
						<option value="<?php echo $res->nivel_plan_cuentas; ?>"<?php if($sel_nivel_plan_cuentas==$res->nivel_plan_cuentas){echo "selected";}?>><?php echo $res->nivel_plan_cuentas;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 <div class="col-xs-2">
			  	<p  class="formulario-subtitulo">Tipo:</p>
			  	<select name="t_plan_cuentas" id="t_plan_cuentas"  class="form-control">
			  	<option value=""><?php echo "--TODOS--";  ?> </option>
			  		<?php foreach($resultTip as $res) {?>
						<option value="<?php echo $res->t_plan_cuentas; ?>"<?php if($sel_t_plan_cuentas==$res->t_plan_cuentas){echo "selected";}?>><?php echo $res->t_plan_cuentas;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 <div class="col-xs-2">
			  	<p  class="formulario-subtitulo">Naturaleza:</p>
			  	<select name="n_plan_cuentas" id="n_plan_cuentas"  class="form-control">
			  	<option value=""><?php echo "--TODOS--";  ?> </option>
			  		<?php foreach($resultNat as $res) {?>
						<option value="<?php echo $res->n_plan_cuentas; ?>"<?php if($sel_n_plan_cuentas==$res->n_plan_cuentas){echo "selected";}?>><?php echo $res->n_plan_cuentas;  ?> </option>
			            <?php } ?>
				</select>
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
					<div id="plancuentas" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="div_plancuentas" >
							
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
      <br> 
 
   </body>  

    </html>   
    
  
    