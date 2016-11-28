<?php
include('conexion.php');
include('menu.php');
if((!isset($_GET['m']))&&(!isset($_GET['a']))){
	header('location:balance_comprobacion.php');	
	}
	else{
		$mes=$_GET['m'];
		$ano=$_GET['a'];
$query="select nombre_cuenta,sum(deber) as deber,sum(haber) as haber from detalle_libro_diario inner join cuenta on(codigo_mayor=cuenta) inner join libro_diario on(detalle_libro_diario.id_movimiento=libro_diario.id_movimiento) where mes=".$mes." and ano=".$ano." and er=1 group by cuenta order by tipo_cuenta ";
$result=$con->query($query) or die(mysqli_error($con));
$debe=0;
$habe=0;
$un=0;
echo "<b>Estado de Resultados del mes ".$mes." y año ".$ano."</b>";
echo "<table border=1>
<tr>
<th>Cuenta</th>
<th>Deber</th>
<th>Haber</th>
</tr>";
while($r=mysqli_fetch_assoc($result)){
echo "<tr>
<td>".$r['nombre_cuenta']."</td>
<td>".$debe=$debe+$r['deber']."</td>
<td>".$habe=$habe+$r['haber']."</td>
</tr>
<tr></tr>
<tr></tr>
<tr>
<td>U.N</td>";
$un=$debe-$habe;
if($un<0){
	$un=(-1)*$un;
echo "<td></td><td>".$un."</td>";	
	}
	else {	
	echo "<td>".$un."</td><td></td>";
	}

echo "</tr></table>";

		}
	}
?>