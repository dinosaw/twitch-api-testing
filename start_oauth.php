<?php
session_start(); // Start or resume the session
// some error logging
ini_set('display_errors', 1);
error_reporting(E_ALL);

$clientId = 'CLIENTID';
$redirectUri = urlencode('http://localhost/dashboard/twitch/redirect_uri_handler.php');
$scope = urlencode('moderator:read:followers');
$state = 'STATE';

// Set these session variables before redirecting
$_SESSION['twitch_client_id'] = $clientId;
$_SESSION['twitch_redirect_uri'] = $redirectUri;
$_SESSION['twitch_scope'] = $scope;
$_SESSION['twitch_state'] = $state;

echo "<a href='https://id.twitch.tv/oauth2/authorize?response_type=code&client_id=$clientId&redirect_uri=$redirectUri&scope=$scope&state=$state'>login with twitch</a>";
?>
