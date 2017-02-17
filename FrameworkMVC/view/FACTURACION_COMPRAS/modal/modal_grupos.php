	
	
	
	<form id="guardarGRUPO">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Agregar Nuevo Grupo</h4>
      </div>
      <div class="modal-body">
			<div id="datos_ajax_register"></div>
          <div class="form-group">
            <label for="nombre_grupo_productos0" class="control-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre_grupo_productos0" name="nombre_grupo_productos" required maxlength="200">
		  </div>
		  <div class="form-group">
            <label for="descripcion_grupo_productos0" class="control-label">Descripción:</label>
            <textarea type="text" class="form-control" id="descripcion_grupo_productos0" name="descripcion_grupo_productos" required maxlength="400"></textarea></textarea>
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