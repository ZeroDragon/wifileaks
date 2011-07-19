<?
$local = array('localhost','127.0.0.1');
if(!in_array($_SERVER['HTTP_HOST'],$local)){
	//configuracion solo para cuando montamos wifileaks en el servidor :D
	mysql_connect(/*add here your database*/, /*add here your db username*/, /*add here your db pass*/);	
}else{
	mysql_connect("localhost","root","");
}
mysql_select_db("434152_zero");
?>
