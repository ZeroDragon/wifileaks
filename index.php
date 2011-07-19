<?php session_start();
$access = 0;
if(isset($_SESSION['elpoderoso'])){
	if($_SESSION['elpoderoso']==true){
		$access = 2;
	}
}elseif(isset($_SESSION['elpoderosito'])){
	if($_SESSION['elpoderosito']==true){
		$access = 1;
	}
}
?>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<style type="text/css">
  html { height: 100% }
  body { height: 100%; margin: 0px; padding: 0px }
  #map_canvas { height: 100% }
  .banner{
  	height:48px;
  	width:20%;
  	background-color:RGBA(119,136,153,0.8);
  	color:#fff;
  	position:absolute;
  	top:0;
  	left:30%;
  	font-size:12px;
  }
  .nomevez{
  	display: none;
  	position: absolute;
  }
  .acepto, .noacepto{
		width: 90%;
		margin: 10px;
		text-align: center;
		padding: 4px;
		color: #FFF;
  	font-weight: bolder;
  	cursor: pointer;
  }
  .acepto{
  	border: 1px solid #070;
  	background-color: #090;
  }
  .noacepto{
  	border: 1px solid #700;
  	background-color: #900;
  }
	.letrachiquita{
		font-size: 8px;
	}
</style>
<script type="text/javascript"
    src="http://maps.google.com/maps/api/js?v=3.3&sensor=true">
</script>
<script type="text/javascript" src="js/markerclusterer.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function drawCircle(point, radius) { 
	var d2r = Math.PI / 180;   // degrees to radians 
	var r2d = 180 / Math.PI;   // radians to degrees 
	var earthsradius = 6371; // 3963 is the radius of the earth in miles
	var points = 50; 
	// find the raidus in lat/lon 
	var rlat = (radius / earthsradius) * r2d; 
	var rlng = rlat / Math.cos(point.lat() * d2r); 
	var extp = new Array(); 
	for (var i=0; i < points+1; i++) // one extra here makes sure we connect the 
	{ 
		var theta = Math.PI * (i / (points/2)); 
		ey = point.lng() + (rlng * Math.cos(theta)); // center a + radius x * cos(theta) 
		ex = point.lat() + (rlat * Math.sin(theta)); // center b + radius y * sin(theta) 
		extp.push(new google.maps.LatLng(ex, ey)); 
	} 
	return extp;
}
function dona(latte, moka, out, inn, color){
	var donut = new google.maps.Polygon({
	paths: [drawCircle(new google.maps.LatLng(latte,moka), out),
			drawCircle(new google.maps.LatLng(latte,moka), inn)],
	strokeColor: color,
	strokeOpacity: 0.0,
	strokeWeight: 1,
	fillColor: color,
	fillOpacity: 0.3,
	clickable: false,
	});
	donut.setMap(map);
}
function alcance(latte,moka){
	var circulo = new google.maps.Circle({ //centro azulito
		center: new google.maps.LatLng(latte, moka), 
		map: map, 
		radius: 10,
		strokeColor: "#00A",
		strokeOpacity: 0.0,
		strokeWeight: 1,
		fillColor: "#00A",
		fillOpacity: 0.3
	});
	dona(latte, moka, 0.06, 0.04, "#F00"); //dona roja
	dona(latte, moka, 0.04, 0.025, "#FFE600"); //dona amarilla
	dona(latte, moka, 0.025, 0.01, "#0A0"); //dona verde
}
var map;
function initialize(latte,moka) {
	var latlng = new google.maps.LatLng(latte, moka);
	var myOptions = {
		zoom: 13,
		center: latlng,
		scaleControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	cosas();
	<?
	if($access>0){
	echo '
	google.maps.event.addListener(map, "rightclick", function(event) {
	spot = new Array(
		event.latLng.lat().toString(),
		event.latLng.lng().toString(),
		"Nueva Wi-Fi",
		"Tipo",
		"mensaje",
		"New",
		false
	);
	maker(spot, false);
	var markerCluster = new MarkerClusterer(map, marcadores);
	$("#editor").hide();
});
	';
	}?>
	alcance(latte,moka);
}

function wifi_bandera(flag){
	if (flag){
		return 'media/img/wifi_false.png';
	}else{
		return 'media/img/wifi_true.png';
	}
}
var marcadores = [];
function maker(spot, permanent){
	latlng = new google.maps.LatLng(spot[0], spot[1]);
	var image = new google.maps.MarkerImage(
	wifi_bandera(spot[6]),
	new google.maps.Size(40,35)
	);

	var shadow = new google.maps.MarkerImage(
	'media/img/shadow.png',
	new google.maps.Size(62,35),
	new google.maps.Point(0,0),
	new google.maps.Point(20,35)
	);

	var shape = {
	coord: [27,0,30,1,32,2,34,3,35,4,36,5,38,6,39,7,39,8,39,9,39,10,38,11,37,12,33,13,34,14,34,15,33,16,32,17,31,18,27,19,28,20,28,21,27,22,26,23,22,25,23,26,24,27,24,28,24,29,24,30,24,31,24,32,23,33,22,34,17,34,16,33,15,32,15,31,14,30,14,29,15,28,15,27,16,26,17,25,13,23,12,22,11,21,11,20,12,19,8,18,7,17,6,16,5,15,5,14,6,13,2,12,1,11,0,10,0,9,0,8,0,7,1,6,3,5,4,4,5,3,7,2,9,1,12,0,27,0],
	type: 'poly'
	};
		
	var marker = new google.maps.Marker({
	position: latlng,
//	map: map,
	animation: google.maps.Animation.DROP,
	draggable: true,
	icon: image,
	shadow: shadow,
	shape: shape
	});

	if(permanent == true){
		marker.setDraggable(false);
	}
	marker.setTitle(name.toString());
	attachSecretMessage(marker, spot[2], spot[3], spot[4], permanent, spot[5], spot[6]);

	marcadores.push(marker);
}

function attachSecretMessage(marker, name, tipo, clave, permanent, id, flag) {
	setealos(marker);
	if(permanent==true){
		var infowindow = new google.maps.InfoWindow({
			content: "<h2>"+name.toString()+"</h2>"+marker.getPosition().toString()+"<hr>"+tipo+"<br>"+clave,
			size: new google.maps.Size(50,50)
		});
	}else{
		contenido = '<div id="formulario"><form id="agrega" method="POST" action="salvar.php"><input type="text" id="BSSID" name="BSSID" placeholder="Nueva Wifi" /><br />	Lat: <input type="text" name="lalat" id="lalat" placeholder="No hay Coordenadas!" value="'+marker.getPosition().lat().toString()+'"/> | Lon:<input placeholder="No hay Coordenadas!" type="text" name="lalon" id="lalon" value="'+marker.getPosition().lng().toString()+'"/><br />	<select id="tipo" name="tipo"><option disabled>Tipo</option><option value="WEP">WEP</option><option value="WPA">WPA</option><option value="WPA">Sin Encripcion</option></select> | 	<input type="text" placeholder="Llave de acceso" id="clave" name="clave" /><br /><input type="hidden" name="accion" value="enviar"> <input type="submit" value="Enviar" id="Enviar">	</form></div>';
		var infowindow = new google.maps.InfoWindow({
			content: contenido,
			size: new google.maps.Size(50,50)
		});
	}
	google.maps.event.addListener(marker, 'drag', function() {
		setealos(marker);
	});
	google.maps.event.addListener(marker, 'dragend', function() {
		setealos(marker);
	});
	google.maps.event.addListener(marker, 'click', function() {
		if(permanent == true){
			$("#editor").show();
			$("#wifiid").val(id);
			$("#selected").val(name);
			$("#tipo").val(tipo);
			$("#clave").val(clave);
			$("#flag").attr('checked',flag);
		}
		map.panTo(marker.getPosition());
		infowindow.open(map,marker);
	});
	if(permanent == false){
		google.maps.event.addListener(marker, 'rightclick', function() {
			marker.setMap(null);
			infowindow.close();
		});
	}
}
function setealos(marker){
		$("#lalat").val(marker.getPosition().lat().toString());
		$("#lalon").val(marker.getPosition().lng().toString());	
}
function cosas(){
<?php
include "dbconnect.php";
$result = mysql_query("SELECT * FROM spots") or die(mysql_error());
while($row = mysql_fetch_array($result)){?>
	spot = new Array(
		"<?=$row['latitud']?>", 
		"<?=$row['longitud']?>", 
		"<?=$row['bssid']?>", 
		"<?=$row['tipo']?>", 
		"<?=$row['llave']?>",
		"<?=$row['id']?>",
		<?=$row['bandera']?>
	);
	maker(spot, true);
<?}?>
    var markerCluster = new MarkerClusterer(map, marcadores)
}

//localizacion
function success(position) {  
  initialize(position.coords.latitude, position.coords.longitude);
}

function error(msg) {
	initialize(21.156915756607123, -86.8252695020523);
}

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(success, error);
} else {
  error('not supported');
}

</script>
</head>
<body>
	<div id="map_canvas" style="width:80%; height:100%; float:left;"></div>
	<div style="float:right; width:20%;">
		Selecciona un wifi existente para ver los detalles
		<?if($access==2){?>
		<form action="salvar.php" method="POST" id="editor" style="display:none"><br />
		<input type="hidden" name="wifiid" id="wifiid" value="" /><br />
		<input type="text" name="selected" id="selected" placeholder="Nombre" value=""/><br />
		<input type="text" name="tipo" id="tipo" placeholder="Tipo" value=""/><br />
		<input type="text" name="clave" id="clave" placeholder="clave" value=""/><br />
		<input type="checkbox" name="flag" id="flag" value="true" />Ya no existe o esta mal colocado<br />
		<input type="hidden" name="accion" value="editar">
		<input type="submit" value="Editar" id="editar" />
		</form><br />
		<?}else{?>
		<form action="salvar.php" method="POST" id="editor" style="display:none">
		<input type="hidden" name="wifiid" id="wifiid" value="" />
		<input type="hidden" name="selected" id="selected" placeholder="Nombre" value=""/>
		<input type="hidden" name="tipo" id="tipo" placeholder="Tipo" value=""/>
		<input type="hidden"  name="clave" id="clave" placeholder="clave" value=""/><br />
		<input type="checkbox" name="flag" id="flag" value="true" />Ya no existe o esta mal colocado<br />
		<input type="hidden" name="accion" value="editar">
		<input type="submit" value="Editar" id="editar" />
		</form><br />
		<?}?>
	</div>
	<div style="float:right; width:20%;">
	<?include "instrucciones.php"?>
	</div>
	<div id="formulario" style="display:none"><form id="agrega" method="POST" action="salvar.php">
		<input type="text" id="BSSID" name="BSSID" placeholder="Nueva Wifi" /><br />
		Lat: <input type="text" name="lalat" id="lalat" placeholder="No hay Coordenadas!" value=""/> | Lon:<input placeholder="No hay Coordenadas!" type="text" name="lalon" id="lalon" value=""/><br />
		<select id="tipo" name="tipo"><option disabled>Tipo</option><option value="WEP">WEP</option><option value="WPA">WPA</option><option value="WPA">Sin Encripcion</option></select> | 
		<input type="text" placeholder="Llave de acceso" id="clave" name="clave" /><br />
		<input type="hidden" name="accion" value="enviar">
		<input type="submit" value="Enviar" id="Enviar">
	</form></div>
	<div class="banner" id="banner">
		<img src="http://a3.twimg.com/profile_images/1228510724/wifi_normal.png" style="float:left; margin-right:10px;">
	Actualmente buscando patrocinadores<br />
	Contacto a Twitter: <a href="http://www.twitter.com/wifileaks" target="_blank">@wifileaks</a>
	</div>
</body>
</html>



















