<?php 
include('conexion.php');
include('menu.php');
echo "<br><b><a href=\"registro_diario.php\">+Agregar Nueva partida</a></b>";
$query="select id_movimiento,dia,mes,ano,partida,descripcion from libro_diario order by mes and ano";
$result=$con->query($query) or die(mysql_error());
echo "<table border=1>
<tr>
<th>Dia</th>
<th>Mes</th>
<th>Año</th>
<th>Partida</th>
<th>Descripcion</th>
</tr>";
while($r=mysqli_fetch_assoc($result)) {
	echo"<tr>
	<td><a href=\"detalle_diario.php?m=".$r['id_movimiento']."\">".$r['dia']."</td></a>
	<td><a href=\"detalle_diario.php?m=".$r['id_movimiento']."\">".$r['mes']."</td></a>
	<td><a href=\"detalle_diario.php?m=".$r['id_movimiento']."\">".$r['ano']."</td></a>
	<td><a href=\"detalle_diario.php?m=".$r['id_movimiento']."\">".$r['partida']."</td></a>
	<td><a href=\"detalle_diario.php?m=".$r['id_movimiento']."\">".$r['descripcion']."</td></a>
	</tr>";
	}
echo "</table>";
?>