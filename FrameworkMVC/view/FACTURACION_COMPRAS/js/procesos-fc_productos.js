
		
        function load(page){
		var parametros = {"action":"ajax"};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'view/FACTURACION_COMPRAS/FC_ProductosView.php',
			data: parametros,
			 beforeSend: function(objeto){
		  $("#loader").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
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

		
		