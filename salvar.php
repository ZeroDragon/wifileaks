<?
include 'oauth/EpiCurl.php';
include 'oauth/EpiOAuth.php';
include 'oauth/EpiTwitter.php';
include 'oauth/secret.php';
include "dbconnect.php";
function twitterrrr($Otoken,$Otoken_secret,$nuevo){
	$text = "Nueva Wifi [".$nuevo['BSSID']."] en Wifileaks";
	$twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $Otoken, $Otoken_secret);
	$twitterObj->post_statusesUpdate(array(
					'status'=>$text,
					'lat'=>$nuevo['latitud'],
					'long'=>$nuevo['longitud'],
					'display_coordinates'=>true,
				));
}
function post2twitter($nuevo){
	twitterrrr("244274213-o7wBmE6Jriz06BDSbSn3JDeJJ4F9IucPeI59zpTK","vnJL9KRlKBkl7AFMY27nVZadGpk3eYCxUEoP6M4hXQ",$nuevo);
}
$spot = Array("latitud" => "", "longitud" => "","BSSID" => "", "tipo" => "", "key" => "", "flag" => "");
function modificar($nuevosvalores){
	$query = "UPDATE spots SET bssid = '".(string)$nuevosvalores['BSSID']."', tipo = '".$nuevosvalores['tipo']."', llave = '".$nuevosvalores['key']."', bandera = '".$nuevosvalores['flag']."' WHERE id = '".$nuevosvalores['id']."'";
	mysql_query($query) or die(mysql_error());
}

function agrega($nuevo){
	$query = "INSERT INTO spots (latitud, longitud, bssid, tipo, llave, bandera) VALUES('".$nuevo['latitud']."','".$nuevo['longitud']."','".$nuevo['BSSID']."','".$nuevo['tipo']."','".$nuevo['key']."','".$nuevo['flag']."')";
	mysql_query($query) or die(mysql_error());
	post2twitter($nuevo);
}
if($_POST['accion']=='editar'){
	if(isset($_POST['flag'])){
		$flag = $_POST['flag'];
	}else{
		$flag = "false";
	}
	$wifi = Array(
		'id' => $_POST['wifiid'],
		'BSSID' => $_POST['selected'],
		'tipo' => $_POST['tipo'],
		'key' => $_POST['clave'],
		'flag' => $flag
	);
	modificar($wifi);
}
if($_POST['accion']=='enviar'){
	$wifi = Array(
		'latitud' => $_POST['lalat'],
		'longitud' => $_POST['lalon'],
		'BSSID' => $_POST['BSSID'],
		'tipo' => $_POST['tipo'],
		'key' => $_POST['clave'],
		'flag' => 'false'
	);
	agrega($wifi);
}
if($_POST['accion']=='borrar'){
	foreach($_POST['id'] as $id){
		mysql_query("DELETE FROM spots WHERE id = '{$id}'") or die(mysql_error());
	}
}
?>
<script>window.location = "./";</script>



























