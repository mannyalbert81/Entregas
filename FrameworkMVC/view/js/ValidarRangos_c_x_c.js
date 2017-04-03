
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-rangos_c_x_c');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {

	         

	        	id_entidades: {
	                    validators: {
	                    	notEmpty: {
	                            message: 'Este campo es requerido.'
	                    }
	                        
	                    }
	                },
	                
	                nombre_rangos_c_x_c: {
	                        validators: {
	                                notEmpty: {
	                                        message: 'Este campo es requerido.'
	                                },
	                                regexp: {
	                                	 
		               					 regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
		                
		               					 message: 'Ingrese Letras'
		                
		               				 }
	                               
	                        }
	                },
	                valor_min_c_x_c: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                },
                                regexp: {
                                  	 
                 					 regexp: /^[0-9]+$/,
                  
                 					 message: 'Ingrese números'
                  
                 				 }
                       
                        }
                },
                valor_max_c_x_c: {
                    validators: {
                            notEmpty: {
                                    message: 'Este campo es requerido.'
                            },
                            regexp: {
                              	 
             					 regexp: /^[0-9]+$/,
              
             					 message: 'Ingrese números'
              
             				 }
                   
                    }
            }
	                
	        }
	        //Cuando el formulario se lleno correctamente y se envia, se ejecuta esta funcion
	    
	    });
	});
	
