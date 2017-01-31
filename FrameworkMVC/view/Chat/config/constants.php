<?php
	date_default_timezone_set('America/Bogota');
	
	
	define("HELP_DESK_DATABASE","contabilidad_des");
	
	$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad_des host=186.4.241.148");
	
	if(!$conn)
	{
		die( "No se pudo conectar");
	}
	
	// Constantes de conexion a la base de datos
	define("HELP_DESK_LINK",$conn);
	//define("HELP_DESK_DB_SELECTED",pg_select(HELP_DESK_DATABASE,HELP_DESK_LINK)); 

	// Super usuarios
	define("HELP_DESK_ADMIN","administrador@dominio.com");
	define("HELP_DESK_MODER","moderador@dominio.com");

	// Parametros comunes
	define("HELP_DESK_THEME",2);
	define("REGISTROS_POR_PAGINA",11);
	define("INTERVALO_CALL_SERVER",1220);
?>