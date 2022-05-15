## Requirements

* PHP 7.4
* Composer
* Symfony CLI
* NODEJS + yarn

## Launch develpment environment

composer install or composer update /
yarn install /
symfony server:start

## Add data tests / Fixtures / PHPFaker

symfony console doctrine:fixtures:load

symfony console doctrine:fixtures:load --env=test (test func)

symfony console doctrine:fixtures:load --no-interaction (Ignore questions)

## Tests unitaires

php bin/phpunit /
php bin/phpunit --testdox (more precision)

## Phpstan

composer run-script phpstan

## Check code quality

composer check-all (tests + phpstan)

## Php-cs-fixer / PSR

php-cs-fixer fix src --verbose --rules=@Symfony

## Translation

php bin/console translation:extract --dump-messages fr 
(show all messages that should be translated for FR)

php bin/console translation:extract --force fr
(updates FR files with missing strings)

## Prod

npm run build (before update public_html/build)

git pull (only git pull if Folder Public has no changes)  + FTP for changes in public (i.e: build)

php composer.phar install (if you have changed files for Hostinger)
