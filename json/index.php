<?php
header('Content-type: application/json');
include "dbconnect.php";
$query = "SELECT * FROM spots";
//$datos = Array(0 => 'id', 1 => 'latitud', 2 => 'longitud', 3 => 'bssid', 4 =>'tipo', 5=> 'llave', 6=> 'bandera');
$spots = Array();
$wifis = mysql_query($query) or die();
$contador = 0;
while ($row = mysql_fetch_array($wifis)){
	$spots[] = Array('value'=>$row['llave'], 'label'=>$row['bssid'], 'tipo'=>$row['tipo'], 'bandera'=>$row['bandera']);
	$contador ++;
}
//echo json_encode($spots);
echo isset($_GET['callback']) ? "{$_GET['callback']}($spots)" : $spots;
?>