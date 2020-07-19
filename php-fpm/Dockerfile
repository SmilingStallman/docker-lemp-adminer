# php-fpm
FROM php:fpm-alpine

RUN docker-php-ext-install pdo_mysql mysqli

CMD ["php-fpm", "-c", "/usr/local/etc/php/php_no_errors.ini"]

EXPOSE 9000
