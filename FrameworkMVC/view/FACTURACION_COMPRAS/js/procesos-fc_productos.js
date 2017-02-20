
	$(document).ready(function(){
		load_productos(1);
		});
		
		
		function load_productos(page){
			var c= $("#c").val();
			$("#productos").fadeIn('slow');
			$.ajax({
				url:'view/FACTURACION_COMPRAS/ajax/cargar_productos.php?action=ajax&page='+page+'&c='+c,
				 beforeSend: function(objeto){
				$("#productos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
				},
				success:function(data){
					$(".div_productos").html(data).fadeIn('slow');
					$("#productos").html("");
				}
			})
		}
		
		

		
		$( "#guardarGRUPO" ).submit(function( event ) {
		var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "view/FACTURACION_COMPRAS/modal/agregar_grupos.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#datos_ajax_register").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#datos_ajax_register").html(datos);
					
					load(1);
				  }
			});
		  event.preventDefault();
		});
		
		
		$( "#guardarUM" ).submit(function( event ) {
			var parametros = $(this).serialize();
				 $.ajax({
						type: "POST",
						url: "view/FACTURACION_COMPRAS/modal/agregar_um.php",
						data: parametros,
						 beforeSend: function(objeto){
							$("#datos_ajax_register1").html("Mensaje: Cargando...");
						  },
						success: function(datos){
						$("#datos_ajax_register1").html(datos);
						
						load(1);
					  }
				});
			  event.preventDefault();
			});

		
		