FROM php:8.2-apache

RUN a2enmod rewrite autoindex

RUN sed -i 's#<Directory /var/www/>#<Directory /var/www/>\n\tAllowOverride All#' /etc/apache2/apache2.conf

RUN docker-php-ext-install pdo_mysql mysqli

COPY . /var/www/html/

RUN echo "=== PHP files in /var/www/html ===" && \ find /var/www/html -type f -name "*.php" -print


EXPOSE 80


