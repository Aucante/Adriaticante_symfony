
# ADRIATICANTE

## Requirements
PHP 7.4  
Composer  
Symfony CLI  
NODEJS + yarn  
Launch develpment environment  

## Installation

### Clone project (HTTPS)
```bash
git clone https://github.com/Aucante/Adriaticante_symfony.git
```
or

Clone project (SSH)
```bash
git clone git@github.com:Aucante/Adriaticante_symfony.git
```

### Update dependencies

```bash
composer install 
```
and

```bash
npm install
```

### Manage database

Create BDD - Créer BDD

```bash
  php bin/console doctrine:database:create
```

Migrate BDD - Migrer BDD

```bash
  php bin/console make:migration
```

```bash
  php bin/console doctrine:migrations:migrate
```

### Fixtures

```bash
symfony console doctrine:fixtures:load  
```
Fixtures for functionnal test database
```bash
symfony console doctrine:fixtures:load --env=test 
```

If you want ignore questions
```bash
symfony console doctrine:fixtures:load --no-interaction 
```

### Launch symfony server
```bash
symfony server:start  
```


## Unit and functionnal tests 

```bash
php bin/phpunit
```

or

for more precisions
```bash
php bin/phpunit --testdox 
```

## Phpstan / Php-cs-fixer

```bash
composer run-script phpstan  
```

Check code quality

Run tests with phpunit and phpstan 
```bash
composer check-all 
``` 

Php-cs-fixer / PSR

```bash
php-cs-fixer fix src --verbose --rules=@Symfony
```

## Translation  

For show all messages that should be translated for FR
```bash
php bin/console translation:extract --dump-messages fr 
```

For updates FR files with missing strings
```bash
php bin/console translation:extract --force fr 
```

## Prod

Run it before updating public_html/build
```bash
npm run build 
```

Use it if  public folder has no changes + FTP for changes in public (i.e: build)
```bash
git pull 
```
Use it if you have changed files for Hostinger
```bash
php composer.phar install 
```
