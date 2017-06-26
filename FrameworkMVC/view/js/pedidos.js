$(document).ready(function(){ 
	
	$('input').on('input', function(){
		  
	    $('.form-control .pedidos').each(function() {
	      
	        if ($(this).prop('value') === ''){        
	           
	           $('#agregar').prop('disabled',true);
	        
	        } else {
	          
	          $('#agregar').prop('disabled',false);
	        }
	    });
	});

	$("#agregar").click(function(){
		
		var value=$.trim($("#txt_cantidad").val());
		return false;
	});
				
});

	//"<?php echo $helper->url("Comprobantes","AutocompleteComprobantesCodigo"); ?>"
//source: "index.php?controller=Comprobantes&action=AutocompleteComprobantesCodigo",
	
