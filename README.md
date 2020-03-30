Pour lancer ce monitoring (projet Symfony) :

* Dézipper le projet dans le dossier concerné

* Lancer composer install
* Modifier le .env pour mettre les bons identifiants de bdd

* Créer la BDD => bin/console doctrine:database:create
* Mettre à jour la BDD => bin/console doctrine:schema:update --force

* Lancer la commande de création de la fixture => bin/console app:create-fixture

* Lancer le serveur => symfony serve -d