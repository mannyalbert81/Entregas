 <?php include("view/modulos/head.php"); ?>
  
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Maycol</title>
	<link rel="stylesheet" href="view/css/bootstrap.css">
    
  <script src="view/js/jquery.js"></script>
  <script src="view/js/bootstrap.min.js"></script>
  <script src="view/js/bootstrapValidator.min.js"></script>
  <script src="view/js/noty.js"></script>
  <script src="view/js/ValidarLogin.js"></script>
	
	<!--  <script>
   function verificar(){
	   usuario = $('#usuarios').val();
       pass = $('#clave').val();

       //Comparamos si el usuario y la contraseña son correctos
       if(usuario == "" || pass == ""){
       	 nota("error","Los Datos Son Incorrectos.");
       }

        else{
          
        	
       }
       function nota(op,msg,time){
   	    if(time == undefined)time = 1000;
   	    var n = noty({text:msg,maxVisible: 1,type:op,killer:true,timeout:time,layout: 'inline'});
   	  }
        }
   	
	</script>
	-->
	
	
   <style>
			body {
			
			    /* Ubicación de la imagen */
		 
		  background-image: url(view/images/fondo_contabilidad.jpg);
		
		  /* Nos aseguramos que la imagen de fondo este centrada vertical y
		    horizontalmente en todo momento */
		  background-position: center center;
		
		  /* La imagen de fondo no se repite */
		  background-repeat: no-repeat;
		
		  /* La imagen de fondo está fija en el viewport, de modo que no se mueva cuando
		     la altura del contenido supere la altura de la imagen. */
		  background-attachment: fixed;
		
		  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana
		     del navegador */
		  background-size: cover;
		
		  /* Fijamos un color de fondo para que se muestre mientras se está
		    cargando la imagen de fondo o si hay problemas para cargarla  */
		  
			}
			
			
			</style>	
		
		
			<style>	
			.Icon span{
background: #A8A6A6;
padding: 10px;
border-radius: 100px;
}
		.Icon{
	margin-top: 0px;
	margin-bottom:0px; 
    color: #FFF;
    font-size: 30px;
    text-align: center;
}	
	
			</style>	
			
			
			
	
</head >

<body>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
       
   
 <form id="form-login"  action="<?php echo $helper->url("Usuarios","Loguear"); ?>" method="post" class="col-lg-12" style="padding-top:70px;">
         
    <div id="login-overlay" class="modal-dialog" >
       <div class="modal-content">
          <div class="modal-body">
              
              <div class="row" >
               <div class="col-lg-6 col-md-3" >
               
                      <div class="well">
                       <div class="Icon"><span  class="glyphicon glyphicon-user"></span></div>
			                  
			                  <div class="form-group">
			                  <label for="usuarios" class="control-label">Usuario</label><br>
			                  <div class="input-group input-group-md">
			                  <span class="input-group-addon" id="usuarios"><i class="glyphicon glyphicon-envelope"></i></span>
							  <input type="text" class="form-control" name="usuarios" placeholder="Usuario" id="usuarios">
							  </div>
							  </div>
							  
							  <div class="form-group">
			                  <label for="clave" class="control-label">Password</label><br>
			                  <div class="input-group input-group-md">
							  <span class="input-group-addon" id="clave"><i class="glyphicon glyphicon-lock"></i></span>
							  <input type="password" name="clave" id="clave" class="form-control" placeholder="******">
							  </div>
                              </div>
                              
                              <button type="submit" id ="btn" class="btn btn-success btn-block" onclick="verificar()">Login</button>
                               
                      </div>
                  </div>
                  
                		  <div class="col-lg-6 col-md-3">
		                      <p class="lead" style ="margin-top: 60px;">Consejos de Seguridad <span class="text-success"></span></p>
		                      <ul class="list-unstyled" style="line-height: 2">
		                          <li><span class="fa fa-check text-success"></span> Recuerda tu usuario y tu clave.</li>
		                          <li><span class="fa fa-check text-success"></span> No enseñes a nadie tu clave.</li>
		                          <li><span class="fa fa-check text-success"></span> La clave es personal.</li>
		                          <li><span class="fa fa-check text-success"></span> Cuidala.</li>
		                     
		                      </ul>
		                  </div>
              </div>
              <?php if (isset($allusers)) {?>
  <?php if ($allusers == "false"){?>
              	  <div class="alert alert-danger alert-dismissible fade in"  role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong> Error</strong> Usuario o Contraseña incorrecta. </div>
			
 <?php }}?> 
          </div>
          
      </div>
 
 </div>
 
 </form>
 
 <br>
        
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer> 
</body>
</html>