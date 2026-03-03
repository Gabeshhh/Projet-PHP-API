<?php

require_once 'config.php';

header('Content-Type: application/json');

$url = $_SERVER['REQUEST_URI'];

$method = $_SERVER['REQUEST_METHOD'];


if ($method === 'GET' && $url === '/') {
    echo json_encode(["message" => "Bienvenue sur l'API Films !"]);

} elseif ($method === 'GET' && str_starts_with($url, '/moovies')) {
    require_once 'movies.php';

} elseif (str_starts_with($url, '/favorites')) {
    require_once 'favorites.php';

} else {
    http_response_code(404);
    echo json_encode(["error" => "Route introuvable"]);
}