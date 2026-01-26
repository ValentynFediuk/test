FROM php:8.2-fpm

# Install PostgreSQL PDO driver
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html
COPY . /var/www/html

EXPOSE 9000
CMD ["php-fpm"]