<?php
include('conexion.php');
include('menu.php');
if(isset($_GET['m'])){
	$movimiento=$_GET['m'];
	
	$query="select cuenta,deber,haber from detalle_libro_diario where id_movimiento=".$movimiento;
	$result=$con->query($query) or die(mysqli_error());
	echo "<table border=1>
	<tr>
	<th>Cuenta</th>
	<th>Deber</th>
	<th>Haber</th>
	</tr>";
	while($r=mysqli_fetch_assoc($result)){
		$result=$con->query("select nombre_cuenta from cuenta where codigo_mayor=".$r['cuenta']);
		$row = mysqli_fetch_assoc($result);
		echo "<tr><td>".$row['nombre_cuenta']."</td>
		<td>".$r['deber']."</td>
		<td>".$r['haber']."</td>
		</tr>";
		}
	echo"</table>";
	}
	else{
	header('location: libro_diario.php');		
		}

?>