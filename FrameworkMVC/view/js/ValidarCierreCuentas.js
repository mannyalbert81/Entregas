$(document).ready(function() {
		//Validacion con BootstrapValidator
		fl = $('#form-cierre-cuentas');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	fecha_cierre_mes: {
               	 
	       			 validators: {
	        
	       				 notEmpty: {
	        
	       					 message: 'La fecha es requerida'
	        
	       				 },
	        
	       				 date: {
	        
	       					 format: 'YYYY-MM-DD',
	        
	       					 message: 'La fecha no es valida'
	        
	       				 }
	        
	       			 }
	        
	       		 }	                
	        }
	        
	    });
	});
