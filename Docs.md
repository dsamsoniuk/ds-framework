# Micro framework CV

### Features:
* authorization system (hash password) bcrypt
* parses
* twig
* PDO
* segregation controllers, services, views, repository
* routing list builder
* csrf secure
* factory template

## run tests
```bash
composer run-script run-test
```

## Install components

Install dependeces of composer:

```bash
composer install
```
## Configuration server

#### VHost - Apache - example

```txt
<VirtualHost *:80>
    ServerName v.test
    DocumentRoot "/var/www/micro-fw/public"
    <Directory /var/www/micro-fw/public>
        Options Indexes FollowSymLinks MultiViews
        AllowOverride All
        Require all granted
    </Directory>

    <FilesMatch \.php$>
        SetHandler "proxy:unix:/var/run/php/php7.2-fpm.sock|fcgi://localhost"
    </FilesMatch>
    ErrorLog /var/www/grev/logs/apache.error.log
    CustomLog /var/www/grev/logs/apache.access.log common
</VirtualHost>
```

### How start - 3 steps

1. Create file controller in src/controller
1. Add route in public/index.php  [routing](How_create_routing.md)
1. Create view in src/views

#### Additionaly

* You can add js, style, images and other things in  ``public/`` directory. 

#### Usage database

I added module https://github.com/FaaPz/PDO you can find there examples how use, here is samplke:
```php

//SELECT
$db = $this->getDatabase();
$selectStatement = $db->select()->from('account')
->where(new Conditional("acct_num", ">", 1))->execute()->fetchAll();

$stmt = $selectStatement->execute();
$data = $stmt->fetch();

// INSERT INTO users ( id , usr , pwd ) VALUES ( ? , ? , ? )
$insertStatement = $pdo->insert(array(
                           "id" =>1234,
                           "usr" => "your_username",
                           "pwd" => "your_password"
                       ))
                       ->into("users");

$insertId = $insertStatement->execute();

// UPDATE users SET pwd = ? WHERE id = ?
$updateStatement = $pdo->update(array("pwd" => "your_new_password"))
                       ->table("users")
                       ->where(new Clause\Conditional("id", "=", 1234));

$affectedRows = $updateStatement->execute();

// DELETE FROM users WHERE id = ?
$deleteStatement = $pdo->delete()
                       ->from("users")
                       ->where(new Clause\Conditional("id", "=", 1234));

$affectedRows = $deleteStatement->execute();

```


TODO:

* add api rest
* create unit tests