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
         
         	
    <script type="text/javascript">
	$(document).ready(function(){
		//load_juicios(1);

		$("#buscar").click(function(){

			load_productos(1);
			
			});
	});

	
	function load_productos(pagina){
		
		//iniciar variables
		 var con_id_entidades=$("#id_entidades").val();
		 var con_codigo_productos=$("#codigo_productos").val();
		 var con_nombre_productos=$("#nombre_productos").val();
		 var con_id_grupo_productos=$("#id_grupo_productos").val();
		 var con_id_unidades_medida=$("#id_unidades_medida").val();
		 var con_iva_productos=$("#iva_productos").val();

		


		 
		  var con_datos={
				  id_entidades:con_id_entidades,
				  codigo_productos:con_codigo_productos,
				  nombre_productos:con_nombre_productos,
				  id_grupo_productos:con_id_grupo_productos,
				  id_unidades_medida:con_id_unidades_medida,
				  iva_productos:con_iva_productos,
				  action:'ajax',
				  page:pagina
				  };


		$("#productos").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("FC_Productos","Reporte_Productos");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#productos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".div_productos").html(data).fadeIn('slow');
				$("#productos").html("");
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
       $sel_codigo_productos="";
       $sel_nombre_productos="";
       $sel_id_grupo_productos="";
       $sel_id_unidades_medida="";
       $sel_iva_productos="";
       
         
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_entidades = $_POST['id_entidades'];
        $sel_codigo_productos=$_POST['codigo_productos'];
       	$sel_nombre_productos=$_POST['nombre_productos'];
       	$sel_id_grupo_productos=$_POST['id_grupo_productos'];
       	$sel_id_unidades_medida=$_POST['id_unidades_medida'];
       	$sel_iva_productos=$_POST['iva_productos'];
       
       }
       
       $arrayOpciones=array("todos"=>'--TODOS--',"true"=>'Si',"false"=>'No');
       
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
			  	<p  class="formulario-subtitulo" >Codigo Producto:</p>
			  	<input type="text"  name="codigo_productos" id="codigo_productos" value="<?php echo $sel_codigo_productos;?>" class="form-control"/> 
          </div>
		
         <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nombre Producto:</p>
			  	<input type="text"  name="nombre_productos" id="nombre_productos" value="<?php echo $sel_nombre_productos;?>" class="form-control"/> 
         </div>
         
           
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo">Grupo Producto:</p>
			  	<select name="id_grupo_productos" id="id_grupo_productos"  class="form-control" >
			  		<option value="0"><?php echo "--TODOS--";  ?> </option>
					<?php foreach($result_FC_grupo_productos as $res) {?>
						<option value="<?php echo $res->id_grupo_productos; ?>"<?php if($sel_id_grupo_productos==$res->id_grupo_productos){echo "selected";}?> ><?php echo $res->nombre_grupo_productos;  ?> </option>
			            <?php } ?>
				</select>
		  </div>
		  
         <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo">UM Producto:</p>
			  	<select name="id_unidades_medida" id="id_unidades_medida"  class="form-control" >
			  		<option value="0"><?php echo "--TODOS--";  ?> </option>
					<?php foreach($result_FC_unidades_medida as $res) {?>
						<option value="<?php echo $res->id_unidades_medida; ?>"<?php if($sel_id_unidades_medida==$res->id_unidades_medida){echo "selected";}?> ><?php echo $res->nombre_unidades_medida;  ?> </option>
			            <?php } ?>
				</select>
		  </div>
		  
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Iva Productos:</p>
			  	<select name="id_unidades_medida" id="id_unidades_medida"  class="form-control">
					<?php foreach($arrayOpciones as $res=>$val) {?>
						<option value="<?php echo $res; ?>" <?php if($sel_id_unidades_medida==$res){echo "selected";}?>><?php echo $val;  ?> </option>
					<?php } ?>
		        </select>
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
					<div id="productos" style="position: absolute;	text-align: center;	top: 10px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="div_productos" >
							
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
    
  
    