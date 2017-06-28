$(document).ready(function(){ 
	
	$("#buscar").click(function(){
		
		load_list_pedidos(1);
		
		});
	
	$( "#f_clientes" ).autocomplete({
			source: "index.php?controller=Pedidos&action=consultaClientes_nom",
			minLength: 2,
			select: function(event, ui) {
					event.preventDefault();
                    $('#hd_idclientes').val(ui.item.id);
					$('#f_clientes').val(ui.item.value);
			     }
	});
	
	$( "#f_identificacion" ).autocomplete({
		source: "index.php?controller=Pedidos&action=consultaClientes_ruc",
		minLength: 2,
		select: function(event, ui) {
				event.preventDefault();
                $('#hd_idclientes').val(ui.item.id);
				$('#f_identificacion').val(ui.item.value);
		     }
});
});


function load_list_pedidos(pagina){
	
	//iniciar variables
	 var jqv_usuario=$("#hd_idusuario").val();
	 var jqv_identificacion=$("#f_identificacion").val();
	 var jqv_numpedido=$("#f_numpedido").val();
	 var jqv_fecha=$("#f_fecha").val();
	 
//datos que van por post
 var con_datos={
		  buscar:1,
		  id_usuario:jqv_usuario,
		  identificacion:jqv_identificacion,
		  numpedido:jqv_numpedido,
		  fecha:jqv_fecha,
		  action:'ajax',
		  page:pagina
			};

	$("#formpedidos").fadeIn('slow');
	$.ajax({
		url:"index.php?controller=Pedidos&action=traePedidos",
        type : "POST",
        async: true,			
		data: con_datos,
		 beforeSend: function(objeto){
		$("#formpedidos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".div_pedidos").html(data).fadeIn('slow');
			$("#formpedidos").html("");
		}
	})
}

	//"<?php echo $helper->url("Comprobantes","AutocompleteComprobantesCodigo"); ?>"
//source: "index.php?controller=Comprobantes&action=AutocompleteComprobantesCodigo",
	
/*
box-shadow: 0 0 5px #d45252;
border-color: #b03535
*/

/*
<script type="text/javascript">
$(document).ready(function(){
	//load_juicios(1);

	$("#buscar").click(function(){

		load_plan_cuentas(1);
		
		});
});


function load_plan_cuentas(pagina){
	
	//iniciar variables
	 var v_usuario=$("#hd_idusuario").val();
	 /*var con_codigo_plan_cuentas=$("#codigo_plan_cuentas").val();
	 var con_nombre_plan_cuentas=$("#nombre_plan_cuentas").val();
	 var con_nivel_plan_cuentas=$("#nivel_plan_cuentas").val();
	 var con_t_plan_cuentas=$("#t_plan_cuentas").val();
	 var con_n_plan_cuentas=$("#n_plan_cuentas").val();
	

	  var con_datos={
			  id_entidades:con_id_entidades,
			  codigo_plan_cuentas:con_codigo_plan_cuentas,
			  nombre_plan_cuentas:con_nombre_plan_cuentas,
			  nivel_plan_cuentas:con_nivel_plan_cuentas,
			  t_plan_cuentas:con_t_plan_cuentas,
			  n_plan_cuentas:con_n_plan_cuentas,
			  action:'ajax',
			  page:pagina
			  };

 var con_datos={
		  buscar:1,
		  id_usuario:v_usuario,			  
		  action:'ajax',
		  page:pagina
			};

	$("#formpedidos").fadeIn('slow');
	$.ajax({
		url:"<?php echo $helper->url("Pedidos","traePedidos");?>",
        type : "POST",
        async: true,			
		data: con_datos,
		 beforeSend: function(objeto){
		$("#formpedidos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".div_pedidos").html(data).fadeIn('slow');
			$("#formpedidos").html("");
		}
	})
}

</script>*/

//autocomplete

/*
$( "#codigo_plan_cuentas" ).autocomplete({
	source: "<?php echo $helper->url("PlanCuentasAdmin","AutocompleteCodigo"); ?>",
	minLength: 1
});
*/