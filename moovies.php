<?php

$type = $_GET['type'] ?? 'popular';

$typesAutorisés = ['popular', 'top_rated', 'upcoming', 'now_playing'];

if (!in_array($type, $typesAutorisés)) {
    http_response_code(400);
    echo json_encode(["error" => "Type invalide. Utilise : popular, top_rated, upcoming ou now_playing"]);
    exit;
}

$urlTMDB = TMDB_URL . "/movie/" . $type . "?api_key=" . TMDB_API_KEY . "&language=fr-FR";

$ch = curl_init($urlTMDB);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$reponse = curl_exec($ch);
$erreur  = curl_error($ch);
curl_close($ch);

if ($reponse === false) {
    http_response_code(500);
    echo json_encode(["error" => "Impossible de contacter TMDB : " . $erreur]);
    exit;
}

echo $reponse;