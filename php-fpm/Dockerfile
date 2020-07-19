# php-fpm
FROM php:fpm-alpine

RUN docker-php-ext-install pdo_mysql mysqli

CMD ["php-fpm"]

EXPOSE 9000
