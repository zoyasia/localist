# Localist

Carnet d'adresses en ligne où regrouper ses restaurants, cafés, bars et boutiques préférés, déjà testés ou à découvrir.
Pour conserver vos spots favoris, il vous suffit de vous inscrire en deux temps trois mouvements. 
Il est possible d’enrichir son profil d’un pseudo, d’une bio et de sa ville de résidence, de modifier et supprimer son compte.



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
Lors de l’ajout d’une adresse, vous êtes invité à renseigner son nom, sa localisation, sa catégorie et son statut, et vous êtes libre de renseigner un commentaire à son sujet, un numéro de téléphone, un site, et de télécharger une photo d’illustration. 
LEs informations d’une adresse peuvent être mises à jour (changer d’avis, changer de statut par exemple), une adresse peut également être supprimée.

Il manque l'update de fichier.


## Edition de profil
Il est possible d’enrichir son profil d’un pseudo, d’une bio et de sa ville de résidence, de modifier et supprimer son compte.

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

Lorsque le client se connecte, j’ai souhaité intégrer un filtre à sa page d’accueil pour gérer l’affichage de ses adresses enregistrées: voir tout, ou seulement les adresses triées par catégories.
J’ai eu des difficultés au départ dans cet affichage car il y avait un conflit entre ma fonction getAllCategories et ma fonction getAddresses. getAllCategories prenait le pas sur la seconde, et faisait apparaître toutes les adresses d’une catégorie, même celles qui n’étaient pas reliées à l’utilisateur connecté.
J’ai trouvé un cas assez proche sur StackOverFlow qui préconisait de stocker dans une variable $params un tableau de paramètres à prendre en compte dans la requête:

```
$sql = "SELECT * FROM addresses WHERE user_id = ?";
if ($selectedCategory) {
  $sql .= " AND category_id = ?";
}
$stmt = $pdo->prepare($sql);
$params = [$user_id];


if ($selectedCategory) {
  $params[] = $selectedCategory;
}

```

Si aucune adresse n'est enregistrée (dans toute la table addresses, ou dans une catégorie), j’affiche un bouton “ajouter une nouvelle adresse”.

Améliorations envisagées:
trier par date d'ajout, du plus récent au plus ancien, le dernier id d'adresse enregistré apparaîtrait alors en premier dans la liste.
vérifier les chemins relatifs / absolus.




