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