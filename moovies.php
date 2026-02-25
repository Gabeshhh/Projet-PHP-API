<?php

$type = $_GET['type'] ?? 'popular';

$typesAutorisés = ['popular', 'top_rated', 'upcoming', 'now_playing'];

if (!in_array($type, $typesAutorisés)) {
    http_response_code(400);
    echo json_encode(["error" => "Type invalide. Utilise : popular, top_rated, upcoming ou now_playing"]);
    exit;
}