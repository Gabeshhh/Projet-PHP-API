<?php

$fichier = __DIR__ . '/data/favorites.json';

// Lire les favories depuis le fichier json 
function lireFavoris($fichier){
    if (!file_exists($fichier)){
        return []; // Si le fichier est différents de [] donc d'une liste vide il renvoie le fichier
    }
    $contenu = file_get_contents($fichier);
    return json_decode($contenu, true) ?? [];
}

// Sauvegarde 
function sauvegarde($fichier, $favoris){
    file_put_contents($fichier, json_encode($favoris, JSON_PRETTY_PRINT));
}

// Méthode GET 
if ($methode === "POST"){
    $body = file_get_contents("php://input");
    $film = json_decode($body, true);
}

// Méthode POST - Ajouté un film
elseif ($method === 'POST') {
    $body = file_get_contents('php://input');
    $film = json_decode($body, true);

    if (!$film || !isset($film['id']) || !isset($film['title'])) {
        http_response_code(400);
        echo json_encode(["error" => "Il faut envoyer un JSON avec 'id' et 'title'"]);
        exit;
    }
    $favoris = lireFavoris($fichier);

    foreach ($favoris as $fav) {
        if ($fav['id'] === $film['id']) {
            http_response_code(409);
            echo json_encode(["error" => "Ce film est déjà dans tes favoris !"]);
            exit;
        }
    }

    $favoris[] = [
        "id"          => $film['id'],
        "title"       => $film['title'],
        "poster_path" => $film['poster_path'] ?? null,
    ];

    sauvegarderFavoris($fichier, $favoris);

    http_response_code(201);
    echo json_encode(["message" => "Film ajouté aux favoris !"]);
}

// Méthode DELETE - supprimer un film 
elseif ($method === 'DELETE') {
    $id = $_GET['id'] ?? null;

    if (!$id) {
        http_response_code(400);
        echo json_encode(["error" => "Il faut passer un 'id' en paramètre : /favorites?id=123"]);
        exit;
    }

    $favoris = lireFavoris($fichier);

    $nouveauxFavoris = [];
    $trouvé = false;

    foreach ($favoris as $fav) {
        if ($fav['id'] == $id) {
            $trouvé = true; 
        } else {
            $nouveauxFavoris[] = $fav;
        }
    }

    if (!$trouvé) {
        http_response_code(404);
        echo json_encode(["error" => "Film introuvable dans les favoris"]);
        exit;
    }

    sauvegarderFavoris($fichier, $nouveauxFavoris);
    echo json_encode(["message" => "Film supprimé des favoris !"]);
}

// Si erreur 
else {
    http_response_code(405);
    echo json_encode(["error" => "Erreur"]);
}
