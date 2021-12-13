### About this Repo
This repo is created to address a requirment for a test i had to take while in a recruitment process

### Docker Container
Docker runing Apache PHP-FPM, Redis and MySQL
I checked this repo: https://github.com/evan70/docker-apache-nginx-php-mysql-redis to get docker container prepared.

You just need to install the docker and docker-compose.

- [Install Docker] (https://docs.docker.com/install/)
- [Install Docker Compose] (https://docs.docker.com/compose/install/)

After installing, just open the terminal/powershell with proper privillages where 
`docker-compose.yml` file is, run command.
``
docker-compose build && docker-compose up -d && docker-compose logs -f``

** - d ** means that it will run in the background and your terminal will not be locked and to kill the process just press `CTRL + C` on windows or` Command + C` on mac.

## Configure Redis server

I noticed you may need to edit redis server configurations inside index.php and request.php to avoid any fatal errorss. this ip get changed once you build it.
to find the IP related to redis use this command once docker up and running

``
docker inspect --format='{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' docker-php8-redis
``

## Pre-configurated images

- [Apache2](https://httpd.apache.org/)
- [Redis](https://redis.io/)
- [PHP 8 FPM](https://php.net/)
  - [PHP Modules]
    - bcmath
    - Core
    - ctype
    - curl
    - date
    - dom
    - exif
    - fileinfo
    - filter
    - ftp
    - gd
    - hash
    - iconv
    - intl
    - json
    - libxml
    - mbstring
    - mysqli
    - mysqlnd
    - openssl
    - pcre
    - PDO
    - pdo_mysql
    - pdo_pgsql
    - pdo_sqlite
    - Phar
    - posix
    - rar
    - readline
    - redis
    - Reflection
    - session
    - SimpleXML
    - soap
    - sodium
    - SPL
    - sqlite3
    - standard
    - tokenizer
    - xdebug
    - xml
    - xmlreader
    - xmlwriter
    - xsl
    - Zend OPcache
    - zip
    - zlib

  - [Zend Modules]
    - Xdebug
    - Zend OPcache
