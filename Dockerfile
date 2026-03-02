FROM php:8.2-apache

RUN a2enmod rewrite autoindex

COPY . /var/www/html/

RUN echo "=== PHP files in /var/www/html ===" && \ find /var/www/html -type f -name "*.php" -print

EXPOSE 80


