<?php

session_start();

$clientId = $_SESSION['twitch_client_id'];
$clientSecret = 'CLIENTSECRET';
$redirectUri = $_SESSION['twitch_redirect_uri'];
$scope = $_SESSION['twitch_scope'];
$state = $_SESSION['twitch_state'];

// more code to help debug
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// try and check for access token
if (empty($_SESSION['access_token']) || empty($_SESSION['twitch_username'])) {
    echo "token or username missing";
    exit;
}

$code = $_GET['code'];
$ch = curl_init();

$url = 'https://id.twitch.tv/oauth2/token';
$data = [
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'code' => $code,
    'grant_type' => 'authorization_code',
    'redirect_uri' => $redirectUri
];

$options = [
    'http' => [
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    ]
];

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

// check for any curl errors
if (curl_errno($ch)) {
    echo "curl errors: " . curl_error($ch);
    exit;
}

curl_close($ch);

$data = json_decode($response, true);

if (isset($data['access_token'])) {
    $accessToken = $data['access_token'];

    $_SESSION['access_token'] = $accessToken;

    header("Location: form.php");
    exit;
} else {
    echo "failed getting token";
    exit;
}

?>
