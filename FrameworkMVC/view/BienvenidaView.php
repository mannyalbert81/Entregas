<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Geopocisionamiento</title>
		<script src="http://maps.google.com/maps/api/js?key=AIzaSyDyu4jW-edLYPnTIBRqHtUxisvp3NRVBps"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
       
       
         <style type="text/css">
		    #mymap {
		      border:1px solid red;
		   
		      height: 500px;
		    }
		  </style>
	</head>
    <body>
     
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>

		
		
		
	  
	
	       <div class="row">
            
             <div class="col-xs-12 col-md-12">
      			<div id="mymap"></div>
             </div>
		  </div>
	
	
	  <script type="text/javascript">
	    var mymap = new GMaps({
	      el: '#mymap',
	      lat: -1.666618,
	      lng: -78.174819,
	      zoom:8
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
	
	
			
		
		    

       <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
    </body>
</html>