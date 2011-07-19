<?session_start();?>
<script language="JavaScript">
<!--
function refreshParent() {
	window.opener.location.reload();
	if (window.opener.progressWindow){
		window.opener.progressWindow.close()
	}
	window.close();
}
//-->
</script>
<?if(isset($_POST['pass'])){
	$elpass = '6ca1b1e31d900b5222287fe7838b73eb';
	if($_POST['pass']==$elpass){
		$_SESSION['elpoderoso'] = true;
		echo "<script>javascript:refreshParent();</script>";
	}
}elseif(isset($_SESSION['twitter_oauth'])){
	$_SESSION['elpoderosito'] = true;
	if(isset($_SESSION['id'])){
		$admin1 = "c4c3085909ec2adf6cd4c3eeda83be7d"; //los admins :D
		$admin2 = "f82d3589f079d6c0b8ead11ddda7b8ad";
		if((md5($_SESSION['id']) == $admin1) || md5($_SESSION['id']) == $admin2){ //TODO... mejorar esta parte
			$_SESSION['elpoderosito'] = false;
			$_SESSION['elpoderoso'] = true;
		}
		echo "<script>javascript:refreshParent();</script>";
	}
}else{
?>
<form action="" method="POST"><input type="password" name="pass" placeholder="P455W0RD"></form>
<?}?>