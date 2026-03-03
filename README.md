# 🎬 API Films — TP PHP

Projet réalisé par :
- **PERRIN Noa**
- **LETESSIER Quentin**
- **LAUGIER Gabriel**

---

## Présentation

API RESTful en PHP qui récupère des films depuis l'API TMDB et permet de gérer une liste de favoris.

---

## Installation

**1. Clone le projet**
```bash
git clone <url-du-repo>
cd Projet-PHP-API
```

**2. Ajoute ta clé API TMDB**

Crée un fichier `.env` à la racine :
```
TMDB_API_KEY=ta_clé_ici
TMDB_BASE_URL=https://api.themoviedb.org/3
```
> Clé gratuite sur : https://www.themoviedb.org/settings/api

**3. Lance le serveur**
```bash
php -S localhost:8000
```

---

## Routes

| Méthode | Route | Description |
|--------|-------|-------------|
| GET | `/movies?type=popular` | Films populaires |
| GET | `/movies?type=top_rated` | Films les mieux notés |
| GET | `/movies?type=upcoming` | Prochaines sorties |
| GET | `/movies?type=now_playing` | Films en ce moment |
| GET | `/favorites` | Voir mes favoris |
| POST | `/favorites` | Ajouter un favori |
| DELETE | `/favorites?id=123` | Supprimer un favori |

---

## Exemples

```bash
# Films populaires
curl "http://localhost:8000/movies?type=popular"

# Ajouter un favori
curl -X POST "http://localhost:8000/favorites" \
  -H "Content-Type: application/json" \
  -d '{"id": 27205, "title": "Inception", "poster_path": "/oYuLEt3zVCKq57qu2F8dT7NIa6f.jpg"}'

# Voir les favoris
curl "http://localhost:8000/favorites"

# Supprimer un favori
curl -X DELETE "http://localhost:8000/favorites?id=27205"
```