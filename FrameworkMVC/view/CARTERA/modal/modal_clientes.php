<?php

	
	
	$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad_des host=186.4.241.148");
	
	if(!$conn)
	{
		die( "No se pudo conectar");
	}

	$ciudad   = pg_query($conn,"SELECT ciudad.id_ciudad, ciudad.nombre_ciudad FROM public.ciudad WHERE ciudad.id_ciudad > 0");
	$provincias   = pg_query($conn,"SELECT  provincias.id_provincias, provincias.nombre_provincias FROM public.provincias WHERE provincias.id_provincias > 0");
	
?>
		
			
  <form id="guardarCliente" class="form-horizontal">
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="panel panel-info">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Agregar Nuevo Cliente</h4>
      </div>
       </div>
      <div class="modal-body">
			<div id="datos_ajax_register"></div>
         
          <div class="form-group">
            <label for="ruc_clientes0" class="col-sm-3 control-label">Ruc:</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="ruc_clientes0" name="ruc_clientes" required maxlength="200">
            </div>
		  </div>
		  
		  <div class="form-group">
            <label for="razon_social_clientes0" class="col-sm-3 control-label">Razón Social:</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="razon_social_clientes0" name="razon_social_clientes" required maxlength="400">
          	</div>
          </div>
          
          <div class="form-group">
				<label for="id_provincias0" class="col-sm-3 control-label">Provincias:</label>
				<div class="col-sm-8">
				 <select class="form-control" id="id_provincias0" name="id_provincias" required>
					<option value="" selected="selected">-- Seleccione --</option>
					<?php while($row = pg_fetch_array($provincias)){?>
							<option value="<?php echo $row['id_provincias']; ?>"  ><?php echo $row['nombre_provincias'];; ?> </option>
				    <?php } ?>
				  </select>
				</div>
		  </div>
		  
		  <div class="form-group">
				<label for="id_ciudad0" class="col-sm-3 control-label">Ciudad:</label>
				<div class="col-sm-8">
				 <select class="form-control" id="id_ciudad0" name="id_ciudad" required>
					<option value="" selected="selected">-- Seleccione --</option>
					<?php while($row = pg_fetch_array($ciudad)){?>
							<option value="<?php echo $row['id_ciudad']; ?>"  ><?php echo $row['nombre_ciudad'];; ?> </option>
				    <?php } ?>
				  </select>
				</div>
		  </div>
			  
          <div class="form-group">
            <label for="direccion_clientes0" class="col-sm-3 control-label">Dirección:</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="direccion_clientes0" name="direccion_clientes" required maxlength="400">
            </div>
          </div>
          
          <div class="form-group">
            <label for="telefono_clientes0" class="col-sm-3 control-label">Teléfono:</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="telefono_clientes0" name="telefono_clientes" required maxlength="400">
            </div>
          </div>
          
           <div class="form-group">
            <label for="celular_clientes0" class="col-sm-3 control-label">Celular:</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="celular_clientes0" name="celular_clientes" required maxlength="400">
          	</div>
          </div>
          
          <div class="form-group">
            <label for="email_clientes0" class="col-sm-3 control-label">Email:</label>
            <div class="col-sm-8">
            <input type="text" class="form-control" id="email_clientes0" name="email_clientes" required maxlength="400">
          	</div>
          </div>
		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>
</form>

