
# ADRIATICANTE

## Requirements
PHP 7.4  
Composer  
Symfony CLI  
NODEJS + yarn  
Launch develpment environment  

## Installation
```bash
composer install 
```
OR

```bash
composer update
```

AND 

```bash
npm install
```
```bash
symfony server:start  
```
## Fixtures

```bash
symfony console doctrine:fixtures:load  
```
```bash
symfony console doctrine:fixtures:load --env=test 
```
(test func)  
```bash
symfony console doctrine:fixtures:load --no-interaction 
```
(Ignore questions)  

## Tests unitaires  

```bash
php bin/phpunit
```

OR

```bash
php bin/phpunit --testdox 
```
(more precision)  

## Phpstan / Php-cs-fixer

```bash
composer run-script phpstan  
```

Check code quality

```bash
composer check-all 
``` 
(tests + phpstan)

Php-cs-fixer / PSR

```bash
php-cs-fixer fix src --verbose --rules=@Symfony
```

## Translation  

```bash
php bin/console translation:extract --dump-messages fr 
```
(show all messages that should be translated for FR)
```bash
php bin/console translation:extract --force fr 
```
(updates FR files with missing strings)

## Prod

```bash
npm run build 
```
(before update public_html/build)

```bash
git pull 
```
(only git pull if Folder Public has no changes) + FTP for changes in public (i.e: build)
```bash
php composer.phar install 
```
(if you have changed files for Hostinger)
