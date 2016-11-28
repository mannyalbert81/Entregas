<?php
#Archivo que conecta con la base de datos 

//$con = mysqli_connect('localhost', 'username', 'password', 'database');

$con = new mysqli('127.0.0.1', 'root', '', 'conta');

// ¡Oh, no! Existe un error 'connect_errno', fallando así el intento de conexión
if ($con->connect_errno) {
	// La conexión falló. ¿Que vamos a hacer?
	// Se podría contactar con uno mismo (¿email?), registrar el error, mostrar una bonita página, etc.
	// No se debe revelar información delicada

	// Probemos esto:
	echo "Lo sentimos, este sitio web está experimentando problemas.";

	// Algo que no se debería de hacer en un sitio público, aunque este ejemplo lo mostrará
	// de todas formas, es imprimir información relacionada con errores de MySQL -- se podría registrar
	echo "Error: Fallo al conectarse a MySQL debido a: \n";
	echo "Errno: " . $con->connect_errno . "\n";
	echo "Error: " . $con->connect_error . "\n";

	// Podría ser conveniente mostrar algo interesante, aunque nosotros simplemente saldremos
	die();
}


/*if(!@$conexion= mysqli_connect('localhost:5000', '', '', 'conta')){
die("Error Al Tratar De Conectar con el Servidor");
}*/

/*if(!@mysql_select_db("conta",$conexion)){
die ("Error Al Tratar De Conectar Con la Base De Datos");
}*/

?>
