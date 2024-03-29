## Générateur de liens de paiement MTN MOMO Bénin

Ce projet Laravel est une application de génération de liens de paiement MTN MOMO Bénin, conçue pour simplifier le processus de paiement en ligne pour les utilisateurs et les administrateurs. L'application permet aux utilisateurs de générer des liens de paiement personnalisés pour leurs clients, de collecter des informations supplémentaires lors du paiement et de suivre toutes les transactions effectuées.

### Fonctionnalités principales :

- **Génération de liens de paiement personnalisés :** Les utilisateurs peuvent créer des liens de paiement spécifiques pour chaque client en fournissant des informations telles que le nom, le prénom, le montant à payer, les services offerts et une brève description.
  
- **Tableau de bord administratif :** L'administration peut gérer les transactions et les utilisateurs via un tableau de bord sécurisé. Les fonctionnalités incluent la visualisation de toutes les transactions avec des détails complets, la recharge des transactions pour obtenir des mises à jour de statut, la création de nouveaux administrateurs, et plus encore.

- **Suivi des transactions :** Les administrateurs peuvent consulter toutes les transactions avec des informations détaillées telles que le nom du client, le montant, la plateforme de paiement, le numéro de téléphone, la date de paiement, le statut de la transaction, etc.

### Technologies utilisées :

- Laravel
- PHP
- HTML/CSS/JS/JQuery
- MySQL

### Comment démarrer :

1. **Installation des dépendances :** Clonez ce dépôt et installez les dépendances en utilisant Composer :

   ```bash
   git clone https://github.com/votre-utilisateur/nom-depot.git
   cd nom-depot
   composer install
   ```

2. **Configuration de l'environnement :** Copiez le fichier `.env.example` en `.env` et configurez les variables d'environnement, notamment la base de données et les informations d'authentification.

3. **Migration de la base de données :** Exécutez les migrations pour créer les tables nécessaires dans la base de données :

   ```bash
   php artisan migrate
   ```

4. **Création d'administrateur**

```bash
php artisan db:seed --class=AdminSeeder
```

L'administrateur a pour username : admin et mot de passe : admin

5. **Démarrage du serveur :** Lancez le serveur Laravel pour accéder à l'application dans votre navigateur :

   ```bash
   php artisan serve
   ```

6. **Accès au tableau de bord :** Connectez-vous en tant qu'administrateur pour accéder au tableau de bord et commencer à gérer les transactions et les utilisateurs.

### Configuration des clés API :

Pour que l'application fonctionne correctement, vous devez remplacer les valeurs par défaut dans le fichier `CollectionKeyController.php` avec vos propres clés API. Voici comment procéder :

1. Ouvrez le fichier `App\Http\Controllers\Component\CollectionKeyController.php` dans votre éditeur de code.

2. Remplacez les valeurs par défaut par vos vraies valeurs dans les fonctions `ApiUser()`, `ApiKey()` et `Ocp_Apim_Subscription_Key()`.

   ```php
   public static function ApiUser(){
       $apiUser = "VOTRE UTILISATEUR API";
   
       return $apiUser;
   }
   
   public static function ApiKey(){
       $apiKey = "VOTRE CLÉ API";
   
       return $apiKey;
   }
   
   public static function Ocp_Apim_Subscription_Key(){
       $primary = "VOTRE CLÉ PRIMAIRE";
       $secondary = "VOTRE CLÉ SECONDAIRE";
   
       $keys = array($primary,$secondary);
       $i = rand(0, count($keys)-1);
       return $keys[$i];
   }
   ```

3. Enregistrez les modifications apportées au fichier `CollectionKeyController.php`.