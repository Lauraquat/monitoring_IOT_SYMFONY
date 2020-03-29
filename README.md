composer install

modifier le .env pour mettre les bon credentials de bdd

bin/console doctrine:database:create
bin/console doctrine:schema:update --force

bin/console app:create-fixture

symfony serve -d