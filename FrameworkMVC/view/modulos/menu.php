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
			<!-- 
			<li style="<?php echo getcontrolador("Repositorio",$controladores) ?>">
			<a href="index.php?controller=Repositorio&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Gestion Repositorios</span> </a>
			</li>
			-->
			<li style="<?php echo getcontrolador("Entidades",$controladores) ?>">
			<a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Entidades</span> </a>
			</li>
            <!--
            <li style="<?php echo getcontrolador("TipoComprobantes",$controladores) ?>">
			<a href="index.php?controller=TipoComprobantes&action=index"> <span class=" glyphicon glyphicon-asterisk" aria-hidden="true"> Tipo de Comprobantes</span> </a>
			</li>
			-->
			<li style="<?php echo getcontrolador("ReporteUsuarios",$controladores) ?>">
			<a href="index.php?controller=ReporteUsuarios&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Reporte Usuarios</span> </a>
			</li>
			<li style="<?php echo getcontrolador("ReporteUsuariosAdmin",$controladores) ?>">
			<a href="index.php?controller=ReporteUsuariosAdmin&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Reporte Usuarios</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Tipo_Persona",$controladores) ?>">
			<a href="index.php?controller=Tipo_Persona&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Tipo Persona</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Tipo_Contribuyente",$controladores) ?>">
			<a href="index.php?controller=Tipo_Contribuyente&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Tipo Contribuyente</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Tipo_Identificacion",$controladores) ?>">
			<a href="index.php?controller=Tipo_Identificacion&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Tipo Identificacion</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Tipo_Notificacion",$controladores) ?>">
			<a href="index.php?controller=Tipo_Notificacion&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Tipo Notificacion</span> </a>
			</li>

</ul>
</li>

        
          <li class="dropdown" style="<?php echo getcontrolador("MenuPlanCuentas",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list-alt" ><?php echo " Plan de Cuentas" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("PlanCuentas",$controladores) ?>">
		  <a href="index.php?controller=PlanCuentas&action=index"><span class="glyphicon glyphicon-book" aria-hidden="true"> Cuentas</span> </a>
		  </li>
		  <!--
          <li style="<?php echo getcontrolador("CentroCostos",$controladores) ?>">
		  <a href="index.php?controller=CentroCostos&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Centro Costos</span> </a>
		  </li>
			
          <li style="<?php echo getcontrolador("ImportacionCuentas",$controladores) ?>">
		  <a href="index.php?controller=ImportacionCuentas&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Importación Cuentas</span> </a>
		  </li>
		  -->
		  <li style="<?php echo getcontrolador("PlanCuentas",$controladores) ?>">
		  <a href="index.php?controller=PlanCuentas&action=ImprimirConsultarPlanCuentas"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar e Imprimir Plan Cuentas</span> </a>
		  </li>
		   <li style="<?php echo getcontrolador("PlanCuentasAdmin",$controladores) ?>">
		  <a href="index.php?controller=PlanCuentasAdmin&action=ImprimirConsultarPlanCuentasAdmin"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar e Imprimir Plan Cuentas</span> </a>
		  </li>
         
</ul>
</li>


        <li class="dropdown" style="<?php echo getcontrolador("MenuComprobantes",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Comprobantes" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          	<li style="<?php echo getcontrolador("Comprobantes",$controladores) ?>">
			<a href="index.php?controller=Comprobantes&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Comprobantes Ingreso / Egreso</span> </a>
			</li>
			
			<li style="<?php echo getcontrolador("ComprobanteContable",$controladores) ?>">
			<a href="index.php?controller=ComprobanteContable&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Comprobante Contable</span> </a>
			</li>
		<!--
		    <li style="<?php echo getcontrolador("ImportacionComprobantes",$controladores) ?>">
			<a href="index.php?controller=ImportacionComprobantes&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Importacion Comprobantes</span> </a>
			</li>
			-->
			<li style="<?php echo getcontrolador("Comprobantes",$controladores) ?>">
			<a href="index.php?controller=Comprobantes&action=ReporteComprobantes"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar Imprimir Comprobantes</span> </a>
			</li>
			<li style="<?php echo getcontrolador("ComprobantesAdm",$controladores) ?>">
			<a href="index.php?controller=ComprobantesAdm&action=ReporteComprobantesAdm"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar Imprimir Comprobantes</span> </a>
			</li>
			
			<!--
			<li style="<?php echo getcontrolador("RecalcularMayor",$controladores) ?>">
			<a href="index.php?controller=RecalcularMayor&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Recalcular Mayor</span> </a>
			</li>
			-->
			<li style="<?php echo getcontrolador("MayorGeneral",$controladores) ?>">
			<a href="index.php?controller=MayorGeneral&action=MayorGeneral"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar Imprimir Mayor General</span> </a>
			</li>
			<!--
			<li style="<?php echo getcontrolador("TipoCierre",$controladores) ?>">
			<a href="index.php?controller=TipoCierre&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Tipo Cierre </span> </a>
			</li>
			-->
			<li style="<?php echo getcontrolador("ComprobantesAdmin",$controladores) ?>">
			<a href="index.php?controller=ComprobantesAdmin&action=ReporteComprobantes"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar Imprimir Comprobantes</span> </a>
			</li>
</ul>
</li>

          <li class="dropdown" style="<?php echo getcontrolador("MenuCierreCuentas",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Cierre Cuentas" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("CierreCuentas",$controladores) ?>">
          <a href="index.php?controller=CierreCuentas&action=index"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Cerrar Cuentas</span> </a>
          </li>
          <li style="<?php echo getcontrolador("BalanceComprobacion",$controladores) ?>">
          <a href="index.php?controller=BalanceComprobacion&action=BalanceComprobacion"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Balance Comprobación</span> </a>
          </li>
          <li style="<?php echo getcontrolador("BalanceComprobacionAdmin",$controladores) ?>">
          <a href="index.php?controller=BalanceComprobacionAdmin&action=BalanceComprobacionAdmin"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Balance Comprobación</span> </a>
          </li>
          <li style="<?php echo getcontrolador("BalanceComprobacionAdm",$controladores) ?>">
          <a href="index.php?controller=BalanceComprobacionAdm&action=BalanceComprobacionAdm"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Balance Comprobación</span> </a>
          </li>
          
</ul>
</li>

 <li class="dropdown" style="<?php echo getcontrolador("MenuFacturacion",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Facturación" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("FC_Productos",$controladores) ?>">
          <a href="index.php?controller=FC_Productos&action=index"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Productos</span> </a>
          </li>
          
          <li style="<?php echo getcontrolador("FC_Productos",$controladores) ?>">
          <a href="index.php?controller=FC_Productos&action=Reporte_Productos"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Reporte Productos</span> </a>
          </li>
          
          <li style="<?php echo getcontrolador("FC_ReporteProductosAdm",$controladores) ?>">
          <a href="index.php?controller=FC_ReporteProductosAdm&action=index"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Reporte Productos</span> </a>
          </li>
         
          <li style="<?php echo getcontrolador("FC_ReporteProductosAdmin",$controladores) ?>">
          <a href="index.php?controller=FC_ReporteProductosAdmin&action=index"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Reporte Productos</span> </a>
          </li>
          
         <li style="<?php echo getcontrolador("FC_Impuestos",$controladores) ?>">
          <a href="index.php?controller=FC_Impuestos&action=index"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Impuestos</span> </a>
          </li>
         
          
</ul>
</li>

 <li class="dropdown" style="<?php echo getcontrolador("MenuMensajeria",$controladores) ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Mensajeria" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Chat",$controladores) ?>">
          <a href="index.php?controller=Chat&action=index"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Chat en linea</span> </a>
          </li>
         
          
</ul>
</li>



</ul>
</div>
</div>
</nav>
</div>
</div>
</div>