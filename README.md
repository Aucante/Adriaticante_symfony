## Requirements

* PHP 7.4
* Composer
* Symfony CLI
* NODEJS + yarn

## Launch develpment environment

composer install or composer update
yarn install
symfony server:start

## Add data tests / Fixtures / PHPFaker

symfony console doctrine:fixtures/load

## Tests unitaires

php bin/phpunit
php bin/phpunit --testdox 

