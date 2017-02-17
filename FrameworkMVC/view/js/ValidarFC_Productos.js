
$(document).ready(function() {
		//Validacion con BootstrapValidator
	fl = $('#form-fc_productos');
	fl.bootstrapValidator({ 
	        message: 'El valor no es valido.',
	        //fields: name de los inputs del formulario, la regla que debe cumplir y el mensaje que mostrara si no cumple la regla
	        feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
	        fields: {
	        	codigo_productos: {
	        		        validators: {
	                                notEmpty: {
	                                	message: 'El codigo es requerido.',
	                	                   
	                                },
	                                regexp: {
	                                	 
		               					 regexp: /^[0-9]+$/,
		                
		               					 message: 'Solo números'
		                
		               				 },
		            				 stringLength: {
		            					 
		            					 min: 4,
		            					 max: 20,
		                                
		            					 message: 'Ingrese min 4 números'
		            					
		            				 }
	                             
	                        }
	                },
	                nombre_productos: {
			        		message: 'El nombre no es valido',
			                        validators: {
			                                notEmpty: {
			                                        message: 'El nombre es requerido.'
			                                }
			                             
			                        }
			                },
			                id_entidades: {
		        		message: 'La entidad no es valido',
		                        validators: {
		                                notEmpty: {
		                                        message: 'La entidad es requerida.'
		                                }
		                             
		                        }
		                },
		                
		                id_grupo_productos: {
				        		message: 'El grupo no es valido',
				                        validators: {
				                                notEmpty: {
				                                        message: 'El grupo es requerido.'
				                                }
				                             
				                        }
				                },
				                descripcion_productos: {
			        		message: 'La descripción no es valida',
			                        validators: {
			                                notEmpty: {
			                                        message: 'La descripción es requerida.'
			                                }
			                             
			                        }
			                },
			                id_unidades_medida: {
				        		message: 'La u/m no es valida',
				                        validators: {
				                                notEmpty: {
				                                        message: 'La u/m es requerida.'
				                                }
				                             
				                        }
				                },
				                iva_productos: {
					        		message: 'Este campo es requerido',
					                        validators: {
					                                notEmpty: {
					                                        message: 'Este campo es requerido.'
					                                }
					                             
					                        }
					                },
					                
					                observaciones_productos: {
						        		message: 'La observación no es valida',
						                        validators: {
						                                notEmpty: {
						                                        message: 'La observación es requerida.'
						                                }
						                             
						                        }
						                }
	        }
	    });
	
	
	});
