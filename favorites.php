<?php

$fichier = __DIR__ . '/data/favorites.json';

// Lire les favories depuis le fichier json 
function lireFavoris($fichier){
    if (!file_exists($fichier)){
        return []; // Si le fichier est différents de [] donc d'une liste vide il renvoie le fichier
    }
}

$url = $_SERVER['REQUEST_URL'];
$methode = $_SERVER['REQUEST_METHOD'];

// Message de bienvenue dans le ../
if ($methode === 'GET' && $url === '/'){
    echo json_encode(["message " => "Bienvenue sur l'API"]);
}