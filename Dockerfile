FROM php:5.6.24-apache

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli

