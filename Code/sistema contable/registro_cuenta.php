<?php
include('conexion.php');
include('menu.php');
$tipos=$con->query("select id_tipo_cuenta,nombre_tipo_cuenta from tipo_cuenta") or die(mysql_error());
?>
<form name="registro_cuentas" action="registrar_cuenta.php" method="post">
<table border="1" >
<tr>
<th>Tipo de Cuenta</th>
<th>Código de Mayor </th>
<th>Nombre de Cuenta</th>
<th>Balance de Comprobacion</th>
<th> Descripción </th>
</tr>
<tr>
<td>
<?php
echo "<select name=\"tipo_cuenta\">";
while($res=mysqli_fetch_assoc($tipos)) {
echo "<option value=\"".$res['id_tipo_cuenta']."\">".$res['nombre_tipo_cuenta']."</option>";
};
echo "</select>"; 
?>
</td>
<td><input type="text" size="10" name="codigo_mayor"></td>
<td><input type="text" size="60" name="nombre_cuenta"></td>
<td align="center">Se incluye:<input type="checkbox" name="er"></td>
<td><textarea name="descripcion_cuenta"></textarea></td>
</tr>
</table>
<input type="submit" value="Registrar">
</form>
