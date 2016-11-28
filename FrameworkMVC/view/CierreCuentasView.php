
<?php include("view/modulos/head.php"); ?>
      
<!DOCTYPE HTML>
<html lang="es">
     <head>
          <meta charset="utf-8"/>
          <title>Cierre Cuentas - Contabilidad 2016</title>
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarCierreCuentas.js"></script>
	      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
          
	     
        
		
	 
          <script type="text/javascript">
		jQuery(function($){
			$.datepicker.regional['es'] = {
				closeText: 'Cerrar',
				prevText: '&#x3c;Ant',
				nextText: 'Sig&#x3e;',
				currentText: 'Hoy',
				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
				'Jul','Ago','Sep','Oct','Nov','Dic'],
				dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
				dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
				weekHeader: 'Sm',
				dateFormat: 'yy-mm-dd',
				firstDay: 1,
				isRTL: false,
				showMonthAfterYear: false,
				yearSuffix: ''};
			$.datepicker.setDefaults($.datepicker.regional['es']);
		});    
		 
		$(document).ready(function() {
		   $("#fecha_cierre_mes").datepicker();
		 });
		</script> 
		         
     </head>
      <body class="cuerpo">
    
       <?php include("view/modulos/menu.php"); ?>
  
    	<div class="container">
        <div class="row" style="background-color: #FAFAFA;">
  
  
            <form id="form-cierre-cuentas" action="<?php echo $helper->url("CierreCuentas","InsertaCierreCuentas"); ?>" method="post" class="col-lg-6">
            <br>	
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	         <?php } } else {?>
	         
	        <div class="well">
            <h4 style="color:#ec971f;">Cierre de Cuentas</h4>
            <hr/>
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
            <div class="form-group">
             
                                 <label for="id_tipo_cierre" class="control-label">Periodo:</label>
                                  <select name="id_tipo_cierre" id="id_tipo_cierre"  class="form-control">
                                    <?php foreach($resultTipCierre as $res) {?>
										<option value="<?php echo $res->id_tipo_cierre; ?>"  ><?php echo $res->nombre_tipo_cierre; ?> </option>
									<?php } ?>
								   </select> 
								  <?php foreach($resultTipCierre as $res) {?>
										<input type="hidden" class="form-control" id="id_entidades" name="id_entidades" value="<?php echo $res->id_entidades; ?>">
							    	<?php } ?>
								    
								  <span class="help-block"></span>
             </div>
             </div>
		     
		     
             <div class="col-xs-6 col-md-6">
		                          <label for="fecha_cierre_mes" class="control-label">Mes:</label><br>
		                          <div class="input-group date" id="datetimePicker">
		                          <input type="date" class="form-control" id="fecha_cierre_mes" name="fecha_cierre_mes" data-date-format="YYYY-MM-DD" value="" placeholder="Mes">
                                  <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                                  </span>
                                  </div>
            
		     </div>
             
             </div>
	         </div>
			
		     <?php } ?>
		     
		    <div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;" > 
            <div class="form-group">
            					  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
            </div>
            </div>
            </div>
            </form>
            
            
            <form action="<?php echo $helper->url("CierreCuentas","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Cuentas Cerradas</h4>
            
            <div class="row">
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <input type="text" class="form-control" id="contenido" name="contenido" value="">
                                  
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" ><?php echo $desc ?> </option>
                                    <?php } ?>
                                  </select>
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <button type="submit" id="Buscar" name="Buscar" class="btn btn-info">Buscar</button>
            </div>
		    </div>
			</div>  
             
       
       <div class="datagrid"> 
       <section style="height:380px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
                    <th style="font-size:100%;">Id</th>
		    		<th style="font-size:100%;">Nombre</th>
		    		<th style="font-size:100%;">Codigo</th>
		    		<th style="font-size:100%;">Nivel</th>
		    		<th style="font-size:100%;">Entidad</th>
		    		<th></th>
		    		<th></th>
		    		
	  		</tr>
	   </thead>
       <tfoot>
       		<tr>
					<td colspan="10">
						<div id="paging">
							<ul>
								<li>
									<a href="#">
						<span>Previous</span>
									</a>
								</li>
								<li>
									<a href="#" class="active">
						<span>1</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>2</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>3</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>4</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>5</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>Next</span>
									</a>
								</li>
								</ul>
						</div>
					
			</tr>
       				
       </tfoot>
       
                <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        	 
               
	   <tbody>
	   		<tr>
	   				   <td style="font-size:80%;"> <?php echo $res->id_centro_costos; ?>       </td>
	                   <td style="font-size:80%;"> <?php echo $res->nombre_centro_costos; ?>   </td>
		               <td style="font-size:80%;" > <?php echo $res->codigo_centro_costos; ?>  </td> 
		               <td style="font-size:80%;"> <?php echo $res->nivel_centro_costos; ?>    </td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_entidades; ?>    </td>
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("CierreCuentas","index"); ?>&id_centro_costos=<?php echo $res->id_centro_costos; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			           </td>
			           <td>   
			               	<div class="right">
			                    <a href="<?php echo $helper->url("CierreCuentas","borrarId"); ?>&id_centro_costos=<?php echo $res->id_centro_costos; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
			                </div>
			           </td>
	   		</tr>
	   
	   </tbody>	
	        		
		        <?php } }else{ ?>
            <tr>
            <td></td>
            <td></td>
	                   <td colspan="5" style="color:#ec971f;font-size:8;"> <?php echo '<span id="snResult">No existen resultados</span>' ?></td>
	        <td></td>
		               
		    </tr>
            <?php 
		}
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
		</section>
        </div>
        </div>
        </form>
        
        </div>
        </div>
  
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          