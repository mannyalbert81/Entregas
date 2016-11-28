<?php
include('conexion.php');
include('menu.php');

$u=0;
function imprime_celdas($conexion){
	$cuentas=$conexion->query("select codigo_mayor,nombre_cuenta,tipo_cuenta from cuenta") or die(mysql_error());
		echo "<td><select name=\"cuenta[]\" style=\"width:200px\" >";
		while($res=mysqli_fetch_assoc($cuentas)) {
		echo "<option value=".$res['codigo_mayor'].">".$res['nombre_cuenta']."</option>";		
		};
		
		echo"</select></td><td><input type=\"text\" name=\"deber[]\" size=\"10\" value=0 width=\"200px\"></td><td><input type=\"text\" name=\"haber[]\" size=\"10\" value=0 width=\"200px\"></td><tr>";
	}
?>
<form name="libro_diario" method="post" action="registrar_diario.php">
<table>
<tr>
<td>Partida N°: <input name="partida" type="text" value="" size="3" width="100px"></td>
<td></td>
<td></td>
</tr>
<tr>
<td>Dia:<select name="dia" style="width:100px;"><?php for($i=1;$i<32;$i++){echo "<option value=".$i.">".$i."</option>";}?></select></td> 
<td>Mes:<select name="mes" style="width:100px;"><?php for($i=1;$i<13;$i++){echo "<option value=".$i.">".$i."</option>";}?></select></td>
<td>Año:<select name="ano" style="width:100px;"><?php for($i=2000;$i<2020;$i++){echo "<option value=".$i.">".$i."</option>";}?></select></td>
</tr>
</table>
<table border="1">
<tr>
<th>Cuenta</th>
<th>Deber</th>
<th>Haber</th>
</tr>
<?php
if(isset($_GET['u']))
{
	$u=$_GET['u'];
	
}else {
	$u=2;
}

for($i=0;$i<$u;$i++){
	imprime_celdas($con);
}

echo "<tr><td><b><a href='".$_SERVER['PHP_SELF']."?u=".($u+1)."'>+Añadir otro campo</a></b></td> <td><b><a href='".$_SERVER['PHP_SELF']."?u=".($u-1)."'>-Eliminar Ultimo campo</a></b></td></tr>";
?>


</table>
Descripción:<br> 
<textarea name="descripcion" rows="5" cols="70"></textarea><br>
<input type="hidden" value="<?php echo $u; ?>" name="n">
<input type="submit" value="Registrar">                    <input type="reset" value="Limpiar Formulario">
</form>
