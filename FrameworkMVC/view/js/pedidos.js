	$(document).ready(function(){ 	
		$( "#id_plan_cuentas" ).autocomplete({
      		source: "index.php?controller=Comprobantes&action=AutocompleteComprobantesCodigo",
      		minLength: 1
    	});

	    $("#id_plan_cuentas").focusout(function(){
    	$.ajax({
    			url:'<?php echo $helper->url("Comprobantes","AutocompleteComprobantesDevuelveNombre"); ?>',
    			type:'POST',
    			dataType:'json',
    			data:{codigo_plan_cuentas:$('#id_plan_cuentas').val()}
    				}).done(function(respuesta){

    					$('#nombre_plan_cuentas').val(respuesta.nombre_plan_cuentas);
    					$('#plan_cuentas').val(respuesta.id_plan_cuentas);
    				
        			});
    				 
    				
    			});   
				
    });

	//"<?php echo $helper->url("Comprobantes","AutocompleteComprobantesCodigo"); ?>"

	
