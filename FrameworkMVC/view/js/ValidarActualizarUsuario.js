
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-Actualizar_Usuario');
	    fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	cedula_usuarios: {
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
	                id_ciudad: {
	                    validators: {
	                    	notEmpty: {
	                            message: 'Este campo es requerido.'
	                    }
	                        
	                    }
	                },

	                
	                nombre_usuarios: {
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
	                
	                usuario_usuarios: {
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
	              
                
                clave_usuarios: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
                cclave_usuarios: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    },
                        identical: {
                            field: 'clave_usuarios',
                            message: 'No coinciden'
                        }
                    }
                },
                
                
                telefono_usuarios: {
                    validators: {
                    	notEmpty: {
                            message: 'Este campo es requerido.'
                    }
                        
                    }
                },
	                
                celular_usuarios: {
	                    validators: {
	                    	notEmpty: {
	                            message: 'Este campo es requerido.'
	                    }
	                        
	                    }
	                }, 
                
		            correo_usuarios: {
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
	
