<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Listar Pedidos</title>
        
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <link rel="stylesheet" href="view/css/bootstrap.css">
	      <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/listadopedidos.js"></script>
	      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		  <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
		
        
    
     
      <script>
	       	$(document).ready(function(){ 	
				
	
    		});

     </script>
     
     
     <script>
	       	$(document).ready(function(){ 	
				$( "#nombre_plan_cuentas" ).autocomplete({
      				source: "<?php echo $helper->url("PlanCuentasAdmin","AutocompleteNombre"); ?>",
      				minLength: 1
    			});
	
    		});

     </script>
     
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
 <form action="<?php echo $helper->url("Pedidos","ListarPedidos"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12" >
 <br>
 <div class="col-lg-12">
	   <div class="panel panel-info">
	      <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-menu-right'></i> Listar Pedidos</h4>
	      </div>
	      <div class="panel-body">  			    
		    <div class="row">
		       <div class="col-xs-6 col-md-3">
		          <div class="form-group">
		    
		     		<label for="f_clientes" class="control-label">Cliente</label>
                    <input type="text" class="form-control" id="f_clientes" name="f_clientes" value=""  placeholder="cliente">
                    <input type="hidden" class="form-control" id="hd_idusuario" name="hd_idusuario" value="<?php  $varsession = isset($_SESSION['id_usuarios'])?$_SESSION['id_usuarios']:-1; echo $varsession;  ?>" >
                    <input type="hidden" class="form-control" id="hd_idclientes" name="hd_idclientes" value="" >
                    <span class="help-block"></span>
		          </div>
		       </div>
		       <div class="col-xs-6 col-md-3">
		          <div class="form-group">
		    
		     		<label for="f_identificacion" class="control-label">Ruc/Identificacion</label>
                    <input type="text" class="form-control" id="f_identificacion" name="f_identificacion" value=""  placeholder="ruc/identificacion">
                    <span class="help-block"></span>
		          </div>
		       </div>
		        <div class="col-xs-6 col-md-3">
		          <div class="form-group">
		    
		     		<label for="f_numpedido" class="control-label">Num. Pedido</label>
                    <input type="text" class="form-control" id="f_numpedido" name="f_numpedido" value=""  placeholder="num">
                    <span class="help-block"></span>
		          </div>
		       </div>
		        <div class="col-xs-6 col-md-3">
		          <div class="form-group">
		    
		     		<label for="f_fecha" class="control-label">Fecha</label>
                    <input type="date" class="form-control" id="f_fecha" name="f_fecha" value="" >
                    <span class="help-block"></span>
		          </div>
		       </div>
		       <div class="col-xs-12 col-md-12">
		       <div class="col-xs-6 col-md-5">
		       </div>
		         <div class="col-xs-6 col-md-2"> 
		            <div class="form-group">
		    			  
				     <button type="button" style="margin-top: 10px" id="buscar" name="buscar" class="btn btn-info"><i class="glyphicon glyphicon-search"> Buscar</i></button>
		     		 <!-- <button type="submit" id="reporte" name="reporte" value="reporte"   class="btn btn-success" style="margin-top: 10px;"><i class="glyphicon glyphicon-print"></i></button>         
	      			 -->
		           </div>
		        </div>
		        <div class="col-xs-6 col-md-5">
		        </div>
		       </div>
            </div>     
		    
		  </div>
	   </div>
	</div>        
     
     <!-- para la busqueda -->
 <div class="col-lg-12">		 
	<div class="col-lg-12">		 
		 <div style="height: 200px; display: block;">		
		     <h4 style="color:#ec971f;"></h4>
			 <div>					
				<!-- Carga gif animado -->
				<div id="formpedidos" style="position: absolute;	text-align: center;	top: 10px;	width: 100%;display:none;"></div>
					
				<!-- Datos ajax Final -->
				<div class="div_pedidos" >							
				</div>
					
		      </div>
		       <br>
				  
		 </div>		 
	</div>		 
  </div>
		 
</form>
     
</div>
     
</div>
      
      <br>
      <br>
      <br>
      <br> 
 
</body>  

</html>   
    
  
    