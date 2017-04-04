
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-clientes');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	ruc_clientes: {
	        		message: 'La cedula no es valida',
	                        validators: {
	                                notEmpty: {
	                                        message: 'La cedula es requerida.'
	                                },
	                                regexp: {
	                                	 
	               					 regexp: /^[0-9]+$/,
	                
	               					 message: 'Ingrese números'
	                
	               				 }
	            				 
	                        }
	                },
	                email_clientes: {
	                    validators: {
	                    	notEmpty: {
	                            message: 'Este campo es requerido.'
	                    },
	                    emailAddress:{
	                        message: 'El email no es valido.'
	                      }
	                        
	                    }
	                },

	                
	                razon_social_clientes: {
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
	              
                
	                id_provincias: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
                id_ciudad: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
                
                direccion_clientes: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
                
                celular_clientes: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
                
                telefono_clientes: {
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
	
