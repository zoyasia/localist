# Localist

Carnet d'adresses en ligne où regrouper ses restaurants, cafés, bars et boutiques préférés, déjà testés ou à découvrir.

## Configuration

Créer un fichier `db.ini` avec ce modèle (disponible dans `db.ini.template`) :

```ini
DB_HOST="localhost"
DB_PORT=3306
DB_NAME="dbname"
DB_CHARSET="utf8mb4"
DB_USER="user"
DB_PASSWORD="password"
```

## Connexion
Lorsque je testais mon formulaire de connexion en entrant un mail et un mot de passe existant dans ma base de données, déjà affectés à un user, je ne parvenais jamais à me connecter. Mes var_dump du mot de passe en clair et du mot de passe haché correspondaient pourtant aux valeurs entrées dans ma db. J'ai d'abord pensé qu'il s'agissait d'un problème lors du hashage ou du dé-hashage du mot de passe, et j'ai enfin découvert que le problème venait de la configuration de ma base de données : ma colonne pwd était un varxhar(45) alors que le hachage est bien plus long (60 caractères). J'ai appris qu'il était recommandé d'opter pour un varchar(255) pour stocker un mdo haché en base de donnée.

## Configuration PHP
Dans mon formulaire pour ajouter une nouvelle adresse (méthode POST), je propose d'uploader une image.
J'ai configuré dans mon php.ini la taille maximale d'upload de fichier (3MO) et la taille maximale des données POST que mon serveur peut accepter (3MO).