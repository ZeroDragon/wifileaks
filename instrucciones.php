<div style="padding:4px;"><hr />
Informacion<br />
<img src="media/img/wifi_true.png"> | Wifi en el mapa para utilizarse
<img src="media/img/wifi_false.png"> | Wifi marcada como erronea
<hr />
Instrucciones<br />
<span style="font-size:12px;">
Video Tutorial (33 Segundos) [<a href="http://www.youtube.com/embed/JRuWPYmQdBs" target="_blank">link</a>]<br />
Inicia session para montar una nueva red.<br />
Click derecho en el mapa para poner una nueva red.<br />
Click en la nueva red para ver el formulario<br />
Arrastra la red para hacer ajustar Lat y Lon<br />
Ingresa los datos<br />
Click en Enviar<br />
</span>
<hr />
<?if($access==2){?>
<a href="showflag.php">Ver WIFIs Flageadas</a><br />
<?}
if($access >= 1){?>
<a href="https://chrome.google.com/webstore/detail/kdkifmmifkjdcngjhmjoncdhnepfdebe" target="_blank">Wifileaks Offline</a><img src="media/img/nuevo.gif"><br />
<a href="logout.php">Cerrar Sesion</a><br />
<?}elseif($access==0){?>
<script language="javascript">
function openPopWin(){
hijito = window.open('oauth/start.php','Wifileaks','status=0,toolbar=0,location=0,menubar=0,directories=0,resizable=0,scrollbars=0,height=470,width=800');
}
</script>
Debes aceptar los terminos y condiciones:
<div class="letrachiquita">
	1) Wifileaks no se hace responsable por el contenido subido por el usuario
	2) El usuario esta obligado a subir unicamente wifis de las que tenga permiso o sean de su propiedad
	3) Wifileaks se reserva el derecho de borrar cualquier contenido en cualquier momento
	4) El usuario debe saber utilizar wifileaks antes de poner una wifi en el mapa
	5) Wifis incompletas, seran borradas sin preguntar por correcciones
	
	Wfileaks es el dominio, pagina, servidor y equipo detras del proyecto
	El usuario es la persona que entra a utilizar wifileaks tanto para contribuir como para leer
	Wifi es un punto en el mapa de wifileaks donde debe tener especificado el nombre del router, su localizacion, el tipo de encripcion y su clave</div>
	<div class="acepto" onClick="javascript:openPopWin()">Acepto los terminos y condiciones</div>
	<div class="noacepto" onClick="javascript:lol();">No acepto y me voy</div>
	<script type="text/javascript" >
		function lol(){
			alert("lol");
			top.location="http://www.twitter.com/la_chingada";
		}
	</script>
<?}?>
</div>