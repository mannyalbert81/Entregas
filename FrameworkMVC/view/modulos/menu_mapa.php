<?php 

$controladores=$_SESSION['controladores'];

 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 		}
 	}
 	}
 	
 	return $display;
 }

?>

	  <script>
	     $(document).ready(function(){

		//alert("hola");
		$("#div_fecha").hide();

		$("#criterio_busqueda").change(function(){

			var ddl_criterio=$(this).val();

			if(ddl_criterio==2){
				//alert("hola");
				$("#div_fecha").show();
				$("#div_nombre").hide();
				}else{
					
					$("#div_nombre").show();
					$("#div_fecha").hide();
					}

			});
		
		});

		</script>

<div class="container" style="margin-top: 15px; " >
<div class="row">
<div class="col-xs-12">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>	
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown"  style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>">
        
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" ><?php echo " Administración" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li style="<?php echo getcontrolador("Usuarios",$controladores) ?>">
        	<a href="index.php?controller=Usuarios&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Usuarios</span> </a>
		    </li>
			<li style="<?php echo getcontrolador("Roles",$controladores) ?>">
			<a href="index.php?controller=Roles&action=index"> <span class=" glyphicon glyphicon-asterisk" aria-hidden="true"> Roles de Usuario</span> </a>
			</li>
			<li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>">
			<a href="index.php?controller=PermisosRoles&action=index"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Permisos Roles</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Controladores",$controladores) ?>">
			<a href="index.php?controller=Controladores&action=index"><span class="glyphicon glyphicon-inbox" aria-hidden="true"> Controladores</span> </a>
			</li>
			
			<li style="<?php echo getcontrolador("Entidades",$controladores) ?>">
			<a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Entidades</span> </a>
			</li>
            
			<li style="<?php echo getcontrolador("ReporteUsuarios",$controladores) ?>">
			<a href="index.php?controller=ReporteUsuarios&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Reporte Usuarios</span> </a>
			</li>
			<li style="<?php echo getcontrolador("ReporteUsuariosAdmin",$controladores) ?>">
			<a href="index.php?controller=ReporteUsuariosAdmin&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Reporte Usuarios</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Tipo_Persona",$controladores) ?>">
			<a href="index.php?controller=Tipo_Persona&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Tipo Persona</span> </a>
			</li>
			
			<li style="<?php echo getcontrolador("Tipo_Identificacion",$controladores) ?>">
			<a href="index.php?controller=Tipo_Identificacion&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Tipo Identificacion</span> </a>
			</li>
			
</ul>
</li>
   
   
   <li class="dropdown" style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Logistica" ;?> </span> <span class="caret"></span></a>
    <ul class="dropdown-menu">
       
        <li style="<?php echo getcontrolador("Pedidos",$controladores) ?>">
        	<a href="index.php?controller=Pedidos&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Pedidos</span> </a>
		    </li> 
		<li style="<?php echo getcontrolador("Pedidos",$controladores) ?>">
        	<a href="index.php?controller=Pedidos&action=ListarPedidos"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Listar Pedidos</span> </a>
		    </li>   
       	
	</ul>
</li>       

</ul>






	 <form class="navbar-form" role="search" action="<?php echo $helper->url("Entregas","index");?>"  method="post" class="col-lg-5"  >
  		
  		    <div class="row">
		    
		    
		    <div class="col-xs-12 col-md-2" id="div_nombre">
		    <div class="form-group">
                                <input type="text" class="form-control" id="contenido_busqueda" name="contenido_busqueda" value=""  placeholder="Texto a Buscar">
            </div>
            </div>
            
            <div class="col-xs-12 col-md-2" id="div_fecha">
		    <div class="form-group">
                                <input type="date" class="form-control" id="contenido_busqueda" name="contenido_busqueda" value=""  placeholder="Texto a Buscar">
            </div>
            </div>
          
            
            <div class="col-xs-12 col-md-2" id="ddl_criterio">
            <div class="form-group">
                                 
                                  <select name="criterio_busqueda" id="criterio_busqueda"  class="form-control" >
                                  <option value="0"  > --TODOS--</option>
									<option value="1"  >Nombre Usuario</option>
									<option value="2"  >Fecha Entrega</option>
										
                                  </select> 
                                  
            </div>
		    </div>
		    <div class="col-xs-12 col-md-1" style="margin-left: 10px">
		    <button type="submit"  name="buscar" class="btn btn-info"><span class="glyphicon glyphicon-search" ></span></button>
            </div>
			</div> 
  			
  		
		
        </form>
</div>
</div>
</nav>
</div>
</div>
</div>