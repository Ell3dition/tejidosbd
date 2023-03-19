FROM php:7.4-apache

# Copia el código fuente de la aplicación a la imagen de Docker
COPY . /var/www/html/

# Instala las dependencias necesarias para la aplicación
# Instala las dependencias necesarias para la aplicación y las extensiones PHP
RUN apt-get update \
 && apt-get install -y \
        libpq-dev \
        && docker-php-ext-install pdo pdo_mysql \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
 && a2enmod rewrite


