<?php
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
?>
<center>
<img src="../media/img/wifi.png" width="200" height="200"/><br />
<a href="<?=$twitterObj->getAuthenticateUrl()?>"><img src="../media/img/twitter_light.png" /></a>
</center>