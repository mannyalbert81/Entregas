
	$(document).ready(function() {
		$("#ok").hide();
		//Validacion con BootstrapValidator
		fl = $('#form-tabla-amortizacion');
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
	                
	                
	                numero_credito_amortizacion_cabeza: {
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
	            
	            
	            
	            numero_pagare_amortizacion_cabeza: {
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
	            
	                
	                
	                
	                
            id_tipo_creditos: {
	                    validators: {
	                    	notEmpty: {
	                            message: 'Este campo es requerido.'
	                    }
	                        
	                    }
	                },
	                
	              
	                capital_prestado_amortizacion_cabeza: {
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
	            
	            
	            
	            
	            tasa_interes_amortizacion_cabeza: {
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
            
            
            
            
            plazo_meses_amortizacion_cabeza: {
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
	                
	                
	                
        fecha_amortizacion_cabeza: {
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
	
