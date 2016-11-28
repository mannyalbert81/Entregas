<?php
include('conexion.php');
$registros=$_POST['n'];
$cuentas=$_POST['cuenta'];
$deber=$_POST['deber'];
$haber=$_POST['haber'];
$dia=$_POST['dia'];
$mes=$_POST['mes'];
$ano=$_POST['ano'];
$partida=$_POST['partida'];
$descripcion=$_POST['descripcion'];

$query="insert into libro_diario(dia,mes,ano,partida,descripcion) values(".$dia.",".$mes.",".$ano.",".$partida.",'".$descripcion."')";

$q2="select id_movimiento from libro_diario where dia=".$dia." and mes=".$mes." and ano=".$ano." and partida=".$partida;

$res=$con->query($q2)or die(mysqli_error($con));

$resultado=mysqli_fetch_assoc($res);

if(!empty($resultado)){
	echo "<script type=\"text/javascript\" >
alert('El numero de partida ".$partida." del dia ".$dia."/".$mes."/".$ano." ya existe en el registro');
setTimeout(\"location.href='registro_diario.php'\",1);
</script>";
	}
	else{
$query="insert into libro_diario(dia,mes,ano,partida,descripcion) values(".$dia.",".$mes.",".$ano.",".$partida.",'".$descripcion."')";
$save=$con->query($query)or die(mysqli_error($con));

$movimiento=mysqli_fetch_assoc($con->query($q2));

for($i=0;$i<$registros;$i++){
	$q="insert into detalle_libro_diario(id_movimiento,cuenta,deber,haber) values(".$movimiento['id_movimiento'].",".$cuentas[$i].",".$deber[$i].",".$haber[$i].")";
	$savedetalle=$con->query($q)or die(mysqli_error($con));
	
	}
	echo "<script type=\"text/javascript\" >
setTimeout(\"location.href='libro_diario.php'\",1);
</script>";
}
?>
