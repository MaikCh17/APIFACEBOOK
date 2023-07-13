<?php

// Configuración de la aplicación
$app_id = '1111632506503482';
$app_secret = 'e61510363d87072f2e749488779d2419';
$redirect_uri = 'http://oddsite-bucket.s3-website-us-west-2.amazonaws.com/'; // URL a la que se redirigirá después de la autenticación

// URL de autorización de Facebook
$auth_url = "https://www.facebook.com/v17.0/dialog/oauth?client_id={$app_id}&redirect_uri={$redirect_uri}&scope=ads_read"; // Reemplaza vX.X con la versión de la API que deseas utilizar y agrega los permisos necesarios

// Si no se ha iniciado sesión, redirigir al flujo de autenticación de Facebook
if (!isset($_GET['code'])) {
    header("Location: {$auth_url}");
    exit;
}

// Si se ha obtenido el código de autorización, canjearlo por un token de acceso
$code = $_GET['code'];

$token_url = "https://graph.facebook.com/v17.0/oauth/access_token?client_id={$app_id}&redirect_uri={$redirect_uri}&client_secret={$app_secret}&code={$code}"; // Reemplaza vX.X con la versión de la API que deseas utilizar


$response = file_get_contents($token_url);
$params = json_decode($response, true);

if (isset($params['access_token'])) {
    $access_token = $params['access_token'];
    
    // Utiliza el token de acceso para realizar las solicitudes a la API de Facebook
    // Aquí puedes hacer llamadas a la API para obtener los resultados de las campañas publicitarias
    // Ejemplo:
    $api_url = "https://graph.facebook.com/v17.0/ads?access_token={$access_token}"; // Reemplaza vX.X con la versión de la API que deseas utilizar
    $api_response = file_get_contents($api_url);
    
    // Procesa la respuesta de la API según tus necesidades
    var_dump($api_response);
} else {
    // No se pudo obtener el token de acceso
    echo 'Error al obtener el token de acceso';
}

?>