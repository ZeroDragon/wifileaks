<?
$crealas = false;
// creacion de tabla
if ($crealas){
	$querys = "CREATE TABLE spots(
	id INT NOT NULL AUTO_INCREMENT, 
	PRIMARY KEY(id),
	latitud DECIMAL(16,14),
	longitud DECIMAL(16,14),
	bssid VARCHAR(30),
	tipo VARCHAR(30),
	llave VARCHAR(30),
	bandera VARCHAR(5))";
	mysql_query($querys) or die(mysql_error());
	
//importamos el XML
	$xml = simplexml_load_file("spots.xml");
	foreach($xml->spot as $spot){	
		mysql_query("INSERT INTO spots (latitud, longitud, bssid, tipo, llave, bandera) VALUES('{$spot->latitud}','{$spot->longitud}','{$spot->BSSID}','{$spot->tipo}','{$spot->key}','{$spot->flag}') ") or die(mysql_error());
	}
}
?>