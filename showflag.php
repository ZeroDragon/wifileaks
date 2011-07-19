<?include "dbconnect.php";
$query = "select * from spots WHERE bandera = 'true'";
$resultado = mysql_query($query) or die(mysql_error());
$res = mysql_query($query) or die(mysql_error());
if (mysql_fetch_array($res)){
?>
<form action="salvar.php" method="POST">
<?while ($row = mysql_fetch_array($resultado)){
	$marker = $row['latitud'].", ".$row['longitud']; ?>
	<img src="http://maps.google.com/maps/api/staticmap?&size=150x150&markers=color:red|<?=$marker?>&zoom=15&sensor=false">
	<input type="checkbox" name="id[]" value="<?=$row['id']?>"> | <?=$row['bssid']?><br />
<?}?>
	<input type="hidden" name="accion" value="borrar">
	<input type="submit" value="Borar Seleccionados"><br />
</form>
<?}else{?>
	No hay Wifis marcadas como erroneas<br />
<?}?>
<a href="javascript:window.location='./'">Regresar</a>