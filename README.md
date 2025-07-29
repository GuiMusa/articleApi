# API Articles - Documentation

## Description
API REST développée avec Laravel pour la gestion d'articles. Cette API permet de créer, lire, modifier et supprimer des articles.

## Prérequis
- PHP 8.2+
- Composer
- Laravel 12.0
- SQLite (par défaut)

## Installation

1. Cloner le projet
```bash
git clone <url-du-repo>
cd articleApi
```

2. Installer les dépendances
```bash
composer install
npm install
```

3. Configuration de l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

4. Migration de la base de données
```bash
php artisan migrate
```

5. Lancer le serveur
```bash
php artisan serve
```

L'API sera accessible à l'adresse : `http://localhost:8000`

## Structure de données

### Modèle Article
```json
{
  "id": 1,
  "title": "Titre de l'article",
  "content": "Contenu de l'article...",
  "publish": true,
  "created_at": "2025-07-29T15:30:00.000000Z",
  "updated_at": "2025-07-29T15:30:00.000000Z"
}
```

## Endpoints de l'API

### Base URL
```
http://localhost:8000/api
```

### 1. Lister tous les articles
**GET** `/article`

**Réponse :**
```json
{
  "success": true,
  "article": [
    {
      "id": 1,
      "title": "Premier article",
      "content": "Contenu du premier article",
      "publish": true,
      "created_at": "2025-07-29T15:30:00.000000Z",
      "updated_at": "2025-07-29T15:30:00.000000Z"
    }
  ]
}
```

### 2. Afficher un article spécifique
**GET** `/article/{id}`

**Réponse :**
```json
{
  "success": true,
  "article": {
    "id": 1,
    "title": "Premier article",
    "content": "Contenu du premier article",
    "publish": true,
    "created_at": "2025-07-29T15:30:00.000000Z",
    "updated_at": "2025-07-29T15:30:00.000000Z"
  }
}
```

### 3. Créer un nouvel article
**POST** `/article`

**Corps de la requête :**
```json
{
  "title": "Nouveau titre",
  "content": "Contenu de l'article",
  "published": true
}
```

**Réponse :**
```json
{
  "success": true,
  "message": "Article créé avec succès",
  "article": {
    "id": 2,
    "title": "Nouveau titre",
    "content": "Contenu de l'article",
    "publish": true,
    "created_at": "2025-07-29T16:00:00.000000Z",
    "updated_at": "2025-07-29T16:00:00.000000Z"
  }
}
```

### 4. Modifier un article
**PUT** `/article/{id}`

**Corps de la requête :**
```json
{
  "title": "Titre modifié",
  "content": "Contenu modifié",
  "published": false
}
```

**Réponse :**
```json
{
  "success": true,
  "message": "Article modifier avec succès",
  "article": {
    "id": 1,
    "title": "Titre modifié",
    "content": "Contenu modifié",
    "publish": false,
    "created_at": "2025-07-29T15:30:00.000000Z",
    "updated_at": "2025-07-29T16:15:00.000000Z"
  }
}
```

### 5. Supprimer un article
**DELETE** `/article/{id}`

**Réponse :**
```json
{
  "success": true,
  "message": "Article supprimer"
}
```

## Exemples d'utilisation en JavaScript

### Configuration de base
```javascript
const API_BASE_URL = 'http://localhost:8000/api';

// Configuration par défaut pour fetch
const defaultHeaders = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
};
```

### 1. Récupérer tous les articles
```javascript
async function getAllArticles() {
  try {
    const response = await fetch(`${API_BASE_URL}/article`, {
      method: 'GET',
      headers: defaultHeaders
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Articles récupérés:', data.article);
      return data.article;
    } else {
      throw new Error('Erreur lors de la récupération des articles');
    }
  } catch (error) {
    console.error('Erreur:', error);
  }
}

// Utilisation
getAllArticles().then(articles => {
  articles.forEach(article => {
    console.log(`${article.title}: ${article.content}`);
  });
});
```

### 2. Récupérer un article spécifique
```javascript
async function getArticleById(id) {
  try {
    const response = await fetch(`${API_BASE_URL}/article/${id}`, {
      method: 'GET',
      headers: defaultHeaders
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Article trouvé:', data.article);
      return data.article;
    } else {
      throw new Error('Article non trouvé');
    }
  } catch (error) {
    console.error('Erreur:', error);
  }
}

// Utilisation
getArticleById(1).then(article => {
  console.log(`Titre: ${article.title}`);
  console.log(`Contenu: ${article.content}`);
  console.log(`Publié: ${article.publish ? 'Oui' : 'Non'}`);
});
```

### 3. Créer un nouvel article
```javascript
async function createArticle(articleData) {
  try {
    const response = await fetch(`${API_BASE_URL}/article`, {
      method: 'POST',
      headers: defaultHeaders,
      body: JSON.stringify(articleData)
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Article créé:', data.article);
      return data.article;
    } else {
      throw new Error('Erreur lors de la création de l\'article');
    }
  } catch (error) {
    console.error('Erreur:', error);
  }
}

// Utilisation
const nouvelArticle = {
  title: "Mon Premier Article via API",
  content: "Ceci est le contenu de mon premier article créé via l'API JavaScript.",
  published: true
};

createArticle(nouvelArticle).then(article => {
  console.log(`Article créé avec l'ID: ${article.id}`);
});
```

### 4. Modifier un article existant
```javascript
async function updateArticle(id, articleData) {
  try {
    const response = await fetch(`${API_BASE_URL}/article/${id}`, {
      method: 'PUT',
      headers: defaultHeaders,
      body: JSON.stringify(articleData)
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Article modifié:', data.article);
      return data.article;
    } else {
      throw new Error('Erreur lors de la modification de l\'article');
    }
  } catch (error) {
    console.error('Erreur:', error);
  }
}

// Utilisation
const articleModifie = {
  title: "Titre Modifié",
  content: "Contenu mis à jour avec de nouvelles informations.",
  published: false
};

updateArticle(1, articleModifie).then(article => {
  console.log(`Article ${article.id} modifié avec succès`);
});
```

### 5. Supprimer un article
```javascript
async function deleteArticle(id) {
  try {
    const response = await fetch(`${API_BASE_URL}/article/${id}`, {
      method: 'DELETE',
      headers: defaultHeaders
    });
    
    const data = await response.json();
    
    if (data.success) {
      console.log('Article supprimé:', data.message);
      return true;
    } else {
      throw new Error('Erreur lors de la suppression de l\'article');
    }
  } catch (error) {
    console.error('Erreur:', error);
    return false;
  }
}

// Utilisation
deleteArticle(1).then(success => {
  if (success) {
    console.log('Article supprimé avec succès');
  }
});
```

### Exemple complet avec gestion d'erreurs
```javascript
class ArticleAPI {
  constructor(baseUrl = 'http://localhost:8000/api') {
    this.baseUrl = baseUrl;
    this.headers = {
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    };
  }

  async request(endpoint, options = {}) {
    try {
      const response = await fetch(`${this.baseUrl}${endpoint}`, {
        headers: this.headers,
        ...options
      });

      if (!response.ok) {
        throw new Error(`HTTP Error: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      console.error('API Request Error:', error);
      throw error;
    }
  }

  async getAll() {
    return this.request('/article');
  }

  async getById(id) {
    return this.request(`/article/${id}`);
  }

  async create(articleData) {
    return this.request('/article', {
      method: 'POST',
      body: JSON.stringify(articleData)
    });
  }

  async update(id, articleData) {
    return this.request(`/article/${id}`, {
      method: 'PUT',
      body: JSON.stringify(articleData)
    });
  }

  async delete(id) {
    return this.request(`/article/${id}`, {
      method: 'DELETE'
    });
  }
}

// Utilisation de la classe
const api = new ArticleAPI();

// Exemple d'utilisation complète
async function exempleComplet() {
  try {
    // Créer un article
    const nouvelArticle = await api.create({
      title: "Article via Classe API",
      content: "Contenu de test",
      published: true
    });
    console.log('Article créé:', nouvelArticle);

    // Récupérer tous les articles
    const articles = await api.getAll();
    console.log('Tous les articles:', articles);

    // Modifier l'article
    const articleModifie = await api.update(nouvelArticle.article.id, {
      title: "Article Modifié",
      content: "Contenu modifié",
      published: false
    });
    console.log('Article modifié:', articleModifie);

    // Supprimer l'article
    await api.delete(nouvelArticle.article.id);
    console.log('Article supprimé');

  } catch (error) {
    console.error('Erreur dans l\'exemple:', error);
  }
}

// Lancer l'exemple
exempleComplet();
```

## Validation des données

### Règles de validation
- **title** : Obligatoire, chaîne de caractères, maximum 255 caractères
- **content** : Obligatoire
- **published** : Booléen (optionnel, défaut: false)

### Exemple de gestion des erreurs de validation
```javascript
async function createArticleWithValidation(articleData) {
  try {
    const response = await fetch(`${API_BASE_URL}/article`, {
      method: 'POST',
      headers: defaultHeaders,
      body: JSON.stringify(articleData)
    });
    
    const data = await response.json();
    
    if (response.status === 422) {
      // Erreurs de validation
      console.error('Erreurs de validation:', data.errors);
      return { success: false, errors: data.errors };
    }
    
    if (data.success) {
      return { success: true, article: data.article };
    }
    
  } catch (error) {
    console.error('Erreur réseau:', error);
    return { success: false, error: error.message };
  }
}
```

## Codes de statut HTTP

- **200** : Succès (GET, PUT, DELETE)
- **201** : Créé avec succès (POST)
- **404** : Ressource non trouvée
- **422** : Erreur de validation
- **500** : Erreur serveur

## Notes importantes

⚠️ **Attention** : Il y a une incohérence dans le code entre le modèle qui utilise `publish` et la validation qui attend `published`. Assurez-vous d'utiliser `published` dans vos requêtes.

## Tests

Pour tester l'API, vous pouvez utiliser les exemples JavaScript ci-dessus ou des outils comme :
- Postman
- Insomnia  
- cURL
- Thunder Client (VS Code)

## Contribution

1. Fork le projet
2. Créer une branche feature
3. Commiter vos changements
4. Pousser vers la branche
5. Ouvrir une Pull Request