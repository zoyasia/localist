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
Lorsque je testais mon formulaire de connexion en entrant un mail et un mot de passe existant dans ma base de données, déjà affectés à un user, je ne parvenais jamais à me connecter. Mes var_dump du mot de passe en clair et du mot de passe haché correspondaient pourtant aux valeurs entrées dans ma db. J'ai d'abord pensé qu'il s'agissait d'un problème lors du hashage ou du dé-hashage du mot de passe, et j'ai enfin découvert que le problème venait de la configuration de ma base de données : ma colonne pwd était un varchar(45) alors que le hachage est bien plus long (60 caractères). J'ai appris qu'il était recommandé d'opter pour un varchar(255) pour stocker un mdo haché en base de donnée.

## Configuration PHP
Dans mon formulaire pour ajouter une nouvelle adresse (méthode POST), je propose d'uploader une image.
J'ai configuré dans mon php.ini la taille maximale d'upload de fichier (3Mo) et la taille maximale des données POST que mon serveur peut accepter (3Mo).

## Raisonnement/ méthodo pour la modification d'une adresse existante 
1- dans le lien "Modifier", insérer un $_GET pour récup l'id de l'adresse à modifier
2- récupérer cet id sur cette page
3- Etablir la connexion à la bdd avec un try catch
4- reprendre le formulaire newAddress
faire en sorte que si aucune donnée n'est entrée dans un champs, alors on conserve la donnée précédemment connue.
5- bouton valider modifie la base de données


## Upload de fichiers
Problèmes de permissions: le dossier uploads dans lequel je cherchais à enregistrer les fichiers avait pour propriétaire root et pour droits d'accès:
En modifiant le propriétaire du dossier (www-data) et les droits (766), l'upload fonctionne.

Vérifier les doublons ?

## Edition/modification d'une adresse
Il manque l'update du fichier uploadé.


## Edition de profil
Pour générer automatiquement un profile_id dans ma table users qui soit identique à l'id de ma table profile, j'ai créé un trigger dans ma table users:
``````
DELIMITER //
CREATE TRIGGER assign_profile_id BEFORE INSERT ON users
FOR EACH ROW
BEGIN
  IF NEW.profile_id IS NULL THEN
    INSERT INTO profiles (id) VALUES (NULL);
    SET NEW.profile_id = LAST_INSERT_ID();
  END IF;
END;
//
DELIMITER ;
```
Modification du mot de passe et des infos personnelles réalisées sur la branch account (mergée dans le main).

## LANDING PAGE 

Ajouter un filtre par catégorie / statut
trier par date d'ajout, la dernière adresse ajoutée en premier
vérifier les chemins relatifs / absolus
si aucune adresse n'est enregistrée, afficher un bouton ajouter une nouvelle addresse
