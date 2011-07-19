<?php
session_start();
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);

$twitterObj->setToken($_GET['oauth_token']);
$token = $twitterObj->getAccessToken();
$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);

// save to cookies
setcookie('oauth_token', $token->oauth_token);
setcookie('oauth_token_secret', $token->oauth_token_secret);

//save to session
$_SESSION['twitter_oauth']=true;
$twitterInfo = $twitterObj->get_accountVerify_credentials();
$_SESSION['id']=$twitterInfo->id;
// echo $token->oauth_token;
// echo " <-> ";
// echo $token->oauth_token_secret;
echo "<script>window.location = '../login.php';</script>";
?>