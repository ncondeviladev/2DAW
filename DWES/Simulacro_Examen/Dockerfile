FROM php:8.5-apache

# Driver de MySQL per a PDO (el veurem al punt 6)
RUN docker-php-ext-install pdo_mysql

# Xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configuració de Xdebug
RUN { \
    echo "xdebug.mode=debug"; \
    echo "xdebug.start_with_request=yes"; \
    echo "xdebug.client_host=host.docker.internal"; \
    echo "xdebug.client_port=9003"; \
} > /usr/local/etc/php/conf.d/xdebug.ini

# Utilitats per a Composer
RUN apt-get update && apt-get install -y unzip git \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Apache serveix la carpeta public/
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf