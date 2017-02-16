<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Contabilidad - 2016 </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Slide Down Box Menu with jQuery and CSS3" />
        <meta name="keywords" content="jquery, css3, sliding, box, menu, cube, navigation, portfolio, thumbnails"/>
		<link rel="stylesheet" href="view/css/style.css" type="text/css" media="screen"/>
		<link rel="stylesheet" href="view/css/bootstrap.css"/>
		<script src="view/js/jquery.js"></script>
		 
        <style>
			body{
				background:#333 url(view/images/inicio/bg.jpg) repeat top left;
				font-family:Arial;
			}
			span.reference{
				position:fixed;
				left:10px;
				bottom:10px;
				font-size:12px;
			}
			span.reference a{
				color:#aaa;
				text-transform:uppercase;
				text-decoration:none;
				text-shadow:1px 1px 1px #000;
				margin-right:30px;
			}
			span.reference a:hover{
				color:#ddd;
			}
			ul.sdt_menu{
				margin-top:90px;
			}
			h1.title{
				text-indent:-9000px;
				background:transparent url(title.png) no-repeat top left;
				width:633px;
				height:69px;
			}
		</style>
		
		
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
		
		
		
    </head>
    <body>
     
     
     
     
          
        	

     
     
      
    <div class="col-lg-12">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-8">
    <div class="row">
    <div class="content" style="<?php echo getcontrolador("MenuAdministracion",$controladores) ?>">
			<ul id="sdt_menu" class="sdt_menu">
				<li>
					<a href="#">
						<img src="view/images/inicio/2.png" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Administración</span>
							<span class="sdt_descr">Administration</span>
						</span>
					</a>
					<div class="sdt_box">
					          <div style="<?php echo getcontrolador("Usuarios",$controladores) ?>">
						      <a href="index.php?controller=Usuarios&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Usuarios</span> </a>
		                      </div>
		                      
		                      <div style="<?php echo getcontrolador("Roles",$controladores) ?>">
								<a href="index.php?controller=Roles&action=index"> <span class=" glyphicon glyphicon-asterisk" aria-hidden="true"> Roles</span> </a>
								</div>
								
								<div style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>">
								<a href="index.php?controller=PermisosRoles&action=index"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Permisos</span> </a>
								</div>
								
								<div style="<?php echo getcontrolador("Controladores",$controladores) ?>">
								<a href="index.php?controller=Controladores&action=index"><span class="glyphicon glyphicon-inbox" aria-hidden="true"> Controladores</span> </a>
								</div>
								
								<div style="<?php echo getcontrolador("Entidades",$controladores) ?>">
								<a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Entidades</span> </a>
								</div>
								
					            <div style="<?php echo getcontrolador("ReporteUsuarios",$controladores) ?>">
								<a href="index.php?controller=ReporteUsuarios&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Reporte</span> </a>
								</div>
								
								<div style="<?php echo getcontrolador("ReporteUsuariosAdmin",$controladores) ?>">
								<a href="index.php?controller=ReporteUsuariosAdmin&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Reporte</span> </a>
								</div>
			
		            </div>
				</li>
			</ul>
			</div>
			
			<div class="content" style="<?php echo getcontrolador("MenuPlanCuentas",$controladores) ?>">
			<ul id="sdt_menu" class="sdt_menu">
			<li>
					<a href="#">
						<img src="view/images/inicio/1.png" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Contabilidad</span>
							<span class="sdt_descr">Accounting</span>
						</span>
					</a>
					<div class="sdt_box">
							 <div style="<?php echo getcontrolador("PlanCuentas",$controladores) ?>">
							  <a href="index.php?controller=PlanCuentas&action=index"><span class="glyphicon glyphicon-book" aria-hidden="true"> Cuentas</span> </a>
							  </div>
							  <div style="<?php echo getcontrolador("PlanCuentas",$controladores) ?>">
							  <a href="index.php?controller=PlanCuentas&action=ImprimirConsultarPlanCuentas"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar e Imprimir Plan Cuentas</span> </a>
							  </div>
							   <div style="<?php echo getcontrolador("PlanCuentasAdmin",$controladores) ?>">
							  <a href="index.php?controller=PlanCuentasAdmin&action=ImprimirConsultarPlanCuentasAdmin"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar e Imprimir Plan Cuentas</span> </a>
							  </div>
					<div style="<?php echo getcontrolador("MenuComprobantes",$controladores) ?>">
       
							  <div style="<?php echo getcontrolador("Comprobantes",$controladores) ?>">
								<a href="index.php?controller=Comprobantes&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Comprobantes Ingreso / Egreso</span> </a>
								</div>
								<div style="<?php echo getcontrolador("ComprobanteContable",$controladores) ?>">
								<a href="index.php?controller=ComprobanteContable&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Comprobante Contable</span> </a>
								</div>
							    <div style="<?php echo getcontrolador("Comprobantes",$controladores) ?>">
								<a href="index.php?controller=Comprobantes&action=ReporteComprobantes"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar Imprimir Comprobantes</span> </a>
								</div>
								<div style="<?php echo getcontrolador("ComprobantesAdm",$controladores) ?>">
								<a href="index.php?controller=ComprobantesAdm&action=ReporteComprobantesAdm"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar Imprimir Comprobantes</span> </a>
								</div>
								<div style="<?php echo getcontrolador("MayorGeneral",$controladores) ?>">
								<a href="index.php?controller=MayorGeneral&action=MayorGeneral"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar Imprimir Mayor General</span> </a>
								</div>
								<div style="<?php echo getcontrolador("ComprobantesAdmin",$controladores) ?>">
								<a href="index.php?controller=ComprobantesAdmin&action=ReporteComprobantes"><span class="glyphicon glyphicon-print" aria-hidden="true"> Consultar Imprimir Comprobantes</span> </a>
								</div>
					</div>
					
					 <div style="<?php echo getcontrolador("MenuCierreCuentas",$controladores) ?>">
							  <div style="<?php echo getcontrolador("CierreCuentas",$controladores) ?>">
					          <a href="index.php?controller=CierreCuentas&action=index"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Cerrar Cuentas</span> </a>
					          </div>
					          <div style="<?php echo getcontrolador("BalanceComprobacion",$controladores) ?>">
					          <a href="index.php?controller=BalanceComprobacion&action=BalanceComprobacion"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Balance Comprobación</span> </a>
					          </div>
					          <div style="<?php echo getcontrolador("BalanceComprobacionAdmin",$controladores) ?>">
					          <a href="index.php?controller=BalanceComprobacionAdmin&action=BalanceComprobacionAdmin"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Balance Comprobación</span> </a>
					          </div>
					          <div style="<?php echo getcontrolador("BalanceComprobacionAdm",$controladores) ?>">
					          <a href="index.php?controller=BalanceComprobacionAdm&action=BalanceComprobacionAdm"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Balance Comprobación</span> </a>
					          </div>
					 
					 </div>
         
					</div>
				</li>
			</ul>
			</div>
			
			<div class="content">
			<ul id="sdt_menu" class="sdt_menu">
			<li>
					<a href="#">
						<img src="view/images/inicio/3.png" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Facturación</span>
							<span class="sdt_descr">Billing</span>
						</span>
					</a>
					<div class="sdt_box">
							<a href="#">Factura</a>
							<a href="#">Clientes</a>
							<a href="#">Proveedores</a>
							<a href="#">Bodegas</a>
							<a href="#">Productos</a>
							
					</div>
				</li>
			</ul>
			</div>
			
			<div class="content">
			<ul id="sdt_menu" class="sdt_menu">
			<li>
					<a href="#">
						<img src="view/images/inicio/4.png" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Inventarios</span>
							<span class="sdt_descr">Inventory</span>
						</span>
					</a>
					<div class="sdt_box">
							<a href="#">Cuentas</a>
							<a href="#">Coteos Ciegos</a>
							<a href="#">Zonas Fisicas</a>
							
					</div>
				</li>
			</ul>
			</div>
			</div>	
				
			
			
			<div class="row" style="margin-top:85px">
            <div class="content">
			<ul id="sdt_menu" class="sdt_menu">	
			<li>
					<a href="#">
						<img src="view/images/inicio/5.png" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Nomina</span>
							<span class="sdt_descr">Roster</span>
						</span>
					</a>
				</li>
			</ul>
			</div>
			
			<div class="content">
			<ul id="sdt_menu" class="sdt_menu">	
			<li>
					<a href="#">
						<img src="view/images/inicio/6.png" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Cuentas</span>
							<span class="sdt_descr">Accounts</span>
						</span>
					</a>
				</li>
			</ul>
			</div>
			
			<div class="content">
			<ul id="sdt_menu" class="sdt_menu">	
			<li>
					<a href="#">
						<img src="view/images/inicio/7.png" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Procesos</span>
							<span class="sdt_descr">Processes</span>
						</span>
					</a>
					<div class="sdt_box">
						<a href="#">Cierre Diario</a>
						<a href="#">Cuadre de Cuentas</a>
						<a href="#">Ventas</a>
					</div>
				</li>
			</ul>
			</div>
			
			<div class="content">
			<ul id="sdt_menu" class="sdt_menu">
			<li>
					<a href="#">
						<img src="view/images/inicio/8.png" alt=""/>
						<span class="sdt_active"></span>
						<span class="sdt_wrap">
							<span class="sdt_link">Consultas</span>
							<span class="sdt_descr">Inquiries</span>
						</span>
					</a>
					<div class="sdt_box">
						<a href="#">Plan Cuentas</a>
						<a href="#">Balance Comprobación</a>
						<a href="#">Mayor General</a>
						<a href="#">Comprobantes</a>
						<a href="#">Libro Diario</a>
					</div>
				</li>
			</ul>
			</div>
			</div>		
				
				
				
				
			
		</div>
		
		
    
    <div class="col-lg-2">
    </div>
    </div>
    
		
       

        <!-- The JavaScript -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript" src="view/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
				/**
				* for each menu element, on mouseenter, 
				* we enlarge the image, and show both sdt_active span and 
				* sdt_wrap span. If the element has a sub menu (sdt_box),
				* then we slide it - if the element is the last one in the menu
				* we slide it to the left, otherwise to the right
				*/
                $('#sdt_menu > li').bind('mouseenter',function(){
					var $elem = $(this);
					$elem.find('img')
						 .stop(true)
						 .animate({
							'width':'170px',
							'height':'170px',
							'left':'0px'
						 },400,'easeOutBack')
						 .andSelf()
						 .find('.sdt_wrap')
					     .stop(true)
						 .animate({'top':'140px'},500,'easeOutBack')
						 .andSelf()
						 .find('.sdt_active')
					     .stop(true)
						 .animate({'height':'170px'},300,function(){
						var $sub_menu = $elem.find('.sdt_box');
						if($sub_menu.length){
							var left = '170px';
							if($elem.parent().children().length == $elem.index()+1)
								left = '-170px';
							$sub_menu.show().animate({'left':left},200);
						}	
					});
				}).bind('mouseleave',function(){
					var $elem = $(this);
					var $sub_menu = $elem.find('.sdt_box');
					if($sub_menu.length)
						$sub_menu.hide().css('left','0px');
					
					$elem.find('.sdt_active')
						 .stop(true)
						 .animate({'height':'0px'},300)
						 .andSelf().find('img')
						 .stop(true)
						 .animate({
							'width':'0px',
							'height':'0px',
							'left':'85px'},400)
						 .andSelf()
						 .find('.sdt_wrap')
						 .stop(true)
						 .animate({'top':'25px'},500);
				});
            });
        </script>
    </body>
</html>