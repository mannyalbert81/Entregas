<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Reporte Usuarios Administrador - contabilidad 2016</title>
        
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

			load_usuarios_admin(1);
			
			});
	});

	
	function load_usuarios_admin(pagina){
		
		//iniciar variables
		 var con_id_entidades=$("#id_entidades").val();
		 var con_nombre_usuarios=$("#nombre_usuarios").val();
		 var con_cedula_usuarios=$("#cedula_usuarios").val();
		 var con_correo_usuarios=$("#correo_usuarios").val();
		 var con_id_rol=$("#id_rol").val();
		 var con_id_estado=$("#id_estado").val();

		  var con_datos={
				  id_entidades:con_id_entidades,
				  nombre_usuarios:con_nombre_usuarios,
				  cedula_usuarios:con_cedula_usuarios,
				  correo_usuarios:con_correo_usuarios,
				  id_rol:con_id_rol,
				  id_estado:con_id_estado,
				  action:'ajax',
				  page:pagina
				  };


		$("#usuarios_admin").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("ReporteUsuariosAdmin","index");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#usuarios_admin").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".div_usuarios_admin").html(data).fadeIn('slow');
				$("#usuarios_admin").html("");
			}
		})
	}
	
	</script>


 <script>
	       	$(document).ready(function(){ 	
				$( "#correo_usuarios" ).autocomplete({
      				source: "<?php echo $helper->url("ReporteUsuariosAdmin","AutocompleteCorreo"); ?>",
      				minLength: 1
    			});
	
    		});

     </script>


	<script>
	       	$(document).ready(function(){ 	
				$( "#nombre_usuarios" ).autocomplete({
      				source: "<?php echo $helper->url("ReporteUsuariosAdmin","AutocompleteNombre"); ?>",
      				minLength: 1
    			});
	
    		});

     </script>

     <script>
	       	$(document).ready(function(){ 	
				$( "#cedula_usuarios" ).autocomplete({
      				source: "<?php echo $helper->url("ReporteUsuariosAdmin","AutocompleteCedula"); ?>",
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
       $sel_nombre_usuarios="";
       $sel_cedula_usuarios="";
       $sel_correo_usuarios="";
       $sel_id_rol="";
       $sel_id_estado="";
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_entidades = $_POST['id_entidades'];
        $sel_nombre_usuarios=$_POST['nombre_usuarios'];
       	$sel_cedula_usuarios=$_POST['cedula_usuarios'];
       	$sel_correo_usuarios=$_POST['correo_usuarios'];
       	$sel_id_rol=$_POST['id_rol'];
       	$sel_id_estado=$_POST['id_estado'];
       
       }
       ?>
 
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("ReporteUsuariosAdmin","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" target="_blank">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Reporte Usuarios</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  					
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo">Entidades:</p>
			  	<select name="id_entidades" id="id_entidades"  class="form-control">
			  			 <option value="0"><?php echo "--TODOS--";  ?> </option>
			  			 <?php foreach($resultEnt as $res) {?>
						<option value="<?php echo $res->id_entidades; ?>"<?php if($sel_id_entidades==$res->id_entidades){echo "selected";}?>><?php echo $res->nombre_entidades;  ?> </option>
			            <?php } ?>
				</select>
		 </div>

		 
		  
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nombre Usuarios</p>
			  	<input type="text"  name="nombre_usuarios" id="nombre_usuarios" value="<?php echo $sel_nombre_usuarios;?>" class="form-control"/> 
          </div>
		
         <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Cedula</p>
			  	<input type="text"  name="cedula_usuarios" id="cedula_usuarios" value="<?php echo $sel_cedula_usuarios;?>" class="form-control"/> 
         </div>
         
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Correo</p>
			  	<input type="text"  name="correo_usuarios" id="correo_usuarios" value="<?php echo $sel_correo_usuarios;?>" class="form-control "/> 
		</div>
        
         <div class="col-xs-2">
			  	<p  class="formulario-subtitulo">Rol</p>
			  	<select name="id_rol" id="id_rol"  class="form-control" >
			  			  	<option value="0"><?php echo "--TODOS--";  ?> </option>
			  		<?php foreach($resultRol as $res) {?>
						<option value="<?php echo $res->id_rol; ?>"<?php if($sel_id_rol==$res->id_rol){echo "selected";}?>><?php echo $res->nombre_rol;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		  <div class="col-xs-2">
			  	<p  class="formulario-subtitulo">Estado</p>
			  	<select name="id_estado" id="id_estado"  class="form-control" >
			  			  	<option value="0"><?php echo "--TODOS--";  ?> </option>
			  		<?php foreach($resultEst as $res) {?>
						<option value="<?php echo $res->id_estado; ?>"<?php if($sel_id_estado==$res->id_estado){echo "selected";}?>><?php echo $res->nombre_estado;  ?> </option>
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
					<div id="usuarios_admin" style="position: absolute;	text-align: center;	top: 10px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="div_usuarios_admin" >
					
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
    
  
    