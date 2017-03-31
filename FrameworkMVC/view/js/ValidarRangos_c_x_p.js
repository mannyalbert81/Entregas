
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-rangos_c_x_p');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {

	                id_entidad: {
	                    validators: {
	                    	notEmpty: {
	                            message: 'Este campo es requerido.'
	                    }
	                        
	                    }
	                },
	                
	                nombre_rangos_c_x_p: {
	                        validators: {
	                                notEmpty: {
	                                        message: 'Este campo es requerido.'
	                                }
	                               
	                        }
	                },
	                valor_min_c_x_p: {
                        validators: {
                                notEmpty: {
                                        message: 'Este campo es requerido.'
                                }
                        }
                },
                valor_max_c_x_p: {
                    validators: {
                            notEmpty: {
                                    message: 'Este campo es requerido.'
                            }
                    }
            }
	                
	        }
	        //Cuando el formulario se lleno correctamente y se envia, se ejecuta esta funcion
	    
	    });
	});
	
