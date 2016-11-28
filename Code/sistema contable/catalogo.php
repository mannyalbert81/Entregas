<?php
include('conexion.php');
include('menu.php');
$query="select * from cuenta order by tipo_cuenta";

$resultado=$con->query($query) or die(mysql_error());

echo "<br><b><a href=\"registro_cuenta.php\"> AGREGAR NUEVA CUENTA </a></b>";
echo "<table border=1>
<tr>
<th>Tipo de Cuenta</th>
<th> Codigo de Mayor </th>
<th> Nombre de Cuenta </th>
<th> Descripcion </th></tr>";
while($r=mysqli_fetch_assoc($resultado)){
	$q2="select nombre_tipo_cuenta from tipo_cuenta where id_tipo_cuenta=".$r['tipo_cuenta'];
	$result=$con->query($q2);
	$row = mysqli_fetch_assoc($result);
	echo "<tr>
	<td>";
	echo $row['nombre_tipo_cuenta'];
	echo "<td>".$r['codigo_mayor']."
	<td>".$r['nombre_cuenta']."
	<td>".$r['descripcion']."
	</tr>";
	};
echo "</table>";
?>