    <?php include("view/modulos/head.php");?> 
    <?php include("view/modulos/menu.php");?>  
    <?php include("view/modulos/modal.php");?>
    <?php include("view/FACTURACION_COMPRAS/modal/modal_grupos.php");?>
    <?php include("view/FACTURACION_COMPRAS/modal/modal_um.php");?>
    <?php include("view/FACTURACION_COMPRAS/modal/buscar_productos.php");?>
   
   
    
<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
         <title>FC Proveedores - Contabilidad 2016</title>
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarFc_Productos.js"></script>
	      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
          <script type="text/javascript" src="view/FACTURACION_COMPRAS/js/VentanaCentrada.js"></script>
          <script type="text/javascript" src="view/FACTURACION_COMPRAS/js/procesos-fc_productos.js"></script>
	      
       
         
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
 
	   
	        <script>
		    var loadFileimg = function(event) {
		        var reader = new FileReader();
		        reader.onload = function(){
		          var outputimg = document.getElementById('outputimg');
		          outputimg.src = reader.result;
		        };

		        reader.readAsDataURL(event.target.files[0]);
		      };
            </script>
            
           
            
	         
     </head>
      <body class="cuerpo">
                  
                   
      <?php   
      
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
        $sel_concepto_ccomprobantes=$_POST['concepto_ccomprobantes'];
        $sel_fecha_ccomprobantes=$_POST['fecha_ccomprobantes'];
       }
        ?>
     
                 
             
    	<div class="container">
        <div class="row" style="background-color: #FAFAFA;">
  		<form id="form-fc_productos" action="<?php echo $helper->url("FC_Proveedores","index"); ?>" method="post" enctype="multipart/form-data" class="col-lg-12">
            
            <br>	
            
             <div class="col-lg-12">
	         <div class="panel panel-info">
	         <div class="panel-heading">
	         <div class="row">
	         <div class="form-group" style="margin-left: 20px">
			      <label for="nuevo_comprobante" class="control-label"><h4><i class='glyphicon glyphicon-edit'></i> Nuevo Proveedor</h4></label>
			 </div>
		     </div>
		     
		    
	         </div>
	         </div>
	         </div>
	         
	         
  			 
  			 <div class="col-lg-12">
  			<div class="col-lg-6">
  			<div class="panel panel-info">
	         <div class="panel-body">
	         <div class="row">
	         
	          <div class="form-group" style="margin-top:15px">
             <div class="col-xs-4 col-md-4">
             
                                  <label for="ruc_proveedores" class="control-label">Ruc:</label>
                                  <input type="text" class="form-control" id="ruc_proveedores" name="ruc_proveedores" value=""   placeholder="Ruc" >
                                  <span class="help-block"></span>
             </div>
             </div>
             
              <div class="form-group">
             <div class="col-xs-8 col-md-8">
             
                                  <label for="razon_social_proveedores" class="control-label">Razón Social:</label>
                                  <input type="text" class="form-control" id="razon_social_proveedores" name="razon_social_proveedores" value=""  placeholder="Razón Social">
                                  <span class="help-block"></span>
             </div>
             </div>
             </div>
             
            <div class="row"> 
	        <div class="form-group" style="margin-top:15px">
            <div class="col-xs-6 col-md-6">
		                          <label for="id_provincias" class="control-label">Provincia:</label>
                                  <select name="id_provincias" id="id_provincias"  class="form-control">
                                  <option value="" selected="selected">--Seleccione--</option>
                                  	<?php foreach($resultProv as $res) {?>
										<option value="<?php echo $res->id_provincias; ?>"  ><?php echo $res->nombre_provincias; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
            
           
           
	        <div class="form-group">
            <div class="col-xs-6 col-md-6">
		                          <label for="id_ciudad" class="control-label">Ciudad:</label>
                                  <select name="id_ciudad" id="id_ciudad"  class="form-control" >
                                  <option value="" selected="selected">--Seleccione--</option>
									<?php foreach($result_ciu as $res) {?>
										<option value="<?php echo $res->id_ciudad; ?>"  ><?php echo $res->nombre_ciudad; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
           
			<div class="form-group">
            <div class="col-xs-6 col-md-6">
		                          <label for="id_entidades" class="control-label">Entidad:</label>
                                  <select name="id_entidades" id="id_entidades"  class="form-control" readonly>
                                  	<?php foreach($resultEnt as $res) {?>
										<option value="<?php echo $res->id_entidades; ?>"  ><?php echo $res->nombre_entidades; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
  			
  			<div class="form-group">
            <div class="col-xs-6 col-md-6">
		                          <label for="id_tipo_contribuyente" class="control-label">Tipo Contribuyente:</label>
                                  <select name="id_tipo_contribuyente" id="id_tipo_contribuyente"  class="form-control">
                                  <option value="" selected="selected">--Seleccione--</option>
                                  	<?php foreach($resultContri as $res) {?>
										<option value="<?php echo $res->id_tipo_contribuyente; ?>"  ><?php echo $res->nombre_tipo_contribuyente; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
  			
  			
  			<div class="form-group">
            <div class="col-xs-6 col-md-6">
		                          <label for="id_tipo_persona" class="control-label">Tipo Persona:</label>
                                  <select name="id_tipo_persona" id="id_tipo_persona"  class="form-control">
                                  <option value="" selected="selected">--Seleccione--</option>
                                  	<?php foreach($resultTipPer as $res) {?>
										<option value="<?php echo $res->id_tipo_persona; ?>"  ><?php echo $res->nombre_tipo_persona; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
  			
  			<div class="form-group">
            <div class="col-xs-6 col-md-6">
		                          <label for="id_tipo_identificacion" class="control-label">Tipo Identificación:</label>
                                  <select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control">
                                  <option value="" selected="selected">--Seleccione--</option>
                                  	<?php foreach($resultTipIdent as $res) {?>
										<option value="<?php echo $res->id_tipo_identificacion; ?>"  ><?php echo $res->nombre_tipo_identificacion; ?> </option>
							        <?php } ?>
								   </select> 
                                  <span class="help-block"></span>
            </div>
            </div>
  			
  			
  			
		     <div class="form-group">
             <div class="col-xs-12 col-md-12">
		                          <label for="direccion_proveedores" class="control-label">Dirección:</label>
                                  <textarea type="text"  class="form-control" id="direccion_proveedores" name="direccion_proveedores" value=""  placeholder="Dirección Proveedores"></textarea>
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		    
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="telefono_proveedores" class="control-label">Teléfono:</label>
                                  <input type="text" class="form-control" id="telefono_proveedores" name="telefono_proveedores" value=""  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="celular_proveedores" class="control-label">Celular:</label>
                                  <input type="text" class="form-control" id="celular_proveedores" name="celular_proveedores" value=""  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="email_proveedores" class="control-label">Email:</label>
                                  <input type="text" class="form-control" id="email_proveedores" name="email_proveedores" value=""   placeholder="Correo Electrónico">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="web_proveedores" class="control-label">Web:</label>
                                  <input type="text" class="form-control" id="web_proveedores" name="web_proveedores" value=""  placeholder="Sitio Web">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="retencion_fuente" class="control-label">Retención Fuente:</label>
                                  <input type="text" class="form-control" id="retencion_fuente" name="retencion_fuente" value="" onkeypress="return numeros(event)" placeholder="0.00">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="retencion_iva" class="control-label">Retención Iva:</label>
                                  <input type="text" class="form-control" id="retencion_iva" name="retencion_iva" value=""  onkeypress="return numeros(event)" placeholder="0%">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
             
                                  <label for="id_cuenta_pagar_ver" class="control-label" >#Cuenta por Pagar: </label>
                                  <input type="text" class="form-control" id="id_cuenta_pagar_ver" name="id_cuenta_pagar_ver" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="id_cuenta_pagar" name="id_cuenta_pagar" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-6 col-md-6">                     
                                  <label for="nombre_cuenta_pagar_ver" class="control-label">Nombre Cuenta por Pagar: </label>
                                  <input type="text" class="form-control" id="nombre_cuenta_pagar_ver" name="nombre_cuenta_pagar_ver" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
             
                                  <label for="id_cuenta_cobrar_ver" class="control-label" >#Cuenta por Cobrar: </label>
                                  <input type="text" class="form-control" id="id_cuenta_cobrar_ver" name="id_cuenta_cobrar_ver" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="id_cuenta_cobrar" name="id_cuenta_cobrar" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-6 col-md-6">                     
                                  <label for="nombre_cuenta_cobrar_ver" class="control-label">Nombre Cuenta por Cobrar: </label>
                                  <input type="text" class="form-control" id="nombre_cuenta_cobrar_ver" name="nombre_cuenta_cobrar_ver" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
             
                                  <label for="id_cuenta_anticipo_entregado_ver" class="control-label" >#Cuenta Anticipo Entregado: </label>
                                  <input type="text" class="form-control" id="id_cuenta_anticipo_entregado_ver" name="id_cuenta_anticipo_entregado_ver" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="id_cuenta_anticipo_entregado" name="id_cuenta_anticipo_entregado" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-6 col-md-6">                     
                                  <label for="nombre_cuenta_anticipo_entregado_ver" class="control-label">Nombre Cuenta Anticipo Entregado: </label>
                                  <input type="text" class="form-control" id="nombre_cuenta_anticipo_entregado_ver" name="nombre_cuenta_anticipo_entregado_ver" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
             
                                  <label for="id_cuenta_anticipo_recibido_ver" class="control-label" >#Cuenta Anticipo Recibido: </label>
                                  <input type="text" class="form-control" id="id_cuenta_anticipo_recibido_ver" name="id_cuenta_anticipo_recibido_ver" value=""  placeholder="Search">
                                  <input type="hidden" class="form-control" id="id_cuenta_anticipo_recibido" name="id_cuenta_anticipo_recibido" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
		     <div class="col-xs-6 col-md-6">                     
                                  <label for="nombre_cuenta_anticipo_recibido_ver" class="control-label">Nombre Cuenta Anticipo Recibido: </label>
                                  <input type="text" class="form-control" id="nombre_cuenta_anticipo_recibido_ver" name="nombre_cuenta_anticipo_recibido_ver" value=""  placeholder="Search">
                                  <span class="help-block"></span>
             </div>
		     </div>
		      </div>
		     
		     
		     
		     
		     <!-- COMIENZA DATOS DEL CONTACTO -->
		     
		     
  		     </div>                    
			 </div>
  		     	
		     </div>
			
			
			 <div class="col-lg-6">
			  <div class="col-md-12">
					<div class="pull-right">
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#Productos">
						 <span class="glyphicon glyphicon-search"></span> Buscar Productos
						</button>
					</div>	
			 </div>	
			 <div class="panel panel-info">
	         <div class="panel-body">
	          <div class="row">
	          <div class="col-xs-12 col-md-12" style="text-align: center";>
	           <h2 style="color:#ec971f;">OPCIONAL</h2>
	           </div>
	           </div>
	         
	         <div class="row"> 
		     
            <div class="form-group" style="margin-top:15px">
             <div class="col-xs-4 col-md-4">
             
                                  <label for="ci_contacto_proveedores" class="control-label">CI Contacto:</label>
                                  <input type="text" class="form-control" id="ci_contacto_proveedores" name="ci_contacto_proveedores" value=""   placeholder="Cedula" >
                                  <span class="help-block"></span>
             </div>
             </div>
             
             <div class="form-group">
             <div class="col-xs-8 col-md-8">
             
                                  <label for="razon_social_proveedores" class="control-label">Nombres Contacto:</label>
                                  <input type="text" class="form-control" id="razon_social_proveedores" name="razon_social_proveedores" value=""  placeholder="Nombres">
                                  <span class="help-block"></span>
             </div>
             </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="telefono_contacto_proveedores" class="control-label">Teléfono:</label>
                                  <input type="text" class="form-control" id="telefono_contacto_proveedores" name="telefono_contacto_proveedores" value=""  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="celular_contacto_proveedores" class="control-label">Celular:</label>
                                  <input type="text" class="form-control" id="celular_contacto_proveedores" name="celular_contacto_proveedores" value=""  onkeypress="return numeros(event)" placeholder="#">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     
		     
		     <div class="form-group">
             <div class="col-xs-6 col-md-6">
		                          <label for="email_contacto_proveedores" class="control-label">Email:</label>
                                  <input type="text" class="form-control" id="email_contacto_proveedores" name="email_contacto_proveedores" value=""   placeholder="Correo Electrónico">
                                  <span class="help-block"></span>
             </div>
		     </div>
		     </div>
		    
	         </div>
	         </div> 
	         </div> 
	         </div>
         	
  			 							
	       <div class="row">
		   <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center; margin-top:20px" > 
           <div class="form-group">
            					  <button type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php echo $helper->url("FC_Proveedores","InsertaFC_Proveedores"); ?>'" class="btn btn-success" >Guardar</button>
           </div>
           </div>
           </div>
		  
		   </form>
            
         
        </div>
        </div>
        <div class="footer" style="margin-top:50px">
        <?php include("view/modulos/footer.php"); ?>
        </div>
     </body>  
    </html>  
    
            