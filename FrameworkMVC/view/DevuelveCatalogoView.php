
<?php

$id_catalogos = '';


if (isset ($_GET["id_catalogos"]))
{
	$id_catalogos = $_GET["id_catalogos"];

}
	
	
	$image = "";
	
	$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=contabilidad_des host=186.4.241.148");
	
	if(!$conn)
	{
		echo  "No se pudo conectar";
	}
	else
	{
	
		$campo = 'archivo_catalogos';
		$tabla = 'fc_catalogos';
		$id_nombre = 'id_catalogos';
		$id_valor = '75820';
	
		$res = pg_query($conn, "SELECT archivo_catalogos FROM fc_catalogos WHERE id_catalogos = '$id_catalogos' ");
	
		if ($res)
		{
			$raw = pg_fetch_result($res, $campo );
				
			header('Content-type: application/pdf');
			echo pg_unescape_bytea($raw);
				
				
		}
	
		pg_close($conn);	
	}	
	 

	



?>
