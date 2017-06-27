$(document).ready(function(){ 
	
	$("#agregar").click(function(){
		
		var jq_idproducto=$("#hd_productoid");
		
		var jq_submit = true;
		
		//inputs
		var jq_producto=$("#f_productos_au");
		var jq_descripcion=$("#txt_descripcion");
		var jq_cantidad=$("#txt_cantidad");
		
		
		//validadores
		var jqv_producto =$(".valida_frm_producto");
		var jqv_descripcion =$(".valida_frm_descripcion");
		var jqv_cantidad =$(".valida_frm_cantidad");
		
		//operaciones
		 if ($.trim(jq_idproducto.val()) === '') {
			 jq_producto.css({"border-color": "#b03535", "box-shadow": "0 0 5px #d45252","background": "#fff url(view/images/c_invalid.png) no-repeat 100% center"});
			 jqv_producto.css({"color": "#b03535", "box-shadow": "0 0 5px #d45252","font-size": "10px"});
			 jqv_producto.text("Producto no valido");
			 jq_submit = false;
		    }
		 
		 if ($.trim(jq_producto.val()) === '') {
			 jq_producto.css({"border-color": "#b03535", "box-shadow": "0 0 5px #d45252","background": "#fff url(view/images/c_invalid.png) no-repeat 100% center"});
			 jqv_producto.css({"color": "#b03535", "box-shadow": "0 0 5px #d45252","font-size": "10px"});
			 jqv_producto.text("Ingrese un producto");
			 jq_submit = false;
		    }
		
		 
		 if ($.trim(jq_cantidad.val()) === '') {
			 jq_cantidad.css({"border-color": "#b03535", "box-shadow": "0 0 5px #d45252","background": "#fff url(view/images/c_invalid.png) no-repeat 100% center"});
			 jqv_cantidad.css({"color": "#b03535", "box-shadow": "0 0 5px #d45252","font-size": "10px"});
			 jqv_cantidad.text("Ingrese Cantidad");
			 jq_submit = false;
		    } 
		 
		 if( !$.isNumeric(jq_cantidad.val()) || jq_cantidad.val()<=0 ){	
			 jq_cantidad.css({"border-color": "#b03535", "box-shadow": "0 0 5px #d45252","background": "#fff url(view/images/c_invalid.png) no-repeat 100% center"});
			 jqv_cantidad.css({"color": "#b03535", "box-shadow": "0 0 5px #d45252","font-size": "10px"});
			 jqv_cantidad.text("Formato numerico no valido");
			 jq_submit = false;
		 }
			 
		 
		return jq_submit;
	});
	
	//para el cambio a color verde
	$("#f_productos_au").keypress(function(){
		var jq_idproducto=$("#hd_productoid");
		jq_idproducto.val('');
		var jq_descripcion=$("#txt_descripcion");
		jq_descripcion.val('');
		var jq_producto=$("#f_productos_au");
		var jqv_producto =$(".valida_frm_producto");
		jq_producto.css({"border-color": "#28921f", "box-shadow": "0 0 5px #28921f","background": "#fff url(view/images/c_valid.jpg) no-repeat 100% center"});
		jqv_producto.css({"color": "#fff", "box-shadow": "0 0 5px #d45252","font-size": "10px"});
		jqv_producto.text("");
	});
	
	
	 $("#txt_cantidad").keypress(function (e) {
	    
		 var jq_cantidad=$("#txt_cantidad");
			var jqv_cantidad =$(".valida_frm_cantidad");
			jq_cantidad.css({"border-color": "#28921f", "box-shadow": "0 0 5px #28921f"});
			jqv_cantidad.css({"color": "#fff", "box-shadow": "0 0 5px #d45252","font-size": "10px"});
			jqv_cantidad.text("");
	 //if the letter is not digit then display error and don't type anything
	     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
	        //display error message
	    	 jq_cantidad.css({"border-color": "#b03535", "box-shadow": "0 0 5px #d45252"});
	    	$("#errmsg").css({"color": "#b03535", "font-size": "10px"});
	        $("#errmsg").html("Solo Numeros").show().fadeOut(1500,"swing");
	        
	         return false;
	    }
	   });
				
});

	//"<?php echo $helper->url("Comprobantes","AutocompleteComprobantesCodigo"); ?>"
//source: "index.php?controller=Comprobantes&action=AutocompleteComprobantesCodigo",
	
/*
box-shadow: 0 0 5px #d45252;
border-color: #b03535
*/