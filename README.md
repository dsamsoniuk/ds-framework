## Micro framework


### htaccess

### VHost
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

TODO:
* routing do zrobienia + przekierowania wszystkie htaccess

