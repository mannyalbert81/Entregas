
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-Tipo-Identificacion');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {

	        	nombre_tipo_identificacion: {
	                    validators: {
	                    	notEmpty: {
	                            message: 'Este campo es requerido.'
	                    },
	                    regexp: {
                       	 
          					 regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
           
          					 message: 'Ingrese Letras'
           
          				 }
	                        
	                    }
	                }                
	      
	                
	        }
	        //Cuando el formulario se lleno correctamente y se envia, se ejecuta esta funcion
	    
	    });
	});
	
