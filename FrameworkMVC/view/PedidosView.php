<?php include("view/modulos/head.php"); ?>
<?php include("view/modulos/menu.php"); ?>
      
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <link rel="stylesheet" href="view/css/bootstrap.css">
	       <link rel="stylesheet" href="view/css/pedidos.css">
	       <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
         
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/pedidos.js"></script>
	      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	
	<script>
	       	$(document).ready(function(){ 	
				$( "#f_productos_au" ).autocomplete({
      				source: "<?php echo $helper->url("Pedidos","Ac_BuscarProducto"); ?>",
      				minLength: 1,
      				select: function(event, ui) {
     					event.preventDefault();
                        $('#hd_productoid').val(ui.item.id);
     					$('#f_productos_au').val(ui.item.value);
     					$('#txt_descripcion').val(ui.item.descp);
     			     }
    			});
	
    		});

     </script>
     
	
   
     
    
</head>
 <body class="cuerpo">
     

       

  <div class="container">
  
  <div class="row" style="background-color: #FAFAFA;">
  
  <!-- para respuestas -->
  
 
  
       <!-- empieza el form --> 
       
<form  action="<?php echo $helper->url("Pedidos","index"); ?>" method="post" enctype="multipart/form-data" >
            <br>
 <?php if($respuesta==1){?> 	
 	<div class="alert alert-success " role="alert"> Pedido ingresado correctamente </div> 	
 <?php //echo '<script language="javascript">alert(" pedido ingresado correctamente");</script>'; 
 }else if($respuesta==2){  ?>
  <div class="alert alert-warning" role="alert"> Pedido Cancelado </div>
  <?php }  else if($respuesta==3){  ?>
  <div class="alert alert-warning" role="alert">Producto Cancelado </div>
  <?php }    else if($respuesta==5){  ?>
  <div class="alert alert-danger" role="alert">Proceso no ejecutado </div>
  <?php }  ?>
 
 <?php  if(empty($dtclientepedidos)||$dtclientepedidos=="") {?>        
 <?php if ($dsclientes !="" || !empty($dsclientes)) { ?>
 
 <div class="col-md-12 col-lg-12">
	   <div class="panel panel-info">
	      <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Clientes</h4>
	      </div>
	      <div class="panel-body">  			
		    <div class="row">
		       <div class="col-xs-6 col-md-6">
		          <div class="form-group">
		    
		     		<label for="f_clientes" class="control-label">Ingrese Identificacion</label>
                    <input type="text" class="form-control" id="f_clientes" name="f_clientes" value=""  placeholder="Identificacion">
                    <span class="help-block"></span>
		          </div>
		       </div>
		       <div class="col-xs-6 col-md-6">
		          <div class="form-group">
		    			  
				    <button type="submit" style="margin-top: 20px" id="buscar" name="buscar" class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button>
		     		     
		          </div>
		       </div>
            </div>     
		    
		  </div>
	   </div>
	</div>
<br>	
	
 <?php  if (!empty ($dsclientes)){?>
 
 <div class="col-md-12 col-lg-12">
  <div class="panel panel-info">
	<table class="table table-hover ">
           <thead>
           <tr>
                    <th style="font-size:100%;">Identificacion/Ruc</th>
		    		<th style="font-size:100%;">RazonSocial</th>
		    		<th style="font-size:100%;">Selecionar</th>
		    		
	  		</tr>
	        </thead>
	           
     <?php foreach ($dsclientes as $rsclientes){?>
	        	
	        <tbody>
	   		<tr>
	   					<td style="font-size:80%;"> <?php echo $rsclientes->ruc_clientes; ?>  </td>
		                <td style="font-size:80%;" > <?php echo $rsclientes->razon_social_clientes; ?>     </td> 		             
			           	<td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("Pedidos","index"); ?>&id_clientes=<?php echo $rsclientes->id_clientes; ?>"><i class="glyphicon glyphicon-ok"></i></a>
			                </div>
			            </td>
	   		</tr>
	        </tbody>
	      
 	
 <?php }?>
      </table>
      </div>
      </div>
      
 <?php }} else {?>		     
		     
	<div class=" col-md-12 col-lg-12">
	   <div class="panel panel-info">
	      <div class="panel-heading">
	         <h4><i class='glyphicon glyphicon-edit'></i> Clientes</h4>
	      </div>
	      <div class="panel-body">  			
		    
		    <div class="row">
		       <div class="col-xs-6 col-md-6">
		          <div class="form-group">
		    
		     					  <label for="f_clientes" class="control-label">Ingrese Identificacion</label>
                                  <input type="text" class="form-control" id="f_clientes" name="f_clientes" value=""  placeholder="Identificacion">
                                  <span class="help-block"></span>
		          </div>
		       </div>
		       <div class="col-xs-6 col-md-6">
		          <div class="form-group">
		    			  
				      
				      <button type="submit" style="margin-top: 20px" id="buscar" name="buscar" class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button>
						 
		     		     
		          </div>
		       </div>
            </div>     
		    
		  </div>
	   </div>
	</div>

 <?php }} ?>
 
 

</form>

       <!-- termina el form --> 
       
<form action="<?php echo $helper->url("Pedidos","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
<br>

<?php  if(!empty($dtclientepedidos)||$dtclientepedidos!="") {?>
<div class="col-lg-12">
	   <div class="panel panel-info">
	      <div class="panel-heading">
	         <h5><i class='glyphicon glyphicon-edit'></i> Formulario Pedidos</h5>
	      </div>
	   </div>
	   
	   <div class="panel-body">  			
		    
		    <div class="row">
		      
		       <div class="col-xs-4 col-md-4">
		          <div class="form-group">
		          	<label for="txt_identificacion" class="control-label">Ruc/Identificacion</label>
                    <input type="hidden" class="form-control" id="hd_idclientes" name="hd_idclientes" value="<?php  echo $dtclientepedidos[0]->id_clientes;?>" >
                    <input type="text" class="form-control" id="txt_identificacion" name="txt_identificacion" value="<?php  echo $dtclientepedidos[0]->ruc_clientes;?>" >
                  
		          </div>
		       </div>
		       
		       <div class="col-xs-4 col-md-4">
		          <div class="form-group">
		          	
                    <label for="txt_nomclientes" class="control-label">RazonSocial</label>
                    <input type="text" class="form-control" id="txt_nomclientes" name="txt_nomclientes" value="<?php  echo $dtclientepedidos[0]->razon_social_clientes;?>" >
                    
                    
		          </div>
		       </div>
		       <div class="col-xs-4 col-md-4">
		          <div class="form-group">
		          	
                    <label for="txt_email" class="control-label">Email</label>
                    <input type="text" class="form-control" id="txt_email" name="txt_email" value="<?php  echo $dtclientepedidos[0]->email_clientes;?>" >
                       
		          </div>
		       </div>
		       <br>
		        <hr>
		        
		        <!-- para el ingreso del detalle -->
		        
		        <div class="col-xs-3 col-md-3">
		             <label for="f_productos_au" class="control-label" >Producto: </label>
                     <input type="text" class="form-control " id="f_productos_au" name="f_productos_au" value=""  placeholder="Search">
                     <input type="hidden" class="form-control" id="hd_productoid" name="hd_productoid" value="" >
                    <span class="valida_frm_producto"></span>
		        
		        </div>
		        <div class="col-xs-3 col-md-3">
		             <label for="txt_descripcion" class="control-label" >Descripcion: </label>
                     <input type="text" class="form-control " id="txt_descripcion" name="txt_descripcion" value="" readonly >
                     <span class="valida_frm_descripcion"></span>
		        </div>
		        <div class="col-xs-3 col-md-3">
		             <label for="txt_cantidad" class="control-label" >Cantidad: </label>
                     <input type="number" class="form-control " id="txt_cantidad" name="txt_cantidad" value=""  >
                     <span class="valida_frm_cantidad"></span><span id="errmsg"></span>
		        </div>
		        <div class="col-xs-3 col-md-3">
		          <div class="form-group">
		    			  
				     <button type="submit" id="agregar" style="margin-top: 25px" name="agregar" class="btn btn-info"><i class="glyphicon glyphicon-plus">Agregar</i></button>
					    
		          </div>
		       </div>
		       
		       <!-- para el temporal x code -->
		       
		       <input type="hidden" name="frutas" value='<?php echo '1';//serialize($dttmppedidos) ?>'></input>
		        
		         
		       
		       <div class="col-xs-8 col-md-8">
		       
		       <!-- para ingreso de producto -->
		       
		     
		       </div>
		       
            </div>
            
            <?php // var_dump($dttmppedidos);?>
       <!-- para la tabla temporal -->     
            <?php  if ((!empty ($dttmppedidos) || $dttmppedidos!="")&& count($dttmppedidos)>0){?>
		          <table class="table table-hover ">
           			<thead>
           				<tr>
		                    <th style="font-size:100%;">Nombre</th>
				    		<th style="font-size:100%;">Descripcion</th>
				    		<th style="font-size:100%;">Cantidad</th>
				    		<th style="font-size:100%;">Selecionar</th>
		    		
	  					</tr>
	        		</thead>
	         <?php foreach ($dttmppedidos as $rstemp){?>
	        		<tbody>
	   					<tr>
		   					<td style="font-size:80%;"> <?php echo $rstemp->nombre_producto; ?>  </td>
			                <td style="font-size:80%;" > <?php echo $rstemp->descripcion; ?>     </td> 
			                <td style="font-size:80%;" > <?php echo $rstemp->cantidad; ?>     </td>		             
				           	<td>   
				              <div class="right">
				                <a href="<?php echo $helper->url("Pedidos","index"); ?>&acc=delete&clienteid=<?php echo $dtclientepedidos[0]->id_clientes;?>&id_tproducto=<?php echo $rstemp->id_temp_pedidos; ?>"><i class="glyphicon glyphicon-trash"></i></a>
				              </div>
				            </td>
			   			</tr>
			        </tbody>
			        
			    <?php }?>
                </table>
            <?php }?> 
            
    <span>        
    <button type="submit" style="margin-top: 20px" id="hacerpedido" name="hacerpedido" class="btn btn-success"><i class="glyphicon glyphicon-hand-right"></i> Realizar Pedido</button>
	</span>	
	<span>        
    <button type="submit" style="margin-top: 20px" id="cancelarpedido" name="cancelarpedido" class="btn btn-warning"><i class="glyphicon glyphicon-remove"></i> Cancelar Pedido</button>
	</span>	
	<!-- para las pruebas
	<button type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php echo $helper->url("Comprobantes","InsertaComprobantes"); ?>'" class="btn btn-success" >Guardar</button>
	 -->	    
		  </div>
</div>

<?php }?>
	      
</form> 
          
          
          
       
      </div>
      </div>
   </body>  

</html>   