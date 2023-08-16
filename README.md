Server http://172.19.0.5/

php bin/console doctrine:migrations:migrate
php bin/console doctrine:migrations:execute --down 'DoctrineMigrations\Version20230816114050'

