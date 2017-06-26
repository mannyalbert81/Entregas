<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Geopocisionamiento</title>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyDyu4jW-edLYPnTIBRqHtUxisvp3NRVBps"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
       
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
         
 		
 		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
		
         <style type="text/css">
		    #mymap {
		      border:1px solid red;
		   
		      height: 500px;
		        width: 100%;
		    }
		  </style>
		  
		   
	</head>
	
    <body>
     
     
     
      <?php
       
       /*  
       $sel_id_usuarios = "";
       $sel_fecha_entregas= "";
       
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	$sel_id_usuarios = $_POST['id_usuarios'];
       	$sel_fecha_entregas= $_POST['fecha_entregas'];
       
       }
       */
      $marcadores ="";
      
        if (!empty($resultDatos)) { 
        	
        	$marcadores="[";
        	
        	foreach($resultDatos as $res) {
        	
        		$marcadores.="['";
        		$marcadores.=$res->nombre_usuarios."',".$res->latitud_entregas_cabezas.",".$res->longitud_entregas_cabezas."],";
        	
         }
         
         $marcadores.="]";
         
       //  echo ($marcadores);
         
        }else{ 
          
      	}
          
          
       ?>
     
     
       <script type="text/javascript">
    function initialize() {
     /* var marcadores = [
				['Quito', -0.1804991, -78.46786299999997],
				['Cayambe', 0.0329091, -78.14970210000001],
				['Quinche', -0.1110111, -78.29494979999998],
				['Guayllabamba', -0.0626176, -78.35128320000001],
				['Carapungo', -0.09430799999999999, -78.4495799],
				['Guayaquil', -2.1709048, -79.9222866],
				['Loja', -4.008115300000001, -79.21077259999998],
				['Manta', -0.9674619999999999, -80.70916249999999],
				['Cuenca', -2.8996687, -79.0058219],
				['Malchingui', 0.0469617, -78.34782339999998],
				['Tabacundo', 0.0460669, -78.20630449999999],
				['Tababela', -0.133943, -78.35849710000002],
				
				
			
      ];*/

      var marcadores = <?php echo $marcadores;?>

      //console.log(marcadores);
      
      var map = new google.maps.Map(document.getElementById('mymap'), {
        zoom: 7,
        center: new google.maps.LatLng(-1.9438015, -77.99350960000004),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map
        });


        infowindow = new google.maps.InfoWindow({
            content: marcadores[i][0]

        });
        google.maps.event.addListener(marker, "click", function () {

            infowindow.open(map, marker);
        });

        infowindow.open(map, marker);
  
      }
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
     
     
       <?php include("view/modulos/modal.php"); ?>
         <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu_mapa.php"); ?>

		
		
	
	       
            <div style="padding-right: 15px; padding-left: 15px;">
             <div class="col-xs-12 col-md-12 col-lg-12">
             <div class="row">
      			<div id="mymap"></div>
      			
             </div>
		  </div>
		    </div>
		
	<!--  
	  <script type="text/javascript">
	    var mymap = new GMaps({
	      el: '#mymap',
	      lat: -1.666618,
	      lng: -78.174819,
	      zoom:7
	    });
	   
	    mymap.addMarker({
	        lat: -1.666618,
		      lng: -78.174819,
		   title: 'Ecuador',
		   infoWindow: {
		    	  content: '<p>HTML Content</p>'
		    	},	
		   click: function(e) {
	        alert('Presionaste, Marcador.');
	      }
	   
	    });
	    
	  </script>
	  -->
	
	
       <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
    </body>
</html>