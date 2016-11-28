<?php
include('conexion.php');
include('menu.php');
$query="select  DISTINCT mes,ano from libro_diario order by ano";
$result=$con->query($query) or die(mysql_error());
echo "<table border=1>
<tr>
<th>Año</th>
<th>Mes</th>
</tr>";
while($r=mysqli_fetch_assoc($result)) {
	$mes=$r['mes'];
	$ano=$r['ano'];
	echo "<tr>
	<td><a href=\"detalle_balance.php?a=".$ano."&m=".$mes."\">".$ano."</a></td>
	<td><a href=\"detalle_balance.php?a=".$ano."&m=".$mes."\">".$mes."</a></td>";
}
echo "</table>";
?>