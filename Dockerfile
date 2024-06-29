# Usa la imagen base de PHP 8 con Apache
FROM php:8-apache

# Actualiza e instala paquetes necesarios
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# Copia los archivos de configuración de PHP
COPY php.ini /usr/local/etc/php/

# Copia los archivos de tu aplicación al contenedor
COPY backend /var/www/html

# Configura Apache para que apunte al directorio de tu aplicación
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite

# Exponer el puerto 80 para el servidor web Apache
EXPOSE 80

# CMD para iniciar Apache al arrancar el contenedor
CMD ["apache2-foreground"]

