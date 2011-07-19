<?php
include "dbconnect.php";
$query = "SELECT * FROM spots";
$wifis = mysql_query($query) or die();
echo "<table style=\"width:100%px;\"><tr><td>";
	while($row = mysql_fetch_array($wifis)){
		if($row['bandera']){
			$marker = $row['latitud'].", ".$row['longitud']; 
			echo "<div style=\"float:left; width:400px;\">";
			?>
			<table><tr><td valign="top">
			<img src="http://maps.google.com/maps/api/staticmap?&size=150x150&markers=color:red|<?=$marker?>&zoom=15&sensor=false">
			</td><td valign="top">
			Nombre: <?=$row['bssid']?><br />
			Tipo: <?=$row['tipo']?><br />
			Clave: <?=$row['llave']?><br />
			Lat: <?=$row['latitud']?><br />
			Lon: <?=$row['longitud']?><br />
			</td></tr></table>
			<?php echo "</div>";
		}
	}
echo "</td></tr></table>";
?>