<?php

$fichier = __DIR__ . '/data/favorites.json';

// Lire les favories depuis le fichier json 
function lireFavoris($fichier){
    if (!file_exists($fichier)){
        return []; // Si le fichier est différents de [] donc d'une liste vide il renvoie le fichier
    }
}

